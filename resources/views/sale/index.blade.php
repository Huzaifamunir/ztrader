@extends('template')
<style>
.toolbar {
    float: left;
}
.input-field{
    display:none;
}
.dataTables_filter input{
        background-color: transparent !important;
    border: none !important;
    border-bottom: 1px solid #9e9e9e !important;
    border-radius: 0 !important;
    outline: none !important;
    height: 1.5rem !important; 
    width: 100% !important;
    font-size: 1rem !important;
    margin: 0 0 20px 0 !important;
    padding: 0 !important;
    -webkit-box-shadow: none;
    box-shadow: none !important;
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
}
.dataTables_filter input:focus{
        border-bottom: 1px solid #9fa8da !important;
    box-shadow: 0 1px 0 0 #9fa8da !important;
}
.dataTables_filter{
      position: absolute;
    top: -32px;
    right: 7px;
}
.flexdiv{
    display:flex;
    align-items:center;
    gap:10px;
}
.flexdiv .add-btn , .flexdiv .back-btn{ 
    display: flex;
    width: max-content;
    align-items: center;
}
.dataTables_filter label{
    font-size: 18px;
    color: #000;
    display: flex;
}

table.dataTable tbody td{
    padding: 20px 10px !important;
}
@media(max-width:490px){
    .searchnav{
        min-height:110px !important;
    }
    .dataTables_filter{
            left: 0;
    top: -43px;
    padding: 0px 13px;
    }
   
}
</style>
@section('section1')
  
  <br>
  @component('components.index_header', ['entity'=>'sale'])
    @slot('column_list')
      <div class="input-field col s5">
        {!! Form::select('column', [
          'bill_no' => 'Bill #', 
        ], 'bill_no', ['placeholder' => 'Select Column', 'required' => 'required']) !!}  
      </div>
    @endslot
  @endcomponent
  
  <div class="z-depth-5" style="padding:1%;background-color: white;">
    
    @if($Sales->isEmpty())

      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>  
    @else

      <table class="highlight bordered display" id="saleTable">
        
        <caption>
          <h3 class="thin">
            <span class="mdi mdi-script"></span>
            Sale
          </h3>
        </caption>
        
        <thead>
          <tr>
              <th hidden>No#</th>
            <th style="padding-right: 10px;">Date</th>
            <th style="padding-right: 10px;">Bill #</th>
            <th style="padding-right: 120px;">Client</th>
            <th style="padding-right: 10px;">Seller</th>
            
            <th style="padding-right: 10px;">Total Amount</th>
            <th style="padding-right: 10px;">Action</th>
          </tr>
        </thead>
            @php Carbon\Carbon::setLocale('de') @endphp
        <tbody>
            
          @foreach($Sales as $Sale)
          <?php $get_Client=\App\Models\User::where(['id' => $Sale->client_id])->first();
                    $get_Client=explode('.',$get_Client->name);

                    $get_Seller=\App\Models\User::where(['id' => $Sale->seller_id])->first();
                    // $get_Seller=explode('.',$get_Seller->name);
                ?>

      
            <tr>
                <td hidden>{{$i++}}</td>
              <td>{{ $Sale->created_at->format('d-M-Y') }}</td>
              <td>ZR_{{ str_pad($Sale['id'], 3, "0", STR_PAD_LEFT) }}</td>
              <td>{{ $get_Client[0]}} {{ $get_Client[1] }}</td>
              
              <td>{{ $get_Seller->name }}</td>
              <!-- <td>{{ $Sale->total_sets }}</td> -->
              <td>{{ $Sale['total_amount'] }}</td>
              <td>
                <a style="font-size:20px;" class="action-btn edit-btn" href="{{ route('sale.edit', [ $Sale['id']]) }}">
                  <span class="mdi mdi-pen"></span>
                </a>
                <a style="font-size:20px;" class="action-btn single-btn" href="{{ route('sale.show', [ $Sale['id']]) }}">
                  <span class="mdi mdi-chevron-right"></span>
                </a>
              </td>
            </tr>  
          @endforeach
        </tbody>
      </table>
    @endif  
    
  </div>  
@stop 
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
  <script>
      $(document).ready(function () {
    $('#saleTable').DataTable({
         "pageLength":25,
                order: [[0, 'asc']],
        dom: '<"toolbar">frtip',
    });
 
    $('div.toolbar').html('');
});
  </script>