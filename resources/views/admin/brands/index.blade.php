@extends('admin.layouts.app')

@section('content')
<section class="content-header">					
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Brand</h1>
			</div>
			<div class="col-sm-6 text-right">
				<a href="{{ route('brands.create') }}" class="btn btn-success btn-sm">New Brand</a>
			</div>
		</div>
	</div>
<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="container-fluid">

	    @if (session('brand_created'))
            <div id="BrandMessage" class="alert alert-success text-center" role="alert">
                <i class="fas fa-check-circle text-dark mr-2" style="font-size: 2rem;"></i>
                <strong class="mr-2" style="font-size: 2rem;">Success!</strong>  <br>
                <span>Brand added successfully</span>
			</div>
        @endif

		@if (session('brand_updated'))
	        <div id="BrandMessage" class="alert alert-success text-center" role="alert">
                <i class="fas fa-check-circle text-dark mr-2" style="font-size: 2rem;"></i>
                <strong class="mr-2" style="font-size: 2rem;">Success!</strong>  <br>
                <span>Brand updated successfully</span>
			</div>
		@endif

		@if (session('brand_deleted'))
	        <div id="BrandMessage" class="alert alert-danger text-center" role="alert">
                <i class="fas fa-check-circle text-dark mr-2" style="font-size: 2rem;"></i>
                <strong class="mr-2" style="font-size: 2rem;">Success!</strong>  <br>
                <span>Brand deleted successfully</span>
			</div>
		@endif

		@if (session('Brand_not_found'))
	        <div id="BrandMessage" class="alert alert-danger text-center" role="alert">
                <i class="fas fa-times-circle text-dark mr-2" style="font-size: 2rem;"></i>
                <strong class="mr-2" style="font-size: 2rem;">Error!</strong>  <br>
                <span>Brand isn't Found</span>
			</div>
		@endif

		<div class="card">
			<form action="" method="get">
			    <div class="card-header">
					<div class="d-flex justify-content-end align-items-center">
						<div class="input-group" style="max-width: 300px; width: 100%;">
							<input type="text" name="keyword" class="form-control rounded-pill border border-dark" value="{{ Request::get('keyword') }}" placeholder="Search">
							<div class="input-group-append">
							    <button type="submit" class="btn btn-dark rounded-pill ml-2" id="searchBtn">
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
                        @if ($brands->isNotEmpty())
                            @foreach($brands as $brand)
                            <tr>
                                <td>{{ $brands->firstItem() + $loop->iteration - 1 }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td>
                                    @if($brand->status == 1)
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
                                    <a href="" class="btn btn-warning btn-sm editbtn" data-id="{{ $brand->id }}" data-name="{{ $brand->name }}">
										<i class="fa-solid fa-pencil"></i><span class="p-1">Edit</span></a>
                                    <a href="" class="btn btn-danger btn-sm deletebtn" data-id="{{ $brand->id }}" data-name="{{ $brand->name }}">
										<i class="fa-solid fa-trash"></i><span class="p-1">Delete</span></a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td>No Brand Found.</td>
                        </tr>
                        @endif
					</tbody>
				</table>										
			</div>
			<div class="card-footer clearfix">
				{{ $brands->links() }}
			</div>
		</div>
	</div>
<!-- /.card -->
</section>
@endsection

@push('scripts')
<script>
	$(document).on('click', '#resetSearchBtn', function() {
		console.log('reset button clicked');
		$(':input[name="keyword"]').val('');
		window.location.href = '{{ route("brands.index") }}';
	});

	$(document).ready(function() {
        if ($('#BrandMessage').length > 0) {
            setTimeout(function() {
                $('#BrandMessage').fadeOut('slow'); 
		    }, 4000);
        }
    });

	$(document).on('click', '.editbtn', function(e) {
		e.preventDefault();

		console.log("edit button");

		let brandId = $(this).attr('data-id');
		let brandName = $(this).attr('data-name');

		Swal.fire({
            title: 'Are you sure?',
            html: `Do you want to edit the brand <br><strong>${brandName} ?</strong><br>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                let editUrl = "{{ route('brands.edit', ['id' => ':id']) }}".replace(':id', brandId);
                window.location.href = editUrl;
            }
        });
	});

	$(document).on('click', '.deletebtn', function(e) {
		e.preventDefault();

		let brandId = $(this).attr('data-id');
		let brandName = $(this).attr('data-name');

		Swal.fire({
            title: 'Are you sure?',
            html: `Do you want to delete the brand <br><strong>${brandName} ?</strong><br>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel',
            reverseButtons: true
        }).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "{{ route('brands.destroy', ['id' => ':id']) }}".replace(':id', brandId),
					type: 'DELETE',
					success: function(result) {
						window.location.href = "{{ route('brands.index') }}";
					}, error: function(jqXHR, textStatus, errorThrown) {
						Swal.fire({
                        icon: 'error',
                        title: 'Server error',
                        html: 'Failed to delete brand.<br/>Please try again later.',
                        timer: 5000,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        background: '#f8d7da',
                        }).then(() => {
							window.location.href = '{{ route("brands.index") }}';
						});
					}
				});
			}
		});
	});
</script>
@endpush