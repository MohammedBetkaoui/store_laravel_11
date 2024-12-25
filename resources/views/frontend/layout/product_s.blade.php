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