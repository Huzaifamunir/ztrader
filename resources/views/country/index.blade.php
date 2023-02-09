@extends('template')

@section('section1')
  
  <br>
  @component('components.index_header', ['entity'=>'country'])
    @slot('column_list')
      <div class="input-field col s5">
        {!! Form::select('column', [
          'name' => 'Name'
          
        ], null, ['placeholder' => 'Select Column', 'required' => 'required']) !!}  
      </div>
    @endslot
  @endcomponent
  
  <div class="z-depth-5" style="padding:1%;background-color: white;">
    
    @if($Countries->isEmpty())

      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>  
    @else

      <table class="highlight bordered">
        <caption>
          <h3 class="thin">Countries</h3>
        </caption>
        <thead>
          <tr>
              <th>Name</th>
              <th>Action</th>
          </tr>
        </thead>

        <tbody>

          @foreach($Countries as $Country)
          
            <tr>
              <td>{{ $Country->name }}</td>
              <td>
                <a class="action-btn edit-btn" href="{{ route('country.edit', [ $Country['id']]) }}">
                  <span class="mdi mdi-pen"></span>
                </a>
                <a class="action-btn single-btn" href="{{ route('country.show', [ $Country['id']]) }}">
                  <span class="mdi mdi-chevron-right"></span>
                </a>
              </td>
            </tr>  
          @endforeach
        </tbody>
      </table>
    @endif  

    {{ $Countries->appends(Request::except('page'))->links() }}
  </div>  
@stop 