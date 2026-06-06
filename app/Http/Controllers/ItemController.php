<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemService;
use Exception;
use App\Http\Controllers\Api\BaseController; // Telah mengimpor BaseController 
use Illuminate\Http\JsonResponse;

class ItemController extends BaseController // Telah extend BaseController [cite: 102]
{
    protected ItemService $svc;

    // Inject ItemService melalui Constructor [cite: 106]
    public function __construct(ItemService $svc)
    {
        $this->svc = $svc;
        // Middleware auth:sanctum sebaiknya dilepas dari sini karena sudah ditangani oleh routes/api.php 
    }

    public function index(): JsonResponse
    {
        // Menggunakan standard response wrapper [cite: 109]
        return $this->success($this->svc->all(), 'Berhasil menarik semua data Item');
    }

    public function store(StoreItemRequest $req): JsonResponse
    {
        $item = $this->svc->create($req->validated());

        // PERBAIKAN: Menghapus sisa array bracket yang menyebabkan error 
        return $this->success($item, 'Item berhasil dibuat', 201);
    }

    public function show($id): JsonResponse
    {
        try {
            $item = $this->svc->find($id);
            return $this->success($item, 'Berhasil menarik satu data Item'); // [cite: 117]
        } catch (Exception $e) {
            // Mengembalikan error response 404 jika item tidak ditemukan [cite: 119]
            return $this->error($e->getMessage(), 404);
        }
    }

    public function update(UpdateItemRequest $req, $id): JsonResponse
    {
        $item = $this->svc->update($id, $req->validated());

        return $this->success($item, 'Item berhasil diperbarui'); // [cite: 123, 125]
    }

    public function destroy($id): JsonResponse
    {
        $this->svc->delete($id);

        // Mengembalikan response kosong dengan status code 204 No Content 
        return $this->success(null, 'Item berhasil dihapus', 204);
    }
}