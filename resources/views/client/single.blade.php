
@extends('template')

     @section('section1')
<br>
<div class="col s12 m6 l5 offset-m3 offset-l3 z-depth-5" style="padding:3%;background-color: white;">

  <a class="btn back-btn tooltipped" href="{{ url(URL::previous()) }}" data-position="bottom" data-delay="200" data-tooltip="client go back">
    <span class="mdi mdi-arrow-left"></span>
  </a>

  <a class="btn back-btn tooltipped" href="{{ route('client') }}" data-position="bottom" data-delay="200" data-tooltip="Client index">
    <span class="mdi mdi-menu"></span>
  </a>

  <table class="highlight bordered">
    <caption>
      <h3 class="thin" style="text-transform:capitalize;">
          <span class="mdi mdi-account-star"></span>
            client
      </h3>
    </caption>

    <tbody>

        <tr>
            <th>Name</th>
            <td>{{ $user->name }}</td>
          </tr>
          {{-- <tr>
            <th>Landline Number</th>
            <td></td>
          </tr> --}}
          <tr>
            <th>Mobile Number</th>
            <td>{{ $user->mobileno }}</td>
          </tr>
          <tr>
            <th>City</th>
            <td>{{ $user->city_id }}</td>
          </tr>
          <tr>
            <th>Address</th>
            <td>{{ $user->address}}</td>
          </tr>
          {{-- <tr>
            <th>Opening Balance</th>
            <td></td>
          </tr> --}}
          <tr>
            <th>Current Balance</th>
            <td>{{ $user->start_bal }}</td>
          </tr>
          <tr>
            <th></th>
            <td>
              <a class="btn" href="">Sale</a>
              <a class="btn" href="">Ledger</a>
            </td>
          </tr>

      <tr>
        <th>
          <a class="btn edit-btn" href="">
            <span class="mdi mdi-pen"></span> Edit
          </a>
        </th>

      </tr>
    </tbody>
  </table>
</div>

@stop
