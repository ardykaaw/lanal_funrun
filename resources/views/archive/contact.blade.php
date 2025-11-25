<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL KENDARI RUN 2025 | Hubungi Kami</title>
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
          <h2>Hubungi Kami</h2>
          <p>Admin resmi DANLANAL KENDARI RUN 2025 siap membantu seluruh kebutuhan informasi Anda.</p>
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
            <h3>Kontak Admin</h3>
            <p>Admin 1 (WhatsApp): <a href="https://wa.me/628110022557" target="_blank" rel="noreferrer noopener">+62 811-0022-557</a></p>
            <p>Admin 2 (WhatsApp): <a href="https://wa.me/6285851295471" target="_blank" rel="noreferrer noopener">+62 858-5129-5471</a></p>
            <p>Email: panitia@danlanalfunrun.id</p>
            <div class="map-placeholder" style="margin-top:1.5rem;">
              Map Placeholder
            </div>
            <p style="margin-top:1rem;color:var(--text-muted);">Lokasi: MAKO LANAL Kendari.</p>
          </div>
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
