@extends('template')

@section('section1')

@component('components.single_view', ['entity'=>'sub_category','id'=>$SubCategory->id])

  @slot('items')
     <tr>
         <th>Category Name</th>
         <td>{{ $SubCategory->name }}</td>
    </tr>
    <tr>
         <th>Sub Categories</th>
         <td></td>
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
