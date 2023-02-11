@extends('template')

@section('section1')

  <br>
  @component('components.index_header', ['entity'=>'stock'])

  @endcomponent
  <style>
    table.dataTable tbody td{
    padding: 20px 10px !important;
}

  </style>
  <div class="z-depth-5" style="padding:1%;background-color: white;">

    @if($Stocks->isEmpty())
      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>
    @else

      <table class="highlight bordered">

        <caption>
          <h3 class="thin">
            <span class="mdi mdi-truck"></span>
            Stock
          </h3>
        </caption>

        <thead>
          <tr>
            <th>Buyer</th>
            <th>Provider</th>
            <th>Company Name</th>
            <th>Total Amount</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($Stocks as $Stock)
          {{-- {{ dd($Stock) }} --}}
            <tr>
              <td>

                {{ $Stock['user']['name'] }}
              </td>
              <td>
                <?php $get_provider=\App\Models\User::where(['id' => $Stock->provider_id])->first();
                    $get_provider=explode('.',$get_provider->name);
                ?>
                {{ $get_provider[0] }} {{ $get_provider[1] }}
              </td>

                <td >
                  <?php $get_provider=\App\Models\User::where(['id' => $Stock->provider_id])->first();?>
                      {{ $get_provider->company_name }}
                </td>

              <td>{{ $Stock->total_amount }}</td>
              <td>
                <a class="action-btn edit-btn" href="{{ route('stock.edit', [ $Stock['id']]) }}">
                  <span class="mdi mdi-pen"></span>
                </a>
                <a class="action-btn single-btn" href="{{ route('stock.show', [$Stock['id']]) }}">
                  <span class="mdi mdi-chevron-right"></span>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>
    @endif

    {{ $Stocks->appends(Request::except('page'))->links() }}
  </div>
@stop
