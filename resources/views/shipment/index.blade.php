@extends('layouts.master')
@section('content')




<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Shipment</h2>
        </div>
        <div class="pull-right">
            {{-- @can('product-create') --}}
            <a class="btn btn-success" href="{{ route('shipment.create') }}"> Create New Shipment</a>
            {{-- @endcan --}}
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Details</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->detail }}</td>
        <td>
            @role('admin')
            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('shipment.show',$product->id) }}">Show</a>
               {{-- @can('product-edit') --}}
                <a class="btn btn-primary" href="{{ route('shipment.edit',$product->id) }}">Edit</a>
                {{-- @endcan --}}


                @csrf
                @method('DELETE')
               {{-- @can ('product-delete') --}}
                <button type="submit" class="btn btn-danger">Delete</button>
                {{-- @endcan --}}
                @endrole
            </form>
        </td>
    </tr>
    @endforeach
</table>













@endsection
