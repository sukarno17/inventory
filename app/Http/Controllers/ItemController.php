<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemService;
use Exception;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    protected ItemService $svc;


    public function __construct(ItemService $svc)
    {
        $this->svc = $svc;
    }


    /**
     * GET /api/v1/items
     * GET /api/v1/items?category_id={id}
     */
    public function index(Request $request): JsonResponse
    {
        $items = $this->svc->all();

        // Filter berdasarkan category_id
        if ($request->filled('category_id')) {

            $items = $items->filter(function ($item) use ($request) {

                return $item->category_id == $request->category_id;

            });

        }


        return $this->success(
            $items->values(),
            'Berhasil menarik data Item'
        );
    }



    /**
     * POST /api/v1/items
     */
    public function store(StoreItemRequest $req): JsonResponse
    {
        $item = $this->svc->create(
            $req->validated()
        );


        return $this->success(
            $item,
            'Item berhasil dibuat',
            201
        );
    }



    /**
     * GET /api/v1/items/{id}
     */
    public function show($id): JsonResponse
    {
        try {

            $item = $this->svc->find($id);


            return $this->success(
                $item,
                'Berhasil menarik satu data Item'
            );


        } catch (Exception $e) {


            return $this->error(
                $e->getMessage(),
                404
            );

        }
    }




    /**
     * PUT /api/v1/items/{id}
     */
    public function update(
        UpdateItemRequest $req,
        $id
    ): JsonResponse {


        $item = $this->svc->update(
            $id,
            $req->validated()
        );


        return $this->success(
            $item,
            'Item berhasil diperbarui'
        );

    }





    /**
     * DELETE /api/v1/items/{id}
     */
    public function destroy($id): JsonResponse
    {

        $this->svc->delete($id);


        return $this->success(
            null,
            'Item berhasil dihapus',
            204
        );

    }

}