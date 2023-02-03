<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name') }}</title>

      <link rel="icon" type="image/png" href="{{ URL::asset('public/materialize/img/favicon/fav.png') }}">
      <link rel="stylesheet" href="{{ URL::asset('public/css/materialize.min.css') }}" />
      <link rel="stylesheet" href="{{ URL::asset('public/css/nouislider.css') }}" />
      <link rel="stylesheet" href="{{ URL::asset('public/css/materialdesignicons.min.css') }}" />
      <link rel="stylesheet" href="{{ URL::asset('public/css/custom.css') }}" />
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>
    </head>
<style>
    table.dataTable {
    width: 100% !important;
    }
</style>
    <body>
        @if(Auth::check())
        <?php $currentUserRole = Auth::user()->roles->pluck('name'); ?>
        @endif
      <!-- Navbar section -->
      <!-- <div class="navbar-fixed"> -->
        <nav class="navbar z-depth-5">
          <div class="nav-wrapper">
            <a href="#" class="brand-logo center">
              <span class="thin">
                ZR Erorex
              </span>
            </a>

            <!-- Side Nav -->
            @if (Auth::guest())
            @else
            <ul id="nav-mobile" class="left">
              <a href="#" data-activates="slide-out" class="button-collapse show-on-large">
                <span class="mdi mdi-menu"></span>
              </a>
              @include('partials/_side_nav')

            </ul>
            @endif

            <!-- BreadCrumbs -->
            <ul class="left">

              <li class="thin tooltipped" data-position="right" data-delay="800" data-tooltip="BreadCrumbs">

                <span>ZR_Erorex</span>

                @for($i = 1; $i <= count(Request::segments()); $i++)
                  &nbsp;&#47;&nbsp;{{Request::segment($i)}}
                @endfor
              </li>
            </ul>

            <ul class="right">
              @if (Auth::guest())
                <li class="tooltipped" data-position="bottom" data-delay="800" data-tooltip="Login">
                  <a href="{{ route('login') }}"><span class="mdi mdi-account-key" style="font-size:25px;"></span></a>
                </li>

              @else
                <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Profile Settings">
                  <a href="/profile">
                    <span class="mdi mdi-account" style="font-size:18px;">
                      {{ Auth::user()->name }}
                    </span>
                  </a>
                </li>

                <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="LogOut">
                  <a href=""
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      <span class="mdi mdi-logout" style="font-size:25px;"></span>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </li>
              @endif
            </ul>
          </div>
        </nav>
      <!-- </div> -->

      <div id="pre_splash" class="center-align">
        <div style="margin-top:20%;"> <!-- margin-top:20%; -->

          <img src="{{ URL::asset('public/img/loader.gif') }}" class="responsive-img">

          <!-- <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-green-only">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
          <span class="thin" style="font-size:18px;">&nbsp;&nbsp;LOADING VIEW</span> -->
        </div>
      </div>

      {{-- <div id="post_splash"> --}}

        <div class="row">
          <!-- <div class="col s2 m1 l1">
            // include _short_nav
          </div> -->

          <div class="col s12 m12 l12">
            @yield('section1')
          </div>
        </div>
      </div> <!-- End Post Splash -->

        <!-- Scripts -->
        <!-- <script src="{{ asset('js/app.js') }}"></script> -->

        <!-- Scripts Section -->
        <script src="{{ URL::asset('public/js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ URL::asset('public/js/materialize.min.js') }}"></script>
        <script src="{{ URL::asset('public/js/nouislider.js') }}"></script>
        <script src="{{ URL::asset('public/js/printThis.js') }}"></script>
        <script src="{{ URL::asset('public/js/vue.js') }}"></script>
        <script src="{{ URL::asset('public/js/custom.js') }}"></script>

  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <!--                -->
        <!-- Flash Messages -->
        <!--                -->
        @if(session()->has('message.level'))

          @if(session('message.level')=='success')
            <script>
              $(window).on('load',function(){
                var $toastContent = $("<span class='mdi mdi-checkbox-marked-circle-outline'></span>&nbsp;<span>{{ session('message.content') }}</span>")
                  .add($("<a href='{{ url(session('message.link')) }}' class='btn-flat toast-action'><span class='mdi mdi-link-variant'></span>link</a>"));
                Materialize.toast($toastContent, 7000, 'green');
              });
            </script>
          @elseif(session('message.level')=='warning')
            <script>
              $(window).on('load',function(){
                var $toastContent = $("<span class='mdi mdi-checkbox-marked-circle-outline'></span>&nbsp;<span>{{ session('message.content') }}</span>")
                  .add($("<a href='{{ url(session('message.link')) }}' class='btn-flat toast-action'><span class='mdi mdi-link-variant'></span>link</a>"));
                Materialize.toast($toastContent, 7000, 'blue');
              });
            </script>
          @elseif(session('message.level')=='error')
            <script>
              $(window).on('load',function(){
                var $toastContent = $("<span class='mdi mdi-backspace'></span>&nbsp;<span>{{ session('message.content') }}</span>");
                Materialize.toast($toastContent, 5000, 'orange');
              });
            </script>
          @elseif(session('message.level')=='not_allowed')
            <script>
              $(window).on('load',function(){
                var $toastContent = $("<span class='mdi mdi-account-alert'></span>&nbsp;<span>{{ session('message.content') }}</span>");
                Materialize.toast($toastContent, 5000, 'red');
              });
            </script>
          @endif
        @endif

        <script type="text/javascript">
          $(window).on('load',function(){

            $('#pre_splash').css('display','none');
            $( "#post_splash" ).toggle("slide");

            $(".button-collapse").sideNav();

            $(".message").delay(2000).slideUp(1000);

            $(".materialboxed").materialbox();

            $('select').material_select();

            $('.datepicker').pickadate({
              selectMonths: true, // Creates a dropdown to control month
              selectYears: 15, // Creates a dropdown of 15 years to control year
              format: 'yyyy-mm-dd' // set the format of date-picker
            });

            $('.modal').modal();

            $('ul.tabs').tabs();

            $('.add-btn').click(function(){
              $('.form-div').animate({"margin-left": '+=1200'});
            });
          });

          function print_this(id){
            $("#"+id).printThis({
              importCSS: true,
              importStyle: true,
              loadCSS: [
                "{{ URL::asset('public/css/materialize.css') }}",
              ],
              //header:'<h1>Table Report</h1>'
            });
          }
        </script>

        <!-- For page wise scripts -->
        @yield('page_scripts')
    </body>
</html>


