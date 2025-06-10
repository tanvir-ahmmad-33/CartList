<aside class="main-sidebar sidebar-light-primary elevation-4">
				<!-- Brand Logo -->
				<a href="{{ route('admin.dashboard') }}" class="brand-link">
					<img src="{{ asset('assets/admin-assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text text-dark fw-bolder">Cart List</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user (optional) -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class
								with font-awesome or any other icon font library -->
							<li class="nav-item">
								<a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'text-success' : '' }}">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'text-success' : 'text-muted' }}">Dashboard</p>
								</a>																
							</li>
							<li class="nav-item">
								<a href="{{ route('categories.index') }}" 
								class="nav-link {{ ( Route::currentRouteName() == 'categories.index' 
								                || Route::currentRouteName() == 'categories.create' 
												|| Route::currentRouteName() == 'categories.edit') ? 'text-success' : '' }}">
									<i class="nav-icon fas fa-file-alt"></i>
									<p class="{{(Route::currentRouteName() == 'categories.index' 
									          || Route::currentRouteName() == 'categories.create'
											  || Route::currentRouteName() == 'categories.edit') ? 'text-success' : 'text-muted' }}">Category</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('sub-categories.index') }}" 
								class="nav-link {{ (Route::currentRouteName() == 'sub-categories.index' 
								                || Route::currentRouteName() == 'sub-categories.create' 
												|| Route::currentRouteName() == 'sub-categories.edit') ? 'text-success' : '' }}">
									<i class="nav-icon fas fa-file-alt"></i>
									<p class="{{(Route::currentRouteName() == 'sub-categories.index' 
									           || Route::currentRouteName() == 'sub-categories.create' 
											   || Route::currentRouteName() == 'sub-categories.edit') ? 'text-success': 'text-muted'}}">Sub Category</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('brands.index') }}" 
								class="nav-link {{ (Route::currentRouteName() == 'brands.index'
								                || Route::currentRouteName() == 'brands.create'
								                || Route::currentRouteName() == 'brands.edit') ? 'text-success' : '' }}">
									<svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
									  </svg>
									<p class="{{(Route::currentRouteName() == 'brands.index' 
									           || Route::currentRouteName() == 'brands.create' 
											   || Route::currentRouteName() == 'brands.edit') ? 'text-success': 'text-muted'}}">Brands</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('products.index') }}" 
								class="nav-link {{ (Route::currentRouteName() == 'products.index'
								                || Route::currentRouteName() == 'products.create'
								                || Route::currentRouteName() == 'products.edit') ? 'text-success' : '' }}">
									<i class="nav-icon fas fa-tag"></i>
									<p class="{{(Route::currentRouteName() == 'products.index' 
									           || Route::currentRouteName() == 'products.create' 
											   || Route::currentRouteName() == 'products.edit') ? 'text-success': 'text-muted'}}">Products</p>
								</a>
							</li>
							
							<li class="nav-item">
								<a href="#" class="nav-link">
									<!-- <i class="nav-icon fas fa-tag"></i> -->
									<i class="fas fa-truck nav-icon"></i>
									<p class="text-muted">Shipping</p>
								</a>
							</li>							
							<li class="nav-item">
								<a href="orders.html" class="nav-link">
									<i class="nav-icon fas fa-shopping-bag"></i>
									<p class="text-muted">Orders</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="discount.html" class="nav-link">
									<i class="nav-icon  fa fa-percent" aria-hidden="true"></i>
									<p class="text-muted">Discount</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="users.html" class="nav-link">
									<i class="nav-icon  fas fa-users"></i>
									<p class="text-muted">Users</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="pages.html" class="nav-link">
									<i class="nav-icon  far fa-file-alt"></i>
									<p class="text-muted">Pages</p>
								</a>
							</li>							
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
         	</aside>