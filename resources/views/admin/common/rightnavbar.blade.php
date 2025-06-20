<ul class="navbar-nav">
	<li class="nav-item">
		<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
	</li>					
</ul>
<div class="navbar-nav pl-2">
	<ol class="breadcrumb p-0 m-0 bg-white">
		<li class="breadcrumb-item active text-dark">
			@if (Route::currentRouteName() == 'admin.dashboard') <span class="text-success">Dashboard</span> @endif

			@if (Route::currentRouteName() == 'categories.index') <span class="text-success">Categories</span> | List @endif
			@if (Route::currentRouteName() == 'categories.create') <span class="text-success">Categories</span> | Create @endif

			@if (Route::currentRouteName() == 'sub-categories.index') <span class="text-success">Subcategories</span> | List @endif
			@if (Route::currentRouteName() == 'sub-categories.create') <span class="text-success">Subcategories</span> | Create @endif
			@if (Route::currentRouteName() == 'sub-categories.edit') <span class="text-success">Subcategories</span> | Edit @endif

			@if (Route::currentRouteName() == 'brands.index') <span class="text-success">Brands</span> | List @endif
			@if (Route::currentRouteName() == 'brands.create') <span class="text-success">Brands</span> | Create @endif
			@if (Route::currentRouteName() == 'brands.edit') <span class="text-success">Brands</span> | Edit @endif

			@if (Route::currentRouteName() == 'products.index') <span class="text-success">Products</span> | List @endif
			@if (Route::currentRouteName() == 'products.create') <span class="text-success">Products</span> | Create @endif
			@if (Route::currentRouteName() == 'products.edit') <span class="text-success">Products</span> | Edit @endif

			<!-- {{ Route::currentRouteName() }} -->
		</li>
	</ol>
</div>
				
<ul class="navbar-nav ml-auto">
	<li class="nav-item">
		<a class="nav-link" data-widget="fullscreen" href="#" role="button">
			<i class="fas fa-expand-arrows-alt"></i>
		</a>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
			<img src="{{ asset('assets/admin-assets/img/avatar5.png') }}" class='img-circle elevation-2' width="40" height="40" alt="">
		</a>
		<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
			<h4 class="h4 mb-0"><strong>{{ Auth::guard('admin')->user()->name }}</strong></h4>
			<div class="mb-3">{{ Auth::guard('admin')->user()->email }}</div>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item">
				<i class="fas fa-user-cog mr-2"></i> Settings								
			</a>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item">
				<i class="fas fa-lock mr-2"></i> Change Password
			</a>
			<div class="dropdown-divider"></div>
			<a href="{{ route('admin.logout') }}" class="dropdown-item text-danger">
				<i class="fas fa-sign-out-alt mr-2"></i> Logout							
			</a>							
		</div>
	</li>
</ul>