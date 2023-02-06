<div class="col s12 m12 l12 searchnav" style="padding:1%;background:#f5f5f5;">

    <div class="col s12 m6 l6 flexdiv">
      <a class="btn back-btn tooltipped" href="{{ url(URL::previous()) }}" data-position="bottom" data-delay="200" data-tooltip="go back">
        <span class="mdi mdi-arrow-left"></span>
      </a>
      <a class="btn add-btn tooltipped" href="{{ url($entity.'/create') }}" data-position="bottom" data-delay="200" data-tooltip="add new {{ $entity }}">
        <span class="mdi mdi-plus"></span>
      </a>
    </div>

    <div class="col s12 m6 l6">
      @if(isset($column_list))
        {!! Form::open(['url' => $entity.'/search', 'method' => 'get']) !!}
          <div class="input-field col s5" >
            {!! Form::text('keyword', null, ['placeholder' => 'Search '.$entity,  'id' => 'searchInput']) !!}
          </div>

     {{ $column_list }}

          <div class="input-field col s2">
            {!! Form::button('<span class="mdi mdi-magnify"></span>', ['class'=>'btn search-btn', 'type'=>'submit', 'id' => 'searchButton']) !!}
          </div>
        {!! Form::close() !!}
      @endif
    </div>
  </div>
