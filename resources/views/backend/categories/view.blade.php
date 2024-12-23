@extends('backend.master')
@section('title','View Categories')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="breadcrumb-item active">View Categories</span>
    </nav>

    <div class="sl-pagebody">
    
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Categories List</h6>
<br><br>
            <div class="table-wrapper">
                <table id="categoriesTable" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Order</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour l'édition -->

  
@endsection

@section('js')
<script>
 $(document).ready(function() {
    let table = $('#categoriesTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: '{{ route('fetch.categories') }}',
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'order', name: 'order' },
            { data: 'created_at', name: 'created_at' },
            { 
                data: null,
                render: function(data, type, row) {
                    return `
                         <a href="{{ route('edit.category', '') }}/${row.id}" class="btn btn-sm btn-warning">Edit</a>
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

    // Édition de catégorie
    $('#categoriesTable').on('click', '.edit-btn', function() {
        let categoryId = $(this).data('id');
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
        $.ajax({
            url: '{{ route('update.category', '') }}/' + categoryId,
            type: 'PUT',
            success: function(response) {
                if (response.success) {
                    swal.fire('success', response.message, 'success');
                    let category = response.data;
                    $('#editCategoryModal #category_id').val(category.id);
                    $('#editCategoryModal #edit_name').val(category.name);
                    $('#editCategoryModal #edit_order').val(category.order);
                    $('#editCategoryModal').modal('show');
                } else {
                    alert('Failed to fetch category details: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseJSON.message);
            }
        });
    });

    // Mettre à jour la catégorie
    $('#updateCategoryBtn').click(function() {
        let categoryId = $('#editCategoryModal #category_id').val();
        let name = $('#editCategoryModal #edit_name').val();
        let order = $('#editCategoryModal #edit_order').val();

        $.ajax({
            url: '{{ route('edit.category', '') }}/' + categoryId,
            type: 'GET',

            data: {
                _token: '{{ csrf_token() }}',
                name: name,
                order: order
            },
            success: function(response) {
                if (response.success) {
                    $('#editCategoryModal').modal('hide');
                    swal.fire('success', response.message, 'success');
                    table.ajax.reload();
                } else {
                    alert('Failed to update category: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseJSON.message);
            }
        });
    });
    // Suppression de catégorie
$('#categoriesTable').on('click', '.delete-btn', function() {
    let categoryId = $(this).data('id');

    if (confirm('Are you sure you want to delete this category?')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $.ajax({
            url: '{{ route('delete.category', '') }}/' + categoryId,
            type: 'DELETE',
            success: function(response) {
                if (response.success) {
                    swal.fire('success', response.message, 'success');                    
                    table.ajax.reload();
                } else {
                    alert('Failed to delete category: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseJSON.message);
            }
        });
    }
});
});


</script>
@endsection
