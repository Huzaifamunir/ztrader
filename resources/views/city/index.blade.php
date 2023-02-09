@extends('template')

@section('section1')
  
  <br>
  @component('components.index_header', ['entity'=>'city'])
    @slot('column_list')
      <div class="input-field col s5">
        {!! Form::select('column', [
          'name' => 'Name'
        ], null, ['placeholder' => 'Select Column', 'required' => 'required']) !!}  
      </div>
    @endslot
  @endcomponent
  
  <div class="z-depth-5" style="padding:1%;background-color: white;">
    
    @if($Cities->isEmpty())

      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>  
    @else

      <table class="highlight bordered">

        <caption>
          <h3 class="thin">Cities</h3>
        </caption>

        <thead>
          <tr>
              <th>Name</th>
              <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($Cities as $City)
            <tr>
              <td>{{ $City->name }}</td>
              <td>
                <a class="action-btn edit-btn" href="{{ route('city.edit', [ $City['id']]) }}">
                  <span class="mdi mdi-pen"></span>
                </a>
                <a class="action-btn single-btn" href="{{ route('city.show', [ $City['id']]) }}">
                  <span class="mdi mdi-chevron-right"></span>
                </a>
              </td>
            </tr>  
          @endforeach
        </tbody>
      </table>
    @endif  

    {{ $Cities->appends(Request::except('page'))->links() }}
  </div>  
@stop 