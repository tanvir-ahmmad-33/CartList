@extends('admin.layouts.app')

@section('content')
@php
    $imageUrl = isset($category->image) && $category->image
        ? url('admin/categories_image/' . $category->image)
        : '';
@endphp

<!-- Content Header (Page header) -->
<section class="content-header">					
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Category</h1>
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
        <form action="" name="categoryForm" id="categoryForm" class="categoryForm">
            @csrf
            @method('PUT')
		    <div class="card">
			    <div class="card-body">								
				    <div class="row">
					    <div class="col-md-6">
						    <div class="mb-3">
							    <label for="name">Name</label>
							    <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $category->name}}">
                                <p id="name-error" class="invalid-feedback"></p>	
						    </div>
					    </div>
					    <div class="col-md-6">
						    <div class="mb-3">
							    <label for="slug">Slug</label>
							    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $category->slug}}" readonly>
                                <p id="slug-error" class="invalid-feedback"></p>	
						    </div>
					    </div>
                        <div class="col-md-6">
						    <div class="mb-3">
							    <label for="image">Image</label>
                                <input type="hidden" id="image_id" name="image_id" value="{{ old('image_id', $category->image_id ?? '') }}">
							    <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>
                                <p id="image-error" class="invalid-feedback"></p>
						    </div>
					    </div>
                        <div class="col-md-6">
						    <div class="mb-3">
							    <label for="status">Status</label>
							    <select name="status" id="status" class="form-control">
                                    <option value="1" {{$category->status == 1 ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{$category->status == 0 ? 'selected' : ''}}>Block</option>
                                </select>
                                <p id="status-error" class="invalid-feedback"></p>	
						    </div>
					    </div>									
				    </div>
			    </div>							
		    </div>
		    <div class="pb-5 pt-3">
			    <button type="submit" class="btn btn-success">Update</button>
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
    $(document).ready(function() {
        let imageId = $('#image_id').val();
        console.log(imageId);
    });

    $('#image_id').on('change', function() {
        let imageId = $(this).val();
        console.log('image_id changed:', imageId);
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

    Dropzone.autoDiscover = false;
    const myDropzone = new Dropzone("#image", {
        url: "{{ route('temp-images.create') }}",
        paramName: "image",
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        init: function() {
            let existingImageUrl = "{{ $imageUrl }}";
            let existingImageId = "{{ $category->image_id ?? '' }}";

            if (existingImageUrl) {
                let mimeType = 'image/jpeg';
                if (existingImageUrl.endsWith('.png')) mimeType = 'image/png';
                else if (existingImageUrl.endsWith('.gif')) mimeType = 'image/gif';

                let mockFile = {
                    name: "Current Image",
                    size: 12345,
                    accepted: true,
                    type: mimeType
                };

                this.emit("addedfile", mockFile);
                this.emit("thumbnail", mockFile, existingImageUrl);
                this.emit("complete", mockFile);
                this.files.push(mockFile);

                const previews = this.previewsContainer.querySelectorAll(".dz-preview img");
                
                if (previews.length) {
                    previews[previews.length - 1].setAttribute("alt", "Current Image");
                }

                $('#image_id').val(existingImageId);
            }

            this.on("success", function(file, response) {
                $('#image_id').val(response.image_id || '');
                $('#image-error').text('');
            });

            this.on("error", function(file, errorMessage) {
                $('#image-error').text(errorMessage);
            });

            this.on("removedfile", function(file) {
                $('#image_id').val('');
            });

            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
        }
    });

    $('#categoryForm').submit(function(e) {
        e.preventDefault();

        $('button[type=submit]').prop('disabled', true);

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');

        let categoryId = "{{ $category->id }}";
        let name = $('#name').val();
        let slug = $('#slug').val();
        let status = $('#status').val();
   
        let data = {
            name: name,
            slug: slug,
            status: status,
        };

        let existingImageId = "{{ $category->image_id ?? '' }}";
        let newImageId = $('#image_id').val() ? $('#image_id').val() : '';

        if (newImageId && newImageId !== existingImageId) {
            data.image_id = newImageId;
        }

        console.log(data);
        

        $.ajax({
            url: '{{ route("categories.update", ["id" => ":id"]) }}'.replace(':id', categoryId),
            type: 'put',
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
                        timerProgressBar: true,
                        didClose: () => {
                            window.location.href = '{{ route("categories.index") }}';
                        }
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
</script>
@endpush