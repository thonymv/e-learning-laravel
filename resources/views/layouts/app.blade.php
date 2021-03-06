@php
$select = isset(View::getSections()['select']) ? View::getSections()['select'] : '';
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Academia QA</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/font-awesome-all.js') }}" defer></script>
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
@auth

    <body class="sb-nav-fixed">
    @else

        <body class="sb-nav-fixed sb-sidenav-toggled">
        @endauth
        <div>
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <a class="navbar-brand" href="{{ url('/') }}">Academia QA</a>
                @auth
                    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
                        <i class="fas fa-bars"></i></button>
                    <!-- Navbar Search-->
                    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                        @csrf
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                @endauth
                <!-- Navbar-->
                @auth
                    <ul class="navbar-nav ml-auto ml-md-0">
                    @else
                        <ul class="navbar-nav ml-auto">
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user fa-fw"></i>
                                    {{ Auth::user()->name }}
                                    {{ ' ' . Auth::user()->last_name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">Settings</a>
                                    <a class="dropdown-item" href="#">Activity Log</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
            </nav>
            <div id="layoutSidenav">
                @auth
                    <div id="layoutSidenav_nav">
                        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                            <div class="sb-sidenav-menu">
                                <div class="nav">
                                    <div class="sb-sidenav-menu-heading">Contenido</div>
                                    <a class="nav-link collapsed {{ $select == '/' || $select == '/register' ? 'active' : '' }}"
                                        href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false"
                                        aria-controls="collapseLayouts">
                                        <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                                        Secciones
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                                        data-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link {{ $select == '/' ? 'active' : '' }}"
                                                href="{{ url('/') }}">Gestionar</a>
                                            <a class="nav-link {{ $select == '/register' ? 'active' : '' }}"
                                                href="{{ url('/sections/register') }}">Registrar</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed {{ $select == '/courses' || $select == '/courses/register' ? 'active' : '' }}"
                                        href="#" data-toggle="collapse" data-target="#collapseLayouts2"
                                        aria-expanded="false" aria-controls="collapseLayouts2">
                                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                        Cursos
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                                        data-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link {{ $select == '/courses' ? 'active' : '' }}"
                                                href="{{ url('/courses') }}">Gestionar</a>
                                            <a class="nav-link {{ $select == '/courses/register' ? 'active' : '' }}"
                                                href="{{ url('/courses/register') }}">Registrar</a>
                                        </nav>
                                    </div>

                                    <div class="sb-sidenav-menu-heading">Usuarios</div>
                                    <a class="nav-link collapsed {{ $select == '/clients' || $select == '/clients/register' ? 'active' : '' }}"
                                        href="#" data-toggle="collapse" data-target="#collapseLayouts3"
                                        aria-expanded="false" aria-controls="collapseLayouts3">
                                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                        Clientes
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                                        data-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link {{ $select == '/clients' ? 'active' : '' }}"
                                                href="{{ url('/clients') }}">Gestionar</a>
                                            <a class="nav-link {{ $select == '/clients/register' ? 'active' : '' }}"
                                                href="{{ url('/clients/register') }}">Registrar</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed {{ $select == '/admin' || $select == '/admin/register' ? 'active' : '' }}"
                                        href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="false"
                                        aria-controls="collapseAdmin">
                                        <div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>
                                        Administradores
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseAdmin" aria-labelledby="headingOne"
                                        data-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link {{ $select == '/admin' ? 'active' : '' }}"
                                                href="{{ url('/admin') }}">Gestionar</a>
                                            <a class="nav-link {{ $select == '/admin/register' ? 'active' : '' }}"
                                                href="{{ url('/admin/register') }}">Registrar</a>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="sb-sidenav-footer">
                                <div class="small">Logueado en:</div>
                                Academia QA
                            </div>
                        </nav>
                    </div>
                @endauth
                <div id="layoutSidenav_content">
                    <main>
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/scripts.js') }}" defer></script>
        <script>
            window.addEventListener('load', function() {
                $('.modal').on("hidden.bs.modal", function(e) {
                    if ($('.modal:visible').length) {
                        $('body').addClass('modal-open');
                        $('body').css("padding-right", "17px");
                    }
                });

                //// CKEditor compatibility with modal bootstrap
                $.fn.modal.Constructor.prototype._enforceFocus = function () {
                    modal_this = this
                    $(document).on('focusin.modal', function (e) {
                        if (modal_this._element[0] !== e.target && modal_this._element.has && !modal_this._element.has(e.target).length
                        && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select')
                        && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_textarea')
                        && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
                            modal_this._element.focus()
                        }
                    })
                }
                
            });
        </script>
    </body>

</html>
