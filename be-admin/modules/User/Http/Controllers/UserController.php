<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\User\Entities\User;
use Modules\User\Services\Contracts\UserServiceInterface;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     *
     */
    private function checkIsRoleExist($attribute, $value, $fail)
    {
        try {
            !Role::findByName($value);
        } catch (\Exception $e) {
            $fail("The $attribute $value is not exist.");
        }
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse($this->userService->index(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        Validator::make($request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|email|unique:' . User::TABLE . ',email',
            'password' => 'required|min:6',
            'phone_number' => 'required|string',
            'is_active' => 'required|boolean',
            'role' => ['string', fn (...$args) => $this->checkIsRoleExist(...$args)]
        ])->validate();

        $encryptedPassword = app('hash')->make($request->input('password'));

        $user = $this->userService->create(array_merge(
            $request->all(),
            ['password' => $encryptedPassword]
        ));

        $token = $user->createToken('api-token')->accessToken;

        return $this->jsonResponse(['token' => $token], Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->jsonResponse($this->userService->show($id), Response::HTTP_OK);
    }



    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id): JsonResponse
    {
        Validator::make($request->all(), [
            'full_name' => 'string',
            'email' => 'email|unique:' . User::TABLE . ',email,' . $id,
            'phone_number' => 'string',
            'is_active' => 'boolean',
            'role' => ['string', fn (...$args) => $this->checkIsRoleExist(...$args)]
        ])->validate();

        return $this->jsonResponse($this->userService->update($request->all(), $id), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id): JsonResponse
    {
        return $this->jsonResponse($this->userService->delete($id), Response::HTTP_OK);
    }
}
