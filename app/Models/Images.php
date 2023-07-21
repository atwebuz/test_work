<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = ['images', 'product_id'];

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
