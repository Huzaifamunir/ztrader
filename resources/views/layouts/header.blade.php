 <!-- <div class="navbar-fixed"> -->
        <nav class="navbar z-depth-5">
            <div class="nav-wrapper">
              <a href="#" class="brand-logo center">
                <span class="thin">
                  ZR Erorex
                </span>
              </a>

              <!-- Side Nav -->

              <!-- BreadCrumbs -->
              <ul class="left">

                <li class="thin tooltipped" data-position="right" data-delay="800" data-tooltip="BreadCrumbs">

                  <span>ZR_Erorex</span>

                                    &nbsp;&#47;&nbsp;home
                                </li>
              </ul>

              <ul class="right">
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


              </ul>
            </div>
          </nav>
        <!-- </div> -->


