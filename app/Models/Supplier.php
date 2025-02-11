<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Supplier extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name'];

    function toSearchableArray()
    {
        return $this->only('name');
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'supplier_id', 'id');
    }
}
