<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Controller for handling user authentication and registration.
 * Uses stateless token-based authentication (Sanctum-like pattern without DB).
 * 
 * NOTE: Real Sanctum requires a database for token storage.
 * This POC uses stateless base64-encoded tokens instead.
 */
class UserController extends Controller
{
    public function __construct(
        private UserServiceInterface $userService
    ) {}

    /**
     * Register a new user.
     * Only accessible by admin and superAdmin roles.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function registerUser(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string|min:3|max:50',
                'password' => 'required|string|min:6',
                'fullname' => 'required|string|max:100',
                'contactNumber' => 'nullable|string|max:20',
                'role' => 'required|string|in:admin,superAdmin',
            ]);

            $user = $this->userService->registerUser($validated);

            return response()->json([
                'success' => true,
                'message' => 'User registered successfully',
                'data' => $user,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Login a user.
     * Returns user data and stateless token on successful authentication.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function loginUser(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = $this->userService->validateCredentials(
                $validated['username'],
                $validated['password']
            );

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials',
                ], 401);
            }

            // Generate stateless token (Sanctum-like pattern without DB)
            // In production Sanctum, this would be: $user->createToken('auth-token')->plainTextToken
            $token = $this->generateToken($user);

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Get the current authenticated user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        $user = $request->attributes->get('user');

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Not authenticated',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    /**
     * Logout the current user.
     * In real Sanctum: $request->user()->currentAccessToken()->delete()
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // Stateless tokens don't need server-side revocation
        // Client should discard the token
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Generate a stateless token for the user.
     * This simulates Sanctum's createToken() without database storage.
     *
     * @param array $user
     * @return string
     */
    private function generateToken(array $user): string
    {
        $payload = [
            'user_id' => $user['id'],
            'role' => $user['role'],
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24), // 24 hours
        ];

        return base64_encode(json_encode($payload));
    }
}
