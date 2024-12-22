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
              <label class="col-sm-4 form-control-label" for="name">Category Name: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" id="name" class="form-control" placeholder="Category Name">
              </div>
            </div>
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label" for="order">Category Order: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="number" id="order" class="form-control" placeholder="Category Order">
              </div>
            </div>
            <div class="form-layout-footer mg-t-30">
              <button class="btn btn-info mg-r-5" id="newCat">Save</button>
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
    
    $(document).ready(function() {
    $('#newCat').click(function(e) {
        e.preventDefault();

        let name = $('#name').val();
        let order = $('#order').val();

        $.ajax({
            url: '{{ route("store.category") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: name,
                order: order
            },
            success: function(response) {
                if (response.success) {
                    swal.fire('success', response.message, 'success');
                    setTimeout(function() {
                        window.location.href = '{{ route("view.categories") }}';
                    }, 2000);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                   swal.fire('error', errors[Object.keys(errors)[0]][0], 'error');
                    
                } else {
                  swal.fire('error', xhr.statusText, 'error');
                }
            }
        });
    });
});

 </script>
@endsection






