<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Modules\Product\Services\Contracts\ProductServiceInterface;

class ProductController extends Controller
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     *
     */
    private function storeImage(UploadedFile $requestImage, string $path)
    {
        $imageName = $requestImage->getClientOriginalName();
        $imageName = uniqid() . '-' . $imageName;

        $destinationPath = app()->basePath() . '/public/' . $path;

        $requestImage->move($destinationPath, $imageName);

        return $path . '/' . $imageName;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse($this->productService->index(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048'
        ])->validate();

        $imagePath = $this->storeImage($request->file('image'), 'img/products');

        $input = array_merge($request->all(), ['image' => $imagePath]);

        return $this->jsonResponse($this->productService->create($input), Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->jsonResponse($this->productService->show($id), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        Validator::make($request->all(), [
            'name' => 'string',
            'price' => 'numeric',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ])->validate();

        $input = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $this->storeImage($request->file('image'), 'img/products');

            $input = array_merge($request->all(), ['image' => $imagePath]);
        }

        return $this->jsonResponse($this->productService->update($input, $id), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->jsonResponse($this->productService->delete($id), Response::HTTP_OK);
    }
}
