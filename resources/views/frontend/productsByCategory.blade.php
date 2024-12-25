<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('/styles/bootstrap4/bootstrap.min.css') }}">
<link href=" {{ asset('/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/plugins/slick-1.8.0/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/styles/responsive.css')}}">


<link rel="stylesheet" type="text/css" href="{{asset('/plugins/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/styles/shop_responsive.css')}}">

@include('frontend.layout.header')

@section('title','products by category')








<div class="home"  >
    <div class="home_background parallax-window" data-parallax="scroll" ></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">{{$category->name}}</h2>
    </div>
</div>

<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <!-- Categories -->
                    <div class="sidebar_section">
                        <div class="sidebar_title">Categories</div>
                        <ul class="sidebar_categories">
                            @foreach ($categories as $category)
                                <li><a href="{{ route('products.by.category',['id'=>$category->id]) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
            
                    <!-- Filter by Price -->
                    <div class="sidebar_section filter_by_section">
                        <div class="sidebar_title">Filter By</div>
                        <div class="sidebar_subtitle">Price</div>
                        <div class="filter_price">
                            <div id="slider-range" class="slider_range"></div>
                            <p>Range: </p>
                            <p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
                        </div>
                    </div>
            
                  
                </div>
            </div>
            

            <div class="col-lg-9">
                
                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count"><span>186</span> products found</div>
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                                        <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_grid">
                        <div class="product_grid_border"></div>

                      <!-- Product Item -->
@foreach($products as $product)
@if($product->old_price > $product->new_price)
<div class="product_item discount">
    <div class="product_border"></div>
    <div class="product_image d-flex flex-column align-items-center justify-content-center">
        @if($product->images->isNotEmpty())
        <div class="viewed_image">
            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}">
        </div>
    @else
        <!-- Image par défaut si aucune image n'est disponible -->
        <div class="viewed_image">
            <img src="{{ asset('images/default_product.jpg') }}" alt="Image par défaut">
        </div>
    @endif
    </div>
    <div class="product_content">
        <div class="product_price">
            {{ $product->new_price }} <span>{{ $product->old_price }}</span>
        </div>
        <div class="product_name">
            <div>
                <a href="#" tabindex="0">{{ $product->name }}</a>
            </div>
        </div>
    </div>
    <div class="product_fav">
        <i class="fas fa-heart"></i>
    </div>
    <ul class="product_marks">
        <li class="product_mark product_discount">
            -{{ intval((($product->old_price - $product->new_price) * 100) / $product->old_price) }}%
        </li>
        <li class="product_mark product_new">new</li>
    </ul>
</div>
@endif
@endforeach

                    </div>

                    <!-- Shop Page Navigation -->

                    <div class="shop_page_nav d-flex flex-row">
                        <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
                        <ul class="page_nav d-flex flex-row">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">21</a></li>
                        </ul>
                        <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Recently Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Recently Viewed</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">
                    
                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">
                        @foreach ($produits as $produit)
                        <div class="owl-item">
                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                
                                <!-- Afficher une seule image (la première) -->
                                @if($produit->images->isNotEmpty())
                                    <div class="viewed_image">
                                        <img src="{{ asset('storage/' . $produit->images->first()->image_path) }}" alt="{{ $produit->name }}">
                                    </div>
                                @else
                                    <!-- Image par défaut si aucune image n'est disponible -->
                                    <div class="viewed_image">
                                        <img src="{{ asset('images/default_product.jpg') }}" alt="Image par défaut">
                                    </div>
                                @endif
                    
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">
                                        {{ $produit->new_price }}<span>{{ $produit->old_price }}</span>
                                    </div>
                                    <div class="viewed_name">
                                        <a href="#">{{ $produit->name }}</a>
                                    </div>
                                </div>
                    
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">
                                        -{{ intval((($produit->old_price - $produit->new_price) * 100) / $produit->old_price) }}%
                                    </li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands -->

<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">
                    
                    <!-- Brands Slider -->

                    <div class="owl-carousel owl-theme brands_slider">
                        
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('/images/brands_1.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('/images/brands_2.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('/images/brands_3.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('/images/brands_4.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('/images/brands_5.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('/images/brands_6.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('/images/brands_7.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('/images/brands_8.jpg')}}" alt=""></div></div>

                    </div>
                    
                    <!-- Brands Slider Navigation -->
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('/js/jquery-3.3.1.min.js')}} "></script>
<script src="{{asset('/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{asset('/plugins/easing/easing.js')}}"></script>
<script src="{{asset('/js/custom.js')}}"></script>



<script src="{{asset('/plugins/Isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
<script src="{{asset('/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('/js/shop_custom.js')}}"></script>

@include('frontend.layout.footer')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<

