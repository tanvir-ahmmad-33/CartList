@extends('admin.layouts.app')

@section('content')
<section class="content-header">					
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
			    <p class="display-4">Dashboard</p>
		    </div>
			<div class="col-sm-6">
								
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</section>
<section class="content">
	<!-- Default box -->
	<div class="container-fluid">
		<div class="row bg">
			<div class="col-lg-4 col-6">							
				<div class="small-box card">
					<div class="inner">
						<h3>150</h3>
						<p>Total Orders</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="#" class="small-box-footer text-dark bg-success">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
							
			<div class="col-lg-4 col-6">							
				<div class="small-box card">
					<div class="inner">
						<h3>50</h3>
						<p>Total Customers</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="#" class="small-box-footer text-dark bg-success">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
							
			<div class="col-lg-4 col-6">							
				<div class="small-box card">
					<div class="inner">
						<h3>$1000</h3>
						<p>Total Sale</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="javascript:void(0);" class="small-box-footer bg-success">&nbsp;</a>
				</div>
			</div>
		</div>
	</div>					
	<!-- /.card -->
</section>
@endsection

@push('scripts')
<script>
    console.log('dashboard loaded.');
</script>
@endpush