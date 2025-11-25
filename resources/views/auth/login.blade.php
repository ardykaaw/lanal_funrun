<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login - DANLANAL KENDARI RUN 2025</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/admin.css') }}" rel="stylesheet" />
    <style>
        @import url("https://rsms.me/inter/inter.css");
        
        body {
            background: linear-gradient(180deg, #e2f4ff 0%, #c8f0ff 50%, #e2f4ff 100%);
            min-height: 100vh;
        }
        
        /* Custom Color Palette untuk Tabler - Biru Muda Dominan */
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
            box-shadow: 0 20px 45px rgba(0, 74, 136, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0368c9, #0b4ea8);
            border-color: #0368c9;
            box-shadow: 0 10px 25px rgba(3, 104, 201, 0.3);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #0b4ea8, #0368c9);
            border-color: #0b4ea8;
            box-shadow: 0 15px 35px rgba(3, 104, 201, 0.4);
            transform: translateY(-2px);
        }
        
        .border-primary {
            border-color: var(--tblr-primary) !important;
        }
        
        .text-primary {
            color: var(--tblr-primary) !important;
        }
        
        .form-control:focus {
            border-color: var(--tblr-primary);
            box-shadow: 0 0 0 0.25rem rgba(var(--tblr-primary-rgb), 0.25);
        }
        
        a {
            color: var(--tblr-primary);
        }
        
        a:hover {
            color: var(--tblr-primary-darken);
        }
        
        .navbar-brand {
            background: linear-gradient(135deg, rgba(110, 207, 246, 0.2), rgba(3, 104, 201, 0.1));
            padding: 1rem;
            border-radius: 16px;
            border: 1px solid rgba(110, 207, 246, 0.3);
        }
        
        .navbar-brand img {
            max-height: 80px;
            width: auto;
            margin-bottom: 1rem;
            filter: drop-shadow(0 8px 16px rgba(3, 104, 201, 0.2));
        }
        
        .btn-primary:focus,
        .btn-primary:active {
            background: linear-gradient(135deg, #0b4ea8, #0368c9);
            border-color: #0b4ea8;
        }
        
        .btn-primary:focus-visible {
            box-shadow: 0 0 0 0.25rem rgba(var(--tblr-primary-rgb), 0.5);
        }
        
        .navbar-brand h1 {
            letter-spacing: 0.5px;
            color: #0368c9;
            font-weight: 700;
        }
        
        .border-top-wide {
            border-top: 4px solid var(--tblr-primary) !important;
        }
        
        /* Responsive untuk mobile */
        @media (max-width: 576px) {
            .navbar-brand img {
                max-height: 60px;
            }
            
            .navbar-brand h1 {
                font-size: 1rem !important;
            }
        }
    </style>
</head>

<body class="d-flex flex-column">
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
    <div class="row g-0 flex-fill">
        <div class="col-12 border-top-wide border-primary d-flex flex-column justify-content-center">
            <div class="container container-tight my-5 px5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-0 mt-3">
                            <div class="navbar-brand">
                                <div style="display: inline-block; margin-bottom: 16px;">
                                    <img src="{{ asset('assets/lanal/logo-event/Logg4.png') }}" 
                                     class="navbar-brand-image" 
                                     alt="DANLANAL KENDARI RUN 2025 Logo"
                                         style="max-height: 80px; width: auto; display: block;">
                                </div>
                                <h1 class="m-0 mt-2" style="font-size: 1.25rem; font-weight: 700;">
                                    DANLANAL KENDARI RUN 2025
                                </h1>
                            </div>
                        </div>
                        <div class="px-2">
                            <div class="card-body">
                                <h2 class="h3 text-center mb-4" style="color: var(--tblr-primary); font-weight: 700;">
                                    Masuk Ke Akun Admin
                                </h2>
                                <p class="text-center text-muted mb-4" style="font-size: 0.9rem;">
                                    Silakan masukkan kredensial Anda untuk mengakses panel administrasi
                                </p>
                                <form action="/login" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: 600; color: var(--tblr-primary);">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Masukan Email" required style="border-radius: 8px; border: 1px solid rgba(110, 207, 246, 0.3);">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('password')
                                            <small class="text-danger">Email atau Password salah</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" style="font-weight: 600; color: var(--tblr-primary);">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Masukan Password" required style="border-radius: 8px; border: 1px solid rgba(110, 207, 246, 0.3);">
                                    </div>
                                    <div class="form-footer mb-3">
                                        <button type="submit" class="btn btn-primary w-100" style="border-radius: 8px; padding: 0.75rem; font-weight: 600; font-size: 1rem;">
                                            Masuk
                                        </button>
                                    </div>
                                </form>
                                <div class="text-center mt-4">
                                    <a href="/" style="color: var(--tblr-primary); text-decoration: none; font-weight: 500;">
                                        ← Kembali Ke Beranda
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
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