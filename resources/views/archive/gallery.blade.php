<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL KENDARI RUN 2025 | Galeri</title>
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
          <h2>Galeri DANLANAL KENDARI RUN 2025</h2>
          <p>Tangkapan momen terbaik dari pesisir, latihan, dan komunitas pelari.</p>
        </div>
        <div class="gallery-grid fade" data-delay="0.2">
          <img src="https://via.placeholder.com/500x400.png?text=Fun+Run+1" alt="Pelari 1" />
          <img src="https://via.placeholder.com/500x400.png?text=Fun+Run+2" alt="Pelari 2" />
          <img src="https://via.placeholder.com/500x400.png?text=Fun+Run+3" alt="Pelari 3" />
          <img src="https://via.placeholder.com/500x400.png?text=Fun+Run+4" alt="Pelari 4" />
          <img src="https://via.placeholder.com/500x400.png?text=Fun+Run+5" alt="Pelari 5" />
          <img src="https://via.placeholder.com/500x400.png?text=Fun+Run+6" alt="Pelari 6" />
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
