@extends('template')

@section('section1')

  <br>
  @component('components.index_header', ['entity'=>'sub_category'])
    @slot('column_list')
      <div class="input-field col s5">
        {!! Form::select('column', [
          'first_name' => 'First Name',
          'last_name' => 'Last Name',
          'mobile_no' => 'Mobile #',
          'email' => 'Email',
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

    @if($SubCategories->isEmpty())

      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>
    @else

      <table class="highlight bordered">

        <caption>
          <h3 class="thin">Products</h3>
        </caption>

        <thead>
          <tr>
            <th>Products</th>
            <th>Brands</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($SubCategories as $SubCategory)
            <tr>
              <td>{{ $SubCategory['name'] }}</td>
              @foreach($mainCategory as $mainCategorys)
              @if ($SubCategory->main_category_id == $mainCategorys->id)
              <td>{{ $mainCategorys->name }}</td>
              @endif
              @endforeach
              <td>
                <a class="action-btn edit-btn" href="{{ route('sub_category.edit', [$SubCategory['id']]) }}">
                  <span class="mdi mdi-pen"></span>
                </a>
                <a class="action-btn single-btn" href="{{ route('sub_category.show', [$SubCategory['id']]) }}">
                  <span class="mdi mdi-chevron-right"></span>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    {{ $SubCategories->appends(Request::except('page'))->links() }}
  </div>
@stop
