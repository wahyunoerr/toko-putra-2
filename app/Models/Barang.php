<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Barang extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'stok',
        'hargaJual',
        'hargaBeli',
        'jenis_id',
        'satuan_id',
        'supplier_id',
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_id', 'id');
    }

    public function satuan()
    {
        return $this->belongsTo(SatuanBarang::class, 'satuan_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'stok' => $this->stok,
            'hargaJual' => $this->hargaJual,
            'hargaBeli' => $this->hargaBeli,
            'jenis_id' => $this->jenis->nama ?? null,
            'satuan_id' => $this->satuan->nama ?? null,
            'supplier_id' => $this->supplier->name ?? null,
        ];
    }
}
