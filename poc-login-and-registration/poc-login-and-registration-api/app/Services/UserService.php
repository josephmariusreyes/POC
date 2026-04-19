<?php

namespace App\Services;

use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Storage;

/**
 * User Service implementation that uses JSON file as data source.
 * This service handles all user-related operations.
 */
class UserService implements UserServiceInterface
{
    /**
     * Path to the JSON data file.
     */
    private string $dataFilePath = 'data/admin-users.json';

    /**
     * Get all users from the JSON file.
     *
     * @return array
     */
    public function getAllUsers(): array
    {
        return $this->readDataFile();
    }

    /**
     * Find a user by their ID.
     *
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $users = $this->readDataFile();

        foreach ($users as $user) {
            if ($user['id'] === $id) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Find a user by their username.
     *
     * @param string $username
     * @return array|null
     */
    public function findByUsername(string $username): ?array
    {
        $users = $this->readDataFile();

        foreach ($users as $user) {
            if (strtolower($user['username']) === strtolower($username)) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Register a new user.
     *
     * @param array $userData
     * @return array
     * @throws \Exception
     */
    public function registerUser(array $userData): array
    {
        $users = $this->readDataFile();

        // Check if username already exists
        foreach ($users as $user) {
            if (strtolower($user['username']) === strtolower($userData['username'])) {
                throw new \Exception('Username already exists');
            }
        }

        // Generate new ID
        $maxId = 0;
        foreach ($users as $user) {
            if ($user['id'] > $maxId) {
                $maxId = $user['id'];
            }
        }

        // Create new user
        $newUser = [
            'id' => $maxId + 1,
            'username' => $userData['username'],
            'password' => $userData['password'],
            'fullname' => $userData['fullname'],
            'contactNumber' => $userData['contactNumber'] ?? '',
            'role' => $userData['role'] ?? 'admin',
        ];

        // Add to users array
        $users[] = $newUser;

        // Save to file
        $this->writeDataFile($users);

        // Return user without password
        return $this->sanitizeUser($newUser);
    }

    /**
     * Validate user credentials for login.
     *
     * @param string $username
     * @param string $password
     * @return array|null Returns sanitized user data if valid, null otherwise
     */
    public function validateCredentials(string $username, string $password): ?array
    {
        $user = $this->findByUsername($username);

        if ($user && $user['password'] === $password) {
            return $this->sanitizeUser($user);
        }

        return null;
    }

    /**
     * Read and parse the JSON data file.
     *
     * @return array
     */
    private function readDataFile(): array
    {
        if (!Storage::disk('local')->exists($this->dataFilePath)) {
            return [];
        }

        $content = Storage::disk('local')->get($this->dataFilePath);
        return json_decode($content, true) ?? [];
    }

    /**
     * Write data to the JSON file.
     *
     * @param array $data
     * @return void
     */
    private function writeDataFile(array $data): void
    {
        $content = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        Storage::disk('local')->put($this->dataFilePath, $content);
    }

    /**
     * Remove sensitive data from user array.
     *
     * @param array $user
     * @return array
     */
    private function sanitizeUser(array $user): array
    {
        unset($user['password']);
        return $user;
    }
}
