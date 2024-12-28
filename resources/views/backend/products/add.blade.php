@extends('backend.master')
@section('title','Add Product')
@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="breadcrumb-item active">Add</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Add new Product</h5>
        </div>
        
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
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

                        <div class="form-group">
                            <label class="custom-checkbox">
                                <input type="checkbox" id="hasPromotion" name="has_promotion">
                                <span class="checkbox-box"></span>
                                <span>Has Promotion</span>
                            </label>
                        </div>
                        
                        <div class="form-group" id="newPriceField" style="display:none;">
                            <label for="new_price">New Price</label>
                            <input type="number" name="new_price" class="form-control" placeholder="New Price">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('hasPromotion').addEventListener('change', function() {
        let newPriceField = document.getElementById('newPriceField');
        newPriceField.style.display = this.checked ? 'flex' : 'none';
    });
</script>

<style>
    /* Style personnalisé pour la case à cocher */
.custom-checkbox {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    user-select: none;
}

.custom-checkbox input[type="checkbox"] {
    display: none;
}

.custom-checkbox .checkbox-box {
    width: 20px;
    height: 20px;
    border: 2px solid #007bff;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s, border-color 0.3s;
}

.custom-checkbox input[type="checkbox"]:checked + .checkbox-box {
    background-color: #007bff;
    border-color: #007bff;
}

.custom-checkbox input[type="checkbox"]:checked + .checkbox-box::after {
    content: '✔';
    color: white;
    font-size: 14px;
    font-weight: bold;
}

</style>
@endsection
