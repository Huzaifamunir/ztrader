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
table .sorting:nth-child(2){
    min-width:200px;
}

table.dataTable tbody td{
    padding: 20px 10px !important;
}
</style>
@section('section1')

  <br>
  @component('components.index_header', ['entity'=>'product'])
    @slot('column_list')
      <div class="input-field col s5">
        {!! Form::select('column', [
          'name' => 'Name',
          'model' => 'Model',
          'purchase_price' => 'Purchase Price',
          'sale_price' => 'Sale Price',
          'current_stock' => 'Current Stock',
        ], null, ['placeholder' => 'Select Column', 'required' => 'required']) !!}
      </div>
    @endslot
  @endcomponent

  <div class="z-depth-5" style="padding:1%;background-color: white;">

    @if($Products->isEmpty())

      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>
    @else

      <table class="highlight bordered display" id="productTable">
        <caption>
          <h3 class="thin">
            <span class="mdi mdi-apple-keyboard-command"></span>
            Products
          </h3>
        </caption>
        <thead>
          <tr>
              <th>Brands</th>
              <th>Products</th>
              <th>Model</th>
              <th>Purchase Price(Rs.)</th>
              <th>Sale Price(Rs.)</th>
              <th>Current Stock</th>
              <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($Products as $Product)
            <tr>
              <!--<th>-->
              <!--  <img src="{{ URL::asset('img/product/'.$Product['image']) }}" class="responsive-img materialboxed" data-caption="{{ $Product['name'] }}" style="height:100px;width:100px;">-->
              <!--</th>-->
              <?php $sub=\App\Models\SubCategory::where(['id' => $Product['sub_category_id']])->first();?>
              
              
              <td>{{  \App\Models\MainCategory::where(['id' => $sub->main_category_id])->pluck('name')->first() }}</td>
              <td>{{  $sub->name }}</td>
              <td>{{ $Product['model'] }}</td>
              <td>{{ $Product['purchase_price'] }}</td>
              <td>{{ $Product['sale_price'] }}</td>
              <td>{{ $Product['current_stock'] }}</td>
              <td>
                <a class="action-btn edit-btn" href="{{ route('product.edit', [ $Product['id']]) }}">
                  <span class="mdi mdi-pen"></span>
                </a>
                <a class="action-btn single-btn" href="{{ route('product.show', [ $Product['id']]) }}">
                  <span class="mdi mdi-chevron-right"></span>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
    <!-- ->appends(Request::except('page')) -->
    {{ $Products->appends(Request::except('page'))->links() }}
  </div>
@stop
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script>
      $(document).ready(function () {
    $('#productTable').DataTable({
         "pageLength":25,
                order: [[0, 'asc']],
        dom: '<"toolbar">frtip',
    });

    $('div.toolbar').html('');
});
  </script>
