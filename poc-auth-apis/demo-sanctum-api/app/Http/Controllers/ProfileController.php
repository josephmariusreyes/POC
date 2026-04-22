<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetUserDetailsRequest;
use App\Http\Requests\CreateUpdateUserRequest;
use App\DTO\CreateUserDto;

use App\Services\UserService\IUserService;

class ProfileController extends Controller
{
	private IUserService $userService;

	public function __construct(IUserService $userService)
	{
		$this->userService = $userService;
	}
    public function getUserDetails(GetUserDetailsRequest $request)
	{
		$validated = $request->validated();
        return response()->json($this->userService->getUserById($validated['id']));
	}

	public function getAllUsers()
	{
		return response()->json($this->userService->getAllUser());
	}

	public function createUser(CreateUpdateUserRequest $request)
	{
		$validated = $request->validated();
		$createdUserDto = new CreateUserDto(
			name: $validated['name'],
			email: $validated['email'],
			password: $validated['password'],
		);

		return response()->json($this->userService->createUser($createdUserDto));
	}

	public function updateUser(CreateUpdateUserRequest $request)
	{
		$validated = $request->validated();
		$updateUserDto = new CreateUserDto(
			name: $validated['name'],
			email: $validated['email'],
			password: $validated['password'],
		);
		$updatedUser = $this->userService->updateUser($validated['id'], $updateUserDto);
		return response()->json($updatedUser);
	}

	public function deleteUser(int $id)
	{
		$result = $this->userService->deleteUser($id);
		return response()->json(['success' => $result]);
	}
}
