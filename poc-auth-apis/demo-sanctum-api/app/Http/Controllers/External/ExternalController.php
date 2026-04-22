<?php

namespace App\Http\Controllers\external;

use App\Http\Controllers\Controller;

// this is just for segragating the externally accessed controllers
class ExternalController extends Controller
{
	public function getUserDetails(int $id)
	{
		return "External getUserDetails Temp Response";
	}

	public function getAllUsers()
	{
		return "External getAllUsers Temp Response";
	}
}
