<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL KENDARI RUN 2025 | Pendaftaran</title>
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
      <div class="container two-column">
        <div>
          <div class="section-header" style="text-align:left;">
            <h2>Pendaftaran Peserta</h2>
              <p>Lengkapi data diri Anda untuk mengikuti DANLANAL KENDARI RUN 2025.</p>
          </div>
          <form id="register-form" action="{{ route('registration.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
              <label>
                Kategori Lari
                <select name="category" required>
                  <option value="5K - Kategori Umum" selected>5K - Kategori Umum</option>
                </select>
              </label>
              <label class="full-width">
                Nama Lengkap
                <input type="text" name="fullName" required placeholder="Tuliskan nama lengkap" />
              </label>
              <label>
                Email
                <input type="email" name="email" required />
              </label>
              <label>
                Nama di BIB
                <input type="text" name="bibName" maxlength="16" required />
              </label>
              <label>
                  Nomor Telepon / WhatsApp
                <input type="tel" name="phone" required />
              </label>
            </div>

            <div class="form-grid">
              <label>
                Tempat Lahir
                <input type="text" name="birthPlace" required placeholder="Kota tempat lahir" />
              </label>
              <label>
                Tanggal Lahir
                <input type="date" name="birthDate" required />
              </label>
              <label>
                Jenis Kelamin
                <select name="gender" required>
                  <option value="">Pilih</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </label>
              <label>
                Jenis Identitas
                <select name="idType" required>
                  <option value="">Pilih</option>
                  <option value="KTP">KTP</option>
                  <option value="SIM">SIM</option>
                  <option value="Passport">Passport</option>
                  <option value="Kartu Pelajar">Kartu Pelajar</option>
                </select>
              </label>
              <label>
                Nomor Identitas
                <input type="text" name="idNumber" required />
              </label>
            </div>

            <label>
              Alamat Lengkap
              <textarea name="address" rows="3" required></textarea>
            </label>

            <div class="form-grid">
              <label>
                Kota
                <input type="text" name="city" required />
              </label>
                <label>
                  Provinsi
                  <input type="text" name="province" required />
              </label>
              <label>
                Ukuran Jersey
                <select name="jerseySize" required>
                  <option value="">Pilih</option>
                  <option value="XS">XS</option>
                  <option value="S">S</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
                  <option value="XXL">XXL</option>
                </select>
              </label>
              <label>
                Golongan Darah
                <select name="bloodType" required>
                  <option value="">Pilih</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="AB">AB</option>
                  <option value="O">O</option>
                  <option value="Tidak Tahu">Tidak Tahu</option>
                </select>
              </label>
            </div>

            <div class="form-grid">
              <label>
                Nama Kontak Darurat
                <input type="text" name="emergencyName" required />
              </label>
              <label>
                Nomor Kontak Darurat
                <input type="tel" name="emergencyPhone" required />
              </label>
            </div>

            <div class="form-grid">
              <label>
                Komunitas (jika ada)
                <input type="text" name="community" />
              </label>
              <label>
                Catatan Medis 
                <textarea name="medicalNotes" rows="3" placeholder="Tuliskan kondisi kesehatan"></textarea>
              </label>
            </div>

            <div class="card">
              <h3>Konfirmasi Pembayaran</h3>
              <p class="muted">Lakukan pembayaran Rp250.000 ke rekening berikut dan unggah bukti pembayaran.</p>
              <p style="font-weight:700;">Mandiri · 0310055511144
                a.n. Endro Pamungkas</p>
            </div>

            <label>
              Bukti Pembayaran (JPG/PNG/PDF)
              <input type="file" name="paymentProof" accept="image/*,.pdf" required />
            </label>

            <div class="checkbox-wrapper">
              <label class="checkbox-label">
                <input type="checkbox" name="consent" required />
                <span>Saya menyetujui ketentuan lomba dan kondisi kesehatan saya prima.</span>
              </label>
            </div>

            <button class="btn btn-primary" type="submit">Kirim Pendaftaran</button>
          </form>
        </div>

        <aside class="card">
          <h3>Biaya Registrasi</h3>
          <p class="price-tag">Rp250.000</p>
            <p>Termasuk Jersey, BIB, Totebag, Medali Finisher, Refreshment, dan Kupon Doorprize.</p>
            
          <div class="size-chart-card">
            <h4>Panduan Ukuran Jersey</h4>
            <img src="{{ asset('assets/lanal/Size-Chart.jpg') }}" alt="Size chart DANLANAL KENDARI RUN 2025" loading="lazy" />
            <p class="muted">Gunakan panduan ukuran untuk memilih jersey yang paling nyaman.</p>
          </div>
        </aside>
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
