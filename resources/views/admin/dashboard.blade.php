@extends('template')
@section('section1')

@role('admin')
{{-- <div id="pre_splash" class="center-align">
    <div style="margin-top:20%;"> <!-- margin-top:20%; --> --}}
      {{-- <img src="{{ asset('public/img/loader.gif') }}" class="responsive-img"> --}}

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
    {{-- </div>
  </div> --}}

  <div id="post_splash" style="display:none;">

    <div class="row">
      <!-- <div class="col s2 m1 l1">
        // include _short_nav
      </div> -->

      <div class="col s12 m12 l12">
        <div class="col s12 m12 l12">
<center>
<h2 class="thin">
  <span class="mdi mdi-view-dashboard"></span>Dashboard
</h2>
</center>
</div>


 <div class="col s12 m12 l12" id="app">
    <div class="col s12 m6 l4">
      <div class="col s12 m12 l12 menu-tab z-depth-4">
        <a href="dashboard/today_sales.html">
          <div class="col s6 m6 l6">
            <h3 align="center">
              <span class="mdi mdi-script"></span>
            </h3>
            <h5 class="thin" align="center">Transactions</h5>
          </div>
        </a>
        <div class="col s6 m6 l6" style="font-size:12px;">
          <a href="dashboard/profit_loss.html">
            <h5>Profit/Loss Report</h5>
          </a>
          <a href="dashboard/today_sales.html">
            <h5>Sale Search</h5>
          </a><br>
          <h6>Today &#40;&#41;</h6>
          <p>
            <strong>Sales: </strong>
          </p>
          <p>
            <strong>Payments: </strong>
          </p>
        </div>
      </div>
    </div>

    <div class="col s12 m6 l4">
      <div class="col s12 m12 l12 menu-tab z-depth-4">
        <a href="report/current_stock.html">
          <div class="col s6 m6 l6">
            <h3 align="center">
              <span class="mdi mdi-chart-pie"></span>
            </h3>
            <h5 class="thin" align="center">Current Stock</h5>
          </div>
        </a>
        <div class="col s6 m6 l6">

        </div>
      </div>
    </div>
    <div class="col s12 m6 l4">
      <div class="col s12 m12 l12 menu-tab z-depth-4">
        <a href="client/reports/report.html">
          <div class="col s6 m6 l6">
            <h3 align="center">
               <span class="mdi mdi-account-star"></span>
            </h3>
            <h5 class="thin" align="center">Client Reports</h5>
          </div>
        </a>
        <div class="col s6 m6 l6" style="font-size:12px;overflow-y:scroll;">

        </div>
      </div>
    </div>

    <div class="col s12 m6 l4">
      <div class="col s12 m12 l12 menu-tab z-depth-4">
        <a href="sale.html">
          <div class="col s6 m6 l6">
            <h3 align="center">
              <span class="mdi mdi-script"></span>
            </h3>
            <h5 class="thin" align="center">Today Sales</h5>
          </div>
        </a>
        <div class="col s6 m6 l6" style="font-size:12px;">
          <h6>Total &#40;&#41;</h6>
                </div>
      </div>
    </div>

    <div class="col s12 m6 l4">
      <div class="col s12 m12 l12 menu-tab z-depth-4">
        <a href="payment.html">
          <div class="col s6 m6 l6">
            <h3 align="center">
              <span class="mdi mdi-script"></span>
            </h3>
            <h5 class="thin" align="center">Today Payments</h5>
          </div>
        </a>
        <div class="col s6 m6 l6" style="font-size:12px;">
          <h6>Total &#40;&#41;</h6>
                </div>
      </div>
    </div>

    <div class="col s12 m6 l4">
      <div class="col s12 m12 l12 menu-tab z-depth-4">
        <a href="product.html">
          <div class="col s6 m6 l6">
            <h3 align="center">
              <span class="mdi mdi-apple-keyboard-command"></span>
            </h3>
            <h5 class="thin" align="center">Top Selling Products</h5>
          </div>
        </a>
        <div class="col s6 m6 l6" style="font-size:12px;overflow-y:scroll;">
                </div>
      </div>
    </div>


  </div> <!-- #app -->
            </div>
          </div>
        </div> <!-- End Post Splash -->

@endrole

@stop
