<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemService;
use Exception;
<<<<<<< HEAD
=======
use App\Http\Controllers\Api\BaseController; // Telah mengimpor BaseController 
>>>>>>> 1b222980c6ed6bd6c754b3ea762dfe7c271a7d81
use Illuminate\Http\JsonResponse;

class ItemController extends BaseController // Telah extend BaseController [cite: 102]
{
    protected ItemService $svc;

<<<<<<< HEAD
    // Inject ItemService melalui Constructor
    public function __construct(ItemService $svc)
    {
        $this->svc = $svc;
=======
    // Inject ItemService melalui Constructor [cite: 106]
    public function __construct(ItemService $svc)
    {
        $this->svc = $svc;
        // Middleware auth:sanctum sebaiknya dilepas dari sini karena sudah ditangani oleh routes/api.php 
>>>>>>> 1b222980c6ed6bd6c754b3ea762dfe7c271a7d81
    }

    public function index(): JsonResponse
    {
<<<<<<< HEAD
        return response()->json([
            'status' => 'success',
            'data' => $this->svc->all(),
            'message' => 'Berhasil menarik semua data Item'
        ]);
=======
        // Menggunakan standard response wrapper [cite: 109]
        return $this->success($this->svc->all(), 'Berhasil menarik semua data Item');
>>>>>>> 1b222980c6ed6bd6c754b3ea762dfe7c271a7d81
    }

    public function store(StoreItemRequest $req): JsonResponse
    {
        $item = $this->svc->create($req->validated());
<<<<<<< HEAD
        return response()->json([
            'status' => 'success',
            'data' => $item,
            'message' => 'Item berhasil dibuat'
        ], 201);
=======

        // PERBAIKAN: Menghapus sisa array bracket yang menyebabkan error 
        return $this->success($item, 'Item berhasil dibuat', 201);
>>>>>>> 1b222980c6ed6bd6c754b3ea762dfe7c271a7d81
    }

    public function show($id): JsonResponse
    {
        try {
            $item = $this->svc->find($id);
<<<<<<< HEAD
            return response()->json([
                'status' => 'success',
                'data' => $item,
                'message' => 'Berhasil menarik satu data Item'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 404);
=======
            return $this->success($item, 'Berhasil menarik satu data Item'); // [cite: 117]
        } catch (Exception $e) {
            // Mengembalikan error response 404 jika item tidak ditemukan [cite: 119]
            return $this->error($e->getMessage(), 404);
>>>>>>> 1b222980c6ed6bd6c754b3ea762dfe7c271a7d81
        }
    }

    public function update(UpdateItemRequest $req, $id): JsonResponse
    {
        $item = $this->svc->update($id, $req->validated());
<<<<<<< HEAD
        return response()->json([
            'status' => 'success',
            'data' => $item,
            'message' => 'Item berhasil diperbarui'
        ]);
=======

        return $this->success($item, 'Item berhasil diperbarui'); // [cite: 123, 125]
>>>>>>> 1b222980c6ed6bd6c754b3ea762dfe7c271a7d81
    }

    public function destroy($id): JsonResponse
    {
        $this->svc->delete($id);
<<<<<<< HEAD
        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => 'Item berhasil dihapus'
        ]);
=======

        // Mengembalikan response kosong dengan status code 204 No Content 
        return $this->success(null, 'Item berhasil dihapus', 204);
>>>>>>> 1b222980c6ed6bd6c754b3ea762dfe7c271a7d81
    }
}