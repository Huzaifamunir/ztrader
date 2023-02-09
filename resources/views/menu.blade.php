@extends('template')

       @section('section1')
 <div class="col s12 m12 l12">
	 <center>
		<h2 class="thin">
			<span class="mdi mdi-menu"></span>Menu
		</h2>
	 </center>
 </div>

<div class="col s12 m12 l12">
	{{-- <div class="col s12 m6 l4">
		<div class="menu-tab z-depth-4">
			<a href="{{ route('country.index') }}">
				<div align="center">
					<h2>
						<span class="mdi mdi-script"></span>
					</h2>
					<h4 class="thin">Country</h4>
					<!-- <a href="{{ route('country.create') }}" class="btn">
						<span class="mdi mdi-plus"></span>
					</a> -->
				</div>
			</a>
		</div>
	</div> --}}

	{{-- <div class="col s12 m6 l4">
		<div class="menu-tab z-depth-4">
			<a href="{{ route('state.index') }}">
				<div align="center">
					<h2>
						<span class="mdi mdi-script"></span>
					</h2>
					<h4 class="thin">State</h4>
				</div>
			</a>
		</div>
	</div> --}}

	{{-- <div class="col s12 m6 l4">
		<div class="menu-tab z-depth-4">
			<a href="{{ route('city.index') }}">
				<div align="center">
					<h2>
						<span class="mdi mdi-script"></span>
					</h2>
					<h4 class="thin">City</h4>
				</div>
			</a>
		</div>
	</div> --}}

	<div class="col s12 m6 l4">
		<div class="menu-tab z-depth-4">
			<a href="{{ route('main_category.index') }}">
				<div align="center">
					<h2>
						<span class="mdi mdi-script"></span>
					</h2>
					<h4 class="thin">Brands</h4>
				</div>
			</a>
		</div>
	</div>

	<div class="col s12 m6 l4">
		<div class="menu-tab z-depth-4">
			<a href="{{ route('sub_category.index') }}">
				<div align="center">
					<h2>
						<span class="mdi mdi-script"></span>
					</h2>
					<h4 class="thin">Products</h4>
				</div>
			</a>
		</div>
	</div>

	<div class="col s12 m6 l4">
		<div class="menu-tab z-depth-4">
			<a href="{{ route('product.index') }}">
				<div align="center">
					<h2>
						<span class="mdi mdi-script"></span>
					</h2>
					<h4 class="thin">Product_Lists</h4>
				</div>
			</a>
		</div>
	</div>

	<div class="col s12 m6 l4">
		<div class="menu-tab z-depth-4">
			<a href="{{ route('stock.index') }}">
				<div align="center">
					<h2>
						<span class="mdi mdi-script"></span>
					</h2>
					<h4 class="thin">Stock</h4>
				</div>
			</a>
		</div>
	</div>

	<div class="col s12 m6 l4">
		<div class="menu-tab z-depth-4">
			<a href="{{ route('sale.index') }}">
				<div align="center">
					<h2>
						<span class="mdi mdi-script"></span>
					</h2>
					<h4 class="thin">Sale</h4>
				</div>
			</a>
		</div>
	</div>

	<div class="col s12 m6 l4">
		<div class="menu-tab z-depth-4">
			<a href="{{ route('payment.index') }}">
				<div align="center">
					<h2>
						<span class="mdi mdi-script"></span>
					</h2>
					<h4 class="thin">Payment</h4>
				</div>
			</a>
		</div>
	</div>
</div>
@stop
