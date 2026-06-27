<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log; // <--- Pastikan baris ini ada di atas! [cite: 50, 51]

class ItemService
{
    public function all(): Collection
    {
        return Item::with('category')->get();
    }

    public function find(int $id): Item
    {
        return Item::with('category')->findOrFail($id);
    }

    public function create(array $data): Item
    {
        $item = Item::create($data); // [cite: 54]

        // Baris Log untuk create [cite: 55]
        Log::info('Item created', [
            'id' => $item->id, // [cite: 58]
            'data' => $data // [cite: 59]
        ]);

        return $item; // [cite: 60]
    }

    public function update(int $id, array $data): Item
    {
        $item = Item::findOrFail($id);
        $item->update($data);

        // Baris Log untuk update [cite: 62]
        Log::info('Item updated', [
            'id' => $id, // [cite: 62]
            'changes' => $data // [cite: 63]
        ]);

        return $item;
    }

    public function delete(int $id): void
    {
        $item = Item::findOrFail($id);
        $item->delete();

        // Baris Log untuk delete [cite: 64]
        Log::info('Item deleted', [
            'id' => $id // [cite: 64, 65]
        ]);
    }
}