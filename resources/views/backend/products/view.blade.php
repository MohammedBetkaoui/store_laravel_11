@extends('backend.master')
@section('title','View Products')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="breadcrumb-item active">View Products</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Products List</h6>
            <br><br>
            <div class="table-wrapper">
                <table id="productsTable" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Old Price</th>
                            <th>New Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->old_price }}</td>
                            <td>{{ $product->new_price }}</td>
                            <td>

                                <a href="{{ route('edit.product', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $product->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
 $(document).ready(function() {
    let table = $('#productsTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: '{{ route('fetch.products') }}',
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'category.name', name: 'category.name' },
            { data: 'old_price', name: 'old_price' },
            { data: 'new_price', name: 'new_price' },
            { 
                data: null,
                render: function(data, type, row) {
                    return `
                        <a href="/products/${row.id}" class="btn btn-sm btn-info">Show</a>
                        <a href="{{ route('edit.product', '') }}/${row.id}" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
                    `;
                }
            }
        ],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page'
        }
    });

    // Suppression de produit avec confirmation
    $('#productsTable').on('click', '.delete-btn', function() {
        let productId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This will delete the product and its associated images!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                $.ajax({
                    url: '{{ route('delete.product', '') }}/' + productId,
                    type: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Deleted!', response.message, 'success');
                            table.ajax.reload();
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'An error occurred: ' + xhr.responseJSON.message, 'error');
                    }
                });
            }
        });
    });
});

</script>
@endsection
