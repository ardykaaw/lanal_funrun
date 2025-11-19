<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL FUN RUN | Kategori 5K</title>
    <link rel="icon" href="{{ asset('assets/lanal/logo-event/Logg4.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('assets/landing/style.css') }}" />
  </head>
  <body>
    <header>
      <div class="container nav">
        <a class="logo" href="/">
          <img src="{{ asset('assets/lanal/logo-event/Logg4.png') }}" alt="Logo DANLANAL Fun Run" />
          <span class="text-label">DANLANAL Fun Run</span>
        </a>
        <nav class="nav-links">
          <a href="/">Beranda</a>
          <a href="{{ route('archive.category') }}">Kategori</a>
          <a href="{{ route('archive.event-info') }}">Info Event</a>
          <a href="{{ route('archive.gallery') }}">Galeri</a>
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
          <h2>Kategori Lari 5 Kilometer</h2>
          <p>Kategori tunggal yang mengutamakan pengalaman lari premium dengan dukungan penuh dari prajurit TNI AL.</p>
        </div>
        <div class="cards-grid">
          <article class="card fade" data-delay="0.15">
            <h3>Detail Rute</h3>
            <p>Rute start dari Gerbang Utama Lanal, melewati dermaga operasional dan berputar di area latihan marinir. Permukaan mulus dengan elevasi ringan.</p>
          </article>
          <article class="card fade" data-delay="0.25">
            <h3>Benefit Finisher</h3>
            <ul>
              <li>• Jersey breathable eksklusif DANLANAL</li>
              <li>• Medali logam brushed finish</li>
              <li>• Goodie bag sponsor</li>
              <li>• Akses zone pendinginan</li>
            </ul>
          </article>
          <article class="card fade" data-delay="0.35">
            <h3>Safety & Support</h3>
            <p>Marshal militer di tiap persimpangan, hydration point tiap 1,5 km, dan tim medis lengkap.</p>
          </article>
        </div>
        <div style="text-align:center;margin-top:3rem;">
          <a class="btn btn-primary" href="{{ route('archive.register') }}">Menuju Pendaftaran</a>
        </div>
      </div>
    </main>

    <footer>
      <div class="container">
        <p>© {{ date('Y') }} DANLANAL Fun Run.</p>
      </div>
    </footer>
    <script src="{{ asset('assets/landing/script.js') }}" defer></script>
  </body>
</html>
