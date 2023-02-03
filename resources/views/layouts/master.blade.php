<!DOCTYPE html>
<html>
<!-- Mirrored from codifytest.codify.pk/home by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jan 2023 10:31:59 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="iIemr5Ya9iClINlVnojjwJ8K3ly9gP5OvlbhGeuK">
      <title>@yield('title')</title>
      <link rel="icon" type="image/png" href="{{ asset('public/materialize/img/favicon/fav.html')}}">
      <link rel="stylesheet" href="{{ asset('public/css/materialize.min.css')}}" />
      <link rel="stylesheet" href="{{ asset('public/css/nouislider.css') }}" />
      <link rel="stylesheet" href="{{ asset('public/css/materialdesignicons.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}" />
      <link rel="stylesheet" href="{{ asset('public/cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css') }}"/>
    </head>

<style>
    table.dataTable {
    width: 100% !important;
    }
</style>
    <body>
        @include('layouts.header')

        @yield('content')

        <!-- Scripts Section -->
        <script src="{{ asset('public/js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('public/js/materialize.min.js') }}"></script>
        <script src="{{ asset('public/js/nouislider.js') }}"></script>
        <script src="{{ asset('public/js/printThis.js')}}"></script>
        <script src="{{ asset('public/js/vue.js')}}"></script>
        <script src="{{ asset('public/js/custom.js')}}"></script>

  <script src="{{ asset('public/cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js')}}"></script>
        <!--                -->
        <!-- Flash Messages -->
        <!--                -->

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
                "https://codifytest.codify.pk/public/css/materialize.css",
              ],
              //header:'<h1>Table Report</h1>'
            });
          }
        </script>

        <!-- For page wise scripts -->
        <script>
//    var app = new Vue({
//   el: '#app',
//   delimiters: ['[[', ']]'],

//   data: {
//     auth_user: ,
//     transactions: { total_sales: null, total_payments: null,total: null },
//     stock: { total_sales: null, total_payments: null },
//     client: { total_sales: null, total_payments: null },
//     salesman: { total_sales: null, total_payments: null },
//     provider: { total_sales: null, total_payments: null },
//     reseller: { total_sales: null, total_payments: null }
//   },

//   computed: {
    // total_sets: function(){
    //   var sum=this.price_per_unit*this.quantity;
    //   return sum;
    // }
//   },

//   methods: {
    // find_product: function (id) {
    //   $.get("/product/"+id,function(data, status){
    //     app.product=data;
    //   });
    //   $('#modal1').modal('open');
    // }
//   },

//   mounted() {
//     $.get("/dashboard/today_sales",function(data, status){
//       app.transactions = data;
//     });
//   }
// });
//
</script>
    </body>

<!-- Mirrored from codifytest.codify.pk/home by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jan 2023 10:32:06 GMT -->
</html>
