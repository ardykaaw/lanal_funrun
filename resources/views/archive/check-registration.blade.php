<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL KENDARI RUN 2025 | Cek Status</title>
    <link rel="icon" href="{{ asset('assets/lanal/logo-event/Logg4.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('assets/landing/style.css') }}?v=2.0" />
    <style>
      .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.6rem 1.2rem;
        border-radius: 999px;
        font-weight: 600;
        margin-bottom: 1.25rem;
      }
      .status-pill.approved {
        background: rgba(46, 204, 113, 0.15);
        color: #1e8748;
      }
      .status-pill.pending {
        background: rgba(255, 165, 0, 0.15);
        color: #b06b00;
      }
      .status-pill.rejected {
        background: rgba(255, 99, 71, 0.15);
        color: #b21807;
      }
      .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
      }
      .info-grid div {
        padding: 0.85rem;
        border: 1px solid rgba(0, 59, 115, 0.12);
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.6);
      }
      .info-grid p {
        margin: 0;
        font-size: 0.85rem;
        color: var(--text-muted);
      }
      .alert {
        margin-top: 1.25rem;
        border-radius: 16px;
        padding: 1rem 1.2rem;
        font-weight: 600;
      }
      .alert.success {
        background: rgba(46, 204, 113, 0.12);
        color: #1e8748;
      }
      .alert.warning {
        background: rgba(255, 165, 0, 0.12);
        color: #b06b00;
      }
      .alert.danger {
        background: rgba(255, 99, 71, 0.12);
        color: #b21807;
      }
      .cta-center {
        text-align: center;
        margin-top: 1rem;
      }
      .card.danger {
        border: 1px solid rgba(255, 99, 71, 0.35);
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
      <div class="container narrow">
        <div class="section-header" style="text-align:center;">
          <h2>Cek Status Pendaftaran</h2>
          <p>Masukkan nomor pendaftaran</p>
        </div>

        <div class="card fade" data-delay="0.1">
          <form class="form" action="{{ route('registration.check') }}" method="GET">
            <label>
              Nomor Pendaftaran
              <input
                type="text"
                name="registration_number"
                placeholder="Contoh: DNL202501234"
                required
                value="{{ request('registration_number') }}"
                style="text-transform:uppercase;"
              />
              <span class="muted" style="font-size:0.85rem;">Nomor dapat ditemukan di email konfirmasi pendaftaran</span>
            </label>
            <div class="form-grid">
              <button class="btn btn-primary" type="submit">Cek Status</button>
              <a class="btn btn-outline" href="{{ route('archive.register') }}">Kembali Daftar</a>
            </div>
          </form>
        </div>

        @if($registration)
          <div class="card fade" data-delay="0.2" style="margin-top:1.5rem;">
            <div class="status-pill {{ $registration->status }}">
              @if($registration->status === 'approved')
                ✅ Pendaftaran Disetujui
              @elseif($registration->status === 'rejected')
                ❌ Pendaftaran Ditolak
              @else
                ⏳ Menunggu Konfirmasi
              @endif
            </div>

            <div class="info-grid">
              <div>
                <p>Nomor Pendaftaran</p>
                <strong>{{ $registration->registration_number ?? 'Belum tersedia' }}</strong>
              </div>
              <div>
                <p>Nama Lengkap</p>
                <strong>{{ $registration->full_name }}</strong>
              </div>
              <div>
                <p>Email</p>
                <strong>{{ $registration->email }}</strong>
              </div>
              <div>
                <p>Kategori</p>
                <span class="badge bg-primary text-white">{{ $registration->category }}</span>
              </div>
              <div>
                <p>Tanggal Daftar</p>
                <strong>{{ $registration->created_at->format('d F Y') }}</strong>
              </div>
              <div>
                <p>Status Pembayaran</p>
                <span class="badge {{ $registration->payment_status === 'verified' ? 'bg-success' : ($registration->payment_status === 'rejected' ? 'bg-danger' : 'bg-warning') }} text-white">
                  {{ ucfirst($registration->payment_status) }}
                </span>
              </div>
              @if($registration->province)
                <div>
                  <p>Provinsi</p>
                  <strong>{{ $registration->province }}</strong>
                </div>
              @endif
            </div>

            @if($registration->status === 'approved')
              <div class="alert success">
                 Selamat! Pendaftaran Anda telah diverifikasi. Silakan cek email untuk informasi dan instruksi lanjutan.
              </div>
              <div class="cta-center">
                <a class="btn btn-primary" href="{{ route('registration.show', $registration->registration_number) }}">Lihat Detail Pendaftaran</a>
              </div>
            @elseif($registration->status === 'rejected' && $registration->admin_notes)
              <div class="alert danger">
                <strong>Alasan Penolakan:</strong><br />
                {{ $registration->admin_notes }}
              </div>
            @else
              <div class="alert warning">
                ⏳ Mohon tunggu; tim admin sedang meninjau berkas Anda. Anda akan menerima email begitu status diperbarui.
              </div>
            @endif
          </div>
        @elseif(request('registration_number'))
            <div class="card fade danger" style="margin-top:1.5rem;">
              <div class="alert danger">
                ❌ Nomor pendaftaran tidak ditemukan. Periksa kembali format DNLxxxx atau hubungi panitia untuk bantuan.
              </div>
            </div>
        @endif
      </div>
    </main>

    <footer>
      <div class="container">
        <p>© {{ date('Y') }} DANLANAL KENDARI RUN 2025. Semua hak cipta.</p>
      </div>
    </footer>
    <script src="{{ asset('assets/landing/script.js') }}" defer></script>
  </body>
</html>
