<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL KENDARI RUN 2025 | Kategori 5K</title>
    <link rel="icon" href="{{ asset('assets/lanal/logo-event/Logg4.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('assets/landing/style.css') }}?v=2.0" />
  </head>
  <body>
    <header>
      <div class="container nav">
        <a class="logo" href="/">
          <img src="{{ asset('assets/lanal/logo-event/Logg4.png') }}" alt="Logo DANLANAL KENDARI RUN 2025" />
          <span class="text-label">DANLANAL KENDARI RUN 2025</span>
        </a>
        <nav class="nav-links">
          <a href="/">Beranda</a>
          <a href="{{ route('archive.event-info') }}">Informasi Lomba</a>
          <a href="{{ route('archive.contact') }}">Kontak</a>
          <a class="btn btn-primary" href="{{ route('archive.register') }}">Daftar</a>
        </nav>
        <button class="mobile-toggle" aria-label="Menu">
          <span>☰</span>
        </button>
      </div>
    </header>


    <main class="section soft">
      <div class="container">
        <div class="section-header fade" data-delay="0.1">
          <h2>Informasi Lomba</h2>
          <p>Detail kategori kini bergabung dengan halaman Informasi Lomba untuk memudahkan Anda menemukan semua data penting.</p>
        </div>
        <div class="card fade" data-delay="0.2" style="text-align:center;">
          <p>Silakan lanjut ke halaman Informasi Lomba untuk melihat rute 5K, benefit finisher, dan ketentuan terbaru.</p>
          <a class="btn btn-primary" href="{{ route('archive.event-info') }}">Buka Informasi Lomba</a>
        </div>
      </div>
    </main>

    <footer>
      <div class="container">
        <p>© {{ date('Y') }} DANLANAL KENDARI RUN 2025.</p>
      </div>
    </footer>
    <script src="{{ asset('assets/landing/script.js') }}" defer></script>
  </body>
</html>
