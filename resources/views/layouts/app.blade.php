<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/logo-mataram.png') }}" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('css')
    <style>
        .nav-link-custom {
            color: #1a56db;
            font-weight: 500;
        }

        body {
            /*background-color: #1a56db;*/
            background-color: #f1f5f9;
        }

        .nav-link-custom.active {
            color: #1a56db;
            font-weight: 700;
        }

        .card {
            border-radius: 0.3em;
        }

        .text-gradient {
            background: -webkit-linear-gradient(#32b8e7, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dropdown-menu {
            border-top: 2px solid #1a56db;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/chat.css') }}" />
</head>

<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white" style="box-shadow: 0 .125rem .5rem rgba(0,0,0,.2)!important;">
        <div class="container">
            <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                <img src="{{ asset('assets/logo-mataram.png') }}" class="me-2" style="max-height: 3em" alt="Logo Mataram">
                <div class="">
                    <span class="text-uppercase h5 fw-bold">Inspektorat</span><br>
                        <span class="text-dark fw-bold h5">Kota Mataram</span>
                </div>
            </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
                        @if (Auth::user()->role == 'root')
                            @php
                                $count_request_coaching = \App\Models\Event::where('status', \App\Models\Event::CHOICE_STATUS[0])->count();
                            @endphp
                            @php
                                $count_mcp_doc = \App\Models\McpTindakLanjut::where('is_approve', 0)->count();
                            @endphp
                            <!-- SIDEBAR UNTUK USER ADMIN ROOT -->
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown"
                                        class="nav-link dropdown-toggle text-capitalize {{ request()->is('admin/pemantauan-tindak-lanjut*') ? 'active' : '' }}"
                                        href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        pemantauan tindak lanjut
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                        style="">
                                        <a class="dropdown-item text-capitalize {{ request()->is('admin/pemantauan-tindak-lanjut') ? 'active' : '' }}"
                                            href="{{ route('admin.pemantauan-tindak-lanjut.index') }}">
                                            daftar pengajuan
                                        </a>
                                        <a class="dropdown-item text-capitalize {{ request()->is('admin/pemantauan-tindak-lanjut/pengajuan_tl*') ? 'active' : '' }}"
                                            href="{{ route('pengajuan_tl') }}">
                                            belum diproses
                                        </a>
                                        <a class="dropdown-item text-capitalize {{ request()->is('admin/pemantauan-tindak-lanjut/setting-pegawai*') ? 'active' : '' }}"
                                            href="{{ route('setting-pegawai.index') }}">
                                            setting pegawai
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown"
                                        class="nav-link dropdown-toggle text-capitalize {{ request()->is('admin/mcp-kpk*') ? 'active' : '' }}"
                                        href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        MCP-KPK
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                        style="">
                                        <a class="dropdown-item text-capitalize {{ request()->is('admin/mcp-kpk') ? 'active' : '' }}"
                                            href="{{ route('admin.mcp-kpk.index') }}">
                                            master data
                                        </a>
                                        <a class="dropdown-item text-capitalize {{ request()->is('admin/mcp-kpk/tindak-lanjut*') ? 'active' : '' }}"
                                            href="{{ route('admin.mcp-kpk.tindak-lanjut.index') }}">
                                            tindak lanjut
                                            <span class="badge bg-danger">{{ $count_mcp_doc }}</span>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown"
                                        class="nav-link dropdown-toggle text-capitalize {{ request()->is('admin/imtak-pengawasan*') ? 'active' : '' }}"
                                        href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        imtak pengawasan
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                        style="">
                                        <a class="dropdown-item text-capitalize {{ request()->is('admin/imtak-pengawasan') ? 'active' : '' }}"
                                            href="{{ route('admin.imtak-pengawasan.index') }}">
                                            seluruh pengajuan
                                        </a>
                                        <a class="dropdown-item text-capitalize {{ request()->is('admin/imtak-pengawasan/request') ? 'active' : '' }}"
                                            href="{{ route('admin.imtak-pengawasan.request') }}">
                                            belum diproses
                                            <span class="badge bg-danger">{{ $count_request_coaching }}</span>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown"
                                        class="nav-link dropdown-toggle text-capitalize {{ request()->is('admin/imtak-pengawasan*') ? 'active' : '' }}"
                                        href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        help desk
                                    </a>
            
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                        style="">
                                        <a href="https://drive.google.com/file/d/16HJILSUChumWEcYMrp-Q4h4dW2ezxbXZ/view"
                                            target="_blank" class="btn text-center">
                                            Buku Panduan
                                        </a>                                      
                                    </div>
                                </li>   
                            </ul>
                        @endif

                        @if (Auth::user()->role != 'root')
                            <!-- SIDEBAR UNTUK USER PEGAWAI -->
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown"
                                        class="nav-link dropdown-toggle text-capitalize {{ request()->is('pegawai/pemantauan-tindak-lanjut*') ? 'active' : '' }}"
                                        href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        pemantauan tindak lanjut
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                        style="">
                                        <a class="dropdown-item text-capitalize {{ request()->is('pegawai/pemantauan-tindak-lanjut') ? 'active' : '' }}"
                                            href="{{ route('pemantauan-tindak-lanjut.index') }}">
                                            daftar pemantauan
                                        </a>
                                        <a class="dropdown-item text-capitalize {{ request()->is('pegawai/pemantauan-tindak-lanjut/tindak-lanjut*') ? 'active' : '' }}"
                                            href="{{ route('tindak_lanjut') }}">
                                            tindak lanjut
                                        </a>
                                    </div>
                                </li>


                                <li class="nav-item">
                                    <a class="text-capitalize nav-link nav-link-custom {{ request()->is('pegawai/imtak-pengawasan*') ? 'active' : '' }}"
                                        href="{{ route('pegawai.imtak-pengawasan.index') }}">
                                        Imtaq pengawasan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="text-capitalize nav-link nav-link-custom {{ request()->is('pegawai/mcp-kpk*') ? 'active' : '' }}"
                                        href="{{ route('pegawai.mcp-kpk.index') }}">
                                        MCP-KPK
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown"
                                        class="nav-link dropdown-toggle text-capitalize {{ request()->is('admin/imtak-pengawasan*') ? 'active' : '' }}"
                                        href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        help desk
                                    </a>
            
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                        style="">
                                        <a href="https://drive.google.com/file/d/16HJILSUChumWEcYMrp-Q4h4dW2ezxbXZ/view"
                                            target="_blank" class="btn text-center">
                                            Buku Panduan
                                        </a>                                      
                                    </div>
                                </li>
                            </ul>
                        @endif
                    @endauth
                    

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom {{ request()->is('login') ? 'active' : '' }}"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="p-4" style="background-color: #e2e8f0; margin-top: 5em">
            <div class="row mb-5 mt-4">
                <div class="col-md-4">
                    <a href="http://inspektorat.mataramkota.go.id/"
                        class="d-flex align-items-center text-decoration-none">
                        <img src="{{ asset('assets/Inspektorat.png') }}" class="me-3" style="max-height: 6em"
                            alt="Logo Mataram">
                        <div class="">
                            <span class="text-uppercase h4 fw-bold">Inspektorat</span><br>
                            <span class="text-dark fw-bold h4">Kota Mataram</span>
                        </div>
                    </a>
                </div>                
                <div class="col-md-4">
                    <h2 class="h5 mb-4 text-sm">Kontak</h2>
                    <ul class="list-group list-unstyled">
                        <li class="mb-2">
                            <a href="https://www.google.com/maps/place/Inspektorat+Kota+Mataram/@-8.620157,116.079956,16z/data=!4m5!3m4!1s0x0:0x4dfe54c44662a8ee!8m2!3d-8.6200886!4d116.0799541?hl=en"
                                class="text-decoration-none text-secondary" target="blank">
                                <div class="d-flex align-items-center">
                                    <svg style="max-width: 15px" class="me-2" viewBox="0 0 384 512"
                                        fill="currentColor">
                                        <path
                                            d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z">
                                        </path>
                                    </svg>
                                    <p class="mb-0">Jl. Dr. Sudjono Lingkar Selatan - Mataram, <br> Provinsi Nusa
                                        Tenggara Barat</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="tel:0370645092" class="text-decoration-none text-secondary" target="blank">
                                <div class="d-flex align-items-center">
                                    <svg style="max-width: 15px" class="me-2" viewBox="0 0 512 512"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z">
                                        </path>
                                    </svg>
                                    <p class="mb-0">(0370) 645092</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://wa.me/081913110303" class="text-decoration-none text-secondary"
                                target="blank">
                                <div class="d-flex align-items-center">
                                    <svg style="max-width: 15px" class="me-2" viewBox="0 0 448 512"
                                        fill="currentColor">
                                        <path
                                            d="M224 122.8c-72.7 0-131.8 59.1-131.9 131.8 0 24.9 7 49.2 20.2 70.1l3.1 5-13.3 48.6 49.9-13.1 4.8 2.9c20.2 12 43.4 18.4 67.1 18.4h.1c72.6 0 133.3-59.1 133.3-131.8 0-35.2-15.2-68.3-40.1-93.2-25-25-58-38.7-93.2-38.7zm77.5 188.4c-3.3 9.3-19.1 17.7-26.7 18.8-12.6 1.9-22.4.9-47.5-9.9-39.7-17.2-65.7-57.2-67.7-59.8-2-2.6-16.2-21.5-16.2-41s10.2-29.1 13.9-33.1c3.6-4 7.9-5 10.6-5 2.6 0 5.3 0 7.6.1 2.4.1 5.7-.9 8.9 6.8 3.3 7.9 11.2 27.4 12.2 29.4s1.7 4.3.3 6.9c-7.6 15.2-15.7 14.6-11.6 21.6 15.3 26.3 30.6 35.4 53.9 47.1 4 2 6.3 1.7 8.6-1 2.3-2.6 9.9-11.6 12.5-15.5 2.6-4 5.3-3.3 8.9-2 3.6 1.3 23.1 10.9 27.1 12.9s6.6 3 7.6 4.6c.9 1.9.9 9.9-2.4 19.1zM400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM223.9 413.2c-26.6 0-52.7-6.7-75.8-19.3L64 416l22.5-82.2c-13.9-24-21.2-51.3-21.2-79.3C65.4 167.1 136.5 96 223.9 96c42.4 0 82.2 16.5 112.2 46.5 29.9 30 47.9 69.8 47.9 112.2 0 87.4-72.7 158.5-160.1 158.5z">
                                        </path>
                                    </svg>
                                    <p class="mb-0">+62 819-1311-0303</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="mailto:inspektorat@mataramkota.go.id" class="text-decoration-none text-secondary"
                                target="blank">
                                <div class="d-flex align-items-center">
                                    <svg style="max-width: 15px" class="me-2" viewBox="0 0 512 512"
                                        fill="currentColor">
                                        <path
                                            d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z">
                                        </path>
                                    </svg>
                                    <p class="mb-0">inspektorat@mataramkota.go.id</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="text-gray-600 dark:text-gray-400">
                        <h2 class="h5 mb-4 text-sm">Survei Layanan</h2>
                        <p>Survei kepuasan dalam pengawasan dan pembinaan APIP lingkup Kota Mataram</p>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSf8TasrjVONUfXmp7uGxJlZ5EWsKVZE938TqiMIXnBSIAz8Lw/viewform"
                            target="_blank" class="btn btn-primary mr-2 mb-2 px-5 text-center">
                            Isi Survei
                        </a>
                    </div>
                </div>
            </div>
            <hr class="border-gray-200">
            <div class="d-flex justify-content-between">
                <small class="text-secondary">© 2022 <a href="/"
                        class="text-secondary text-decoration-none">Inspektorat Kota Mataram</a>. All Rights
                    Reserved.</small>
                <div class="d-flex">
                    <a href="/" class="text-secondary">
                        <svg style="max-height: 2em; max-width: 2em" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/inspektorat_kota/" aria-label="true" class="text-secondary">
                        <svg style="max-height: 2em; max-width: 2em" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </footer>
    </div>
    <div class="chart" id="basic-example"></div>

    <!--Start of Tawk.to Script-->
    {{-- <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement('script'),
                s0 = document.getElementsByTagName('script')[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/636b364ddaff0e1306d6780e/1ghdco7tm';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script> --}}
    <!--End of Tawk.to Script-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <div class="floating-container">
        <div class="floating-button">ONLINE! Silahkan Chat Disini</div>
        <div class="element-container">
            <a href="https://api.whatsapp.com/send?phone=+6281337774795&text=Selamat Pagi" target="blank"> <span class="float-element">
            <svg fill="white" xmlns="http://www.w3.org/2000/svg"  width="25" height="25" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                    </svg> IRBAN I 
                </span></a>
            <a href="https://api.whatsapp.com/send?phone=+6281917981313&text=Selamat Pagi" target="blank"> <span class="float-element">
            <svg fill="white" xmlns="http://www.w3.org/2000/svg"  width="25" height="25" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                    </svg> IRBAN II
                </span></a>
            <a href="https://api.whatsapp.com/send?phone=+6281237314377&text=Selamat Pagi" target="blank"> <span class="float-element">
            <svg fill="white" xmlns="http://www.w3.org/2000/svg"  width="25" height="25" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                    </svg> IRBAN III
                </span></a>
            <a href="https://api.whatsapp.com/send?phone=+6282339965186&text=Selamat Pagi" target="blank"> <span class="float-element">
            <svg fill="white" xmlns="http://www.w3.org/2000/svg"  width="25" height="25" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                    </svg> IRBAN IV
                </span></a>
            <a href="https://api.whatsapp.com/send?phone=+6285253725455&text=Selamat Pagi" target="blank"> <span class="float-element">
            <svg fill="white" xmlns="http://www.w3.org/2000/svg"  width="25" height="25" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                    </svg> Sekretariat
                </span></a>
        </div>
    </div>
    @yield('js')
</body>

</html>
