<?php
namespace App\Services\UserService;
use App\Models\User;
use App\DTO\CreateUserDto;
use App\DTO\UpdateUserDto;

// all methods in this service will do CRUD on the userModel
class UserService implements IUserService
{
    public function createUser(CreateUserDto $createUserDto): User
    {
        return User::create([
            'name' => $createUserDto->name,
            'email' => $createUserDto->email,
            'password' => $createUserDto->password,
        ]);
    }

    public function updateUser(UpdateUserDto $updateUserDto): User
    {
        $user = User::findOrFail($updateUserDto->id);
        $user->update($updateUserDto->toArray());
        return $user->refresh();
    }

    public function deleteUser(int $id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    public function getUserById(int $id)
    {
        return User::find($id);
    }

    public function getAllUser()
    {
        return User::all();
    }
}
