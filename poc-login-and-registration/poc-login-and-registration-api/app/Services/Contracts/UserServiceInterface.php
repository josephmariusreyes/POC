<?php

namespace App\Services\Contracts;

/**
 * Interface for User Service operations.
 * Defines the contract for user data management.
 */
interface UserServiceInterface
{
    /**
     * Get all users from the data source.
     *
     * @return array
     */
    public function getAllUsers(): array;

    /**
     * Find a user by their ID.
     *
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array;

    /**
     * Find a user by their username.
     *
     * @param string $username
     * @return array|null
     */
    public function findByUsername(string $username): ?array;

    /**
     * Register a new user.
     *
     * @param array $userData
     * @return array
     */
    public function registerUser(array $userData): array;

    /**
     * Validate user credentials for login.
     *
     * @param string $username
     * @param string $password
     * @return array|null Returns user data if valid, null otherwise
     */
    public function validateCredentials(string $username, string $password): ?array;
}
