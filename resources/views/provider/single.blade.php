@extends('template')

@section('section1')

<br>
<div class="col s12 m8 l8 offset-m2 offset-l2 z-depth-5" style="padding:3%;background-color: white;">

  <a class="btn back-btn" href="{{ url(URL::previous()) }}">
    <span class="mdi mdi-arrow-left"></span>
  </a>

  <a class="btn back-btn" href="{{ route('provider') }}">
    <span class="mdi mdi-menu"></span>
  </a>

  @if($provider==NULL)
    <center>
      <h3 class="thin">No Record Found !</h3>
    </center>
  @else

    <table class="highlight bordered">

      <caption>
        <h4 class="thin">
          <span class="mdi mdi-account-box-outline"></span>
          Provider
        </h4>
      </caption>

      <tbody>
        <tr>
          <th>Name</th>
          <td>{{ $provider->name}}</td>

        </tr>

        <tr>
          <th>Company</th>
          <td>{{ $provider->company_name}}</td>
        </tr>

        <tr>
          <th>Mobile #</th>
          <td>{{ $provider->mobileno}}</td>
        </tr>

        {{-- <tr>
          <th>Land Line #</th>
          <td></td>
        </tr> --}}

        {{-- <tr>
          <th>Email</th>
          <td></td>
        </tr> --}}

        <tr>
          <th>Address</th>
          <td>{{ $provider->address}}</td>
        </tr>

        <tr>
          <th>City</th>
          <td>{{ $provider->city_id}}</td>
        </tr>

        {{-- <tr>
          <th>State</th>
          <td></td>
        </tr> --}}

        {{-- <tr>
          <th>Country</th>
          <td></td>
        </tr> --}}

        <tr>
          <th>
            <a class="btn edit-btn" href="{{ route('provider_edit',$provider->id) }}">
              <span class="mdi mdi-pen"></span> Edit
            </a>
          </th>
          <td>
            <a class="btn delete-btn" href="{{ route('provider_delete', $provider->id)}}">Delete</a>
            {{-- {{ Form::open(['method'=>'delete', 'route'=>['provider.destroy', $Provider['id']]]) }}
              {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
            {{ Form::close() }} --}}
          </td>
        </tr>
      </tbody>
    </table>
  @endif
</div>

@stop
