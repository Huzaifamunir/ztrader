@extends('template')

@section('section1')

@component('components.single_view', ['entity'=>'sub_category','id'=>$SubCategory->id])

  @slot('items')

  {{-- {{ $SubCategory }} --}}
     <tr>
         <th>Product Name</th>
         <td>{{ $SubCategory->name }}</td>
    </tr>
    <tr>
         <th>Product_List</th>

        
    </tr>
    <tr>

       @foreach ( $Products as  $product)

         <tr>
          <td><a href="{{ route('product.show', [$product->id]) }}">{{ $product->model }}</a></td>
          </tr>

           
         @endforeach
      
    </tr>
    {{-- @foreach($SubCategory->products as $key => $product)
      <tr>
        <td>
          {{ $key+1 }}- <a href="{{ route('product.show', [$product['id']]) }}">{{ $product->name }}</a>
        </td>
        <td></td>
      </tr>
    @endforeach --}}
  @endslot
@endcomponent

@stop
