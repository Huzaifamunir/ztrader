@extends('template')

@section('section1')
  
<br>
<div class="col s12 m8 l8 offset-m2 offset-l2 z-depth-5" style="padding:3%;background-color: white;">

  <div class="col s4">
    <a class="btn back-btn" href="{{ url(URL::previous()) }}">
      <span class="mdi mdi-arrow-left"></span>
    </a>

    <a class="btn back-btn" href="{{ route('home') }}">
      <span class="mdi mdi-menu"></span>
    </a>

    <span class="btn back-btn" onclick="print_this('transaction_container')">
      <span class="mdi mdi-printer"></span>
    </span>
  </div>

  <div class="col s8">
    <h4 class="thin">
      <span class="mdi mdi-script"></span>
      Sale Payment Report
    </h4>
  </div>

  <div class="col s12 m12 l12">
    {!! Form::open(['url' => 'dashboard/date_sales', 'method' => 'post']) !!}
      <div class="input-field col s6 m3 l3">
        <input type="date" class="datepicker" name="date">        
        <label for="date" class="active">Date</label>
      </div>
      <div class="input-field col s6 m3 l3">
        {{ Form::button('<span class="mdi mdi-script"></span>', ['class'=>'btn add-btn', 'type'=>'submit']) }}
      </div>
    {{ Form::close() }}

    <div class="col s12 m6 l6">
      <p class="thin">{{ $report_date }}</p>
    </div>
  </div>

  <div class="row" id="transaction_container">
    <div class="col s6 m6 l6">
      <table class="highlight bordered">
        @if($sales->isEmpty())
          <caption>
            <h4 class="thin">Sales not found!!</h4>
          </caption>  
        @else
          <caption>
            <h4 class="thin">Sales</h4>
            <p>
              <strong>Total: {{ $total_sales }}</strong>
            </p>
          </caption>

          <thead>
            <th>Bill #</th>
            <th>Client</th>
            <th>Amount</th>
          </thead>

          <tbody>
            @foreach($sales as $Sale)
           
              <tr>
                <td>ZR_{{ str_pad($Sale['id'], 3, "0", STR_PAD_LEFT) }}</td>
                <?php $get_client=\App\Models\User::where(['id' => $Sale->client_id])->first();
                $get_client_name=explode('.',$get_client->name);?>
               
                <td> {{ $get_client_name[0] }} {{ $get_client_name[1] }}</td>
                <td>{{ $Sale->total_amount }}</td>
              </tr>
            @endforeach
          </tbody>
        @endif  
      </table>
    </div>

    <div class="col s6 m6 l6">
      <table class="highlight bordered">
        @if($payments->isEmpty())
          <caption>
            <h4 class="thin">Payments not found!!</h4>
          </caption>  
        @else
          <caption>
            <h4 class="thin">Payments</h4>
            <p>
              <strong>Total: {{ $total_payments }}</strong>
            </p>
          </caption>

          <thead>
            <th>Payment #</th>
            <th>Client</th>
            <th>Amount</th>
          </thead>

          <tbody>
            @foreach($payments as $Payment)
           
              <tr>
                <td>ZR_{{ str_pad($Payment['id'], 3, "0", STR_PAD_LEFT) }}</td>
                <?php $get_client=\App\Models\User::where(['id' => $Payment->payer_id])->first();
                $get_client_name=explode('.',$get_client->name);?>
               
                <td> {{ $get_client_name[0] }} {{ $get_client_name[1] }}</td>
                <td>{{ $Payment->amount }}</td>
              </tr>
            @endforeach
          </tbody>
        @endif  
      </table>
    </div>  
  </div>
</div>

@stop 