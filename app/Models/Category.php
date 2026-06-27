<?php

namespace App\Models;

// PERBAIKAN: Baris di bawah ini wajib ada agar kelas Model dikenali oleh Laravel
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}