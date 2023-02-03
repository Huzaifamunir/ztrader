@extends('template')

     @section('section1')

     <div class="col s12 m12 l12" style="height:20px;"></div>

     <div class="col s12 m6 l6 offset-m3 offset-l3 form z-depth-5 form-div" style="padding:0px;">

       <div class='form-header pad-2'>

         <a class="btn back-btn tooltipped" href="{{ url(URL::previous()) }}" data-position="bottom" data-delay="200" data-tooltip="go back">
           <span class="mdi mdi-arrow-left"></span>
         </a>

         <a class="btn back-btn tooltipped" href="" data-position="bottom" data-delay="200" data-tooltip="index">
           <span class="mdi mdi-menu"></span>
         </a>

         <h4 class='thin font-light tooltipped' align='center' data-position="bottom" data-delay="200" data-tooltip="add new">
           <span class="mdi mdi-account-star"></span>
           <span class="uc-first">Client</span>
         </h4>

       </div>
       @slot('form')

       <div class="col s12 m12 l12" >

        <form method="post" action="{{ route('client_add') }}">
            {{-- @endif --}}
            @csrf

             @include('partials/_errors')

              <div class="input-field col s4">
                <input type="text" name="first_name" required/>
                <label for="first_name" >First Name</label>
              </div>

              <div class="input-field col s4">
                <input type="text" name="last_name" required/>
                <label for="last_name" >Last Name</label>
              </div>

              <div class="input-field col s4">
                  <input type="number" name="start_bal" required />
                  <label for="opening_balance" >Opening Balance</label>
              </div>

              <div class="input-field col s6">
                <input type="text" name="mobile_no" />
                <label for="mobile_no" >Mobile #</label>
              </div>

              <div class="input-field col s4">
                 <select selected name="city_id" required>
                      <option selected>Choose </option>
                      <option value="">A</option>
                      <option value="">B</option>
                      <option value="">C</option>
                 </select>

              </div>

              <div class="input-field col s8">
                <input type="text" name="address" required/>
                <label for="Address" >Address</label>
              </div>

              <div class="input-field col s6 m6 l6">
                  <button type="submit" class="btn add-btn">Submit</button>
              </div>
          </form>


       </div>

       <div class="col s12 m12 l12" style="height:20px;"></div>
     </div> <!-- /Form Container -->


      {{-- @component('components.entity_form', ['entity'=>'client','icon'=>'account-star']) --}}

         {{-- @slot('form') --}}

      {{-- @if($form['value']=='update')
        {!! Form::model($client, ['route' => ['client.update', $client['id']], 'method' => 'patch']) !!}
      @else --}}
        {{-- {!! Form::open(['url' => 'client/', 'method' => 'post']) !!} --}}
        {{-- <form method="post" action=""> --}}
      {{-- @endif --}}

      {{-- @include('partials/_errors')

        <div class="input-field col s4"> --}}

             {{--
                @if($form['value']=='update')
             {!! Form::text('first_name', $client['user']['person']['first_name']) !!}
             @else
             --}}
            {{-- {!! Form::text('first_name', null) !!} --}}
          {{-- <input type="text" name="first_ name" /> --}}
          {{-- @endif --}}
          {{-- {!! Form::label('first_name','First Name') !!} --}}
          {{-- <label for="first_name" >First Name</label>
        </div> --}}

        {{-- <div class="input-field col s4"> --}}
          {{-- @if($form['value']=='update')
            {!! Form::text('last_name', $client['user']['person']['last_name']) !!}
          @else --}}
          {{-- <input type="text" name="last_name" /> --}}

             {{-- {!! Form::text('last_name',null) !!} --}}

                       {{-- @endif  --}}
          {{-- {!! Form::label('last_name','Last Name') !!} --}}
          {{-- <label for="last_name" >Last Name</label> --}}

        {{-- </div> --}}
{{--
        <div class="input-field col s4">
            <input type="number" name="start_bal" />
            <label for="opening_balance" >Opening Balance</label> --}}

          {{-- {!! Form::number('start_bal',null) !!}
          {!! Form::label('start_bal','Opening Balance') !!} --}}
        {{-- </div> --}}

        {{-- <div class="input-field col s6"> --}}
          {{-- @if($form['value']=='update')
            {!! Form::text('mobile_no', $client['user']['person']['mobile_no']) !!}
          @else --}}
            {{-- {!! Form::text('mobile_no',null) !!} --}}
          {{-- @endif --}}
          {{-- <input type="text" name="mobile_no" />
          <label for="mobile_no" >Mobile #</label> --}}
          {{-- {!! Form::label('mobile_no','Mobile #') !!} --}}
        {{-- </div> --}}

        {{-- <div class="input-field col s6"> --}}
          {{-- @if($form['value']=='update')
            {!! Form::text('land_line_no', $client['user']['person']['land_line_no']) !!}
          @else --}}
            {{-- {!! Form::text('land_line_no',null) !!} --}}
          {{-- @endif --}}
          {{-- {!! Form::label('land_line_no','Landline #') !!} --}}
        {{-- </div> --}}

        {{-- <div class="input-field col s4"> --}}
          {{-- @if($form['value']=='update')
            {!! Form::select('city_id',
              $Cities->pluck('name', 'id')->all(),
              $client['user']['person']['city_id'], ['placeholder' => 'Select City']) !!}
          @else --}}
               {{-- <select>
                <option value="">A</option>
                <option value="">B</option>
                <option value="">C</option>
               </select> --}}
            {{-- {!! Form::select('city_id',
              $Cities->pluck('name', 'id')->all(),
              null, ['placeholder' => 'Select City']) !!} --}}
          {{-- @endif --}}
        {{-- </div>

        <div class="input-field col s8"> --}}

          {{-- @if($form['value']=='update')
            {!! Form::text('address', $client['user']['person']['address']) !!}
          @else --}}
          {{-- <input type="text" name="address" />
          <label for="Address" >Address</label> --}}
            {{-- {!! Form::text('address',null) !!} --}}
          {{-- @endif --}}

          {{-- {!! Form::label('address','Address') !!} --}}
        {{-- </div>

        <div class="input-field col s6 m6 l6">
            <button type="submit" class="btn add-btn">Submit</button> --}}
          {{-- {{ Form::button('<span class="mdi mdi-send"></span> '.$form['value'], ['class'=>'btn add-btn', 'type'=>'submit']) }} --}}
        {{-- </div>
    </form> --}}
      {{-- {!! Form::close() !!} --}}
      {{-- @if($form['value']=='update')
        <div class="input-field col s6 m6 l6">
          {{ Form::open(['method'=>'delete', 'route'=>['client.destroy', $client['id']]]) }}
            {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
          {{ Form::close() }}
        </div>
      @else --}}
      {{-- @endif --}}
    @endslot
  {{-- @endcomponent --}}
@stop

{{-- @section('page_scripts')
 <script>
var app = new Vue({
  el: '#app',
  delimiters: ['[[', ']]'],
  data: {
    parent_id:@if($form['value']=='update'){{ $client['parent_id'] }}@else null @endif,
    user_id:@if($form['value']=='update'){{ $client['user_id'] }}@else null @endif,
  },
  computed: {
     selected_user: function(){
      var user=$('#user_list_'+this.user_id).html();
      return user;
     },
     selected_parent: function(){
      var parent=$('#parent_list_'+this.parent_id).html();
      return parent;
     }
  },
});
</script>
@stop --}}
