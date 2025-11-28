# CHANGELOG - REVISI TERBARU
Tanggal: Revisi terbaru setelah implementasi barcode scan

## RINGKASAN PERUBAHAN

### 1. COUNTDOWN LABEL
**File:** `resources/views/archive/index.blade.php`
- **Perubahan:** Label countdown diubah dari "Menuju Flag Off" menjadi "Race Day"
- **Detail:** 
  - Line 42: `<span>Menuju Flag Off</span>` → `<span>Race Day</span>`
  - Label di-center (flex-direction: column, text-align: center)

**File:** `public/assets/landing/style.css`
- **Perubahan:** CSS untuk countdown-label diubah menjadi center
- **Detail:**
  - `.countdown-label` diubah dari `justify-content: space-between` menjadi `justify-content: center`
  - Ditambahkan `flex-direction: column` dan `text-align: center`

---

### 2. TOTAL PRIZE POOL TEXT
**File:** `resources/views/archive/index.blade.php`
- **Perubahan:** Teks total prize pool diubah
- **Detail:**
  - Line 63: `<p>Hadiah podium & door prize premium untuk seluruh peserta.</p>`
  - Menjadi: `<p>Hadiah Podium untuk Pelari Tercepat serta Doorprize untuk Peserta yang beruntung.</p>`

---

### 3. DOOR PRIZE SPEKTAKULER
**File:** `resources/views/archive/index.blade.php`
- **Perubahan:** Text diubah menjadi uppercase
- **Detail:**
  - Line 80: `Door Prize Spektakuler` → `DOOR PRIZE SPEKTAKULER`

---

### 4. PODIUM PRIZE SECTION
**File:** `resources/views/archive/index.blade.php`
- **Perubahan:** 
  - Header diubah menjadi uppercase: `Podium Prize 5K` → `PODIUM PRIZE 5K`
  - Judul diubah: `Hadiah Tunai untuk Juara Male & Female` → `Hadiah Tunai untuk Podium Male & Female`
  - Deskripsi "Hadiah podium Rp5.000.000 dengan trophy eksklusif. Berlomba cepat, tampil terbaik." dihapus
  - List juara diubah menjadi card-based dengan styling baru

**Detail perubahan struktur:**
- List `<ul><li>` diubah menjadi `<div class="podium-prizes">` dengan card structure
- Setiap juara menggunakan card dengan:
  - Banner vertikal "TUNAI" di kiri (gradient emas)
  - Content: rank (JUARA 1, 2, dst) dan nominal hadiah
  - Background gradient berbeda untuk setiap rank

**File:** `public/assets/landing/style.css`
- **Perubahan:** Ditambahkan styling untuk podium cards
- **Detail:**
  - Ditambahkan CSS untuk `.podium-prizes`, `.podium-card`, `.podium-banner`, `.podium-content`, `.podium-rank`, `.podium-amount`
  - Gradient backgrounds untuk setiap rank (podium-1 sampai podium-5)
  - Responsive styling untuk mobile

---

### 5. BENEFIT FINISHER
**File:** `resources/views/archive/event-info.blade.php`
- **Perubahan:** Judul dan list benefit diubah
- **Detail:**
  - Line 66: `<h3>Benefit Finisher</h3>` → `<h3>Benefit </h3>`
  - List benefit diubah menjadi:
    - BIB
    - Jersey
    - Medali Finisher
    - Goodie Bag
    - Refreshment

---

### 6. HAPUS FIELD PEKERJAAN
**File yang diubah:**

#### a. Form Registrasi
- **File:** `resources/views/archive/register.blade.php`
  - Dihapus field `<label>Pekerjaan</label>` dan input-nya

#### b. Controller
- **File:** `app/Http/Controllers/RegistrationController.php`
  - Dihapus validation: `'occupation' => 'required|string|max:255',`
  - Dihapus dari create: `'occupation' => $request->occupation,`

#### c. Model
- **File:** `app/Models/Registration.php`
  - Dihapus `'occupation'` dari array `$fillable`

#### d. Views
- **File:** `resources/views/archive/registration-detail.blade.php`
  - Dihapus: `<div class="info-row"><span>Pekerjaan</span><strong>{{ $registration->occupation }}</strong></div>`

- **File:** `resources/views/admin/registrations/show.blade.php`
  - Dihapus section pekerjaan

- **File:** `resources/views/admin/participants/show.blade.php`
  - Dihapus section pekerjaan

#### e. Export Files
- **File:** `app/Exports/RegistrationsExport.php`
  - Dihapus "Pekerjaan" dari headers array
  - Dihapus `$registration->occupation` dari data array
  - Column widths disesuaikan (1 kolom berkurang)
  - Merge cells diupdate dari `:P` menjadi `:Y` (25 kolom)

- **File:** `app/Exports/ParticipantsExport.php`
  - Dihapus "Pekerjaan" dari headers array
  - Dihapus `$participant->occupation` dari data array

**CATATAN:** Field `occupation` masih ada di database, hanya tidak digunakan lagi. Tidak perlu migration untuk menghapus kolom (optional).

---

### 7. FORMAT REGISTRATION NUMBER
**File:** `app/Models/Registration.php`
- **Perubahan:** Format registration number diubah dari DNL5001 menjadi DNL5501
- **Detail:**
  - Method `generateRegistrationNumber()` diupdate:
    - Pattern: `/^DNL5(\d+)$/` → `/^DNL55(\d+)$/`
    - Query: `where('registration_number', 'like', 'DNL5%')` → `where('registration_number', 'like', 'DNL55%')`
    - Start number: `5001` → `5501`
    - Comment: "Format: DNL5001, DNL5002, etc." → "Format: DNL5501, DNL5502, etc."

**File:** `app/Http/Controllers/Admin/RegistrationController.php`
- **Perubahan:** Regex pattern diupdate untuk format baru
- **Detail:**
  - Line 76: `!preg_match('/^DNL5\d{3,}$/', ...)` → `!preg_match('/^DNL55\d{2,}$/', ...)`
  - Comment: "DNL5001, DNL5002, etc." → "DNL5501, DNL5502, etc."

**File:** `app/Console/Commands/UpdateRegistrationNumbers.php`
- **Perubahan:** Description command diupdate
- **Detail:**
  - Line 23: `'Update registration numbers to new format (DNL5001, DNL5002, etc.)'`
  - Menjadi: `'Update registration numbers to new format (DNL5501, DNL5502, etc.)'`

**CATATAN:** Untuk registrasi yang sudah ada dengan format DNL5001, akan tetap berfungsi. Format baru (DNL5501) hanya untuk registrasi baru yang disetujui setelah perubahan ini.

---

## SQL QUERIES (OPSIONAL - Hanya jika ingin menghapus kolom occupation)

Jika ingin menghapus kolom `occupation` dari database (tidak wajib):

```sql
ALTER TABLE registrations DROP COLUMN occupation;
```

**PENTING:** Backup database terlebih dahulu sebelum menjalankan query ini!

---

## FILE YANG DIUBAH (RINGKASAN)

1. `resources/views/archive/index.blade.php`
2. `resources/views/archive/event-info.blade.php`
3. `resources/views/archive/register.blade.php`
4. `resources/views/archive/registration-detail.blade.php`
5. `resources/views/admin/registrations/show.blade.php`
6. `resources/views/admin/participants/show.blade.php`
7. `app/Http/Controllers/RegistrationController.php`
8. `app/Http/Controllers/Admin/RegistrationController.php`
9. `app/Models/Registration.php`
10. `app/Exports/RegistrationsExport.php`
11. `app/Exports/ParticipantsExport.php`
12. `app/Console/Commands/UpdateRegistrationNumbers.php`
13. `public/assets/landing/style.css`

---

## LANGKAH DEPLOY KE PRODUKSI

1. **Backup database** terlebih dahulu
2. **Pull/update code** dari repository
3. **Clear cache:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```
4. **Jika ada perubahan CSS, clear browser cache** atau tambahkan versioning:
   - Update `?v=2.0` menjadi `?v=2.1` di semua link CSS jika diperlukan
5. **Test** semua fitur yang berubah:
   - Form registrasi (pastikan field pekerjaan tidak muncul)
   - Export Excel (pastikan kolom pekerjaan tidak ada)
   - Approval registrasi (pastikan format DNL5501 muncul)
   - Halaman homepage (countdown, prize pool, podium cards)

---

## CATATAN PENTING

- **Field occupation:** Meskipun sudah dihapus dari form dan views, kolom masih ada di database. Tidak perlu dihapus kecuali benar-benar ingin membersihkan database.
- **Format registration number:** Registrasi lama dengan format DNL5001 akan tetap berfungsi. Format baru DNL5501 hanya untuk registrasi baru.
- **Podium cards:** Styling menggunakan gradient dan banner vertikal. Pastikan browser support CSS modern (backdrop-filter, writing-mode, dll).

