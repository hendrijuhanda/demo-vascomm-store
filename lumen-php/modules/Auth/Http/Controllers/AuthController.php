<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\UnauthorizedException;
use Modules\User\Entities\Contracts\UserInterface;
use Modules\User\Http\Controllers\UserController;
use Modules\User\Http\Resources\UserResource;

class AuthController extends UserController
{
    /**
     * Log user in.
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        Validator::make($request->all(), [
            'email_or_phone' => 'required',
            'password' => 'required'
        ])->validate();

        $user = $this->userService->authenticate($request->input('email_or_phone'), $request->input('password'));

        if (!$user) {
            throw new UnauthorizedException('Unauthorized.');
        }

        $token = $user->createToken('api-token')->accessToken;

        return $this->jsonResponse(
            array_merge(
                (new UserResource($user))->toArray(null),
                ['token' => $token]
            ),
            Response::HTTP_OK
        );
    }

    /**
     * Get current authenticated user data.
     * @return JsonResponse
     */
    public function authenticate(): JsonResponse
    {
        $user = Auth::user();

        return $this->jsonResponse(new UserResource($user), Response::HTTP_OK);
    }

    /**
     * Register user.
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        Validator::make($request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|email|unique:' . UserInterface::TABLE . ',email',
            'phone_number' => 'required|string|unique:' . UserInterface::TABLE . ',phone_number',
        ])->validate();

        $this->userService->register($request->all());

        return $this->jsonResponse(null, Response::HTTP_OK, 'User resgistration is success! Please check your email.');
    }

    /**
     * Register user.
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $isRevoked = false;

        $user = $request->user();

        if ($user) {
            $token = $user->token();

            $token->revoke();

            $isRevoked = true;
        }

        return $this->jsonResponse(
            null,
            Response::HTTP_OK,
            $isRevoked ? 'Logged out successfully.' : "You don't have active session! You can safely ignore this notice."
        );
    }
}
