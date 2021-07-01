<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function variant()
    {
        return $this->hasMany(Variant::class);
    }

    public function scopeBrandname($query,$name)
    {
        return $query->where('name',$name);
    }
}
