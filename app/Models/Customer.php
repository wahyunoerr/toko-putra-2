<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'phone'
    ];

    public function details()
    {
        return $this->hasMany(PosDetail::class);
    }

    public function pos()
    {
        return $this->hasMany(Pos::class);
    }

    function toSearchableArray()
    {
        return $this->only('name', 'phone');
    }
}
