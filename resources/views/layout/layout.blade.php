<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Colegio DashBoard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
        <!-- Select2 CSS -->
    <!-- Enlaces CDN para Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>



    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!-- Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!-- Config: Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file. -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{route('dashboard')}}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <!-- SVG content -->
                        </span>
                        <img src="/assets/img/logos/logo.png" alt="BootstrapBrain Logo" width="200">
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item ">
                        @if (Auth::user()->rol === 'admin')
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                        </a>
                        @elseif(Auth::user()->rol === 'profesor')
                        <div style="margin-left: 40px">
                            <img src="/assets/img/logos/profe2.png" alt="" width="200">
                        </div>
                        @elseif(Auth::user()->rol === 'padre_familia')
                        <div style="margin-left: 40px">
                            <img src="/assets/img/logos/padres.png" alt="" width="200">
                        </div>
                        @endif
                        <ul class="menu-sub">
                            <li class="menu-item active">
                                <a href="{{ route('alumnos.index') }}" class="menu-link">
                                    <div data-i18n="Analytics">Alumnos</div>
                                </a>
                            </li>
                          </ul>

                          <ul class="menu-sub">
                              <li class="menu-item active">
                                  <a href="{{ route('nivels.index') }}" class="menu-link">
                                      <div data-i18n="Analytics">Niveles</div>
                                  </a>
                              </li>
                          </ul>
                          <ul class="menu-sub">
                              <li class="menu-item active">
                                  <a href="{{ route('grados.index') }}" class="menu-link">
                                      <div data-i18n="Analytics">Grados</div>
                                  </a>
                              </li>
                          </ul>
                          <ul class="menu-sub">
                              <li class="menu-item active">
                                  <a href="{{ route('secciones.index') }}" class="menu-link">
                                      <div data-i18n="Analytics">Secciones</div>
                                  </a>
                              </li>
                          </ul>
                          <ul class="menu-sub">
                                <li class="menu-item active">
                                    <a href="#" class="menu-link">
                                        <div data-i18n="Analytics">Competencias</div>
                                    </a>
                                </li>
                          </ul>
                          <ul class="menu-sub">
                              <li class="menu-item active">
                                  <a href="{{ route('areas.index') }}" class="menu-link">
                                      <div data-i18n="Analytics">Áreas Académicas</div>
                                  </a>
                              </li>
                          </ul>
                          <ul class="menu-sub">
                              <li class="menu-item active">
                                  <a href="{{ route('profes.index') }}" class="menu-link">
                                      <div data-i18n="Analytics">Docentes</div>
                                  </a>
                              </li>
                          </ul>
                          <ul class="menu-sub">
                              <li class="menu-item active">
                                  <a href="{{ route('padres.index') }}" class="menu-link">
                                      <div data-i18n="Analytics">Padres de Familia</div>
                                  </a>
                              </li>
                          </ul>
                          <ul class="menu-sub">
                              <li class="menu-item active">
                                  <a href="{{ route('periodos.index') }}" class="menu-link">
                                      <div data-i18n="Analytics">Periodos</div>
                                  </a>
                              </li>
                          </ul>
                    </li>
                    <!-- Layouts -->
                    <li class="menu-item">
                        @if (Auth::user()->rol === 'admin')
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div data-i18n="Layouts">Operaciones</div>
                        </a>
                        @else
                        <a href="javascript:void(0);" class="menu-link menu-toggle" hidden>
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div data-i18n="Layouts">Operaciones</div>
                        </a>
                        @endif
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('matriculas.index') }}" class="menu-link">
                                    <div data-i18n="Without Menu">Matricular Estudiante</div>
                                </a>
                            </li>
                        </ul>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="#" class="menu-link">
                                    <div data-i18n="Without Menu">Filtar cursos y alumnos</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                   
                    <li class="menu-item">
                        @if (Auth::user()->rol === 'admin')
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Layouts">Cursos</div>
                        </a>
                        @else
                        <a href="javascript:void(0);" class="menu-link menu-toggle" hidden>
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Layouts">Cursos</div>
                        </a>
                        @endif
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('cursos.index', ['nivel'=>1]) }}" class="menu-link">
                                <div data-i18n="cursosPrimaria">Cursos - Nivel Primaria</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('cursos.index', ['nivel'=>2]) }}" class="menu-link">
                                    <div data-i18n="cursosSecundaria">Cursos - Nivel Secundaria</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <ul class="menu-item " >
                                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                                        <i class="menu-icon tf-icons bx bx-collection"></i>
                                        <div data-i18n="">Grado - Cursos</div>
                                    </a>
                                    <ul class="menu-sub" >
                                        <li class="menu-item">
                                            <a href="#" class="menu-link ms-5">
                                                <div data-i18n="">Cursos por Grado del Nivel Primaria</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="#" class="menu-link ms-5">
                                                <div data-i18n="">Cursos por Grado del Nivel Secundaria</div>
                                            </a>
                                        </li>
                                    </ul>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                      <p style="margin-top: 19px">Menú Principal</p>
                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>

                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">

                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">

                                                <div class="flex-shrink-0 me-3">

                                                    <div class="avatar avatar-online">

                                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block">{{ Auth::user()->name }}
                                                        @if (Auth::user()->rol === 'admin')
                                                        {{ __(' (Administrador)') }}
                                                        @elseif(Auth::user()->rol === 'profesor')
                                                        {{ __(' (Profesor)') }}
                                                        @elseif(Auth::user()->rol === 'padre_familia')
                                                        {{ __(' (Padre de Familia)') }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                      <a class="dropdown-item" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                       {{ __('Logout') }}
                                   </a>

                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                       @csrf
                                   </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                @yield('contenido')
                            </div>
                        </div>
                    </div>
                    @yield('paginacion')
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <!-- Place this tag in your head or just before your close-->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @yield('script')
  </body>
</html>
    <script src=  "{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close-->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
