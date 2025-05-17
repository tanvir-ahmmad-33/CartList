@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Create Category</h1>
			</div>
			<div class="col-sm-6 text-right">
				<a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm">Back</a>
			</div>
		</div>
	</div>
<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="container-fluid">
        <form action="" method="POST" id="categoryForm" class="categoryForm" name="categoryForm">
            @csrf
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
							    <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                <p id="slug-error" class="invalid-feedback"></p>
						    </div>
					    </div>
                        <div class="col-md-6">
						    <div class="mb-3">
                                <input type="hidden" id="image_id" name="image_id" value="">
                                <input type="hidden" id="image_extension" name="image_extension" value="">
							    <label for="image">Image</label>
							    <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload. <br><br>
                                    </div>
                                </div>
                                <p id="image-error" class="invalid-feedback"></p>
						    </div>
					    </div>		
                        <div class="col-md-6">
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
			<a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
		</div>
        </form>
	</div>
	<!-- /.card -->
</section>
<!-- /.content -->
@endsection

@push('scripts')
<script>
    $('#categoryForm').submit(function(e) {
        e.preventDefault();

        $('button[type=submit]').prop('disabled', true);

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');

        let name = $('#name').val();
        let slug = $('#slug').val();
        let status = $('#status').val();
        let imageId = $('#image_id').val() ? $('#image_id').val() : '';
        let imageExt = $('#image_extension').val() ? $('#image_extension').val() : '';

   
        let data = {
            name: name,
            slug: slug,
            status: status
        };

        if (imageId) {
            data.image_id = imageId;
            data.image_extension = imageExt;
        }
        

        $.ajax({
            url: '{{ route("categories.store") }}',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(result) {

                console.log(result);

                if(result['status']) {
                    $('#categoryForm')[0].reset();
                    $('button[type=submit]').prop('disabled', false);
                    window.location.href = '{{ route("categories.index") }}';
                }
            },error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 422) {
                    var errors = jqXHR.responseJSON.errors;

                    $.each(errors, function(field, messages) {
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

    $('#name').change(function() {
        let title = $(this).val();
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

    Dropzone.autoDiscover = false;
    const dropzone = $('#image').dropzone({
        init: function() {
            this.on('addedfile', function(file) {
                if(this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
        },

        url: "{{ route('temp-images.create') }}",
        maxFiles: 1,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif,image/jpg",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, success: function(file, result){
            $("#image_id").val(result.image_id);
            let fileExtension = file.name.split('.').pop().toLowerCase();
            $("#image_extension").val(fileExtension);
        }
    });
</script>
@endpush