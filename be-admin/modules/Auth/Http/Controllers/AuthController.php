<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\UnauthorizedException;
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

        return $this->jsonResponse(array_merge((new UserResource($user))->toArray(null), ['token' => $token]), Response::HTTP_OK);
    }
}
