<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SatuanBarang extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['nama'];

    function toSearchableArray()
    {
        return $this->only('nama');
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'satuan_id', 'id');
    }
}
