@if($errors->has($field_name))
	@php $field_class="invalid"; @endphp
	@php $field_error=$errors->first($field_name); @endphp
@else
	@php $field_class=""; @endphp
	@php $field_error=""; @endphp
@endif


{!! Form::text($field_name, null, ['class' => 'validate '.$field_class]) !!}
{!! Form::label($field_name, $field_label, ['data-error' => $field_error, 'data-success' => 'seems ok..']) !!}

