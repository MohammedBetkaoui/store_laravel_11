@extends('frontend.master')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/product_responsive.css') }}">
<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Liste des images -->
            <div class="col-lg-2 order-lg-1 order-2">
                <ul class="image_list">
                    @foreach($produit->images as $image)
                        <li data-image="{{ asset('storage/' . $image->image_path) }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $produit->name }}">
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Image sélectionnée -->
            <div class="col-lg-5 order-lg-2 order-1">
                @if($produit->images->isNotEmpty())
                    <div class="image_selected">
                        <img src="{{ asset('storage/' . $produit->images->first()->image_path) }}" alt="{{ $produit->name }}">
                    </div>
                @else
                    <div class="image_selected">
                        <img src="{{ asset('images/default.jpg') }}" alt="Image par défaut">
                    </div>
                @endif
            </div>

            <!-- Description du produit -->
            <div class="col-lg-5 order-3">
                <div class="product_description">
                    <div class="product_category">{{ $produit->category->name ?? 'Non catégorisé' }}</div>
                    <div class="product_name">{{ $produit->name }}</div>
                   <!-- Prix du produit -->
                   <div class="product_price">
                    @if($produit->new_price && $produit->new_price < $produit->old_price)
                        <span style="color: rgb(27, 42, 214); font-size: 25px ; font-weight: bold;">{{ $produit->new_price }} Dz</span>
                        <span style="text-decoration: line-through; color: rgb(251, 4, 4); font-size:16px">{{ $produit->old_price }}</span>
                    @else
                        <span style="color: rgb(27, 42, 214); font-size: 25px ; font-weight: bold;">{{ $produit->old_price ?? $produit->new_price }} Dz</span>
                    @endif
                </div>
                    <div class="product_text">
                        <p>{{ $produit->description }}</p>
                    </div>
                    <div class="order_info d-flex flex-row">
                        <form action="#">
                            <div class="clearfix" style="z-index: 1000;">
                                <!-- Quantité -->
                                <div class="product_quantity clearfix">
                                    <span>Quantity: </span>
                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>
                            </div>

                           

                            <!-- Boutons d'action -->
                            <div class="button_container">
                                <button type="button" class="button cart_button">Add to Cart</button>
                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                            </div>

                            <!-- Pourcentage de réduction -->
                            @if($produit->new_price && $produit->new_price < $produit->old_price)
                                <div class="product_discount">
                                    <span>
                                        -{{ intval((($produit->old_price - $produit->new_price) * 100) / $produit->old_price) }}%
                                    </span>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>




@endsection
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('js/product_custom.js') }}"></script>
