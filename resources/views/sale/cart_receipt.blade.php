@extends('template')

@section('section1')
<br>
<div class="container">
	<a class="btn back-btn" href="{{ url(URL::previous()) }}">
		<span class="mdi mdi-arrow-left"></span>
	</a>
	<span class="btn print-btn" onclick="window.print()">
		<span class="mdi mdi-printer"></span>
	</span>
</div>

<div class="row container z-depth-5" style="border-bottom:3px solid black;padding:2%;background:lightgrey;">
	{!! Form::open(['url' => 'sale/', 'method' => 'post']) !!}
	<div class="col s8 m8 l8">
            <br>
            <img src="{{ URL::asset('img/logo.png') }}">
	</div>

	<div class="col s4 m4 l4">
		<p style="font-size:14px;">
			<strong>Tel:</strong> (+78) 565 3246267<br>
			<strong>Email:</strong> info@gtl.com<br>
		</p>	
	</div>

	<div class="col s4 m4 l4">
		<p style="font-size:14px;">
			<strong>Sale #</strong> {{ "SL".$Salesman->id."CL".$Client->id }}-GTL4573<br>	
			<strong>Date:</strong> 	{{ Carbon\Carbon::now() }}
		</p>
	</div>

	<div class="col s12 m12 l12">
		<center>
			<h4 class="thin">Cart Receipt</h4>
		</center>
	</div>

	<div class="col s4 m4 l4">
		<h5 class="thin">Client</h5>
		<p style="font-size:14px;">
			{!! Form::hidden('client_id', $Client->id) !!}

			{{$Client->user->person->first_name." ".$Client->user->person->last_name}}<br>
			{{$Client->user->person->email}}<br>
			{{$Client->user->person->address}}<br>
		</p>
	</div>

	<div class="col s4 m4 l4">
		<h5 class="thin">Salesman</h5>
		<p style="font-size:14px;">
			{!! Form::hidden('seller_id', Auth::User()->id) !!}

			{{$Salesman->user->person->first_name." ".$Salesman->user->person->last_name}}<br>
			{{$Salesman->user->person->email}}<br>
			{{$Salesman->user->person->address}}<br>
		</p>
	</div>

	<div class="col s12 m12 l12">
		<table class="bordered">
	      
	      <thead>
	        <tr class="table-head">
	            <th>Sr #</th>
	            <th>Company</th>
	            <th>Product Name</th>
	            <th>Model</th>
	            <th>IMEI</th>
	            <th>Price</th>
	        </tr>
	      </thead>

	      <tbody>
	      	@php $total_amount=0; @endphp

	        @foreach($Products as $Item)
	          <tr>
	            <td>{{ $loop->iteration }}</td>
	            <td>{{ $Item->product->sub_category->name }}</td>
	            <td>{{ $Item->product->name }}</td>
	            <td>{{ $Item->product->model }}</td>
	            <td>{{ $Item->imei }}</td>
	            <td>{{ $Item->product->sale_price }}&euro;</td>

	            {!! Form::hidden('item_id[]', $Item->id) !!}
	            @php $total_amount=$total_amount+$Item->product->sale_price; @endphp
	          </tr>  
	        @endforeach
	      </tbody>

	      <tfoot>
	        <tr>
	            <th></th>
	            <th></th>
	            <th></th>
	            <th></th>	
	            <th>Quantity = {{ count($Products) }}</th>
	            <th>Total Amount = {{ $total_amount }}</th>
	            {!! Form::hidden('total_sets', count($Products)) !!}
	            {!! Form::hidden('total_amount', $total_amount) !!}
	        </tr>
	      </tfoot>
	    </table>
	</div>

	<div class="col s12 m6 l6">
		{{ Form::button('<span class="mdi mdi-receipt"></span> Save', ['class'=>'btn add-btn', 'type'=>'submit']) }}
	</div>
	<div class="col s12 m6 l6" style="padding:1%;">
		<div style="border-top:1px solid grey;">
			<p style="float:right;">
				<strong>{{ $Client->user->person->first_name }}'s Current Balance: {{ $Client->current_bal }}&euro;</strong><br>
				<strong>{{ $Client->user->person->first_name }}'s Total Balance: {{ $Client->current_bal+$total_amount }}&euro;</strong>
			</p>
		</div>	
	</div>

	<div class="col s12 m12 l12" style="border-top:2px solid grey;">
		<p>Terms and conditions may apply</p>
	</div>
	{!! Form::close() !!}
</div>
@stop




