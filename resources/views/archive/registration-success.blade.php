<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendaftaran Berhasil - DANLANAL Fun Run</title>
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
            <h1 style="margin-bottom: 1rem; color: var(--secondary); font-size: clamp(1.8rem, 4vw, 2.4rem);">Data Pendaftaran Terkirim!</h1>
            <p style="font-size: 1.1rem; margin-bottom: 0; color: var(--text-muted);">
              Terima kasih <strong style="color: var(--secondary);">{{ $registration->first_name }}</strong>, data pendaftaran Anda telah berhasil dikirim.
            </p>
          </div>

          <div style="background: rgba(110, 207, 246, 0.1); border: 1px solid rgba(110, 207, 246, 0.3); border-radius: calc(var(--radius) - 12px); padding: 2rem; margin-bottom: 2rem; text-align: left;">
            <h3 style="margin-bottom: 1.5rem; color: var(--secondary); font-size: 1.3rem; text-align: center;">Informasi Pendaftaran</h3>
            <div style="display: grid; gap: 1rem;">
              <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid rgba(110, 207, 246, 0.2);">
                <span style="color: var(--text-muted);">Nama:</span>
                <strong style="color: var(--secondary);">{{ $registration->full_name }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid rgba(110, 207, 246, 0.2);">
                <span style="color: var(--text-muted);">Email:</span>
                <strong style="color: var(--secondary);">{{ $registration->email }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid rgba(110, 207, 246, 0.2);">
                <span style="color: var(--text-muted);">Kategori:</span>
                <strong style="color: var(--secondary);">{{ $registration->category }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0;">
                <span style="color: var(--text-muted);">Status:</span>
                <span style="background: linear-gradient(135deg, #ffd43b, #ffa94d); color: #0a1f33; padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 600;">
                  Menunggu Konfirmasi
                </span>
              </div>
            </div>
          </div>

          <div style="background: linear-gradient(135deg, rgba(110, 207, 246, 0.15), rgba(3, 104, 201, 0.1)); border: 1px solid rgba(110, 207, 246, 0.3); border-radius: calc(var(--radius) - 12px); padding: 1.5rem; margin-bottom: 2rem;">
            <p style="margin: 0; color: var(--text-dark); font-size: 1rem; line-height: 1.7;">
              <strong style="color: var(--secondary);">📋 Langkah Selanjutnya:</strong><br>
              Data pendaftaran Anda sedang dalam proses peninjauan oleh admin. 
              Anda akan menerima notifikasi via email setelah pendaftaran dikonfirmasi.
            </p>
          </div>

          <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
            <a href="{{ route('registration.check') }}" class="btn btn-outline">Cek Status Pendaftaran</a>
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

