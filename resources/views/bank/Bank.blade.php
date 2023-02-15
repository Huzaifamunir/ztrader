@extends('template')

@section('section1')

<br>
@component('components.index_header', ['entity'=>'bank'])
@slot('column_list')
<div class="input-field col s5">
    {!! Form::select('column', [
    'name' => 'Name'

    ], null, ['placeholder' => 'Select Column', 'required' => 'required']) !!}
</div>
@endslot
@endcomponent

<div class="z-depth-5" style="padding:1%;background-color: white;">

    <table class="highlight bordered">
        <caption>
            <h3 class="thin">Banks</h3>
        </caption>
        <thead>
            <tr>
                <th>Bank Name</th>
                <th>Balance</th>
                <th style="width:120px;">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($data as $Bank)

            <tr>
                <td>{{$Bank['bank_name']}}</td>
                <td>{{$Bank['balance']}}</td>
                <td>
                    <a style="font-size:20px;" class="action-btn edit-btn" href="{{ route('bank.edit', [ $Bank['id']]) }}">
                        <span class="mdi mdi-pen"></span>
                    </a>

                    <a style="font-size:20px;" class="action-btn single-btn" href="{{ route('bank.show', [ $Bank['id']]) }}">
                        <span class="mdi mdi-chevron-right"></span>
                    </a>

                    {{-- <a style="font-size:20px;" class="action-btn single-btn" href="{{ url('transiction', [ $Bank['id']]) }}">
                        <span class="mdi mdi-chevron-right"></span>
                    </a> --}}

                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{-- @endif   --}}

</div>

@stop
