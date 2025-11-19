<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL FUN RUN | Home</title>
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

    <main>
      <section class="hero">
        <span class="accent-ring" aria-hidden="true"></span>
        <span class="accent-ring secondary" aria-hidden="true"></span>
        <div class="container hero-grid">
          <div class="hero-content fade">
            <div class="text-logo">
              <img src="{{ asset('assets/lanal/logo-event/Logg4.png') }}" alt="DANLANAL Fun Run Logo" />
              <span>DANLANAL FUN RUN</span>
            </div>
            <p>21 Desember 2025 · Pangkalan TNI AL Kendari</p>
            <h1>Experience Maritime Energy · 5K</h1>
          <p>Event 5K oleh Komandan Pangkalan Angkatan Laut dengan vibe premium dan pengalaman lari tak terlupakan.</p>
          <div id="countdown" class="countdown"></div>
          <div class="cta-group">
            <a class="btn btn-primary" href="{{ route('archive.register') }}">Daftar Sekarang</a>
            <a class="btn btn-outline" href="#about">Tentang Event</a>
          </div>
        </div>
        <div class="hero-visual fade" aria-hidden="true">
          <img src="{{ asset('assets/lanal/logo-event/image.png') }}" alt="Poster DANLANAL Fun Run" />
        </div>
        </div>
      </section>

      <section id="about" class="section soft">
        <div class="container">
          <div class="section-header" style="text-align:left;">
            <h2>Tentang Event</h2>
            <p>DANLANAL Fun Run mengajak Anda menaklukkan rute 5 kilometer yang dirancang oleh prajurit terbaik dengan dukungan fasilitas premium.</p>
          </div>
          <div class="two-column">
            <div class="fade" data-delay="0.1">
              <ul>
                <li>• Start & finish di Pangkalan Angkatan Laut</li>
                <li>• Pelari dibatasi 1.000 peserta untuk pengalaman eksklusif</li>
                <li>• Hiburan musik & aktivasi komunitas laut</li>
              </ul>
            </div>
            <div class="card fade" data-delay="0.2">
              <h3>Harga Pendaftaran</h3>
              <p class="price-tag">Rp250.000</p>
              <p>Termasuk race pack premium, medali finisher, dan akses area VIP.</p>
              <a class="btn btn-primary" href="{{ route('archive.register') }}">Amankan Slot</a>
            </div>
          </div>
        </div>
      </section>

      <section class="section" id="category">
        <div class="container">
          <div class="section-header fade" data-delay="0.1">
            <h2>Kategori Lari 5K</h2>
            <p>Satu kategori, kualitas maksimal. Fokus untuk performa terbaik Anda.</p>
          </div>
          <div class="cards-grid">
            <article class="card fade" data-delay="0.15">
              <h3>Rute Strategis</h3>
              <p>Jelajahi area pangkalan dengan jalur aman, berpermukaan halus, dan panorama laut.</p>
            </article>
            <article class="card fade" data-delay="0.25">
              <h3>Benefit Finisher</h3>
              <p>Mendapat Jersey eksklusif, medali custom, e-certificate, serta hidrasi lengkap.</p>
            </article>
            <article class="card fade" data-delay="0.35">
              <h3>Support Crew</h3>
              <p>Pandu oleh tim TNI AL, marshal profesional, dan tim medis siaga di tiap 1 KM.</p>
            </article>
          </div>
        </div>
      </section>

      <section class="section soft" id="pricing">
        <div class="container two-column">
          <div class="card fade" data-delay="0.1">
            <h3>Paket Pendaftaran</h3>
            <p>Harga flat untuk semua peserta</p>
            <p class="price-tag">Rp250.000</p>
            <ul>
              <li>• Race pack eksklusif</li>
              <li>• Chip timing</li>
              <li>• Refreshment & hidrasi</li>
              <li>• Medali finisher</li>
            </ul>
            <a class="btn btn-primary" href="{{ route('archive.register') }}">Daftar Sekarang</a>
          </div>
          <div class="card fade" data-delay="0.2">
            <h3>Timeline</h3>
            <p>Pendaftaran dibuka hingga 10 Desember 2025</p>
            <ul>
              <li>• 05:30 - Registrasi ulang</li>
              <li>• 06:15 - Peregangan & briefing</li>
              <li>• 06:30 - Flag off</li>
              <li>• 08:00 - Awarding & hiburan</li>
            </ul>
          </div>
        </div>
      </section>

      <section class="promo-section" id="doorprize">
        <div class="container promo-layout">
          <div class="promo-text">
            <p class="text-logo">
              <img src="{{ asset('assets/lanal/logo-event/Logg4.png') }}" alt="Logo Event" />
              Door Prize Spektakuler
            </p>
            <h3>Hadiah untuk Semua Peserta</h3>
            <p>Rayakan finish Anda dengan deretan door prize spesial dari DANLANAL Kendari. Semua peserta berkesempatan membawa pulang hadiah utama.</p>
            <ul>
              <li>Paket umroh eksklusif</li>
              <li>Sepeda motor & sepeda listrik</li>
              <li>Peralatan rumah tangga premium</li>
            </ul>
            <p>#HariArmadaRI2025 #DanlanalKendari</p>
          </div>
          <div class="promo-visual">
            <img src="{{ asset('assets/lanal/005-Doorprize-Website-1440x1080.jpg') }}" alt="Doorprize DANLANAL Kendari" loading="lazy" />
          </div>
        </div>
      </section>

      <section class="promo-section" id="podium">
        <div class="container promo-layout">
          <div class="promo-visual">
            <img src="{{ asset('assets/lanal/005-Podium-Website-1440x1080.jpg') }}" alt="Podium Prize DANLANAL Kendari" loading="lazy" />
          </div>
          <div class="promo-text">
            <p class="text-logo">
              <img src="{{ asset('assets/lanal/logo-event/image.png') }}" alt="Runner Logo" />
              Podium Prize 5K
            </p>
            <h3>Hadiah Tunai untuk Juara Male & Female</h3>
            <p>Hadiah podium hingga Rp5.000.000 dengan trophy eksklusif berbentuk monumen armada. Berlomba cepat, tampil terbaik.</p>
            <ul>
              <li>Juara 1 Rp5.000.000 + Trophy</li>
              <li>Juara 2 Rp3.000.000</li>
              <li>Juara 3 Rp2.000.000</li>
              <li>Juara 4 Rp1.000.000 · Juara 5 Rp500.000</li>
            </ul>
          </div>
        </div>
      </section>

      <section class="promo-section" id="total-prize">
        <div class="container promo-layout">
          <div class="promo-text">
            <p class="text-logo">
              <img src="{{ asset('assets/lanal/logo-event/Logg4.png') }}" alt="Logo Event" />
              Total Prize Pool
            </p>
            <h3>Rp150.000.000</h3>
            <p>Kombinasi hadiah podium dan door prize mencapai Rp150 juta. Ini saatnya menunjukkan energi maritim terbaik Anda di garis start.</p>
            <p>Ayo amankan slot dan jadilah bagian dari perayaan besar Hari Armada RI 2025.</p>
          </div>
          <div class="promo-visual">
            <img src="{{ asset('assets/lanal/005-Total-hadiah-Website-1920x1080.jpg') }}" alt="Total Prize DANLANAL" loading="lazy" />
          </div>
        </div>
      </section>

    </main>

    <footer>
      <div class="container">
        <p>© {{ date('Y') }} DANLANAL Fun Run. Semua hak cipta.</p>
      </div>
    </footer>
    <script src="{{ asset('assets/landing/script.js') }}" defer></script>
  </body>
</html>
