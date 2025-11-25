<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pendaftaran - DANLANAL KENDARI RUN 2025</title>
  </head>
  <body style="font-family: system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, sans-serif; background:#f7f7fb; margin:0; padding:24px;">
    <div style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:12px; padding:24px; border:1px solid #eee;">
      <div style="text-align:center; margin-bottom:16px;">
        <img src="{{ url('/assets/lanal/logo-event/Logg4.png') }}" alt="DANLANAL KENDARI RUN 2025" style="height:56px; width:auto;">
      </div>
      <h2 style="margin:0 0 8px; color:#222;">Selamat, Pendaftaran Telah Diverifikasi ✅</h2>
      <p style="margin:0 0 16px; color:#555;">Halo {{ $registration->full_name }},</p>
      <p style="margin:0 0 16px; color:#555;">
        Pendaftaran Anda untuk <strong>DANLANAL KENDARI RUN 2025</strong> telah <strong>diverifikasi</strong>.
      </p>

      <div style="background:#e3f2fd; border:1px solid #90caf9; border-radius:10px; padding:16px; margin:16px 0;">
        <p style="margin:0; color:#333;"><strong>Nomor Pendaftaran:</strong> {{ $registration->registration_number }}</p>
        <p style="margin:8px 0 0; color:#333;"><strong>Kategori:</strong> {{ $registration->category }}</p>
        <p style="margin:8px 0 0; color:#333;"><strong>Tanggal Event:</strong> 21 Desember 2025</p>
        <p style="margin:8px 0 0; color:#333;"><strong>Waktu Pengambilan Race Pack:</strong> 20 Desember 2025, pukul 10.00 - 17.00 WITA</p>
        <p style="margin:8px 0 0; color:#333;"><strong>Lokasi:</strong> Aula Lanal Kendari</p>
      </div>

      <p style="margin:0 0 16px; color:#555;">
        Anda dapat mengecek status pendaftaran kapan saja melalui halaman berikut:
      </p>
      <p style="margin:0 0 16px;">
        <a href="{{ url('/registration/check') }}?registration_number={{ $registration->registration_number }}" 
           style="display:inline-block; background:#4fc3f7; color:white; text-decoration:none; padding:10px 16px; border-radius:8px; font-weight:600;">
          Cek Status Pendaftaran
        </a>
      </p>

      <div style="background:#fff3cd; border:1px solid #ffc107; border-radius:10px; padding:16px; margin:16px 0;">
        <p style="margin:0; color:#856404; font-weight:600;">
          ⚠️ Penting: Tunjukkan barcode ini pada saat pengambilan racepack.
        </p>
      </div>

      @if($registration->registration_number)
        <div style="text-align:center; margin:24px 0; padding:20px; background:#f8f9fa; border-radius:10px;">
          <p style="margin:0 0 12px; color:#333; font-weight:600; font-size:16px;">QR Code Pengambilan Race Pack</p>
          <div style="display:inline-block; background:#fff; padding:16px; border-radius:12px; border:2px solid #ddd; box-shadow:0 4px 8px rgba(0,0,0,0.1);">
            @if($hasQrCode && !empty($qrCodePath))
              @php
                try {
                  $qrCodeFullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($qrCodePath);
                  if (file_exists($qrCodeFullPath)) {
                    $qrCodeContent = file_get_contents($qrCodeFullPath);
                  } else {
                    $qrCodeContent = null;
                  }
                } catch (\Exception $e) {
                  $qrCodeContent = null;
                }
              @endphp
              @if($qrCodeContent)
                <img src="{{ $message->embedData($qrCodeContent, 'qrcode.png') }}" 
                     alt="QR Code {{ $registration->registration_number }}" 
                     style="display:block; width:250px; height:250px; max-width:100%; margin:0 auto; border:0;">
              @else
                <div style="width:250px; height:250px; background:#f0f0f0; display:flex; align-items:center; justify-content:center; border:2px dashed #ccc; margin:0 auto;">
                  <p style="color:#999; font-size:12px; text-align:center; padding:20px;">QR Code akan tersedia di halaman detail pendaftaran</p>
                </div>
              @endif
            @else
              <div style="width:250px; height:250px; background:#f0f0f0; display:flex; align-items:center; justify-content:center; border:2px dashed #ccc; margin:0 auto;">
                <p style="color:#999; font-size:12px; text-align:center; padding:20px;">QR Code akan tersedia di halaman detail pendaftaran</p>
              </div>
            @endif
          </div>
          <p style="margin:16px 0 0; color:#333; font-size:16px; font-weight:700; letter-spacing:2px;">{{ $registration->registration_number }}</p>
          <p style="margin:8px 0 0; color:#666; font-size:13px;">Simpan atau print QR Code ini untuk pengambilan race pack</p>
          <p style="margin:12px 0 0; color:#999; font-size:12px;">Tunjukkan QR Code ini kepada panitia saat pengambilan race pack di lokasi event</p>
          @if(!$hasQrCode)
            <p style="margin:12px 0 0; color:#856404; font-size:12px; background:#fff3cd; padding:8px; border-radius:6px; display:inline-block;">
              <a href="{{ url('/registration/check') }}?registration_number={{ $registration->registration_number }}" style="color:#856404; text-decoration:underline;">Klik di sini untuk melihat QR Code</a>
            </p>
          @endif
        </div>
      @endif

      <p style="margin:16px 0 0; color:#777; font-size:12px;">
        Email ini dikirim otomatis. Jika Anda merasa tidak mendaftar, abaikan email ini.
      </p>
    </div>
    <p style="text-align:center; color:#999; font-size:12px; margin-top:12px;">
      © {{ date('Y') }} DANLANAL KENDARI RUN 2025
    </p>
  </body>
  </html>


