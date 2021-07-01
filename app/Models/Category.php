<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->hasMany(Brand::class);
    }

    public function scopeCatname($query,$name)
    {
        return $query->where('name',$name);
    }

}
