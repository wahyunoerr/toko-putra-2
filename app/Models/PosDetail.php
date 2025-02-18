<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosDetail extends Model
{
    use HasFactory;

    protected $fillable = ['pos_id', 'barang_id', 'customer_id', 'quantity', 'sub_total'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    function pos()
    {
        return $this->belongsTo(Pos::class);
    }
}
