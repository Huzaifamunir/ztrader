<div id="slide-out" class="side-nav">

     <div class="navbar">
        <center>
            <br>
            <img style="height: 88px;" sty src="{{ URL::asset('public/img/logo.png') }}">
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

                @if(!empty(Auth::user()->id) && Auth::user()->id == 1)
                <tr class="spaceUnder">
                    <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Sale Index">
                        <a href="{{url('companies')}}">
                            <span class="mdi mdi-script font-dark">
                               <span>Companies</span>
                            </span>
                        </a>
                    </td>
                    <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Invoice">
                        <a href="{{url('companies')}}">
                            <span class="mdi mdi-plus-circle-outline font-dark"></span>
                        </a>
                    </td>
                  </tr>

                  <tr class="spaceUnder">
                    <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Sale Index">
                        <a href="{{route('country.index')}}">
                            <span class="mdi mdi-script font-dark">
                               <span>Country</span>
                            </span>
                        </a>
                    </td>
                    <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Invoice">
                        <a href="{{route('country.index')}}">
                            <span class="mdi mdi-plus-circle-outline font-dark"></span>
                        </a>
                    </td>
                  </tr>

                  <tr class="spaceUnder">
                    <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Sale Index">
                        <a href="{{route('state.index')}}">
                            <span class="mdi mdi-script font-dark">
                               <span>State</span>
                            </span>
                        </a>
                    </td>
                    <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Invoice">
                        <a href="{{route('state.index')}}">
                            <span class="mdi mdi-plus-circle-outline font-dark"></span>
                        </a>
                    </td>
                  </tr>

                  <tr class="spaceUnder">
                    <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Sale Index">
                        <a href="{{route('city.index')}}">
                            <span class="mdi mdi-script font-dark">
                               <span>City</span>
                            </span>
                        </a>
                    </td>
                    <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Invoice">
                        <a href="{{route('city.index')}}">
                            <span class="mdi mdi-plus-circle-outline font-dark"></span>
                        </a>
                    </td>
                  </tr>

                  <tr class="spaceUnder">
                    <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Sale Index">
                        <a href="{{route('show_bank')}}">
                            <span class="mdi mdi-script font-dark">
                               <span>Add Bank</span>
                            </span>
                        </a>
                    </td>
                    <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Invoice">
                        <a href="{{route('show_bank')}}">
                            <span class="mdi mdi-plus-circle-outline font-dark"></span>
                        </a>
                    </td>
                  </tr>
                  @endif
                  @role('admin')
             <tr class="spaceUnder">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Dashboard Index">
                    <a href="{{ route('home') }}">
                        <span class="mdi mdi-view-dashboard font-dark">
                            <span> Dashboard</span>
                        </span>
                    </a>
                </td>
                <td></td>
             </tr>


              <tr class="spaceUnder">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Sale Index">
                    <a href="{{ route('sale.index') }}">
                        <span class="mdi mdi-script font-dark">
                           <span>Sale</span>
                        </span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Invoice">
                    <a href="">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="spaceUnder">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Payment Index">
                    <a href="{{ route('payment.index') }}">
                        <span class="mdi mdi-currency-eur font-dark">
                           <span>Payment</span>
                        </span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Receive payment">
                    <a href="">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="spaceUnder">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Client Index">
                    <a href="{{ url('client') }}">
                        <span class="mdi mdi-account-star font-dark">
                           <span> Client</span>
                        </span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Client">
                    <a href="{{ route('client_create')}}">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="spaceUnder">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Stock Index">
                    <a href="{{ route('stock.index') }}">
                        <span class="mdi mdi-truck font-dark">
                           <span>Stock</span>
                        </span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Stock">
                    <a href="{{ route('stock.create') }}">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="spaceUnder">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Products Index">
                    <a href="{{ route('products.index') }}">
                        <span class="mdi mdi-apple-keyboard-command font-dark">
                           <span>Products</span>
                        </span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Product">
                    <a href="">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <!-- <tr class="spaceUnder">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Users Index">
                    <a href="">
                        <span class=""mdi mdi-account font-dark">
                            <span> Users</span>
                        </span>
                    </a>
                </td>
              </tr> -->

              <tr class="spaceUnder">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Provider Index">
                    <a href="{{ route('provider')}}">
                        <span class="mdi mdi-account-box-outline font-dark">
                           <span>Provider</span>
                        </span>
                    </a>
                </td>
                <td class="tooltipped" data-position="right" data-delay="500" data-tooltip="Add Provider">
                    <a href="{{ route('provider_create')}}">
                        <span class="mdi mdi-plus-circle-outline font-dark"></span>
                    </a>
                </td>
              </tr>

              <tr class="spaceUnder">
                <td class="tooltipped" data-position="right" data-delay="800" data-tooltip="Dashboard Index">
                    <a href="{{ url('menu')}}">
                        <span class="mdi mdi-menu font-dark">
                            <span> Menu</span>
                        </span>
                    </a>
                </td>
                <td></td>
              </tr>
@endrole
            </tbody>
        </table>
    </ul>
</div>
