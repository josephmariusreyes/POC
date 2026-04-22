<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GetUserDetailsRequest;

class ProfileController extends Controller
{
    public function getUserDetails(GetUserDetailsRequest $request)
	{
		       // You can access validated data via $request->validated() if rules are defined
		       // Example: $data = $request->validated();
		       return "getUserDetails Temp Response";
	}

	public function getAllUsers()
	{
		return "getAllUsers Temp Response";
	}

	public function createUser(Request $request)
	{
		return "createUser Temp Response";
	}

	public function updateUser(Request $request, int $id)
	{
		return "updateUser Temp Response";
	}

	public function deleteUser(int $id)
	{
		return "deleteUser Temp Response";
	}
}
