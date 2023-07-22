@extends('layouts.layout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('section__content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
         
            <div class="content-body">
                <!-- app ecommerce details start -->
                <section class="app-ecommerce-details">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-5 mt-2">
                                <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                    <div class="d-flex align-items-center justify-content-center">
                                        
                                        <div class="card-body">
                                            <div id="carousel-keyboard" class="carousel slide" data-keyboard="true">
                                                <div class="carousel-inner" role="listbox">
                                                    @forelse($post->images as $key => $image)
                                                    <ol class="carousel-indicators">
                                                        <li data-target="#carousel-keyboard" data-slide-to="{{$loop->index}}" class="{{$key == 0 ? 'active' : '' }}"></li>
                                                        {{-- <li data-target="#carousel-keyboard" data-slide-to="{{$loop->index}}" class=""></li> --}}
                                                    </ol>
                                                        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                                            <img class="img-fluid w-100" src="{{$image->images ? asset('image/' . $image->images) : asset('assets/images/no-image.png')}}" alt="image not-found" />
                                                        </div>
                                                        @empty
                                                            
                                                        <img class="img-fluid" src="{{asset('assets/images/no-image.png')}}" alt="image not-found" />

                                                    @endforelse 
                                                </div>
                                                <a class="carousel-control-prev" style="z-index: 1100" href="#carousel-keyboard" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" style="z-index: 1100" href="#carousel-keyboard" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </div>

                                        {{-- @forelse($post->images as $image)
                                        <img class="img-fluid" src="{{$image->images ? asset('image/' . $image->images) : asset('assets/images/no-image.png')}}" alt="image not-found" />

                                        @empty
                                        <img class="img-fluid" src="{{asset('assets/images/no-image.png')}}" alt="image not-found" />

                                        @endforelse --}}

                                        {{-- <img class="img-fluid" src="{{$post->image ? asset('image/' . $post->image) : asset('assets/images/no-image.png')}}" alt="image not-found" /> --}}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5>{{$post->title}}</h5>
                                    <p class="text-muted">by {{$post->user->name}}</p> 

                                    {{-- @dd($post->reads) --}}

                                    {{-- @dd($post->user) --}}
                                    <div class="ecommerce-details-price d-flex flex-wrap">

                                        
                                        <p class="text-primary font-medium-5 mr-0 mb-0 pr-1 " style="font-size: 2rem;font-weight:700" >${{$post->price}}</p>
                                        {{-- <span class="pl-1 font-medium-3 border-left">
                                            <i class="feather icon-star text-warning"></i>
                                            <i class="feather icon-star text-warning"></i>
                                            <i class="feather icon-star text-warning"></i>
                                            <i class="feather icon-star text-warning"></i>
                                            <i class="feather icon-star text-secondary"></i>
                                        </span>
                                        <span class="ml-50 text-dark font-medium-1">{{$post->rating}} {{__('ratings')}}</span> --}}
                                    </div>
                                    <hr>

                                
                                    <div class="form-group">
                                        <label class="font-weight-bold">{{__('Category')}}</label>
                                        {{$post->category->name}}
                                    </div>

                                 
                                    <div class="row">          
                                    

    
                                        <div class="form-group col-6">
                                            <label class="font-weight-bold">{{__('Address')}}</label>
                                            {{$post->address}}
                                        </div>
                                            <hr>
                                        <div class="form-group col-6">
                                            <label class="font-weight-bold">{{__('Created at')}}</label>
                                            {{$post->created_at}}
                                        </div>
                                    
                                    </div>

                            
                                    <div class="form-group ">
                                        <label class="font-weight-bold">{{__('Paragrah')}}</label>
                                        {{$post->paragraph}}
                                    </div>  

                                   <hr>
                                   
                                    
                                        @if(count($post->tags) > 0)
                                        <b>Tags: </b> <ul class="d-flex m-0 p-0" style="flex-wrap: wrap">
                                        @endif

                                        @foreach ($post->tags as $tag)
                                            {{-- <li class="my-1" style="list-style-type: none;"><a class="btn btn-primary mr-1" href="#">{{$tag->name}}</a></li> --}}
                                            <li class="my-0" style="list-style-type: none;"><a class="js-programmatic-close btn btn-outline-primary mr-1 mb-1 waves-effect waves-light" href="#">{{$tag->name}}</a></li>

                                            
                                        @endforeach
                                      </ul>


                                @if(count($post->order) !== 0 )
                                   @foreach($post->order as $ord)
                                   {{-- @dump($ord->post->id) --}}
                                        @unless($ord->post->id)
                                        
                                        <p>{{__('Available')}} - <span class="text-success">{{__('In stock')}}</span></p>
                                        @else
                                        
                                        <p style="font-size: 20px">{{__('Maxsulot')}} - <span class="text-danger " style="font-weight: bold">{{__('sotuvda mavjud emas')}}</span></p>
                                        @endunless

                                        {{-- @dump($post->order ) --}}
                                        {{-- <p>{{__('Maxsulot')}} - <span class="text-danger">{{__('sotuvda mavjud emas')}}</span></p> --}}

                                   @endforeach
                                @endif
                                    


                                    
                                    <div class="d-flex flex-column flex-sm-row">
                                        @auth
                                            
                                     
                                        <a href="{{ route('add.to.cart', $post->id) }}" class="btn btn-primary m-0"><i class="feather icon-shopping-cart mr-25"></i>{{__('Add to cart')}}</a>

                                  
                                        {{-- <button class="btn btn-outline-danger mx-1"><i class="feather icon-heart mr-25"></i>{{__('Wishlist')}}</button> --}}
                                        @endauth
                                        <button class="btn btn-primary ml-1">Ko'rilganlar soni: {{$post->reads}}</button>
                                        <button style="opacity: 0;">{{$post->incrementReadCount()}}</button>
                                    </div>
                                   
                                    
                                  
                                    <hr>
                                    
                                    @auth
                                        @canany(['update', 'delete'], $post)
                                            <form class="my-3" action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                                
                                                @csrf
                                                @method('DELETE')
                                                
                                                <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">{{__('Edit')}}</a>
                                                <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                                                {{-- <button type="submit" class="btn btn-outline-primary mb-2 waves-effect waves-light">Delete</button> --}}
                                                
                                            </form>
                                        @endcanany
                                    @endauth

                                    
                                    
                                </div>


                            </div>
                        </div>
               
                    
                </div>
                


                
            </div>
        </section>

   

                <!-- app ecommerce details end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection