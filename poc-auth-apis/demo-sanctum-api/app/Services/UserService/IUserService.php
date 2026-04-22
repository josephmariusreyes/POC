<?php

namespace App\Services\UserService;
use App\DTO\CreateUserDto;
use App\DTO\UpdateUserDto;
use App\Models\User;

interface IUserService
{
    public function createUser(CreateUserDto $createUserDto): User;
    public function updateUser(UpdateUserDto $updateUserDto): User;
    public function deleteUser(int $id);
    public function getUserById(int $id);
    public function getAllUser();
}
