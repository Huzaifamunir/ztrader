@extends('template')

@section('section1')
  
<br>
<div class="col s12 m8 l8 offset-m2 offset-l2 z-depth-5" style="padding:3%;background-color: white;">
  <div id="hideExtra">
  <a class="btn back-btn" href="{{ url(URL::previous()) }}">
    <span class="mdi mdi-arrow-left"></span>
  </a>
  <a class="btn back-btn" href="{{ route('payment.index') }}">
    <span class="mdi mdi-menu"></span>
  </a>
  <a class="btn back-btn" href="javascript:;" onclick="printPayment()">
    print
  </a>
</div>
  @if($Payment==NULL) 
    <center>
      <h3 class="thin">No Record Found !</h3>
    </center>  
  @else 
    <table class="highlight bordered">
      
      <caption>
        <h3 class="thin">Payment</h3>
      </caption>

      <tbody>
        <tr>
          <th>Date</th>
          <td>{{ $Payment['created_at']->format('d-M-Y') }}</td>
        </tr>
        <tr>
          <th>Received By</th>
          <?php $get_receiver=\App\Models\User::where(['id' => $Payment->receiver_id])->first();
              
              ?>
          <td>{{ $get_receiver->name }}</td>
        </tr>
        <tr>
          <th>Payer</th>
          <td>
            <?php $get_client=\App\Models\User::where(['id' => $Payment->payer_id])->first();
              $get_client_name=explode('.',$get_client->name);
              ?>
            <a href="{{ route('client_single',['id'=>$get_client->id]) }}">
              
              {{ $get_client_name[0] }} {{ $get_client_name[1] }}
            </a>
            {{-- <!-- &#40;{{ $Payment['payer']['client']['current_bal'] }}&#41; --> --}}
          </td>  
        </tr>
        <tr>
          <th>Transaction Mode</th>
          @if($Payment['transaction_mode']=="Bank")
            <td>
              {{ $Payment['transaction_mode'] }}
              &#40;{{ $Payment['remarks'] }}&#41;
            </td>
          @else
            <td>{{ $Payment['transaction_mode'] }}</td>
          @endif
        </tr>
        <tr>
          <th>Amount</th>
          <td>{{ $Payment['amount'] }}</td>
        </tr>
        <!-- <tr>
          <th>Remarks</th>
          <td>{{ $Payment['remarks'] }}</td>
        </tr> -->

        <!-- <tr>
          <th>
            <a class="btn edit-btn" href="{{ route('payment.edit', [$Payment['id']]) }}">
              <span class="mdi mdi-pen"></span> Edit
            </a>
          </th>
          
          <td>
            {{ Form::open(['method'=>'delete', 'route'=>['payment.destroy', $Payment['id']]]) }}
              {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
            {{ Form::close() }}
          </td>
        </tr> -->
      </tbody>
    </table>
  @endif  
</div>
<script type="text/javascript">
  
  function printPayment() {
    //var x=document.getElementById('hideExtra');
   //x.style.visibility = "hidden";
    window.print();
  }
</script>
@stop 