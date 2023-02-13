@extends('template')

@section('section1')
  
  <br>
  @component('components.index_header', ['entity'=>'state'])
    @slot('column_list')
      <div class="input-field col s5">
        {!! Form::select('column', [
          'name' => 'Name'
        ], null, ['placeholder' => 'Select Column', 'required' => 'required']) !!}  
      </div>
    @endslot
  @endcomponent
  
  <div class="z-depth-5" style="padding:1%;background-color: white;">
    
    @if($States->isEmpty())

      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>  
    @else

      <table class="highlight bordered">
        <caption>
          <h3 class="thin">States</h3>
        </caption>
        <thead>
          <tr>
              <th>Name</th>
              <th style="width:100px;">Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($States as $State)
            <tr>
              <td>{{ $State->name }}</td>
              <td>
                <a  style="font-size:20px;" class="action-btn edit-btn" href="{{ route('state.edit', [ $State['id']]) }}">
                  <span class="mdi mdi-pen"></span>
                </a>
                <a style="font-size:20px;" class="action-btn single-btn" href="{{ route('state.show', [ $State['id']]) }}">
                  <span class="mdi mdi-chevron-right"></span>
                </a>
              </td>
            </tr>  
          @endforeach
        </tbody>
      </table>
    @endif  

    {{ $States->appends(Request::except('page'))->links() }}
  </div>  
@stop 