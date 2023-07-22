<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container contents">
            <div class="navbar-collapse" id="navbar-mobile" style="justify-content: space-between">

                <ul class="d-flex">
                    <h2 style="" class="p-1 mt-1 "><a href="{{route('posts.index')}}">Laravel</a></h2>
                    <h3 style="border: 3px dashed black;" class="p-1 mt-1 mr-2 rounded"><a href="{{route('posts.create')}}">create post</a></h3>
                    <h3 style="border: 3px dashed black;" class="p-1 mt-1 rounded"><a href="/statistic">Statistic</a></h3>
                </ul>
         
                <ul class="nav navbar-nav float-right">
                  
                 
                      @auth
                        <li class="dropdown dropdown-notification nav-item">

                            @php $total = 0 @endphp
                            @foreach((array) session('cart') as $id => $details)
                                @php $total += $details['quantity'] @endphp
                            @endforeach
                            <a class="nav-link nav-link-label" href="#"
                                data-toggle="dropdown">
                                <i class="ficon feather icon-shopping-cart"></i>
                                <span
                                    class="badge badge-pill badge-primary badge-up cart-item-count">{{ $total }}</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-cart dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header m-0 p-2">
                                        <h3 class="white">
                                                    <span class="cart-item-count">{{$total}}</span>                          
                                                    <span class="mx-50">{{__('Items')}}</span>
                                        </h3>
                                    
                                       

                                            <span class="notification-title">{{_('In Your Cart')}}</span>
                                    

                                   
                                    </div>
                                </li>
                                @if(session('cart') )
                                @foreach(session('cart') as $id => $details)
                                <li class="scrollable-container media-list">
                                        <a class="cart-item"
                                            href="#!">
                                            <div class="media">
                                            
                                                        <img class="media-left d-flex justify-content-center align-items-center" src="{{$details['image'] ? asset('image/' . $details['image']) : asset('assets/images/no-image.png')}}" alt="image not-found" width="75" />
                                                <div class="media-body"><span
                                                        class="item-title text-truncate text-bold-500 d-block mb-50">{{ $details['name'] }}</span><span
                                                        class="item-desc font-small-2 text-truncate d-block"> {{ $details['paragraph'] }}</span>
                                                    <div class="d-flex justify-content-between align-items-center mt-1"><span
                                                            class="align-middle d-block">:{{ $details['quantity'] }} x ${{ $details['price'] }}</span>
                                                            <i class="remove-cart-item feather icon-x danger font-medium-1"></i>
                                                    </div> 
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center text-primary"
                                        href="{{route('posts.checkout')}}"><i
                                        class="feather icon-shopping-cart align-middle"></i><span
                                        class="align-middle text-bold-600">{{__('Checkout')}}</span></a></li>
                                        <li class="empty-cart d-none p-2">{{__('Your Cart Is Empty.')}}</li>
                                        @endforeach
                                        @endif
                            </ul>
                        </li>
                      @endauth
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown">

                            @auth
                            {{-- @dd(auth()->user()->image)  --}}
                            <div class="user-nav d-sm-flex d-none"><span
                                    class="user-name text-bold-600">{{auth()->user()->name}}</span><span
                                    class="user-status">{{__('Available')}}</span></div><span>
                                        <img class="round" src="{{auth()->user()->image ? asset('image/' . auth()->user()->image) : asset('assets/images/no-image.png')}}" alt="avatar"
                                    height="40" width="40"></span>

                                    @else
                                 
                                        
                                  <form action="{{route('login')}}">

                                      <button type="submit" class="btn btn-primary" href="">
                                          <i class="feather icon-power"></i> {{__('Login')}}
                                      </button>

                                  </form>
                                  
                            @endauth

                            {{-- <div class="user-nav d-sm-flex d-none"><span
                                    class="user-name text-bold-600">Guest</span><span
                                    class="user-status">Available</span></div><span><img class="round"
                                    src="{{asset('assets/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"
                                    height="40" width="40"></span> --}}
                        </a>
                        @auth
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                href="{{route('profile.edit')}}"><i class="feather icon-user"></i> {{__('Edit Profile')}}</a><a
                                class="dropdown-item" href="app-chat.html"><i class="feather icon-message-square"></i>
                                {{__('Chats')}}</a>

                            <div class="dropdown-divider"></div>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item" href="">
                                    <i class="feather icon-power"></i> {{__('Logout')}}
                                </button>
                            </form>

                        </div>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

