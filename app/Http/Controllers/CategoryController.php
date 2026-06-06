<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use App\Http\Controllers\Api\BaseController; // 1. Import BaseController sesuai modul
use Exception;

class CategoryController extends BaseController // 2. Ubah extend ke BaseController
{
    protected CategoryService $svc;

    // Inject CategoryService melalui Constructor
    public function __construct(CategoryService $svc)
    {
        $this->svc = $svc;
    }

    public function index()
    {
        // 3. Gunakan $this->success() untuk response wrapper yang konsisten
        return $this->success($this->svc->all(), 'Berhasil menarik semua data Kategori'); 
    }

    public function store(StoreCategoryRequest $req)
    {
        $cat = $this->svc->create($req->validated());
        // 4. Berikan parameter status code 201 untuk data Created
        return $this->success($cat, "Kategori dibuat", 201); 
    }

    public function show($id)
    {
        try {
            $cat = $this->svc->find($id);
            return $this->success($cat, 'Berhasil menarik satu data kategori');
        } catch (Exception $e) {
            // 5. Gunakan $this->error() jika terjadi exception (404 Not Found)
            return $this->error($e->getMessage(), 404); 
        }
    }

    public function update(UpdateCategoryRequest $req, $id)
    {
        $cat = $this->svc->update($id, $req->validated());
        return $this->success($cat, "Kategori diperbarui");
    }

    public function destroy($id)
    {
        $this->svc->delete($id);
        // 6. Berikan parameter null dan status code 204 untuk No Content
        return $this->success(null, "Kategori dihapus", 204); 
    }
}