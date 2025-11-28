<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pendaftaran - DANLANAL KENDARI RUN 2025</title>
    <meta name="description" content="Detail lengkap pendaftaran DANLANAL KENDARI RUN 2025">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ url('/assets/lanal/logo-event/Logg4.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/landing/style.css') }}?v=2.0">
    <style>
      body {
        background: var(--bg);
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
        color: #e8f4ff;
      }
      .detail-wrapper {
        width: min(1100px, 92%);
        margin: 0 auto;
        padding: 4rem 0 3rem;
      }
      .glass-card {
        background: rgba(255, 255, 255, 0.08);
        border-radius: var(--radius);
        border: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 25px 55px rgba(6, 28, 54, 0.3);
        backdrop-filter: blur(22px);
        padding: 2.5rem;
        margin-bottom: 2rem;
        color: #f5fbff;
      }
      .glass-section {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: calc(var(--radius) - 14px);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
      }
      .info-row {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.85rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        word-break: break-word;
      }
      .info-row:last-child {
        border-bottom: none;
      }
      .info-row span:first-child {
        color: rgba(255, 255, 255, 0.72);
        font-weight: 500;
      }
      .info-row strong {
        color: #ffffff;
      }
      .badge-glass {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.45rem 1rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
        font-weight: 600;
      }
      .cta-area {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
      }
      @media (max-width: 768px) {
        .glass-card {
          padding: 1.75rem;
        }
        .info-row {
          flex-direction: column;
          align-items: flex-start;
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

    <main>
      <section class="hero" style="padding: 3rem 0 2rem;">
        <div class="detail-wrapper">
          <div class="glass-card" style="text-align: center;">
            <div class="hero-prize-card" style="margin: 0 auto 1.5rem; max-width: 420px;">
              <p style="margin: 0; text-transform: uppercase; letter-spacing: 0.18em; font-size: 0.85rem;">Nomor Pendaftaran</p>
              <strong style="font-size: 2.2rem; letter-spacing: 0.12em;">{{ $registration->registration_number }}</strong>
            </div>
            <h1 style="margin-bottom: 0.5rem; color: #fff;">Detail Pendaftaran</h1>
            <p class="muted" style="color: rgba(255, 255, 255, 0.75);">Mohon simpan informasi berikut untuk proses verifikasi.</p>
          </div>

          <div class="glass-card">
            <div class="glass-section">
              <h3 style="margin-bottom: 1rem; color: #fff;">📋 Informasi Event</h3>
              <div class="info-row"><span>Event</span><strong>DANLANAL KENDARI RUN 2025</strong></div>
              <div class="info-row"><span>Tanggal</span><strong>21 Desember 2025</strong></div>
              <div class="info-row"><span>Kategori</span><strong>{{ $registration->category }}</strong></div>
              <div class="info-row"><span>Nama BIB</span><strong>{{ $registration->bib_name }}</strong></div>
            </div>

            <div class="glass-section">
              <h3 style="margin-bottom: 1rem; color: #fff;">👤 Data Pribadi</h3>
              <div class="info-row"><span>Nama Lengkap</span><strong>{{ $registration->full_name }}</strong></div>
              <div class="info-row"><span>Email</span><strong>{{ $registration->email }}</strong></div>
              <div class="info-row"><span>Nomor Telepon</span><strong>{{ $registration->phone }}</strong></div>
              <div class="info-row"><span>Tanggal Lahir</span><strong>{{ $registration->birth_date->format('d F Y') }}</strong></div>
              <div class="info-row"><span>Jenis Kelamin</span><strong>{{ $registration->gender }}</strong></div>
            </div>

            <div class="glass-section">
              <h3 style="margin-bottom: 1rem; color: #fff;">🏠 Alamat</h3>
              <div class="info-row" style="flex-direction: column; align-items: flex-start;">
                <span>Alamat Lengkap</span>
                <strong>{{ $registration->address }}</strong>
              </div>
              <div class="info-row"><span>Kota</span><strong>{{ $registration->city }}</strong></div>
            </div>

            <div class="glass-section">
              <h3 style="margin-bottom: 1rem; color: #fff;">🏃 Informasi Event</h3>
              <div class="info-row"><span>Ukuran Jersey</span><strong>{{ $registration->jersey_size }}</strong></div>
              <div class="info-row"><span>Golongan Darah</span><strong>{{ $registration->blood_type }}</strong></div>
            </div>

            <div class="glass-section">
              <h3 style="margin-bottom: 1rem; color: #fff;">📞 Kontak Darurat</h3>
              <div class="info-row"><span>Nama</span><strong>{{ $registration->emergency_name }}</strong></div>
              <div class="info-row"><span>Nomor Telepon</span><strong>{{ $registration->emergency_phone }}</strong></div>
            </div>

            @if($registration->community)
              <div class="glass-section">
                <h3 style="margin-bottom: 1rem; color: #fff;">👥 Komunitas</h3>
                <div class="badge-glass">{{ $registration->community }}</div>
              </div>
            @endif

            @if($registration->registration_number)
              <div class="glass-section" style="text-align: center; background: rgba(110, 207, 246, 0.1); border: 1px solid rgba(110, 207, 246, 0.3);">
                <h3 style="margin-bottom: 1rem; color: #fff;">📱 QR Code Pengambilan Race Pack</h3>
        <p style="margin: 0 0 0.5rem; color: rgba(255, 255, 255, 0.85); font-size: 0.9rem;">
          Tunjukkan QR Code ini saat pengambilan race pack di lokasi event
        </p>
        <p style="margin: 0 0 1rem; color: rgba(255, 255, 255, 0.95); font-size: 0.95rem; font-weight: 600;">
          📅 <strong>Waktu:</strong> 20 Desember 2025, pukul 10.00 - 17.00 WITA<br>
          📍 <strong>Lokasi:</strong> Aula Lanal Kendari
        </p>
                <div style="background: #fff; padding: 1.5rem; border-radius: 12px; display: inline-block; margin-bottom: 1rem; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);">
                  <img src="{{ \App\Services\BarcodeService::generateBarcodeBase64Static($registration->registration_number) }}" 
                       alt="QR Code {{ $registration->registration_number }}" 
                       style="display: block; width: 250px; height: 250px; max-width: 100%; margin: 0 auto;">
                  <p style="margin: 1rem 0 0; color: #333; font-weight: 700; font-size: 1.1rem; letter-spacing: 0.15em;">
                    {{ $registration->registration_number }}
                  </p>
                </div>
                <p style="margin: 0; color: rgba(255, 255, 255, 0.7); font-size: 0.85rem;">
                  Simpan atau print QR Code ini untuk memudahkan proses pengambilan race pack
                </p>
              </div>
            @endif

            <div class="glass-section">
              <p style="margin: 0; color: #fff;">
                <strong>📌 Catatan Penting:</strong><br>
                Simpan nomor pendaftaran ini untuk keperluan pengambilan race pack dan saat event berlangsung.
              </p>
            </div>
          </div>

          <div class="cta-area">
            <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
            <a href="{{ route('registration.check') }}" class="btn btn-outline">Cek Status Lainnya</a>
          </div>
        </div>
      </section>
    </main>

    <footer>
      <div class="container">
        <p>© {{ date('Y') }} DANLANAL KENDARI RUN 2025.</p>
      </div>
    </footer>
    <script src="{{ asset('assets/landing/script.js') }}" defer></script>
  </body>
</html>

