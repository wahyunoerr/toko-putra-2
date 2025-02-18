<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Pos extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['kode_transaksi', 'total_belanja'];


    public function details()
    {
        return $this->hasMany(PosDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    function toSearchableArray(): array
    {
        $array = $this->toArray();
        $array['kode_transaksi'] = $this->kode_transaksi;
        $array['total_belanja'] = $this->total_belanja;
        return $array;
    }
}
