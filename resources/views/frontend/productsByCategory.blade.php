@extends('frontend.master')
@section('title','products by category')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/styles/shop_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/styles/shop_responsive.css') }}">

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

@endsection






