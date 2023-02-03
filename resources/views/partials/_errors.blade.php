<div class="row" id="error_bag">
  @if (count($errors) > 0)
    <div class="error-bag pad-2" style='color:white;'>
      <span class="mdi mdi-close-box" onclick="close_me('error_bag')" style="float:right;color:black;font-size:20px;"></span>
      <strong>Whoops!</strong> There were some problems with your input.<br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</div>
