<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pendaftaran - DANLANAL Kendari Fun Run 2025</title>
  </head>
  <body style="font-family: system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, sans-serif; background:#f7f7fb; margin:0; padding:24px;">
    <div style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:12px; padding:24px; border:1px solid #eee;">
      <div style="text-align:center; margin-bottom:16px;">
        <img src="{{ url('/assets/lanal/logo-event/Logg4.png') }}" alt="DANLANAL Kendari Fun Run" style="height:56px; width:auto;">
      </div>
      <h2 style="margin:0 0 8px; color:#222;">Pendaftaran Dikonfirmasi ✅</h2>
      <p style="margin:0 0 16px; color:#555;">Halo {{ $registration->full_name }},</p>
      <p style="margin:0 0 16px; color:#555;">
        Pendaftaran Anda untuk <strong>DANLANAL Kendari Fun Run 2025</strong> telah <strong>dikonfirmasi</strong>.
      </p>

      <div style="background:#e3f2fd; border:1px solid #90caf9; border-radius:10px; padding:16px; margin:16px 0;">
        <p style="margin:0; color:#333;"><strong>Nomor Pendaftaran:</strong> {{ $registration->registration_number }}</p>
        <p style="margin:8px 0 0; color:#333;"><strong>Kategori:</strong> {{ $registration->category }}</p>
        <p style="margin:8px 0 0; color:#333;"><strong>Tanggal Event:</strong> 21 Desember 2025</p>
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
          ⚠️ Penting: Tunjukkan email ini pada saat pengambilan racepack.
        </p>
      </div>

      <p style="margin:16px 0 0; color:#777; font-size:12px;">
        Email ini dikirim otomatis. Jika Anda merasa tidak mendaftar, abaikan email ini.
      </p>
    </div>
    <p style="text-align:center; color:#999; font-size:12px; margin-top:12px;">
      © {{ date('Y') }} DANLANAL Kendari Fun Run 2025
    </p>
  </body>
  </html>


