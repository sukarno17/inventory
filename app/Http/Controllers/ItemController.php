<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ItemService;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index()
    {
        return response()->json(
            $this->itemService->all()
        );
    }

    public function store(Request $request)
    {
        return response()->json(
            $this->itemService->create($request->all()),
            201
        );
    }

    public function show($id)
    {
        return response()->json(
            $this->itemService->find($id)
        );
    }

    public function update(Request $request, $id)
    {
        return response()->json(
            $this->itemService->update($id, $request->all())
        );
    }

    public function destroy($id)
    {
        $this->itemService->delete($id);

        return response()->json([
            'message' => 'Item deleted successfully'
        ]);
    }
}