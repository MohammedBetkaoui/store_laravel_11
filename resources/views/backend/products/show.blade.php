@extends('backend.master')

@section('title', 'Product Details')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
      <a class="breadcrumb-item" href="{{ route('view.products') }}">View Products</a>
      <span class="breadcrumb-item active">Product Details</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Product Details</h5>
            <p>Information about the selected product.</p>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Product Information</h6>
            <p class="mg-b-20 mg-sm-b-30">Here are the details for the selected product.</p>

            <div class="row">
                <!-- Product Name and Description -->
                <div class="col-md-6">
                    <h4><strong>{{ $product->name }}</strong></h4>
                    <p><strong>Category:</strong> {{ $product->category->name }}</p>
                    <p><strong>Old Price:</strong> ${{ number_format($product->old_price, 2) }}</p>
                    <p><strong>New Price:</strong> ${{ number_format($product->new_price, 2) }}</p>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                </div>

                <!-- Product Images -->
                <div class="col-md-6">
                    <h5>Product Images</h5>
                    <div class="row">
                        @foreach($product->images as $image)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <a href="{{ route('view.products') }}" class="btn btn-secondary">Back to Products</a>
            </div>
        </div><!-- card -->
    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
@endsection
