# CHANGELOG - Revisi 21 November 2025

## Ringkasan Perubahan
Dokumen ini berisi semua perubahan yang dilakukan sejak revisi pertama tanggal 21 November 2025 malam (sekitar jam 8-9 malam).

---

## 1. PERUBAHAN DATABASE

### Query SQL untuk Produksi

```sql
-- Tambah kolom barcode dan race_pack_picked_up
ALTER TABLE `registrations` 
ADD COLUMN `barcode` VARCHAR(255) NULL AFTER `registration_number`,
ADD COLUMN `race_pack_picked_up` TINYINT(1) NOT NULL DEFAULT 0 AFTER `approved_at`,
ADD COLUMN `race_pack_picked_up_at` TIMESTAMP NULL AFTER `race_pack_picked_up`;

-- Index untuk performa (opsional)
CREATE INDEX `idx_barcode` ON `registrations` (`barcode`);
CREATE INDEX `idx_race_pack_picked_up` ON `registrations` (`race_pack_picked_up`);
```

---

## 2. DEPENDENCIES BARU (Composer)

### Library yang Ditambahkan:
1. **picqer/php-barcode-generator** (v3.2.3) - untuk generate barcode 1D (tidak digunakan lagi)
2. **simplesoftwareio/simple-qrcode** (v4.2.0) - untuk generate QR Code 2D

### Command untuk Produksi:
```bash
composer require simplesoftwareio/simple-qrcode
```

---

## 3. FILE BARU YANG DITAMBAHKAN

### A. Services
- `app/Services/BarcodeService.php` - Service untuk generate QR Code

### B. Controllers
- `app/Http/Controllers/Admin/BarcodeScanController.php` - Controller untuk scan barcode

### C. Commands
- `app/Console/Commands/GenerateBarcodesForApprovedRegistrations.php` - Generate barcode untuk data lama
- `app/Console/Commands/UpdateRegistrationNumbers.php` - Update nomor pendaftaran ke format baru

### D. Views
- `resources/views/admin/barcode-scan/index.blade.php` - Halaman scan barcode untuk admin

---

## 4. FILE YANG DIMODIFIKASI

### A. Models
**File:** `app/Models/Registration.php`
- Tambah field `barcode`, `race_pack_picked_up`, `race_pack_picked_up_at` di `$fillable`
- Tambah cast untuk `race_pack_picked_up` (boolean) dan `race_pack_picked_up_at` (datetime)
- **Ubah fungsi `generateRegistrationNumber()`**: Format baru DNL5001, DNL5002, dst. (sequential)

### B. Controllers
**File:** `app/Http/Controllers/Admin/RegistrationController.php`
- Import `BarcodeService`
- **Ubah fungsi `approve()`**: Auto-generate QR Code saat approve
- **Ubah logika approve**: Cek format nomor pendaftaran, jika format lama auto-update ke format baru

**File:** `app/Http/Controllers/Admin/BarcodeScanController.php` (BARU)
- `index()` - Halaman scan
- `lookup()` - Cari pendaftaran berdasarkan barcode/nomor
- `confirmPickup()` - Konfirmasi race pack diambil

### C. Mail
**File:** `app/Mail/RegistrationApprovedMail.php`
- Tambah property `$qrCodePath` dan `$hasQrCode`
- Generate QR Code di constructor
- Tambah method `getQrCodeContent()` untuk embed QR Code

### D. Views - Email
**File:** `resources/views/emails/registration_approved.blade.php`
- Tambah section QR Code dengan embedded image
- QR Code ditampilkan sebagai embedded attachment (CID)
- Fallback jika QR Code tidak tersedia

### E. Views - Public Pages
**File:** `resources/views/archive/index.blade.php`
- Hapus "Danlanal" dari hero-section
- Hapus "Tentang event" section
- Hapus "Kategori 5k" section
- Hapus second registration package
- Pindah "Hadiah" section ke atas
- Hapus frase "hingga rp 5" dan "berbentuk monumen armada"
- Pindah "Total prize pool image" ke hero-section
- Pindah konten di atas footer ke "Info Event"
- Ubah text "medali finisher" menjadi "medali finisher dengan akses maritim sebagai simbol kebanggaan tiap finisher"
- Ganti "Per segmen" dengan "akan segera dirilis"
- Logo di hero tanpa text "event info"
- Hero visual menggunakan `assets/lanal/logo-event/image.png`
- Total Prize Pool di bawah countdown timer
- Countdown card dengan liquid glass style
- Location dan date pills di bawah countdown
- Hapus semua `<section class="section soft">` blocks

**File:** `resources/views/archive/category.blade.php`
- Ubah menjadi redirect ke "Informasi Lomba"
- Title: "Informasi Lomba"

**File:** `resources/views/archive/event-info.blade.php`
- Title: "Informasi Event"
- Hapus "Jadwal acara" section
- Pindah FAQ ke bawah
- Ubah jawaban FAQ ketiga
- Hapus "Coming Soon" heading, subheading, dan badges
- Card "Coming Soon" menjadi card biasa dalam grid

**File:** `resources/views/archive/contact.blade.php`
- "Hubungi panitia" → "Hubungi kami"
- "Kontak panitiai" → "Kontak admin"
- Tambah 2 nomor WhatsApp admin
- Location: "MAKO LANAL Kendari"

**File:** `resources/views/archive/register.blade.php`
- Hapus `fade` dan `data-delay` dari main content untuk immediate visibility

**File:** `resources/views/archive/registration-success.blade.php`
- Tambah custom CSS untuk responsive layout
- Perbaiki text wrapping untuk nama dan email panjang
- Perbaiki layout dan styling

**File:** `resources/views/archive/registration-detail.blade.php`
- Ganti header dengan public header component
- Ganti CSS path ke `asset('assets/landing/style.css')`
- Tambah custom CSS dengan liquid glass theme
- Tambah section QR Code untuk pengambilan race pack
- Perbaiki text visibility dengan color palette yang baik

### F. Views - Admin Pages
**File:** `resources/views/admin/barcode-scan/index.blade.php` (BARU)
- Halaman scan barcode dengan HTML5 QRCode Scanner
- Input manual untuk nomor pendaftaran
- Tampilkan detail peserta setelah scan
- Tombol konfirmasi race pack pickup
- Modal konfirmasi profesional
- Toast notification untuk feedback
- Fitur flip kamera (depan/belakang)

**File:** `resources/views/components/nav-menu.blade.php`
- Tambah menu "Scan Barcode"
- Struktur kembali ke original Tabler (tanpa li wrapper)

**File:** `resources/views/components/sidebar.blade.php`
- Perbaikan layout untuk mobile

**File:** `resources/views/components/logo.blade.php`
- (Tidak ada perubahan signifikan)

**File:** `resources/views/components/profil-menu.blade.php`
- Perbaiki button logout styling untuk mobile

### G. CSS & JavaScript
**File:** `public/assets/landing/style.css`
- Tambah CSS untuk `.hero-logo-only`
- Tambah CSS untuk `.countdown-card` dengan liquid glass effect
- Tambah CSS untuk `.countdown-label`, `.countdown-grid`
- Tambah CSS untuk `.hero-prize-card`
- Tambah CSS untuk `.hero-info-pills` dan `.hero-info-pill`
- Update `.hero-visual img` max-width
- Update `.logo img` height ke 64px
- Update `.logo .text-label` font-size ke 0.95rem
- Tambah CSS untuk image lightbox (`.image-lightbox`, dll)
- Responsive rules untuk mobile

**File:** `public/assets/landing/script.js`
- Tambah global image lightbox functionality
- Semua gambar clickable (kecuali dengan `data-no-lightbox`)

**File:** `resources/views/layouts/app.blade.php`
- Tambah CSS untuk mobile logo size fix
- Tambah CSS untuk navbar-toggler clickable fix
- Tambah CSS untuk dropdown menu z-index fix
- Tambah JavaScript untuk handle dropdown di mobile
- Tambah JavaScript untuk ensure navbar-toggler clickable

### H. Routes
**File:** `routes/web.php`
- Tambah route group `admin/barcode-scan`:
  - `GET /admin/barcode-scan` - Halaman scan
  - `POST /admin/barcode-scan/lookup` - Cari pendaftaran
  - `POST /admin/barcode-scan/{id}/confirm-pickup` - Konfirmasi pickup

---

## 5. PERUBAHAN UTAMA

### A. Format Nomor Pendaftaran
**Dari:** `DNL2025xxxxx` (random)
**Ke:** `DNL5001`, `DNL5002`, `DNL5003`, dst. (sequential)

**Logika:**
- Mulai dari DNL5001
- Increment otomatis dari nomor terakhir
- Hanya mempertimbangkan format baru (DNL5xxx)
- Auto-update format lama saat approve

### B. Fitur Barcode/QR Code
1. **Auto-generate QR Code** saat admin approve pendaftaran
2. **QR Code di Email** - Embedded sebagai attachment (CID)
3. **QR Code di Halaman Detail** - Tampil di halaman detail pendaftaran
4. **Halaman Scan Barcode** - Admin bisa scan QR Code untuk cek detail dan konfirmasi pickup
5. **Fitur Flip Kamera** - Switch antara kamera depan/belakang

### C. Fitur Race Pack Pickup
1. **Status Tracking** - `race_pack_picked_up` (boolean)
2. **Timestamp** - `race_pack_picked_up_at` (datetime)
3. **Konfirmasi Pickup** - Admin bisa konfirmasi via scan barcode

---

## 6. COMMANDS YANG TERSEDIA

### Generate Barcode untuk Data Lama
```bash
php artisan registrations:generate-barcodes
```
Generate QR Code untuk semua registrasi yang sudah approved tapi belum punya barcode.

### Update Nomor Pendaftaran ke Format Baru
```bash
php artisan registrations:update-numbers
```
Update semua nomor pendaftaran dari format lama ke format baru (DNL5001, dst.).

**Dengan force (update semua):**
```bash
php artisan registrations:update-numbers --force
```

---

## 7. PERUBAHAN UI/UX

### Homepage (Beranda)
- Hero section: Logo besar saja, tanpa text
- Countdown dengan liquid glass effect
- Location & date pills di bawah countdown
- Total Prize Pool card di hero section
- Hapus beberapa section yang tidak perlu
- Pindah konten ke halaman Info Event

### Halaman Kategori
- Redirect ke "Informasi Lomba"
- Kategori digabung dengan Info Event

### Halaman Info Event
- Title: "Informasi Event"
- FAQ dipindah ke bawah
- "Coming Soon" cards menjadi card biasa

### Halaman Contact
- Update teks dan kontak admin
- Tambah 2 nomor WhatsApp

### Halaman Scan Barcode (Admin)
- Scanner dengan HTML5 QRCode
- Input manual
- Detail peserta
- Konfirmasi pickup
- Modal konfirmasi profesional
- Toast notification
- Flip kamera

### Navigation Menu
- Hanya 4 item: Beranda, Informasi lomba, Kontak, Daftar
- Admin menu: Dashboard, Pendaftaran, Peserta, Scan Barcode, Pengaturan

---

## 8. PERUBAHAN STYLING

### Liquid Glass Effect
- Countdown card dengan backdrop-filter blur
- Hero prize card dengan gradient
- Info pills dengan glass effect

### Responsive Mobile
- Logo dan text diperkecil di mobile
- Navbar-toggler clickable fix
- Dropdown menu z-index fix
- Scanner responsive

### Image Lightbox
- Semua gambar clickable
- Popup dengan zoom
- Close dengan X, click outside, atau ESC

---

## 9. CHECKLIST DEPLOY KE PRODUKSI

### Database
- [ ] Jalankan query SQL untuk tambah kolom
- [ ] Buat index (opsional)

### Dependencies
- [ ] `composer require simplesoftwareio/simple-qrcode`
- [ ] `composer install` atau `composer update`

### File Baru
- [ ] Upload semua file baru (Services, Controllers, Commands, Views)

### File Modified
- [ ] Upload semua file yang dimodifikasi

### Assets
- [ ] Upload `public/assets/landing/style.css` (updated)
- [ ] Upload `public/assets/landing/script.js` (updated)

### Storage
- [ ] Pastikan `storage/app/public/barcodes` directory ada dan writable
- [ ] Pastikan `php artisan storage:link` sudah dijalankan

### Commands (Opsional)
- [ ] Jalankan `php artisan registrations:update-numbers` untuk update nomor lama
- [ ] Jalankan `php artisan registrations:generate-barcodes` untuk generate barcode data lama

### Clear Cache
- [ ] `php artisan config:clear`
- [ ] `php artisan cache:clear`
- [ ] `php artisan view:clear`
- [ ] `php artisan route:clear`

---

## 10. CATATAN PENTING

1. **Format Nomor Pendaftaran Baru**: Semua pendaftaran baru akan otomatis menggunakan format DNL5001, DNL5002, dst.

2. **QR Code**: 
   - Auto-generate saat approve
   - Tersimpan di `storage/app/public/barcodes/`
   - Ditampilkan di email dan halaman detail

3. **Race Pack Pickup**:
   - Admin bisa scan QR Code untuk cek detail
   - Admin bisa konfirmasi pickup via scan
   - Status tersimpan di database

4. **Mobile Navigation**:
   - Navbar-toggler sekarang clickable
   - Dropdown menu tidak auto-open
   - Logo dan text diperkecil di mobile

5. **Scanner**:
   - Support flip kamera (depan/belakang)
   - Input manual juga tersedia
   - Toast notification untuk feedback

---

## 11. TROUBLESHOOTING

### QR Code tidak tampil di email
- Pastikan `storage/app/public/barcodes` directory ada dan writable
- Cek log untuk error QR Code generation
- Pastikan library `simplesoftwareio/simple-qrcode` terinstall

### Nomor pendaftaran masih format lama
- Jalankan command `php artisan registrations:update-numbers`
- Atau approve ulang pendaftaran (akan auto-update)

### Scanner tidak bisa flip kamera
- Pastikan device support multiple cameras
- Cek browser permission untuk kamera
- Cek console untuk error

### Navbar-toggler tidak bisa diklik
- Pastikan CSS z-index sudah benar
- Cek apakah ada overlay yang menutupi
- Pastikan JavaScript sudah ter-load

### Styling Liquid Glass / Countdown tidak tampil di produksi
**TIDAK PERLU LIBRARY TAMBAHAN** - Liquid glass hanya menggunakan CSS native

**Solusi:**
1. **Clear browser cache** - Tekan Ctrl+Shift+R (Windows/Linux) atau Cmd+Shift+R (Mac)
2. **Pastikan CSS ter-update** - Semua file CSS sudah menggunakan versioning `?v=2.0`
3. **Cek browser support** - `backdrop-filter` didukung di:
   - Chrome 76+
   - Firefox 103+
   - Safari 9+
   - Edge 79+
4. **Fallback sudah ada** - Browser lama akan menggunakan background solid sebagai fallback
5. **Pastikan file CSS ter-upload** - Cek `public/assets/landing/style.css` sudah ter-update
6. **Clear Laravel cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

**Catatan:** 
- Liquid glass menggunakan CSS `backdrop-filter: blur()` yang native browser
- Tidak perlu library JavaScript atau CSS framework tambahan
- Jika tidak tampil, kemungkinan besar masalah cache browser atau file CSS belum ter-update

---

**Dokumen ini dibuat:** 21 November 2025
**Versi:** 1.1

