@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Create Product</h1>
			</div>
			<div class="col-sm-6 text-right">
				<a href="{{ route('products.index') }}" class="btn btn-sm btn-success">Back</a>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
    <form action="" method="post" id="productForm" class="productForm" name="productForm">
		<div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">								
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                        <p id="title-error" class="invalid-feedback"></p>	
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                                        <p id="slug-error" class="invalid-feedback"></p>	
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                    </div>
                                </div>                                            
                            </div>
                        </div>	                                                                      
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Media</h2>
                            <input type="hidden" id="image_ids" name="image_ids" value='{{ old("image_ids", "[]") }}'>							
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">    
                                    <br>Drop files here or click to upload.<br><br>                                            
                                </div>
                            </div>
                            <p id="image-error" class="invalid-feedback"></p>
                        </div>	                                                                      
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Pricing</h2>								
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                        <p id="price-error" class="invalid-feedback"></p>	
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="compare_price">Compare at Price</label>
                                        <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                         <p class="text-muted mt-3">
                                            To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                        </p>	
                                    </div>
                                </div>                                            
                            </div>
                        </div>	                                                                      
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Inventory</h2>								
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sku">SKU (Stock Keeping Unit)</label>
                                        <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">
                                        <p id="sku-error" class="invalid-feedback"></p>	
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="barcode">Barcode</label>
                                        <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                                    </div>
                                </div>   
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="hidden" name="track_qty" value="No">
                                            <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" value="Yes" checked>
                                            <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                            <p id="track_qty-error" class="invalid-feedback"></p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">
                                        <p id="qty-error" class="invalid-feedback"></p>	
                                    </div>
                                </div>                                         
                            </div>
                        </div>	                                                                      
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">	
                            <h2 class="h4 mb-3">Product status</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="card">
                        <div class="card-body">	
                            <h2 class="h4  mb-3">Product category</h2>
                            <div class="mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value=""> Select a Category </option>
                                    @if($categories->isNotEmpty())
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                    @endforeach
                                    @endif
                                </select>
                                <p id="category_id-error" class="invalid-feedback"></p>
                            </div>
                            <div class="mb-3">
                                <label for="sub_category_id">Sub category</label>
                                <select name="sub_category_id" id="sub_category_id" class="form-control">
                                    <option value=""> Select a Subcategory </option>
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="card mb-3">
                        <div class="card-body">	
                            <h2 class="h4 mb-3">Product brand</h2>
                            <div class="mb-3">
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">Select a Brand</option>
                                    @if($brands->isNotEmpty())
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="card mb-3">
                        <div class="card-body">	
                            <h2 class="h4 mb-3">Featured product</h2>
                            <div class="mb-3">
                                <select name="is_featured" id="is_featured" class="form-control">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>                                                
                                </select>
                                <p id="is_featured-error" class="invalid-feedback"></p>
                            </div>
                        </div>
                    </div>                                 
                </div>
            </div>
						
			<div class="pb-5 pt-3">
				<button type="submit" class="btn btn-primary">Create</button>
				<a href="{{ route('products.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
			</div>
		</div>
		<!-- /.card -->
    </form>
</section>
<!-- /.content -->
@endsection

@push('scripts')
<script>
    // get Slug by name
    $('#title').on('input', function() {
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

    // get Subcategory using Category
    $(document).on('change', '#category_id', function(e) {
        e.preventDefault();

        let category_id = $(this).val();

        $.ajax({
            url: "{{ route('product-subcategories.index') }}",
            type: 'get',
            dataType: 'json',
            data: {
                category_id: category_id,
            },
            success: function(result) {
                $("#sub_category_id").find("option").not(":first").remove();
                $.each(result['data'], function(key, value) {
                    $("#sub_category_id").append(`<option value="${value.id}">${value.name}</option>`);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 404) {
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
        });
    });

    $('#productForm').submit(function(e) {
        e.preventDefault();

        $('button[type=submit]').prop('disabled', true);

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');

        let formData = {};
        $(this).serializeArray().forEach(field => {
            formData[field.name] = field.value;
        });


        $.ajax({
            url: "{{ route('products.store') }}",
            type: 'post',
            dataType:'json',
            data: formData,
            success: function(result) {
                if(result['status']) {
                    $('#productForm')[0].reset();
                    $('button[type=submit]').prop('disabled', false);
                    window.location.href = '{{ route("products.index") }}';
                }
            }, error: function(jqXHR, textStatus, errorThrown) {
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

    // tracking images
    Dropzone.autoDiscover = false;
    const uploadImageIds = [];
    const dropzone = new Dropzone('#image', {
        url: "{{ route('temp-images.create') }}",
        paramName: "image",
        maxFiles: 10,
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif,image/jpg",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },

        init: function() {
            this.on("success", function(file, response) {
                uploadImageIds.push(response.image_id);
                $('#image_ids').val(JSON.stringify(uploadImageIds));
                file.imageId = response.image_id;

                console.log(uploadImageIds);
            });

            this.on("removedfile", function(file) {
                if(file.imageId) {
                    const index = uploadImageIds.indexOf(file.imageId);

                    if(index >= 0) {
                        uploadImageIds.splice(index, 1);
                        $('#image_ids').val(JSON.stringify(uploadImageIds));

                    }
                }
            });
        }
    });
</script>
@endpush