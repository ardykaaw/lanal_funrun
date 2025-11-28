<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL KENDARI RUN 2025 | Informasi Event</title>
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
          <h2>Informasi Event</h2>
          <p>Rangkuman resmi seputar lintasan, fasilitas, dan ketentuan DANLANAL KENDARI RUN 2025.</p>
        </div>

        <section class="section" style="padding-top:0;">
          <div class="two-column">
            <div class="card fade" data-delay="0.15">
              <h3>Tentang Event</h3>
              <p>DANLANAL KENDARI RUN 2025 mengajak Anda menaklukkan rute 5 kilometer yang dirancang oleh prajurit terbaik dengan dukungan fasilitas premium.</p>
              <ul>
                <li>• Start & finish di Pangkalan Angkatan Laut</li>
                <li>• Pelari dibatasi 1.000 peserta untuk pengalaman eksklusif</li>
                <li>• Hiburan musik dan deretan hadiah menarik</li>
              </ul>
            </div>
            
          </div>
        </section>

        <section class="section" id="race-details">
          <div class="section-header" style="text-align:left;">
            <h2 style="margin-bottom:0.1rem;">Kategori Lari</h2>
            <ul style="margin-bottom:0.1rem; margin-top:0;">
              <li><strong>5K - UMUM</strong>
            </ul>
            <p>Satu kategori, kualitas maksimal. Fokus untuk performa terbaik Anda.</p>
          </div>
          <div class="cards-grid">
            <article class="card fade" data-delay="0.1">
              <h3>Rute MAKO LANAL</h3>
              <p>Jelajahi MAKO LANAL Kendari dengan jalur aman, permukaan mulus, dan view armada laut yang jarang dibuka untuk publik.</p>
            </article>
            <article class="card fade" data-delay="0.2">
              <h3>Benefit </h3>
              <ul>
                <li>• BIB</li>
                <li>• Jersey</li>
                <li>• Medali Finisher</li>
                <li>• Goodie Bag</li>
                <li>• Refreshment</li>
              </ul>
            </article>
          </div>
        </section>

        <section class="section" style="padding-top:2rem;">
          <div class="two-column">
            <div class="card fade" data-delay="0.1">
              <h3>Peraturan Utama</h3>
              <ul>
                <li>Coming Soon.</li>
                {{-- <li>Dilarang membawa kendaraan pendamping.</li>
                <li>Cut-off 45 menit setelah flag off.</li>
                <li>Ikuti arahan marshal dan petugas keamanan.</li>
                <li>Bawalah identitas diri saat registrasi ulang.</li> --}}
              </ul>
            </div>
            <div class="card fade" data-delay="0.2">
              <h3>Lokasi</h3>
              <p>MAKO LANAL Kendari · Jalan Samudra Raya No. 21.</p>
              <p>Area strategis dengan akses langsung menuju dermaga operasional dan zona upacara Hari Armada RI.</p>
            </div>
          </div>
        </section>

        <section class="section" id="coming-soon-info" style="padding-top:2rem;">
          <div class="coming-soon-grid">
            <article class="card">
              <h3>Info Rute 5K</h3>
              <p>Detail rute resmi akan segera hadir lengkap dengan titik water station, zona cheering, serta elevasi setiap segmen.</p>
            </article>
            <article class="card">
              <h3>Medali Finisher</h3>
              <p>Medali custom dengan aksen maritim eksklusif sebagai simbol kebanggaan seluruh finisher DANLANAL KENDARI RUN.</p>
            </article>
            <article class="card">
              <h3>Jersey Performance</h3>
              <p>Jersey breathable bernuansa Armada RI akan dipublikasikan bersamaan dengan preview resmi beberapa waktu lagi.</p>
            </article>
          </div>
        </section>

        <section class="section" id="faq" style="padding-top:2rem;">
          <div class="section-header">
            <h2>FAQ</h2>
            <p>Pertanyaan umum seputar pelaksanaan DANLANAL KENDARI RUN 2025.</p>
          </div>
          <div class="fade" data-delay="0.1">
            <div class="faq-item">
              <div class="faq-question">
                <span>Apakah ada kategori selain 5K?</span>
                <span>+</span>
              </div>
              <div class="faq-answer">
                <p>Tahun ini kami fokus pada kategori 5K untuk pengalaman terbaik dan pengawalan maksimal.</p>
              </div>
            </div>
            <div class="faq-item">
              <div class="faq-question">
                <span>Bagaimana pengambilan race pack?</span>
                <span>+</span>
              </div>
              <div class="faq-answer">
                <p>Race pack dapat diambil pada <strong>20 Desember 2025 (H-1)</strong> di <strong>Aula Lanal Kendari</strong> antara pukul <strong>10.00 - 17.00 WITA</strong> dengan membawa bukti pembayaran atau QR Code yang telah dikirim melalui email.</p>
              </div>
            </div>
            <div class="faq-item">
              <div class="faq-question">
                <span>Apakah boleh membawa keluarga?</span>
                <span>+</span>
              </div>
              <div class="faq-answer">
                <p>Boleh, dengan tidak mengganggu jalannya acara berlangsung, dan anak anak wajib dalam pengawasan orang tua.</p>
              </div>
            </div>
          </div>
        </section>
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
