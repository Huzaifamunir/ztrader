@extends('template')

@section('section1')

  @component('components.entity_form', ['entity'=>'payment','icon'=>'currency-eur'])
    
    @slot('form')

      @if($form['value']=='update')
        {!! Form::model($payment, ['route' => ['payment.update', $payment['id']], 'method' => 'patch']) !!}
      @else
        {!! Form::open(['url' => 'payment/', 'method' => 'post']) !!}
      @endif
        
      @include('partials/_errors')

        {!! Form::hidden('receiver_id', Auth::User()->id) !!}

        {!! Form::hidden('company_id', Auth::User()->company_id) !!}

        <div id="app" class="input-field col s6">
          @if($form['value']=='update')
            <h5>

              <?php $get_client=\App\Models\user::where(['id' => $payment->payer_id])->first();
              $get_client_name=explode('.',$get_client->name);
              ?>



              {{ $get_client_name[0] }} {{ $get_client_name[1] }} -
              {{ $get_client->current_bal }}
            </h5>
            {!! Form::hidden('client_id',$get_client->id) !!}
          @else
          <div id="client_list_">
            <input type="text" list="users_list" name="client_id" v-model="payer_id">
            <label class="active">Client</label>
              
            <div>
              <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [[ selected_client ]]</label>
            </div>

          </div>

            <datalist id="users_list">
              @foreach($clients_list as $client)
              
                <option value="{{ $client->id }}" id="client_list_{{ $client->id }}">
                  {{ $client->name }}
                  {{ $client->current_bal }}
                </option>
              @endforeach
            </datalist>
          @endif
        </div> 

        <div class="input-field col s3">
          <select name="transaction_mode" id="payment_type">
            @foreach ($banks as $bank)
            <option value="{{ $bank->bank_id }}">{{ $bank->bank_name }}</option>
            @endforeach
            
          </select>
          <label>Transaction Mode</label>
        </div>

        <div class="input-field col s3">
          @component('components.text_field', ['field_name'=>'amount','field_label'=>'Amount'])
          @endcomponent
        </div>
   
        <div class="col s12 m12 l12"></div>

        <div class="input-field col s6 m6 l6">
          {{ Form::button('<span class="mdi mdi-send"></span> '.$form['value'], ['class'=>'btn add-btn', 'type'=>'submit']) }}
        </div>
      {!! Form::close() !!}

      @if($form['value']=='update')
        <div class="input-field col s6 m6 l6">
          {{ Form::open(['method'=>'delete', 'route'=>['payment.destroy', $payment['id']]]) }}
            {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
          {{ Form::close() }}
        </div>
      @else  

      @endif
    @endslot
  @endcomponent
@stop 

@section('page_scripts')
<script>
var app = new Vue({
  el: '#app',
  delimiters: ['[[', ']]'],
  
  data: { 
    payer_id:null,
  },
  
  computed: {
    selected_client: function(){
      var user=$('#client_list_'+this.payer_id).html();
      return user; 
    }
  },

  mounted() {
    $('#payment_type').change(function(event){
      if(event.target.value=='Bank'){
        $('#remarks').slideDown();
      }
      else if(event.target.value=='Cash'){
        $('#remarks').slideUp();
      }
    });
  },
});
</script>
@stop