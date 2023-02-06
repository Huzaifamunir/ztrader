@extends('template')
@section('section1')
  <br>
  @component('components.index_header', ['entity'=>'main_category'])
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

    @if($MainCategories->isEmpty())
      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>
    @else
      <table class="highlight bordered">
        <caption>
          <h3 class="thin">MainCategories</h3>
        </caption>
        <thead>
          <tr>
            <th>MainCategory</th>
            <th>SubCategories</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($MainCategories as $MainCategory)
            <tr>
              <td>{{ $MainCategory['name'] }}</td>

              <td>
                @foreach($subcategories as $sub_category)

                 @if($MainCategory->id == $sub_category->main_category_id)
                   <a href="{{ route('sub_category.show', [$sub_category->id]) }}">{{ $sub_category->name }}</a> |
                 @endif

                  @endforeach
              </td>

              <td>
                <a class="action-btn edit-btn" href="{{ route('main_category.edit', [$MainCategory['id'] ] ) }}">
                  <span class="mdi mdi-pen"></span>
                </a>
                <a class="action-btn single-btn" href="{{ route('main_category.show', [$MainCategory['id'] ]) }}">
                  <span class="mdi mdi-chevron-right"></span>
                </a>
              </td>

            </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    {{ $MainCategories->appends(Request::except('page'))->links() }}
  </div>
@stop
