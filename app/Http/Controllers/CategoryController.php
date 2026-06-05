<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected CategoryService $svc;

    public function __construct(CategoryService $svc)
    {
        $this->svc = $svc;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->svc->all(),
            'message' => 'Berhasil menarik semua data Kategori'
        ]);
    }

    public function store(StoreCategoryRequest $req): JsonResponse
    {
        $cat = $this->svc->create($req->validated());

        return response()->json([
            'status' => 'success',
            'data' => $cat,
            'message' => 'Kategori berhasil dibuat'
        ], 201);
    }

    public function show($id): JsonResponse
    {
        try {
            $cat = $this->svc->find($id);

            return response()->json([
                'status' => 'success',
                'data' => $cat,
                'message' => 'Berhasil menarik satu data kategori'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }
    }

    public function update(UpdateCategoryRequest $req, $id): JsonResponse
    {
        try {
            $cat = $this->svc->update($id, $req->validated());

            return response()->json([
                'status' => 'success',
                'data' => $cat,
                'message' => 'Kategori berhasil diperbarui'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->svc->delete($id);

            return response()->json([
                'status' => 'success',
                'data' => null,
                'message' => 'Kategori berhasil dihapus'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }
    }
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return response()->json($category, 201);
    }

    public function show(string $id)
    {
        return Category::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $category->update($request->all());

        return response()->json($category);
    }

    public function destroy(string $id)
    {
        Category::destroy($id);

        return response()->json([
            'message' => 'Category deleted'
        ]);
    }
}