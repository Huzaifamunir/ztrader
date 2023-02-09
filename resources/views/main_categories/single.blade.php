@extends('template')

@section('section1')

@component('components.single_view', ['entity'=>'main_category','id'=>$MainCategory->id])
  @slot('items')
     <tr>
       <th>Brand Name</th>
       <td>{{ $MainCategory->name }}</td>
    </tr>
    <tr>
      <th>Products</th>
      <td>
        @foreach($sub_categories as $sub_category)

         @if($MainCategory->id == $sub_category->main_category_id)
            <a href="{{ route('sub_category.show', [$sub_category->id]) }}">{{ $sub_category->name }}</a> |
         @endif

          @endforeach
      </td>
    </tr>
  @endslot
@endcomponent

@stop
