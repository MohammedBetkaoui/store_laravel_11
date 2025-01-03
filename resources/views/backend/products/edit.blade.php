@extends('backend.master')
@section('title', 'Edit Product')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('view.products') }}">View Products</a>
        <span class="breadcrumb-item active">Edit Product</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Edit Product</h5>
            <p>Modify the details of the selected product.</p>
        </div>

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Edit Product Form</h6>
            <p class="mg-b-20 mg-sm-b-30">Update product details below.</p>

            <form action="{{ route('update.product', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Nom du Produit -->
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>

                <!-- Catégorie du Produit -->
                <div class="form-group">
                    <label for="category">Product Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Prix (Ancien) -->
                <div class="form-group">
                    <label for="old_price">Old Price</label>
                    <input type="number" name="old_price" class="form-control" value="{{ $product->old_price }}" required>
                </div>

                <!-- Promotion Checkbox -->
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="hasPromotion" name="has_promotion" {{ $product->new_price ? 'checked' : '' }}>
                        Has Promotion
                    </label>
                </div>

                <!-- Prix (Nouveau) -->
                <div class="form-group" id="newPriceField" style="{{ $product->new_price ? '' : 'display:none;' }}">
                    <label for="new_price">New Price</label>
                    <input type="number" name="new_price" class="form-control" value="{{ $product->new_price }}">
                </div>

                <!-- Images Existantes -->
                <div class="form-group">
                    <label>Existing Images</label>
                    <div class="row">
                        @foreach($product->images as $image)
                            <div class="col-md-3">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid" alt="Product Image">
                                <label>
                                    <input type="checkbox" name="image_delete[]" value="{{ $image->id }}">
                                    Delete this image
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Ajouter de nouvelles images -->
                <div class="form-group">
                    <label for="images">Add New Images</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Product Description</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
                </div>

                <!-- Boutons -->
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="{{ route('view.products') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('hasPromotion').addEventListener('change', function() {
        let newPriceField = document.getElementById('newPriceField');
        newPriceField.style.display = this.checked ? 'block' : 'none';
    });
</script>
@endsection
