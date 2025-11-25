# Fix Styling di Production

## Masalah
CSS/JS di `public/assets/landing/` tidak terbaca di production meskipun file sudah ada.

## Solusi yang Sudah Diterapkan
1. ✅ Controller `ArchiveController` sudah diupdate untuk mencari file di `public/assets/` terlebih dahulu
2. ✅ Path normalization ditambahkan untuk handle berbagai format path
3. ✅ Logging ditambahkan untuk debugging

## Langkah-langkah di Production (SSH)

### 1. Pastikan File Controller Sudah Ter-update
```bash
cd ~/public_html/lanal_funrun
# Pastikan file app/Http/Controllers/ArchiveController.php sudah ter-update
```

### 2. Clear Semua Cache Laravel
```bash
cd ~/public_html/lanal_funrun
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan optimize:clear
```

### 3. Rebuild Cache (Opsional, untuk performa)
```bash
php artisan config:cache
php artisan route:cache
```

### 4. Verifikasi File CSS/JS Ada
```bash
ls -la public/assets/landing/
# Harus menampilkan:
# - style.css
# - script.js
```

### 5. Test Akses File Langsung
```bash
# Test apakah file bisa diakses via URL
curl -I http://yourdomain.com/assets/landing/style.css
# Harus return HTTP 200 dengan Content-Type: text/css
```

### 6. Cek Log Jika Masih Error
```bash
tail -f storage/logs/laravel.log
# Buka website dan lihat apakah ada error di log
```

## Troubleshooting

### Jika Masih 404:
1. **Cek Route Cache**: Pastikan sudah run `php artisan route:clear`
2. **Cek Permissions**: 
   ```bash
   chmod 644 public/assets/landing/style.css
   chmod 644 public/assets/landing/script.js
   ```
3. **Cek Web Server Config**: Pastikan web server tidak block request ke `/assets/`

### Jika File Ter-load Tapi Styling Tidak Terlihat:
1. **Clear Browser Cache**: Hard refresh (Ctrl+Shift+R atau Cmd+Shift+R)
2. **Cek Console Browser**: Buka Developer Tools > Console, lihat apakah ada error loading CSS
3. **Cek Network Tab**: Lihat apakah request ke `style.css` return 200 atau error

### Debug Manual di Controller
Jika masih bermasalah, tambahkan logging sementara:
```php
// Di ArchiveController::asset(), sebelum return
\Log::info('Serving asset', [
    'path' => $path,
    'resolved' => $resolvedPath,
    'mime' => $mimeType,
]);
```

## Catatan Penting
- Setelah update controller, **WAJIB** clear route cache
- Jika menggunakan shared hosting, pastikan PHP version compatible
- Pastikan `public/assets/landing/` folder dan file memiliki permission yang benar (644 untuk file, 755 untuk folder)

