@extends('admin.layouts.app')

@section('content')
<section class="content-header">					
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Products</h1>
			</div>
			<div class="col-sm-6 text-right">
				<a href="{{ route('categories.create') }}" class="btn btn-sm btn-success">New Product</a>
			</div>
		</div>
	</div>
</section>
				
<section class="content">
	<div class="container-fluid">

        @if (session('product_created'))
        <div id="ProductMessage" class="alert alert-success text-center" role="alert">
            <i class="fas fa-check-circle text-dark mr-2" style="font-size: 2rem;"></i>
            <strong class="mr-2" style="font-size: 2rem;">Success!</strong>  <br>
            <span>Product added successfully</span>
		</div>
        @endif

        @if (session('product_updated'))
        <div id="ProductMessage" class="alert alert-success text-center" role="alert">
            <i class="fas fa-check-circle text-dark mr-2" style="font-size: 2rem;"></i>
            <strong class="mr-2" style="font-size: 2rem;">Success!</strong>  <br>
            <span>Product updated successfully</span>
		</div>
        @endif

        @if (session('product_deleted'))
        <div id="ProductMessage" class="alert alert-danger text-center" role="alert">
            <i class="fas fa-check-circle text-dark mr-2" style="font-size: 2rem;"></i>
            <strong class="mr-2" style="font-size: 2rem;">Success!</strong>  <br>
            <span>Product deleted successfully</span>
		</div>
        @endif

        @if (session('product_not_found'))
        <div id="ProductMessage" class="alert alert-danger text-center" role="alert">
            <i class="fas fa-times-circle text-dark mr-2" style="font-size: 2rem;"></i>
            <strong class="mr-2" style="font-size: 2rem;">Error!</strong>  <br>
            <span>Product isn't Found</span>
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
							<th width="80"></th>
							<th>Product</th>
							<th>Price</th>
							<th>Qty</th>
							<th>SKU</th>
							<th width="100">Status</th>
							<th width="100">Action</th>
						</tr>
					</thead>
					<tbody>
						@if($products->isNotEmpty())
						    @foreach($products as $product)
						    <tr>
								<td> {{ $products->firstItem() + $loop->iteration - 1 }} </td>
								<td> --- </td>
							    <td> {{ $product->title }}                               </td>
								<td> {{ $product->price }}                               </td>
								<td> {{ $product->qty }} left in Stock                   </td>
								<td> {{ $product->sku }}                                 </td>
								<td>
									@if($product->status == 1)
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
                                    <a href="" class="btn btn-warning btn-sm editbtn" data-id="{{ $product->id }}" data-name="{{ $product->name }}">
										<i class="fa-solid fa-pencil"></i><span class="p-1">Edit</span></a>
                                    <a href="" class="btn btn-danger btn-sm deletebtn" data-id="{{ $product->id }}" data-name="{{ $product->name }}">
										<i class="fa-solid fa-trash"></i><span class="p-1">Delete</span></a>
                                </td>
						    </tr>
							@endforeach

						@else
						<tr>
							<td>No product Found.</td>
						</tr>

						@endif
					</tbody>
				</table>										
			</div>
			<div class="card-footer clearfix">
				{{ $products->links() }}
			</div>
		</div>
	</div>
</section>
@endsection

@push('scripts')
<script>
</script>
@endpush