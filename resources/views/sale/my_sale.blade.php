@extends('template')

@section('section1')
  
  <br>
  @component('components.index_header', ['entity'=>'sale'])
    @slot('column_list')
      <div class="input-field col s5">
        {!! Form::select('column', [
          'company_name' => 'Company', 
          'tax_no' => 'Tax #',
          'hrb_no' => 'HRB #',
          'start_bal' => 'Starting Balance',
          'current_bal' => 'Current Balance'
        ], null, ['placeholder' => 'Select Column', 'required' => 'required']) !!}  
      </div>
    @endslot
  @endcomponent
  
  <div class="z-depth-5" style="padding:1%;background-color: white;">
    
    @if($Sales->isEmpty())

      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>  
    @else

      <table class="highlight bordered">
        
        <caption>
          <h3 class="thin">{{ $Seller->person->first_name." ".$Seller->person->last_name }} Sales</h3>
        </caption>
        
        <thead>
          <tr>
            <th>Date</th>
            <th>Client</th>
            <th>Total Items</th>
            <th>Total Amount(&euro;)</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($Sales as $Sale)
            <tr>
              <th>{{ $Sale->created_at }}</th>
              <td>
                {{ $Sale->client->user->person->first_name." ".$Sale->client->user->person->last_name }}
                &#40;{{ $Sale['client']['company_name'] }}&#41;
              </td>
              <td>{{ $Sale->total_sets }}</td>
              <td>{{ $Sale->total_amount }}</td>
              <td>
                <!-- <a class="action-btn edit-btn" href="{{ route('sale.edit', [$Sale['id']]) }}">
                  <span class="mdi mdi-pen"></span>
                </a> -->
                <a class="action-btn single-btn" href="{{ route('sale.show', [$Sale['id']]) }}">
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