<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
	public function login(LoginRequest $request): JsonResponse
	{
		$credentials = $request->validated();

		$user = User::where('email', $credentials['email'])->first();

		if (! $user || ! Hash::check($credentials['password'], $user->password)) {
			return response()->json([
				'message' => 'The provided credentials are incorrect.',
			], 401);
		}

		$tokenName = $credentials['device_name'] ?? 'api-token';
		$token = $user->createToken($tokenName)->plainTextToken;

		return response()->json([
			'message' => 'Login successful.',
			'token' => $token,
			'user' => $user,
		]);
	}

	public function logout(Request $request): JsonResponse
	{
		$request->user()->currentAccessToken()?->delete();

		return response()->json([
			'message' => 'Logout successful.',
		]);
	}
}
