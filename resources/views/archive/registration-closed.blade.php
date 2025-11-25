<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Ditutup - DANLANAL KENDARI RUN 2025</title>
    <meta name="description" content="Pendaftaran untuk DANLANAL KENDARI RUN 2025 saat ini sudah ditutup.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ url('/assets/lanal/logo-event/Logg4.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/landing/style.css') }}?v=2.0">
    <style>
      /* Remove background and border effects from logo-wrapper */
      .logo-wrapper[style*="background: transparent"]::before {
        display: none !important;
      }
    </style>
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
      <div class="container" style="max-width: 700px;">
        <div class="card fade" style="text-align: center; padding: 3rem 2rem;">
          <div style="margin-bottom: 2rem;">
            <div style="width: 100px; height: 100px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #ffd43b, #ffa94d); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 56px; color: #0a1f33; font-weight: 900; box-shadow: 0 15px 35px rgba(255, 168, 77, 0.3);">
              ⚠
            </div>
            <h1 style="margin-bottom: 1rem; color: var(--secondary); font-size: clamp(1.8rem, 4vw, 2.4rem);">Pendaftaran Ditutup</h1>
            <p style="font-size: 1.1rem; margin-bottom: 0; color: var(--text-muted);">
              Maaf, pendaftaran untuk <strong style="color: var(--secondary);">DANLANAL KENDARI RUN 2025</strong> saat ini sudah ditutup.
            </p>
          </div>

          <div style="background: rgba(110, 207, 246, 0.1); border: 1px solid rgba(110, 207, 246, 0.3); border-radius: calc(var(--radius) - 12px); padding: 2rem; margin-bottom: 2rem;">
            <p style="margin: 0; color: var(--text-dark); line-height: 1.8;">
              <strong style="color: var(--secondary);">Event Details:</strong><br>
              📅 <strong>Tanggal:</strong> 21 Desember 2025<br>
              🏃 <strong>Kategori:</strong> Umum<br>
              📍 <strong>Lokasi:</strong> Pangkalan TNI AL Kendari
            </p>
          </div>

          <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-bottom: 2rem;">
            <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
            <a href="{{ route('registration.check') }}" class="btn btn-outline">Cek Status Pendaftaran</a>
          </div>

          <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(110, 207, 246, 0.2);">
            <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
              Jika Anda sudah mendaftar sebelumnya, Anda dapat mengecek status pendaftaran Anda.<br>
              Untuk informasi lebih lanjut, silakan hubungi panitia.
            </p>
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

