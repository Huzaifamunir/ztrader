@extends('template')

@section('section1')

<br>
<div class="col s12 m8 l8 offset-m2 offset-l2 z-depth-5" style="padding:3%;background-color: white;">

  <a class="btn back-btn" href="{{ url(URL::previous()) }}">
    <span class="mdi mdi-arrow-left"></span>
  </a>

  <a class="btn back-btn" href="{{ route('product.index') }}">
    <span class="mdi mdi-menu"></span>
  </a>

  @if($Product==NULL)
    <center>
      <h3 class="thin">No Record Found !</h3>
    </center>
  @else
    <table class="highlight bordered">

      <caption>
        <h3 class="thin">
          <span class="mdi mdi-apple-keyboard-command"></span>
          Product
        </h3>
      </caption>

      <tbody>
        <tr>
          <td>
            <div style="max-width: 200px;">
              <img src="{{ URL::asset('img/product/'.$Product['image']) }}" class="responsive-img materialboxed" data-caption="{{ $Product['name'] }}">
            </div>
          </td>
        </tr>

        <tr>
          <th>Name</th>
          <td>{{ $Product['name'] }}</td>
        </tr>

        {{-- <tr>
          <th>Company</th>
          <td>{{ $Product['sub_category']['name'] }}</td>
        </tr> --}}

        <tr>
          <th>Main Category</th>
          <td>{{ $maincategory->name }}</td>
        </tr>

        <tr>
          <th>Model</th>
          <td>{{ $Product['model'] }}</td>
        </tr>

        <tr>
          <th>Purchase Price</th>
          <td>{{ $Product['purchase_price'] }}</td>
        </tr>

        <tr>
          <th>Sale Price</th>
          <td>{{ $Product['sale_price'] }}</td>
        </tr>

        <tr>
          <th>Current Stock</th>
          <td>{{ $Product['current_stock'] }}</td>
        </tr>

        <!-- <tr>
          <th>
            <a class="btn edit-btn" href="{{ route('product.edit', [ $Product['id']]) }}">
              <span class="mdi mdi-pen"></span> Edit
            </a>
          </th>
          <td>
            {{ Form::open(['method'=>'delete', 'route'=>['product.destroy', $Product['id']]]) }}
              {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
            {{ Form::close() }}
          </td>
        </tr> -->
      </tbody>
    </table>
  @endif
</div>

@stop
