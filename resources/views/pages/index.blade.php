@extends('layout.app')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-detached ">
                <div class="content-body">
       

                    <section id="ecommerce-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ecommerce-header-items">
                                    <div class="result-toggler">
                                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                                            <span class="navbar-toggler-icon d-block d-lg-none"><i class="feather icon-menu"></i></span>
                                        </button>
                                      
                                    </div>
                                    <div class="view-options d-flex">

                                        <div class="view-btn-option">
                                            <button class="btn btn-white view-btn grid-view-btn active">
                                                <i class="feather icon-grid"></i>
                                            </button>
                                            <button class="btn btn-white list-view-btn view-btn">
                                                <i class="feather icon-list"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                
                    <div class="shop-content-overlay"></div>
        
        

                    <section id="ecommerce-products" class="grid-view">
                        @if(count($products) >= 1)
                        @foreach($products as $product)
                             <div class="card ecommerce-card">
                            <div class="card-content">
                                <div class="item-img text-center">
                                    <a href="{{route('products.show', $product->id)}}">
                                
                                        <img class="img-fluid w-100" src="{{false ? asset('image/' . $product->images[0]->images) : asset('assets/images/no-image.png')}}" alt="image not-found" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="item-wrapper">
                                     
                                        <div>
                                            <h6 class="item-price" style="font-size: 1.8rem !important">
                                                ${{$product->price}}
                                            </h6>
                                        </div>
                                    </div>
                                    {{-- <div class="item-name">
                                        <a href="{{route('products.show', $product->id)}}">{{$product->title}}</a>
                                        <p class="item-company">By <span class="company-name">{{$product->user->name}}</span></p>
                                    </div> --}}
                                    <div>
                                        <p class="item-description">
                                          {{$product->paragraph}}
                                        </p>
                                        {{-- <p><b>{{__('Category')}}: </b> {{$product->category->name}}</p>
                                        <p><b>{{__('Created at')}}:</b> {{$product->created_at}}</p> --}}
                                    </div>
                                </div>
                                <div class="item-options text-center d-flex">
                                 
                                    @auth
                                        
                                  
                                  <form action="{{ route('wishlist.add') }}" method="POST">
                                        @csrf

                                        <div class="wishlist">
                                            <input type="hidden" name="post_id" value="{{$product->id}}">
                                           <button style="border: none;outline: none; background: transparent" type="submit"> <i class="fa fa-heart-o"></i> {{__('Wishlist')}}</button>
                                  
                                        </div>
                                    </form>

                              
                               
                                    <a class="cart" href="{{ route('add.to.cart', $product->id) }}">
                                        <i class="feather icon-shopping-cart"></i> <span class="add-to-carts">{{__('Add to cart')}}</span> <a href="{{ route('products.checkout') }}" class="view-in-cart d-none">{{__('View In Cart')}}</a>

                                    </a>

                                    @else
                                                                                     
                                    @endauth
                                </div>
                            </div>
                            
                        </div>
                        @endforeach

                        @else
                         <p>No listings found</p>
                        @endif
                            
                       
                      
                    </section>
                
                

                </div>
            </div>
            
        </div>
    </div>
    
@endsection