<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendaftaran Berhasil - DANLANAL KENDARI RUN 2025</title>
    <link rel="icon" href="{{ asset('assets/lanal/logo-event/Logg4.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('assets/landing/style.css') }}?v=2.0" />
    <style>
      .success-wrapper {
        max-width: 760px;
        margin: 0 auto;
      }
      .success-card {
        text-align: center;
        padding: 3rem 2.5rem;
      }
      .success-icon {
        width: 110px;
        height: 110px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #6ecff6, #0368c9);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        color: #ffffff;
        font-weight: 900;
        box-shadow: 0 18px 40px rgba(3, 104, 201, 0.35);
      }
      .info-box {
        background: rgba(110, 207, 246, 0.08);
        border: 1px solid rgba(110, 207, 246, 0.3);
        border-radius: calc(var(--radius) - 12px);
        padding: 2rem;
        margin-bottom: 2rem;
        text-align: left;
      }
      .info-grid {
        display: grid;
        gap: 1rem;
      }
      .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding-bottom: 0.85rem;
        border-bottom: 1px solid rgba(110, 207, 246, 0.2);
        word-break: break-word;
      }
      .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
      }
      .info-row span:first-child {
        color: var(--text-muted);
        font-weight: 500;
      }
      .status-pill {
        background: linear-gradient(135deg, #ffd43b, #ffa94d);
        color: #0a1f33;
        padding: 0.5rem 1.1rem;
        border-radius: 999px;
        font-size: 0.95rem;
        font-weight: 600;
        white-space: nowrap;
      }
      .next-step-box {
        background: linear-gradient(135deg, rgba(110, 207, 246, 0.15), rgba(3, 104, 201, 0.08));
        border: 1px solid rgba(110, 207, 246, 0.3);
        border-radius: calc(var(--radius) - 12px);
        padding: 1.75rem;
        margin-bottom: 2rem;
        text-align: left;
        line-height: 1.7;
      }
      .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
      }
      @media (max-width: 640px) {
        .success-card {
          padding: 2.5rem 1.25rem;
        }
        .info-box,
        .next-step-box {
          padding: 1.5rem;
        }
        .info-row {
          flex-direction: column;
          align-items: flex-start;
          word-break: break-word;
        }
        .status-pill {
          margin-top: 0.5rem;
        }
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
      <div class="container success-wrapper">
        <div class="card fade success-card">
          <div class="success-icon">✓</div>
          <h1 style="margin-bottom: 1rem; color: var(--secondary); font-size: clamp(1.8rem, 4vw, 2.4rem);">Data Pendaftaran Terkirim!</h1>
          <p style="font-size: 1.1rem; margin-bottom: 2rem; color: var(--text-muted);">
            Terima kasih <strong style="color: var(--secondary);">{{ $registration->full_name }}</strong>, data pendaftaran Anda telah berhasil dikirim.
          </p>

          <div class="info-box">
            <h3 style="margin-bottom: 1.5rem; color: var(--secondary); font-size: 1.3rem; text-align: center;">Informasi Pendaftaran</h3>
            <div class="info-grid">
              <div class="info-row">
                <span>Nama</span>
                <strong style="color: var(--secondary);">{{ $registration->full_name }}</strong>
              </div>
              <div class="info-row">
                <span>Email</span>
                <strong style="color: var(--secondary);">{{ $registration->email }}</strong>
              </div>
              <div class="info-row">
                <span>Kategori</span>
                <strong style="color: var(--secondary);">{{ $registration->category }}</strong>
              </div>
              <div class="info-row">
                <span>Status</span>
                <span class="status-pill">Menunggu Konfirmasi</span>
              </div>
            </div>
          </div>

          <div class="next-step-box">
            <p style="margin: 0; color: var(--text-dark);">
              <strong style="color: var(--secondary);"> Langkah Selanjutnya:</strong><br />
              Data pendaftaran Anda sedang dalam proses peninjauan oleh admin. Anda akan menerima notifikasi via email setelah pendaftaran dikonfirmasi.
            </p>
          </div>

          <div class="action-buttons">
            <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
            <a href="{{ route('registration.check') }}" class="btn btn-outline">Cek Status Pendaftaran</a>
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

