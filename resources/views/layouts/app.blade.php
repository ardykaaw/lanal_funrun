<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0
* @link https://tabler.io
* Copyright 2018-2025 The Tabler Authors
* Copyright 2018-2025 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin - DANLANAL Fun Run 2025</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/lanal/logo-event/Logg4.png') }}">
    <!-- CSS files -->
    <link href="{{ asset('dist/css/admin.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');
        
        body {
            background: linear-gradient(180deg, #e2f4ff 0%, #c8f0ff 50%, #e2f4ff 100%);
        }
        
        .page-wrapper {
            background: transparent;
        }
        
        /* Custom Color Palette untuk Tabler Admin - Biru Muda Dominan */
        :root {
            --tblr-primary: #0368c9;
            --tblr-primary-rgb: 3, 104, 201;
            --tblr-primary-darken: #0b4ea8;
            --tblr-primary-lighten: #6ecff6;
            --tblr-bg-light: #e2f4ff;
            --tblr-bg-card: #ffffff;
        }
        
        .card {
            background: var(--tblr-bg-card);
            border: 1px solid rgba(110, 207, 246, 0.3);
            box-shadow: 0 15px 35px rgba(0, 74, 136, 0.12);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0368c9, #0b4ea8);
            border-color: #0368c9;
            box-shadow: 0 8px 20px rgba(3, 104, 201, 0.25);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #0b4ea8, #0368c9);
            border-color: #0b4ea8;
            box-shadow: 0 12px 28px rgba(3, 104, 201, 0.35);
            transform: translateY(-2px);
        }
        
        .border-primary {
            border-color: var(--tblr-primary) !important;
        }
        
        .text-primary {
            color: var(--tblr-primary) !important;
        }
        
        .bg-primary {
            background: linear-gradient(135deg, #0368c9, #0b4ea8) !important;
        }
        
        .nav-link.aktif {
            background: linear-gradient(135deg, rgba(110, 207, 246, 0.2), rgba(3, 104, 201, 0.1));
            color: var(--tblr-primary) !important;
            border-left: 3px solid var(--tblr-primary);
        }
        
        .nav-link.aktif .icon {
            color: var(--tblr-primary);
        }
        
        .navbar-brand h1 {
            color: var(--tblr-primary);
            font-weight: 700;
        }
        
        .avatar.bg-cyan-lt {
            background: linear-gradient(135deg, rgba(110, 207, 246, 0.2), rgba(3, 104, 201, 0.15)) !important;
            color: var(--tblr-primary) !important;
        }
        
        .badge.bg-white.text-primary {
            color: var(--tblr-primary) !important;
            background: rgba(255, 255, 255, 0.9) !important;
        }
        
        .badge.bg-primary {
            background: linear-gradient(135deg, #0368c9, #0b4ea8) !important;
        }
        
        .link-secondary {
            color: var(--tblr-primary) !important;
        }
        
        .link-secondary:hover {
            color: var(--tblr-primary-darken) !important;
        }
        
        .sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #f2f8ff 100%);
            border-right: 1px solid rgba(110, 207, 246, 0.3);
        }
        
        .page-header {
            background: transparent;
        }
        
        .form-control:focus {
            border-color: var(--tblr-primary);
            box-shadow: 0 0 0 0.25rem rgba(var(--tblr-primary-rgb), 0.25);
        }
        
        .table thead th {
            background: linear-gradient(135deg, rgba(110, 207, 246, 0.15), rgba(3, 104, 201, 0.1));
            color: var(--tblr-primary);
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="page">
        @include('components.alert.error')
        @include('components.alert.success')
        <!-- Sidebar -->
        @include('components.sidebar')

        <div class="page-wrapper">
            @yield('content')
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    <a href="/" class="link-secondary" target="_blank">Website Event</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary">Dokumentasi</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; {{ date('Y') }}
                                    <a href="/" class="link-secondary">DANLANAL Fun Run 2025</a>.
                                    All rights reserved.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toast = document.getElementById("toast-simple");

            if (toast) {
                setTimeout(() => {
                    toast.classList.remove("show");
                    toast.classList.add("hide");
                }, 3000); // 5 detik
            }
        });
    </script>
</body>

</html>