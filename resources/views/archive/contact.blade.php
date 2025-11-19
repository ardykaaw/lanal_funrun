<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL FUN RUN | Kontak</title>
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
          <h2>Hubungi Panitia</h2>
          <p>Kami siap membantu kebutuhan informasi DANLANAL Fun Run Anda.</p>
        </div>
        <div class="two-column">
          <form class="fade" data-delay="0.15">
            <label>
              Nama
              <input type="text" required />
            </label>
            <label>
              Email
              <input type="email" required />
            </label>
            <label>
              Pesan
              <textarea rows="4" required></textarea>
            </label>
            <button class="btn btn-primary" type="submit">Kirim Pesan</button>
          </form>

          <div class="contact-info fade" data-delay="0.25">
            <h3>Kontak Panitia</h3>
            <p>Hotline: +62 811-0022-557</p>
            <p>Email: panitia@danlanalfunrun.id</p>
            <div class="map-placeholder" style="margin-top:1.5rem;">
              Map Placeholder
            </div>
            <p style="margin-top:1rem;color:var(--text-muted);">Lokasi: Pangkalan Angkatan Laut XYZ, Kendari.</p>
          </div>
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
