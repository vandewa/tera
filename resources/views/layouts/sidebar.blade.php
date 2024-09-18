      <!-- Preloader --> {{-- <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__shake" src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
              height="60" width="60">
      </div> --}}

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
          </ul>

          <!-- Right navbar links -->
          <ul class="ml-auto navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('logout') }}"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <div class="d-flex align-items-center">
                          <div class="ms-3"><i class="mr-2 fas fa-sign-out-alt"></i></i>Keluar</div>
                      </div>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </a>
              </li>
          </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-info elevation-4">
          <!-- Brand Logo -->
          <a href="{{ route('dashboard') }}" class="brand-link">
              {{-- <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                  class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
              <img src="{{ asset('pemda.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                  style="opacity: .8">
              <span class="brand-text font-weight-light">RAINBO</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="pb-3 mt-3 mb-3 user-panel d-flex">
                  <div class="image">
                      <img src="{{ asset('soul.png') }}" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                      <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                  </div>
              </div>

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                      data-accordion="false">
                      @role(['superadministrator', 'administrator', 'penera'])
                          <li class="nav-item">
                              <a href="{{ route('dashboard') }}"
                                  class="nav-link  {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}{{ Request::segment(1) == '' ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-home"></i>
                                  <p>
                                      Dashboard
                                  </p>
                              </a>
                          </li>
                      @endrole

                      @role('user')
                          <li class="nav-item">
                              <a href="{{ route('permohonan') }}"
                                  class="nav-link  {{ Request::segment(1) == 'permohonan' ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-pencil-alt"></i>
                                  <p>
                                      Permohonan
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('user-uttp') }}"
                                  class="nav-link  {{ Request::segment(1) == 'my-uttp' ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-suitcase"></i>
                                  <p>
                                      Uttp Saya
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('data-diri') }}"
                                  class="nav-link  {{ Request::segment(1) == 'data-diri' ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-user-edit"></i>
                                  <p>
                                      Data Diri
                                  </p>
                              </a>
                          </li>
                      @endrole

                      @role(['superadministrator', 'administrator', 'penera'])
                          <li class="nav-item">
                              <a href="{{ route('admin.permohonan') }}"
                                  class="nav-link  {{ Request::segment(2) == 'permohonan' ? 'active' : '' }}
                               {{ Request::segment(2) == 'proses' ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-pen-square"></i>
                                  <p class="mr-1">
                                      Permohonan
                                  </p>
                                  <livewire:component.badges.permohonan-badges>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.sidang.tera') }}"
                                  class="nav-link  {{ Request::segment(2) == 'sidang-tera' ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-tools"></i>
                                  <p class="mr-1">
                                      Sidang Tera
                                  </p>
                              </a>
                          </li>
                      @endrole

                      @role(['superadministrator', 'administrator'])
                          <li class="nav-item">
                              <a href="{{ route('jadwal-tera') }}"
                                  class="nav-link
                              {{ Request::segment(1) == 'jadwal-tera' ? 'active' : '' }}
                              {{ Request::segment(1) == 'detail-jadwal-tera' ? 'active' : '' }}
                              ">
                                  <i class="nav-icon fas fa-calendar"></i>
                                  <p>
                                      Jadwal Tera
                                  </p>
                              </a>
                          </li>
                          <li
                              class="nav-item
                            {{ Request::segment(2) == 'user-index' ? 'menu-is-opening menu-open' : '' }}
                            {{ Request::segment(2) == 'user' ? 'menu-is-opening menu-open' : '' }}
                            {{ Request::segment(2) == 'uttp' ? 'menu-is-opening menu-open' : '' }}
                            {{ Request::segment(2) == 'peralatan' ? 'menu-is-opening menu-open' : '' }}
                            {{ Request::segment(2) == 'template-dokumen' ? 'menu-is-opening menu-open' : '' }}
                        ">
                              <a href="#"
                                  class="nav-link
                                {{ Request::segment(2) == 'user-index' ? 'active' : '' }}
                                {{ Request::segment(2) == 'user' ? 'active' : '' }}
                                {{ Request::segment(2) == 'uttp' ? 'active' : '' }}
                                {{ Request::segment(2) == 'peralatan' ? 'active' : '' }}
                                {{ Request::segment(2) == 'template-dokumen' ? 'active' : '' }}
                                ">
                                  <i class="nav-icon fa-solid fa-file-lines"></i>
                                  <p>
                                      Master
                                      <i class="fas fa-angle-left right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('master.uttp') }}"
                                          class="nav-link {{ Request::segment(2) == 'uttp' ? 'active' : '' }}">
                                          @if (Request::segment(2) == 'uttp')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>Jenis UTTP</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('master.peralatan') }}"
                                          class="nav-link {{ Request::segment(2) == 'peralatan' ? 'active' : '' }}">
                                          @if (Request::segment(2) == 'peralatan')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>Peralatan</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('master.template-dokumen') }}"
                                          class="nav-link {{ Request::segment(2) == 'template-dokumen' ? 'active' : '' }}">
                                          @if (Request::segment(2) == 'template-dokumen')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>Template Dokumen</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('master.user-index') }}"
                                          class="nav-link
                                        {{ Request::segment(2) == 'user-index' ? 'active' : '' }}
                                        {{ Request::segment(2) == 'user' ? 'active' : '' }}
                                      ">
                                          @if (Request::segment(2) == 'user-index')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @elseif(Request::segment(2) == 'user')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>User</p>
                                      </a>
                                  </li>

                              </ul>
                          </li>
                      @endrole
                  </ul>

              </nav>
              <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
      </aside>
