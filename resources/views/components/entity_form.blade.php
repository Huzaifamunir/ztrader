<div class="col s12 m12 l12" style="height:20px;"></div>

<div class="col s12 m6 l6 offset-m3 offset-l3 form z-depth-5 form-div" style="padding:0px;">

  <div class='form-header pad-2'>
    <a class="btn back-btn tooltipped" href="{{ url(URL::previous()) }}" data-position="bottom" data-delay="200" data-tooltip="go back">
      <span class="mdi mdi-arrow-left"></span>
    </a>

    <a class="btn back-btn tooltipped" href="{{ Route($entity.'.index') }}" data-position="bottom" data-delay="200" data-tooltip="{{ $entity }} index">
      <span class="mdi mdi-menu"></span>
    </a>

    <h4 class='thin font-light tooltipped' align='center' data-position="bottom" data-delay="200" data-tooltip="add new {{ $entity }}">
      <span class="mdi mdi-{{$icon}}"></span>
      <span class="uc-first">{{ $entity }}</span>
    </h4>
  </div>  

  <div class="col s12 m12 l12" id="app">
    {{ $form }}
  </div>

  <div class="col s12 m12 l12" style="height:20px;"></div>
</div> <!-- /Form Container -->
