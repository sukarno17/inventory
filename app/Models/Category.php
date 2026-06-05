<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item; // Bersanding dengan import Model di atas

class Category extends Model
{
    // Menggabungkan fillable: 'name' dari branch kamu, dan 'description' dari branch main
    protected $fillable = ['name', 'description'];

    // Relasi hasMany ke model Item tetap dipertahankan
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
