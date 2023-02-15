<div class="short-nav" style="height:1200px;">

    <div class="navbar" style="height:120px;">
        <center>
            <br>
            <!-- <img src="{{ URL::asset('img/logo.png') }}"> -->
        </center>
    </div>

    <ul class="collapsible" data-collapsible="accordion">
        <table class="highlight font-dark">
            <thead>
              <!-- <tr>
                  <th>Name</th>
                  <th>Item Name</th>
                  <th>Item Price</th>
              </tr> -->
            </thead>

            <tbody>
              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Dashboard Index">
                    <a href="{{ route('dashboard.index') }}">
                        <span class="mdi mdi-view-dashboard font-dark"></span>
                    </a>
                </td>
                <td></td>
              </tr>

              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Users Index">
                    <a href="{{ route('user.index') }}">
                        <span class="mdi mdi-account font-dark"></span>
                    </a>
                </td>
                <td></td>
              </tr>

              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Salesman Index">
                    <a href="{{ route('salesman.index') }}">
                        <span class="mdi mdi-account-outline font-dark"></span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Salesman">
                    <a href="{{ route('salesman.create') }}">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Client Index">
                    <a href="{{ route('client.index') }}">
                        <span class="mdi mdi-account-star font-dark"></span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Client">
                    <a href="{{ route('client.create') }}">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Provider Index">
                    <a href="{{ route('provider.index') }}">
                        <span class="mdi mdi-ticket-account font-dark"></span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Provider">
                    <a href="{{ route('provider.create') }}">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Mobile Index">
                    <a href="{{ route('mobile.index') }}">
                        <span class="mdi mdi-apple-keyboard-command font-dark"></span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Product">
                    <a href="{{ route('mobile.create') }}">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Stock Index">
                    <a href="{{ route('stock.index') }}">
                        <span class="mdi mdi-truck font-dark"></span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Stock">
                    <a href="{{ route('stock.create') }}">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Sale Index">
                    <a href="{{ route('sale.index') }}">
                        <span class="mdi mdi-script font-dark"></span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Invoice">
                    <a href="{{ route('sale.create') }}">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Bag Index">
                    <a href="{{ route('bag.index') }}">
                        <span class="mdi mdi-shopping font-dark"></span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Bag">
                    <a href="{{ route('bag.create') }}">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>



              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Reports Index">
                    <a href="{{ Route('reports.index') }}">
                        <span class="mdi mdi-chart-pie font-dark"></span>
                    </a>
                </td>
                <td></td>
              </tr>

              <tr class="new_class">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Settings Index">
                    <a href="{{ route('settings.index') }}">
                        <span class="mdi mdi-settings font-dark"></span>
                    </a>
                </td>
                <td></td>
              </tr>

            </tbody>
        </table>
    </ul>
</div>
