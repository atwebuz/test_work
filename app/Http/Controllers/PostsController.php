<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Images;
use App\Models\Order;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct(){
        $this->middleware('auth')->except(['index', 'show', 'search']);
     }

     


    
    public function index()
    {

        return view('pages.index', [
            'posts' => Post::latest()->with('oneimage')->paginate(9),
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'images' => Images::all(),
        ]); 

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'images' => Images::all(),
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      


        // dd($request);

        $this->validate($request, [
        
            'title' => 'required',
            'paragraph' => 'required',
          
            'price' => 'required',
            'address' => 'required',
            'images.*' => 'min:2|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'paragraph' => $request->paragraph,
          
            'price' => $request->price,
        
            'address' => $request->address
        ]);

        foreach($request->file('images') as $image) 
        {  
            $name = $image->getClientOriginalName();
            $image = $image->move('image/', $name);
            $image = $name;
            Images::create([
                'images'=>$name,
                'post_id'=>$post->id
            ]);
          }
  
        if(isset($request->tags)){
            foreach($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }

        return redirect()->route('posts.index')->with('success', 'waw it was created successfully');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.show',[
            'post' => Post::with('images')->findOrFail($id),
            'tags' => Tag::all(),
            'orders' => Order::all(),
            'categories' => Category::all()
        ]);

    
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        return view('pages.edit', [
            'post' => Post::findOrFail($id),
            'categories' => Category::all(),
            'images' => Images::all(),


        ]);

        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
// dd($request);

        // Gate::authorize('update', $post);
        $this->authorize('update', $post);

        if($request->id && $request->quantity){
            dd('errrorno');
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }


        $this->validate($request, [
            'title' => 'required',
            'paragraph' => 'required',
            'price' => 'required',

            'address' => 'required',
            'images.*' => 'min:2|mimes:jpeg,png,jpg,gif,svg|max:2048',
           

        ]);


        foreach($request->file('images') as $image) 
        {  
            $name = $image->getClientOriginalName();
            $image = $image->move('image/', $name);
            $image = $name;
            Images::create([
                'images'=>$name,
                'post_id'=>$post->id
            ]);
          }
          
          $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'waw it was updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Gate::authorize('delete', $post);

        $post->delete();
         
        return redirect()->route('posts.index')->with('success','waw it was deleted successfully');
    }

    // dev start

    public function cart()
    {
        return view('pages.cart');
    }
  

    public function addToCart($id)
    {

        // dd('worked');
        $post = Post::with('oneimage')->findOrFail($id);
        //   dd($post);
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            // dd($post->title);

        } else {
            $image = (count($post->oneimage)>0 ? $post->oneimage[0]->images : "no-image.png");
            // dd($image);
            $cart[$id] = [
                "name" => $post->title,
                "quantity" => 1,
                "price" => $post->price,
                "image" => $image,
                "paragraph" => $post->paragraph
            ];

        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'post added to cart successfully!');
    }
  


    public function remove(Request $request)
    {
        dd('delete');
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'post removed successfully');
        }
    }

    



}
    