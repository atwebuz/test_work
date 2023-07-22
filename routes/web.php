<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FallbackController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    if(!false){
        return redirect()->route('posts.index');
    }
});



Route::get('/statistic', function () {
    $posts = Post::all();
    $productName = "Gentra"; 
    $product = Post::where('title', $productName)->first(); 
    $labels = $posts->pluck('title')->toArray(); 
    $data = $posts->pluck('price')->toArray();
    $labels1 = $posts->pluck('title')->toArray(); 
    $data1 = $posts->pluck('reads')->toArray();
    $labels2 = $posts->pluck('title')->toArray(); 
    $data2 = $posts->pluck('rating')->toArray(); 
    $labels3 = $product->pluck('title')->toArray(); 
    $data3 = $product->pluck('price')->toArray();
    $currentPrice = 750; 
    $comparisonPrice = 500; 
    $expensiveProducts = Post::getExpensiveProducts();
    $getCheepestProducts = Post::getCheepestProducts();

    // $expensiveProducts2 = Post::where('title', $productName)->get();
    // $getCheapestProducts2 = Post::where('title', $productName)->get();
    

    return view('pages.statistic',
    ['expensiveProducts' => $expensiveProducts],
    ['getCheepestProducts'=> $getCheepestProducts],
    // ['expensiveProducts2' => $expensiveProducts2],
    // ['getCheapestProducts2'=> $getCheapestProducts2],
    ['currentPrice' => $currentPrice, 'comparisonPrice' => $comparisonPrice])
     ->with('labels', $labels)
     ->with('data', $data)
     ->with('data1', $data1)
     ->with('labels1', $labels1);
    //  ->with('data2', $data2)
    //  ->with('labels2', $labels2)
    //  ->with('data3', $data3)
    //  ->with('labels3', $labels3);
})->middleware('auth');
// Route::get('/statistic', [CategoryController::class, 'getCategoryStatistics'])->name('category.statistics');
 

Route::get('/clear', function(Request $request){
    
    Session::flush();
});

Route::get('/carousel', function () {
    return view('pages.carousel');
});
Route::get('/search',[PostsController::class, 'search'])->name('search');
Route::get('posts/wishlist', [WishlistController::class, 'wishlist'])->name('posts.wishlist');
Route::any('posts/wishlist_add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::any('posts/order_add', [OrderController::class, 'add'])->name('order.add');
Route::any('posts/wishlist_remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('posts/checkout', [PagesController::class, 'checkout'])->name('posts.checkout');
// Route::any('posts/settings', [PagesController::class, 'settings'])->name('posts.settings');
Route::any('posts/faq', [PagesController::class, 'faq'])->name('posts.faq');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

 
});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('throttle:3,1');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_store'])->name('register_store');


Route::resource('posts', PostsController::class);
Route::resource('comments', CommentController::class);

// Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
// Route::post('/wishlist/{post}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
// Route::get('/wishlist', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
// Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');



// Route::resources([
//     'posts', PostsController::class,
//     'comments', PostsController::class,
// ]);
    

// Route::get('/', [PostsController::class, 'index']);  
// Route::get('cart', [PostsController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [PostsController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [PostsController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [PostsController::class, 'destroy'])->name('remove.from.cart');


// Route::get('/sort', [PostsController::class, 'sorting'])->name('items.index');
