@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Create Brand</h1>
			</div>
			<div class="col-sm-6 text-right">
				<a href="{{ route('brands.index') }}" class="btn btn-primary btn-sm">Back</a>
			</div>
		</div>
	</div>
<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="container-fluid">
        <form action="" method="post" id="createBrandForm" class="createBrandForm" name="createBrandForm">
		<div class="card">
			<div class="card-body">								
				<div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<label for="name">Name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            <p id="name-error" class="invalid-feedback"></p>	
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label for="slug">Slug</label>
							<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" readonly>
                            <p id="slug-error" class="invalid-feedback"></p>	
						</div>
					</div>
                    <div class="col-md-12">
						<div class="mb-3">
							<label for="status">Status</label>
							<select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Block</option>
                            </select>
                            <p id="status-error" class="invalid-feedback"></p>	
						</div>
					</div>									
				</div>
			</div>							
		</div>
		<div class="pb-5 pt-3">
			<button type="submit" class="btn btn-success">Create</button>
			<a href="{{ route('brands.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
		</div>
        </form>
	</div>
<!-- /.card -->
</section>
<!-- /.content -->
@endsection

@push('scripts')
<script>
    $('#createBrandForm').submit(function(e) {
        e.preventDefault();

        $('button[type=submit]').prop('disabled', true);

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');

        let name = $('#name').val();
        let slug = $('#slug').val();
        let status = $('#status').val();

   
        let data = {
            name: name,
            slug: slug,
            status: status,
        };
        

        $.ajax({
            url: '{{ route("brands.store") }}',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(result) {
                console.log(result);

                if(result['status']) {
                    $('#createBrandForm')[0].reset();
                    $('button[type=submit]').prop('disabled', false);
                    window.location.href = '{{ route("brands.index") }}';
                }
            },error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 422) {
                    var errors = jqXHR.responseJSON.errors;

                    $.each(errors, function(field, messages) {
                        console.log(field + ' ' + messages)
                        $('#' + field).addClass('is-invalid');
                        $('#' + field + '-error').html(messages.join('<br>'));
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please check the form for errors.',
                        timer: 5000,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        background: '#f8d7da',
                    });
                } else if (jqXHR.status === 404) {
                    Swal.fire({
                        icon: 'error',
                        title: '404 Error',
                        text: 'Requested resource not found.',
                        timer: 5000, 
                        toast: true,
                        position: 'top-end',
                        background: '#f8d7da', 
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                } else if (jqXHR.status === 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'There was a problem with the server. Please try again later.',
                        timer: 5000,
                        toast: true,
                        position: 'top-end',
                        background: '#f8d7da', 
                        showConfirmButton: false,
                        timerProgressBar: true,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'An error occurred: ' + textStatus + ', ' + errorThrown,
                        timer: 10000,
                        toast: true,
                        position: 'top-end',
                        background: '#f8d7da',
                        showConfirmButton: false,
                        timerProgressBar: true,
                    });
                }
            }
        })
    });


    $('#name').on('input', function() {
        let title = $(this).val();

        if (title.length === 0) {
            $('#slug').val('');
            return;
        }
        
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title : title},
            dataType: 'json',
            success: function(result) {
                if(result['status']) {
                    $('#slug').val(result['slug']);
                }
            }
        });
    });
</script>
@endpush