<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'quantity', 'customer_name'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
