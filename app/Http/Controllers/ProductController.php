<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.index', [
            'products' => Product::all(),
            // 'categories' => Category::all(),
            // 'tags' => Tag::all(),
            // 'images' => Images::all(),
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create')->with([
            // 'categories' => Category::all(),
            // 'tags' => Tag::all(),
            // 'images' => Images::all(),
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
            'images' => 'min:2|required',
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $product = Product::create([
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
            // Images::create([
            //     'images'=>$name,
            //     'product_id'=>$product->id
            // ]);
          }
  

        return redirect()->route('posts.index')->with('success', 'waw it was created successfully');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.show',[
            'product' => Product::with('images')->findOrFail($id),
            // 'tags' => Tag::all(),
            // 'orders' => Order::all(),
            // 'categories' => Category::all()
        ]);

    
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        return view('pages.edit', [
            'product' => Product::findOrFail($id),
            // 'categories' => Category::all(),
            // 'images' => Images::all(),


        ]);

        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
// dd($request);

        // Gate::authorize('update', $product);
        $this->authorize('update', $product);

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
            'images' => 'min:2|required',
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
           

        ]);


        foreach($request->file('images') as $image) 
        {  
            $name = $image->getClientOriginalName();
            $image = $image->move('image/', $name);
            $image = $name;
            // Images::create([
            //     'images'=>$name,
            //     'post_id'=>$product->id
            // ]);
          }
          
          $product->update($request->all());

        return redirect()->route('posts.index')->with('success', 'waw it was updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Gate::authorize('delete', $product);

        $product->delete();
         
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
        $product = Product::with('oneimage')->findOrFail($id);
        //   dd($product);
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            // dd($product->title);

        } else {
            $image = (count($product->oneimage)>0 ? $product->oneimage[0]->images : "no-image.png");
            // dd($image);
            $cart[$id] = [
                "name" => $product->title,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $image,
                "paragraph" => $product->paragraph
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
