<br>
<div class="col s12 m6 l5 offset-m3 offset-l3 z-depth-5" style="padding:3%;background-color: white;">

  <a class="btn back-btn tooltipped" href="{{ url(URL::previous()) }}" data-position="bottom" data-delay="200" data-tooltip="go back">
    <span class="mdi mdi-arrow-left"></span>
  </a>

  <a class="btn back-btn tooltipped" href="{{ route($entity.'.index') }}" data-position="bottom" data-delay="200" data-tooltip="{{ $entity }} index">
    <span class="mdi mdi-menu"></span>
  </a>

  <table class="highlight bordered">
    <caption>
      <h3 class="thin" style="text-transform:capitalize;">
        @if(isset($icon))
          <span class="mdi mdi-{{ $icon }}"></span>
        @endif
        @if($entity=='main_category')
          Brands
        @elseif($entity=='sub_category')

        Product
        
        @else
        {{ $entity }}
        @endif
      </h3>
    </caption>

    <tbody>

      {{ $items }}

      <tr>
        <th>
          <a class="btn edit-btn" href="{{ route($entity.'.edit', [$id]) }}">
            <span class="mdi mdi-pen"></span> Edit
          </a>

        </th>
        

      </tr>
    </tbody>
  </table>
</div>
