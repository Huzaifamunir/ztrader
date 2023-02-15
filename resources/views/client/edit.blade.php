@extends('template')

     @section('section1')

     <div class="col s12 m12 l12" style="height:20px;"></div>

     <div class="col s12 m6 l6 offset-m3 offset-l3 form z-depth-5 form-div" style="padding:0px;">

       <div class='form-header pad-2'>

         <a class="btn back-btn tooltipped" href="{{ url(URL::previous()) }}" data-position="bottom" data-delay="200" data-tooltip="go back">
           <span class="mdi mdi-arrow-left"></span>
         </a>

         <a class="btn back-btn tooltipped" href="{{ url('client') }}" data-position="bottom" data-delay="200" data-tooltip="index">
           <span class="mdi mdi-menu"></span>
         </a>

         <h4 class='thin font-light tooltipped' align='center' data-position="bottom" data-delay="200" data-tooltip="add new">
           <span class="mdi mdi-account-star"></span>
           <span class="uc-first">Client</span>
         </h4>

       </div>


       <div class="col s12 m12 l12" id="app">

        <form method="post" action="{{ route('client_update') }}">
            {{-- @endif --}}
            @csrf

            @if(session()->has('msg'))
                 <div class="row" id="error_bag" style="margin-top:2%;">
                   <div class="error-bag pad-2" style='color:white;'>
                      <span class="mdi mdi-close-box" onclick="close_me('error_bag')" style="float:right;color:black;font-size:20px;"></span>
                        <strong>Congrajulations!</strong> Your Request Was Successfully Handled.<br>
                     <ul>
                        <li>{{ session()->get('msg') }}</li>
                     </ul>
                  </div>
                @endif

                @if(session()->has('error'))
                <div class="row" id="error_bag" style="margin-top:2%;">
                  <div class="error-bag pad-2" style='color:white;'>
                     <span class="mdi mdi-close-box" onclick="close_me('error_bag')" style="float:right;color:black;font-size:20px;"></span>
                       <strong>Whoops!</strong> There were some problems with your input.<br>
                    <ul>
                       <li>{{ session()->get('error') }}</li>
                    </ul>
                 </div>
               @endif

              </div>

              <?php
              $name=explode('.',$client->name);
              $first_name=$name[0];
              $last_name=$name[1];
               ?>

              <div class="input-field col s4">
                <input type="hidden" name="id" value="{{ $client->id }}" required/>

                <input type="text" name="first_name" value="{{ $first_name }}" required/>
                <label for="first_name" >First Name</label>
              </div>

              <div class="input-field col s4">
                <input type="text" name="last_name" value="{{ $last_name }}" required/>
                <label for="last_name" >Last Name</label>
              </div>

              <div class="input-field col s4">
                  <input type="number" name="start_bal" value="{{ $client->start_bal }}" required />
                  <label for="opening_balance" >Opening Balance</label>
              </div>

              <div class="input-field col s6">
                <input type="text" name="mobile_no" value="{{ $client->mobileno }}" required/>
                <label for="mobile_no" >Mobile #</label>
              </div>

              <div class="input-field col s6">
                <input type="text" name="email" value="{{ $client->email }}" required/>
                <label for="email" >Email</label>
              </div>

              <div class="input-field col s6">
                <div id="client_list_">
                  
                  <input type="text" list="city_id" name="city_id" v-model="payer_id">
                  <label class="active">City</label>
              
                </div>
      
                  <datalist id="city_id">
                    @foreach ($city as $item)
  
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                      
                    @endforeach
                  </datalist>

              </div>

              <div class="input-field col s6">
                <input type="text" name="address" value="{{ $client->address }}" required/>
                <label for="Address" >Address</label>
              </div>

              <div class="input-field col s6 m6 l6">
                  <button type="submit" class="btn" style="background:green;margin-bottom:2%;">Submit</button>
              </div>
          </form>


       </div>

       <div class="col s12 m12 l12" style="height:20px;"></div>
     </div> 

@stop

