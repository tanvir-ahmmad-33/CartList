@extends('admin.layouts.app')

@section('content')
<section class="content-header">					
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Categories</h1>
			</div>
			<div class="col-sm-6 text-right">
				<a href="{{ route('categories.create') }}" class="btn btn-success btn-sm">New Category</a>
			</div>
		</div>
	</div>
<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="container-fluid">

	    @if (session('category_created'))
            <div id="categoryMessage" class="alert alert-success text-center" role="alert">
                <i class="fas fa-check-circle text-dark mr-2" style="font-size: 2rem;"></i>
                <strong class="mr-2" style="font-size: 2rem;">Success!</strong>  <br>
                <span>Category added successfully</span>
			</div>
        @endif

		@if (session('found_category_error'))
		    <div id="categoryMessage" class="alert alert-danger text-center" role="alert">
				<i class="fas fa-times-circle text-dark mr-2" style="font-size: 2rem;"></i>
                <strong class="mr-2" style="font-size: 2rem;">Error!</strong>  <br>
                <span>Category is not found</span>
			</div>
		@endif
		
		@if (session('category_updated'))
		    <div id="categoryMessage" class="alert alert-success text-center" role="alert">
				<i class="fas fa-check-circle text-dark mr-2" style="font-size: 2rem;"></i>
                <strong class="mr-2" style="font-size: 2rem;">Success!</strong>  <br>
                <span>Category updated successfully</span>
			</div>
		@endif

		@if (session('category_deleted'))
            <div id="categoryMessage" class="alert alert-success text-center" role="alert">
                <i class="fas fa-check-circle text-dark mr-2" style="font-size: 2rem;"></i>
                <strong class="mr-2" style="font-size: 2rem;">Success!</strong>  <br>
                <span>Category deleted successfully</span>
			</div>
        @endif

		<div class="card">
			<form action="" method="get">
			    <div class="card-header">
					<div class="d-flex justify-content-end align-items-center">
						<div class="input-group" style="max-width: 300px; width: 100%;">
							<input type="text" name="keyword" class="form-control rounded-pill border border-dark" value="{{ Request::get('keyword') }}" placeholder="Search">
							<div class="input-group-append">
							    <button type="submit" class="btn btn-dark rounded-pill ml-2">
								    <i class="fas fa-search"></i>
								</button>
								<button type="reset" class="btn btn-secondary rounded-pill ml-2" id="resetSearchBtn">
								    <i class="fas fa-undo"></i>
								</button>
							</div>
						</div>
					</div>
			    </div>
			</form>
			<div class="card-body table-responsive p-0">								
				<table class="table table-hover text-nowrap">
					<thead>
						<tr>
							<th width="60">ID</th>
					    	<th>Name</th>
							<th>Slug</th>
							<th width="100">Status</th>
							<th width="100">Action</th>
						</tr>
					</thead>
				    <tbody>
                        @if ($categories->isNotEmpty())
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $loop->iteration - 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    @if($category->status == 1)
                                    <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
									</svg>
                                    @else
                                    <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
									</svg>
                                    @endif
                                </td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm editbtn" data-id="{{ $category->id }}" data-name="{{ $category->name }}"><i class="fa-solid fa-pencil"></i><span class="p-1">Edit</span></a>
                                    <a href="" class="btn btn-danger btn-sm deletebtn" data-id="{{ $category->id }}" data-name="{{ $category->name }}"><i class="fa-solid fa-trash"></i><span class="p-1">Delete</span></a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td>No Categories Found.</td>
                        </tr>
                        @endif
					</tbody>
				</table>										
			</div>
			<div class="card-footer clearfix">
				{{ $categories->links() }}
			</div>
		</div>
	</div>
<!-- /.card -->
</section>
@endsection

@push('scripts')
<script>
	$(document).on('click', '#resetSearchBtn', function() {
		console.log('button clickeed');
		$(':input[name="keyword"]').val('');
		window.location.href = '{{ route("categories.index") }}';
	});

	$(document).ready(function() {
        if ($('#categoryMessage').length > 0) {
            setTimeout(function() {
                $('#categoryMessage').fadeOut('slow'); 
		    }, 4000);
        }
    });

	$(document).on('click', '.editbtn', function(e) {
		e.preventDefault();
		
		
		let categoryId = $(this).attr('data-id');
		let categoryName = $(this).attr('data-name');

		Swal.fire({
            title: 'Are you sure?',
            html: `Do you want to edit the category <br><strong>${categoryName} ?</strong><br>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                let editUrl = "{{ route('categories.edit', ['id' => ':id']) }}".replace(':id', categoryId);
                window.location.href = editUrl;
            }
        });
	});


	$(document).on('click', '.deletebtn', function(e) {
		e.preventDefault();
		
		let categoryId = $(this).attr('data-id');
		let categoryName = $(this).attr('data-name');

		Swal.fire({
            title: 'Are you sure?',
            html: `Do you want to delete the category <br><strong>${categoryName} ?</strong><br>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel',
            reverseButtons: true
        }).then((result) => {
			if(result.isConfirmed) {
				$.ajax({
					url: "{{ route('categories.destroy', ['id' => ':id']) }}".replace(':id', categoryId),
			        type: 'delete',
			        dataType: 'json',
			        success: function(result) {
				        window.location.href = '{{ route("categories.index") }}';
			        }, error: function(jqXHR, textStatus, errorThrown) {
						Swal.fire({
                            icon: 'error',
                            title: 'Server error',
                            html: 'Failed to delete category.<br/>Please try again later.',
                            timer: 3000,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            background: '#f8d7da',
                            }).then(() => {
							window.location.href = '{{ route("categories.index") }}';
						});
					}
				});
			}
		});
	});
</script>
@endpush