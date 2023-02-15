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
    
    </div>
  </div>
