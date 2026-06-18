<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemService;
use Exception;
use App\Http\Controllers\Api\BaseController; 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request; // Diperlukan untuk mengambil query parameter

class ItemController extends BaseController 
{
    protected ItemService $svc;

    // Inject ItemService melalui Constructor
    public function __construct(ItemService $svc)
    {
        $this->svc = $svc;
    }

    public function index(Request $request): JsonResponse
    {
        // Ambil query parameter 'category_id' dari URL Postman
        $categoryId = $request->query('category_id');

        // Jika user mengirimkan category_id, lakukan filter melalui service/model
        if ($categoryId) {
            // Memanggil filter kategori (Pastikan method 'allByFormat' atau filter Anda di service sudah sesuai)
            $items = $this->svc->all()->where('category_id', $categoryId)->values();
        } else {
            // Jika tidak ada parameter, tarik semua data item
            $items = $this->svc->all();
        }

        return $this->success($items, 'Berhasil menarik data Item');
    }

    public function store(StoreItemRequest $req): JsonResponse
    {
        $item = $this->svc->create($req->validated());
        return $this->success($item, 'Item berhasil dibuat', 201);
    }

    public function show($id): JsonResponse
    {
        try {
            $item = $this->svc->find($id);
            return $this->success($item, 'Berhasil menarik satu data Item'); 
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function update(UpdateItemRequest $req, $id): JsonResponse
    {
        $item = $this->svc->update($id, $req->validated());
        return $this->success($item, 'Item berhasil diperbarui'); 
    }

    public function destroy($id): JsonResponse
    {
        $this->svc->delete($id);
        return $this->success(null, 'Item berhasil dihapus', 204);
    }
}