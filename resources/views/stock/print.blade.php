@extends('template')

@section('section1')
<br>
<div class="container">
	<a class="btn back-btn" href="{{ url(URL::previous()) }}">
		<span class="mdi mdi-arrow-left"></span>
	</a>
	<span class="btn print-btn"  onclick="printDiv()">
		<span class="mdi mdi-printer"></span>
	</span>
</div>

<div class="row container z-depth-5" style="border-bottom:3px solid black;padding:2%;background:lightgrey;">
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

	<div class="col s8 m8 l8">
		<h5 class="thin">Provider</h5>
		<p style="font-size:14px;">
			@if(is_null($Stock->provider))
              	unknown
            @else
	            {{$Stock->provider->user->person->first_name." ".$Stock->provider->user->person->last_name}}<br>
			   	{{$Stock->provider->user->person->email}}<br>
				{{$Stock->provider->user->person->address}}<br>
            @endif

		</p>
	</div>

	<div class="col s4 m4 l4">
		<p style="font-size:14px;">
			<strong>Stock #</strong> {{ $Stock->id }}-GTL4573<br>
			<strong>Date:</strong> {{ date('F d, Y', strtotime($Stock->created_at)) }}
		</p>
	</div>

	<div class="col s12 m12 l12">
		<table class="bordered">

	      <thead>
	        <tr class="table-head">
	            <th>Sr #</th>
	            <th>Mobile</th>
	            <th>Total Sets</th>
	            <th>SubTotal(&euro;)</th>
	        </tr>
	      </thead>

	      <tbody>
	        @foreach($Stock->items as $Item)
	          <tr>
	            <td>{{ $loop->iteration }}</td>
	            <td>{{ $Item->mobile_id }}</td>
	            <td>{{ $Item->quantity }}</td>
	            <td>{{ $Item->subtotal }}</td>
	          </tr>
	        @endforeach
	      </tbody>

	      <tfoot>
	        <tr>
	            <th></th>
	            <th></th>
	            <th>{{ $Stock->total_sets }}</th>
	            <th>{{ $Stock->total_amount }}</th>
	        </tr>
	      </tfoot>
	    </table>
	</div>

	<div class="col s12 m6 l6">
		<p>
			sig. ____________
		</p>
	</div>
	<div class="col s12 m6 l6" style="padding:1%;">
		<div style="border-top:1px solid grey;">
			<p style="float:right;">
				<strong>Current Balance: {{ $Stock->total_amount }}</strong>
			</p>
		</div>	
	</div>

	<div class="col s12 m12 l12" style="border-top:2px solid grey;">
		<p>Terms and conditions may apply</p>
	</div>
</div>

  <script>
        function printDiv() {
            var divContents = document.getElementById("GFG").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body > <h1>Div contents are <br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>
@stop




