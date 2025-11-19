<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DANLANAL FUN RUN | Pendaftaran</title>
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
      <div class="container two-column">
        <div class="fade" data-delay="0.1">
          <div class="section-header" style="text-align:left;">
            <h2>Pendaftaran Peserta</h2>
            <p>Lengkapi data diri Anda untuk mengikuti DANLANAL Fun Run 5K.</p>
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
              <label>
                Nama Depan
                <input type="text" name="firstName" required />
              </label>
              <label>
                Nama Belakang
                <input type="text" name="lastName" required />
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
                Nomor Telepon
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
                Pekerjaan
                <input type="text" name="occupation" required />
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
                <textarea name="medicalNotes" rows="3" placeholder="Tuliskan kondisi atau alergi khusus"></textarea>
              </label>
            </div>

            <div class="card">
              <h3>Konfirmasi Pembayaran</h3>
              <p class="muted">Lakukan pembayaran Rp250.000 ke rekening berikut dan unggah bukti pembayaran.</p>
              <p style="font-weight:700;">BRI · 183901005388536 a.n. Eka SriWahyuni</p>
            </div>

            <div class="payment-type-section">
              <label class="payment-type-label">Jenis Pembayaran</label>
              <div class="payment-type-grid">
                <label class="payment-type-option">
                  <input type="radio" name="paymentType" value="cash" required />
                  <span>Tunai</span>
                </label>
                <label class="payment-type-option">
                  <input type="radio" name="paymentType" value="transfer" required />
                  <span>Transfer</span>
                </label>
              </div>
              <p class="payment-instruction muted">*Silahkan centang untuk jenis pembayaran yang digunakan</p>
              <p class="payment-instruction muted">*Screenshot Bukti transfer dan kirim ke NO : 0809</p>
            </div>

            <label>
              Bukti Pembayaran (JPG/PNG/PDF)
              <input type="file" name="paymentProof" accept="image/*,.pdf" required />
            </label>

            <label>
              Catatan untuk Panitia
              <textarea name="adminNotes" rows="2" placeholder="Opsional"></textarea>
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

        <aside class="card fade" data-delay="0.2">
          <h3>Biaya Registrasi</h3>
          <p class="price-tag">Rp250.000</p>
          <p>Termasuk jersey, BIB, tas race pack, medali finisher, dan kupon refreshment.</p>
          <a class="btn btn-outline" href="{{ route('archive.category') }}">Lihat Detail Kategori</a>
          <p style="margin-top:1.5rem;color:var(--text-muted);">Setelah submit, tim panitia akan mengirim detail pembayaran ke email Anda.</p>
        </aside>
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
