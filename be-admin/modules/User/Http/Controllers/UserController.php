<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\User\Services\Contracts\UserServiceInterface;

class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
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
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'is_active' => 'required|boolean'
        ])->validate();

        return $this->jsonResponse($this->userService->create($request->all()), Response::HTTP_OK);
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
            'email' => 'email',
            'phone_number' => 'string',
            'is_active' => 'boolean'
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
