@extends('backend.master')
@section('title','Add Category')
@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
      <span class="breadcrumb-item active">Add</span>
    </nav>

    <div class="sl-pagebody">
    <!-- sl-page-title -->
<!-- card -->

      <div class="row row-sm mg-t-20">
        <div class="col-xl-12">
          <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
            <h6 class="card-body-title">Add new Category</h6><br><br>
            <div class="row">
              <label class="col-sm-4 form-control-label" id="name">Category Name: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" class="form-control" placeholder="Category Name">
              </div>
            </div><!-- row -->
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label" id="order">Category Order: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="number" class="form-control" placeholder="Category Order">
              </div>
            </div>
         
            <div class="form-layout-footer mg-t-30">
              <button class="btn btn-info mg-r-5" id="newCat" >Save</button>
            </div><!-- form-layout-footer -->
          </div><!-- card -->
        </div><!-- col-6 -->
       <!-- col-6 -->
      </div><!-- row -->

     <!-- card -->

    </div><!-- sl-pagebody -->
   
  </div>
@endsection

@section('js')
 <script>
    
      $(document).ready(function(){

         $('#newCat').click(function(e){
            e.preventDefault();
            console.log('New');
            let name = $('#name').val();
            let order = $('#order').val();
            // var _token = $('input[name="_token"]').val();

      })
      })




 </script>

@endsection