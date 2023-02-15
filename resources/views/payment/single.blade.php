@extends('template')

@section('section1')
  
<br>

<div class="col m8 l8 offset-m2 offset-l2">

  <a style="background-color: #0D47A1; color:#fff;" class="btn back-btn" href="{{ url(URL::previous()) }}">
    <span class="mdi mdi-arrow-left"></span>
  </a>

  <a style="background-color: #0D47A1; color:#fff;" class="btn back-btn" href="javascript:;" onclick="printPayment()">
    <span class="mdi mdi-printer"></span>
  </a>

  <a style="background-color: #0D47A1; color:#fff;" id="download-button" class="btn back-btn" data-position="bottom" data-delay="200"
  data-tooltip="PDF">
  <span>PDF</span></a>

</div>


<div id="paymentpdf">


  <div class="col s12 m8 l8 offset-m2 offset-l2 z-depth-5" style="padding:3%;background-color: white;">
  <div id="hideExtra">

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

        {{-- {{ dd($balance) }} --}}
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
          <?php $get_bank=\App\Models\Bank::where(['bank_id' => $Payment->transaction_mode])->first();
         
          ?>
            <td>{{ $get_bank->bank_name }}</td>
          @endif
        </tr>
        <tr>
          <th>Recive Amount</th>
          <td>{{ $Payment['amount'] }}</td>
        </tr>

        {{-- {{ dd($balance) }} --}}

        <tr>
          <th>Current_Balance</th>
          <td>{{ $balance->current_bal }}</td>
        </tr>
        <!-- <tr>
          <th>Remarks</th>
          <td></td>
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
  </div>

</div>




<script type="text/javascript">
  
  function printPayment() {
    //var x=document.getElementById('hideExtra');
   //x.style.visibility = "hidden";
    window.print();
  }
</script>


<script>
  const button = document.getElementById('download-button');

  function generatePDF() {
      // Choose the element that your content will be rendered to.
      const element = document.getElementById('paymentpdf');
      // Choose the element and save the PDF for your user.
      html2pdf().from(element).save();
  }

  button.addEventListener('click', generatePDF);

</script>
@stop 