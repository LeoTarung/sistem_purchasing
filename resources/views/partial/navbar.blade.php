      <!-- Header-->
      <header id="header" class="header">
          <div class="top-left">

              <div class="navbar-header">
                  {{-- <a class="navbar-brand" href="./"><img src="/img/nusametal.png" alt="Logo"></a> --}}
                  {{-- <a class="navbar-brand" href="./"><img height="50" src="/img/rma.jpg" alt="Logo"></a> --}}
                  {{-- <a class="navbar-brand hidden" href="./"><img src="/img/nusametal.png" alt="Logo"></a> --}}
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                  {{-- <a id="menuToggle" class="menutoggle"><i class="fa fa-arrow-left"></i> </a> --}}

              </div>
              {{-- <h3>
                    {{ $title }}
              </h3> --}}
          </div>

          <div class="top-right">
              <div class="header-menu">
                  <div class="header-left">
                      @if (Auth::user()->role == 'Supplier')
                          <div class="dropdown for-notification">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-bell"></i>
                                  <span id="countMsg" class="count bg-danger"></span>
                              </button>
                              <div id="notificationMsg" class="dropdown-menu" aria-labelledby="notification">
                                  <p id="pMsg" class="red"></p>
                              </div>
                          </div>
                      @endif
                      <div class="dropdown for-message">
                          <div class="nama">
                              {{-- {{ str_pad(Auth::user()->nrp, 4, '0', STR_PAD_LEFT) }} | --}}
                              {{-- {{ implode(' ', array_slice(explode(' ', Auth::user()->name), 0, 2)) }} --}}
                              {{ Auth::user()->name }}
                          </div>
                      </div>
                  </div>

                  <div class="user-area dropdown float-right">
                      <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                          <img class="user-avatar rounded-circle" src="/img/user.png" alt="User Avatar">
                      </a>

                      <div class="user-menu dropdown-menu">
                          {{-- <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                          <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span
                                  class="count">13</span></a>

                          <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a> --}}

                          <a class="nav-link" href="{{ route('logout') }}"><i class="fa fa-power-off"></i>Logout</a>
                      </div>
                  </div>
              </div>
          </div>
      </header>
