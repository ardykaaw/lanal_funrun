<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendaftaran Berhasil - DANLANAL Fun Run</title>
    <meta name="description" content="Konfirmasi pendaftaran DANLANAL Fun Run 2025. Simpan informasi ini untuk pengambilan race pack.">
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
        </nav>
        <button class="mobile-toggle" aria-label="Menu">
          <span>☰</span>
        </button>
      </div>
    </header>

    <main class="section soft">
      <div class="container" style="max-width: 700px;">
        <div class="card fade" style="text-align: center; padding: 3rem 2rem;">
          <div style="margin-bottom: 2rem;">
            <div style="width: 100px; height: 100px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #6ecff6, #0368c9); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 56px; color: #ffffff; font-weight: 900; box-shadow: 0 15px 35px rgba(3, 104, 201, 0.3);">
              ✓
            </div>
            <h1 style="margin-bottom: 1rem; color: var(--secondary); font-size: clamp(1.8rem, 4vw, 2.4rem);">Terima kasih, pendaftaran berhasil!</h1>
            <p style="font-size: 1.1rem; margin-bottom: 0; color: var(--text-muted);">
              Detail pendaftaran Anda ditampilkan di bawah. Email konfirmasi akan dikirim setelah pendaftaran dikonfirmasi.
            </p>
          </div>

          <div id="summary" class="summary" style="background: rgba(110, 207, 246, 0.1); border: 1px solid rgba(110, 207, 246, 0.3); border-radius: calc(var(--radius) - 12px); padding: 2rem; margin-bottom: 2rem; text-align: left;"></div>

          <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a class="btn btn-primary" href="/">Kembali ke Beranda</a>
            <button class="btn btn-outline" id="downloadBtn">Unduh Bukti (PNG)</button>
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


