-- ============================================
-- DATABASE UPDATE SCRIPT
-- Tanggal: 21 November 2025
-- ============================================

-- Tambah kolom barcode untuk menyimpan path file QR Code
ALTER TABLE `registrations` 
ADD COLUMN `barcode` VARCHAR(255) NULL AFTER `registration_number`;

-- Tambah kolom race_pack_picked_up untuk tracking status pengambilan race pack
ALTER TABLE `registrations` 
ADD COLUMN `race_pack_picked_up` TINYINT(1) NOT NULL DEFAULT 0 AFTER `approved_at`;

-- Tambah kolom race_pack_picked_up_at untuk menyimpan timestamp pengambilan
ALTER TABLE `registrations` 
ADD COLUMN `race_pack_picked_up_at` TIMESTAMP NULL AFTER `race_pack_picked_up`;

-- Index untuk performa query (opsional, tapi direkomendasikan)
CREATE INDEX `idx_barcode` ON `registrations` (`barcode`);
CREATE INDEX `idx_race_pack_picked_up` ON `registrations` (`race_pack_picked_up`);

-- ============================================
-- CATATAN:
-- 1. Pastikan backup database dilakukan sebelum menjalankan script ini
-- 2. Script ini aman untuk dijalankan di production
-- 3. Kolom baru akan memiliki nilai NULL/default sesuai definisi
-- ============================================

