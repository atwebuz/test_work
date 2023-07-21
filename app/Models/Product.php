<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['user_id','category_id', 'title', 'paragraph', 'price', 'image','reads','address', 'is_salled'];

//     public function incrementReadCount() {
//         $this->reads++;
//         return $this->save();
//     }
 
//     public static function getExpensiveProducts()
//     {
//         // return self::where('price', '>', 30000)->get();

//         return self::orderBy('price', 'desc')
//         ->limit(4)
//         ->get();
//     }

//     public static function getCheepestProducts()
//     {

//         return self::orderBy('price', 'asc')
//         ->limit(4)
//         ->get();
//     }


//     public function user(){
//         return $this->belongsTo(User::class);
//     }

//     public function category(){
//         return $this->belongsTo(Category::class);
//     }

//     public function comments(){
//         return $this->hasMany(Comment::class);
//     } 

//     public function images(){
//         return $this->hasMany(Images::class);
//     } 
//     public function oneimage(){
//         return $this->images()->take(1);
//         // return $this->images()->first();
//     } 



//     public function wishlist()
// {
//     return $this->hasMany(Wishlist::class);
// }

// public function order()
// {
//     return $this->hasMany(Order::class);
// }

}
