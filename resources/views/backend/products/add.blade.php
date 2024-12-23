@extends('backend.master')
@section('title','Add Product')
@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
      <span class="breadcrumb-item active">Add</span>
    </nav>

    
        <div class="sl-pagebody">
            <!-- sl-page-title -->
        <!-- card -->
        <div class="sl-page-title">
            <h5>Add new Product</h5>
          </div>
        
              <div class="row row-sm mg-t-20">
                <div class="col-xl-12">
                  <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    
    <!-- sl-page-title -->
<!-- card -->
<form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">Product Category:</label>
        <div class="col-sm-8">
            <select class="form-control" name="category" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">Product Name:</label>
        <div class="col-sm-8">
            <input type="text" name="name" class="form-control" placeholder="Product Name">
        </div>
    </div>

    <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">Old Price:</label>
        <div class="col-sm-8">
            <input type="number" name="old_price" class="form-control" placeholder="Old Price">
        </div>
    </div>

    <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">New Price:</label>
        <div class="col-sm-8">
            <input type="number" name="new_price" class="form-control" placeholder="New Price">
        </div>
    </div>

    <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">Product Images:</label>
        <div class="col-sm-8">
            <input type="file" name="images[]" class="form-control" multiple>
        </div>
    </div>

    <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">Description:</label>
        <div class="col-sm-8">
            <textarea name="description" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-layout-footer mg-t-30">
        <button type="submit" class="btn btn-info">Save</button>
    </div>
</form><!-- row -->

     <!-- card -->

    </div><!-- sl-pagebody -->
   
  </div>
@endsection
