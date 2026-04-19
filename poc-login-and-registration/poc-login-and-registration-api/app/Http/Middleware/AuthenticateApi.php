<?php

namespace App\Http\Middleware;

use App\Services\Contracts\UserServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware to authenticate requests using Bearer tokens.
 * This simulates Sanctum-like authentication for demonstration purposes.
 */
class AuthenticateApi
{
    public function __construct(
        private UserServiceInterface $userService
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string ...$roles Optional roles required to access the route
     * @return Response
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication required',
            ], 401);
        }

        // Decode the token
        $tokenData = $this->decodeToken($token);

        if (!$tokenData) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token',
            ], 401);
        }

        // Check if token is expired
        if (isset($tokenData['exp']) && $tokenData['exp'] < time()) {
            return response()->json([
                'success' => false,
                'message' => 'Token expired',
            ], 401);
        }

        // Get user from data source
        $user = $this->userService->findById($tokenData['user_id']);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 401);
        }

        // Check role permissions if roles are specified
        if (!empty($roles) && !in_array($user['role'], $roles)) {
            return response()->json([
                'success' => false,
                'message' => 'Access denied. Insufficient permissions.',
            ], 403);
        }

        // Sanitize user (remove password) and attach to request
        unset($user['password']);
        $request->attributes->set('user', $user);

        return $next($request);
    }

    /**
     * Decode the Bearer token.
     *
     * @param string $token
     * @return array|null
     */
    private function decodeToken(string $token): ?array
    {
        try {
            $decoded = base64_decode($token);
            return json_decode($decoded, true);
        } catch (\Exception $e) {
            return null;
        }
    }
}
