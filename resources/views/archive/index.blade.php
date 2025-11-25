<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL KENDARI RUN 2025 | Home</title>
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

    <main>
      <section class="hero">
        <span class="accent-ring" aria-hidden="true"></span>
        <span class="accent-ring secondary" aria-hidden="true"></span>
        <div class="container hero-grid">
          <div class="hero-content fade">
            <h1 class="sr-only">DANLANAL KENDARI RUN 2025</h1>
            <div class="hero-logo-only">
              <img src="{{ asset('assets/lanal/logo-event/Logg4.png') }}" alt="Logo DANLANAL KENDARI RUN 2025" />
            </div>
            <div class="countdown-card">
              <div class="countdown-label">
                <span>Hitung Mundur</span>
                <span>Menuju Flag Off</span>
              </div>
              <div id="countdown" class="countdown-grid"></div>
            </div>
            <div class="hero-info-pills">
              <div class="hero-info-pill">
                <span class="hero-info-icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-6-5.33-6-10a6 6 0 0 1 12 0c0 4.67-6 10-6 10z"></path><circle cx="12" cy="11" r="2.5"></circle></svg>
                </span>
                <span>MAKO LANAL Kendari</span>
              </div>
              <div class="hero-info-pill">
                <span class="hero-info-icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"></rect><path d="M16 2v4"></path><path d="M8 2v4"></path><path d="M3 10h18"></path></svg>
                </span>
                <span>21 Desember 2025</span>
              </div>
            </div>
            <div class="hero-prize-card">
              <span>Total Prize Pool</span>
              <strong>Rp150.000.000</strong>
              <p>Hadiah podium & door prize premium untuk seluruh peserta.</p>
            </div>
            <div class="cta-group">
              <a class="btn btn-primary" href="{{ route('archive.register') }}">Daftar Sekarang</a>
            </div>
          </div>
          <div class="hero-visual fade" aria-hidden="true">
            <img src="{{ asset('assets/lanal/logo-event/image.png') }}" alt="Total Prize Pool DANLANAL KENDARI RUN 2025" />
          </div>
        </div>
      </section>

      <section class="promo-section" id="doorprize">
        <div class="container promo-layout">
          <div class="promo-text">
            <p class="text-logo">
              <img src="{{ asset('assets/lanal/logo-event/Logg4.png') }}" alt="Logo DANLANAL KENDARI RUN 2025" />
              Door Prize Spektakuler
            </p>
            <h3>Hadiah untuk Semua Peserta</h3>
            <p>Rayakan finish Anda dengan deretan door prize spesial dari DANLANAL KENDARI RUN 2025. Semua peserta berkesempatan membawa pulang hadiah utama.</p>
            <ul>
              <li>Paket umroh eksklusif</li>
              <li>Sepeda motor & sepeda listrik</li>
              <li>Peralatan rumah tangga premium</li>
            </ul>
            <p>#HariArmadaRI2025 #DanlanalKendari</p>
          </div>
          <div class="promo-visual">
            <img src="{{ asset('assets/lanal/005-Doorprize-Website-1440x1080.jpg') }}" alt="Doorprize DANLANAL KENDARI RUN 2025" loading="lazy" />
          </div>
        </div>
      </section>

      <section class="promo-section" id="podium">
        <div class="container promo-layout">
          
          <div class="promo-text">
            <p class="text-logo">
              <img src="{{ asset('assets/lanal/logo-event/image.png') }}" alt="Runner Logo" />
              Podium Prize 5K
            </p>
            <h3>Hadiah Tunai untuk Juara Male & Female</h3>
            <p>Hadiah podium Rp5.000.000 dengan trophy eksklusif. Berlomba cepat, tampil terbaik.</p>
            <ul>
              <li>Juara 1 Rp5.000.000 + Trophy</li>
              <li>Juara 2 Rp3.000.000</li>
              <li>Juara 3 Rp2.000.000</li>
              <li>Juara 4 Rp1.000.000</li>
              <li>Juara 5 Rp500.000</li>
            </ul>
          </div>
          <div class="promo-visual">
            <img src="{{ asset('assets/lanal/005-Podium-Website-1440x1080.jpg') }}" alt="Podium Prize DANLANAL Kendari" loading="lazy" />
          </div>
        </div>
      </section>

    </main>

    <footer>
      <div class="container">
        <p>© {{ date('Y') }} DANLANAL KENDARI RUN 2025. Semua hak cipta.</p>
      </div>
    </footer>
    <script src="{{ asset('assets/landing/script.js') }}" defer></script>
  </body>
</html>
