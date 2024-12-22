@extends('backend.master')
@section('title', 'Edit Category')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('view.categories') }}">View Categories</a>
        <span class="breadcrumb-item active">Edit Category</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Edit Category</h5>
            <p>Modify the details of the selected category.</p>
        </div>

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Edit Category Form</h6>
            <p class="mg-b-20 mg-sm-b-30">Update category details below.</p>

            <form action="{{ route('update.category', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>

                <div class="form-group">
                    <label for="order">Category Order</label>
                    <input type="number" name="order" class="form-control" value="{{ $category->order }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Category</button>
                <a href="{{ route('view.categories') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
