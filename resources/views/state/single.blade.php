@extends('template')

@section('section1')
  
<br>
<div class="col s12 m8 l8 offset-m2 offset-l2 z-depth-5" style="padding:3%;background-color: white;">

  <a class="btn back-btn" href="{{ url(URL::previous()) }}">
    <span class="mdi mdi-arrow-left"></span>
  </a>

  @if($State==NULL) 
    <center>
      <h3 class="thin">No Record Found !</h3>
    </center>  
  @else 
    <table class="highlight bordered">
      
      <caption>
        <h3 class="thin">State</h3>
      </caption>

      <tbody>
        <tr>
          <th>Country</th>
          <td>{{ $State->country->name }}</td>
        </tr>
        <tr>
          <th>Name</th>
          <td>{{ $State->name }}</td>
        </tr>
        <tr>
          <th>
            <a href="">Cities</a>
          </th>
          <td></td>
        </tr>

        <tr>
          <th>
            <a class="btn edit-btn" href="{{ route('state.edit', [ $State['id']]) }}">
              <span class="mdi mdi-pen"></span> Edit
            </a>
          </th>
          <td>
            {{ Form::open(['method'=>'delete', 'route'=>['state.destroy', $State['id']]]) }}
              {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
            {{ Form::close() }}
          </td>
        </tr>
      </tbody>
    </table>
  @endif  
</div>

@stop 