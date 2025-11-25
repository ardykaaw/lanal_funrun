@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Race Pack Pickup
                    </div>
                    <h2 class="page-title">
                        Scan Barcode
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Scanner Barcode</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Scan atau Masukkan Kode Barcode</label>
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control" 
                                           id="barcode-input" 
                                           placeholder="Scan barcode atau ketik nomor pendaftaran"
                                           autofocus>
                                    <button class="btn btn-primary" type="button" id="scan-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 7V5a2 2 0 0 1 2-2h2"></path>
                                            <path d="M17 3h2a2 2 0 0 1 2 2v2"></path>
                                            <path d="M21 17v2a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M7 21H5a2 2 0 0 1-2-2v-2"></path>
                                            <line x1="7" y1="8" x2="7" y2="16"></line>
                                            <line x1="12" y1="8" x2="12" y2="16"></line>
                                            <line x1="17" y1="8" x2="17" y2="16"></line>
                                        </svg>
                                        Scan
                                    </button>
                                </div>
                            </div>

                            <div id="scanner-container" style="display: none;">
                                <div id="reader" style="width: 100%; min-height: 300px; position: relative;">
                                    <button class="camera-flip-btn" id="flip-camera-btn" title="Flip Camera" style="display: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="scanner-controls">
                                    <button class="btn btn-secondary flex-fill" id="stop-scan-btn" style="display: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                            <rect x="6" y="6" width="12" height="12" rx="2"/>
                                        </svg>
                                        Stop Scanner
                                    </button>
                                </div>
                            </div>

                            <div id="loading" class="text-center" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2">Mencari data pendaftaran...</p>
                            </div>

                            <div id="error-message" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-circle">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                            <path d="M12 8v4" />
                                            <path d="M12 16h.01" />
                                        </svg>
                                    </div>
                                    <div class="flex-fill">
                                        <h4 class="alert-title">Terjadi Kesalahan</h4>
                                        <div class="text-secondary" id="error-message-text"></div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card" id="registration-card" style="display: none;">
                        <div class="card-header">
                            <h3 class="card-title">Detail Pendaftaran</h3>
                        </div>
                        <div class="card-body">
                            <div id="registration-details">
                                <!-- Details will be loaded here -->
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-success w-100" id="confirm-pickup-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <path d="M20 6L9 17l-5-5"></path>
                                    </svg>
                                    Konfirmasi Race Pack Diambil
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="empty-state" style="display: block;">
                        <div class="card-body text-center py-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted mb-3">
                                <path d="M3 7V5a2 2 0 0 1 2-2h2"></path>
                                <path d="M17 3h2a2 2 0 0 1 2 2v2"></path>
                                <path d="M21 17v2a2 2 0 0 1-2 2h-2"></path>
                                <path d="M7 21H5a2 2 0 0 1-2-2v-2"></path>
                                <line x1="7" y1="8" x2="7" y2="16"></line>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="17" y1="8" x2="17" y2="16"></line>
                            </svg>
                            <h3 class="text-muted">Belum ada data</h3>
                            <p class="text-muted">Scan barcode atau masukkan nomor pendaftaran untuk melihat detail peserta</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List of Participants Who Picked Up Race Pack -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Peserta yang Sudah Mengambil Race Pack</h3>
                        <div class="card-actions">
                            <span class="badge bg-success text-light">{{ $pickedUpRegistrations->count() }} peserta</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($pickedUpRegistrations->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Pendaftaran</th>
                                            <th>Nama Peserta</th>
                                            <th>Kategori</th>
                                            <th>Waktu Pengambilan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pickedUpRegistrations as $index => $reg)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><strong>{{ $reg['registration_number'] }}</strong></td>
                                                <td>{{ $reg['full_name'] }}</td>
                                                <td>{{ $reg['category'] }}</td>
                                                <td>
                                                    <span class="badge bg-success text-light">{{ $reg['picked_up_at'] }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted mb-3">
                                    <path d="M3 7V5a2 2 0 0 1 2-2h2"></path>
                                    <path d="M17 3h2a2 2 0 0 1 2 2v2"></path>
                                    <path d="M21 17v2a2 2 0 0 1-2 2h-2"></path>
                                    <path d="M7 21H5a2 2 0 0 1-2-2v-2"></path>
                                    <line x1="7" y1="8" x2="7" y2="16"></line>
                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                    <line x1="17" y1="8" x2="17" y2="16"></line>
                                </svg>
                                <h3 class="text-muted">Belum ada peserta yang mengambil race pack</h3>
                                <p class="text-muted">Daftar akan muncul setelah ada konfirmasi pengambilan race pack</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal modal-blur fade" id="confirmPickupModal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="confirmPickupModalTitle">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-success"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg text-success mb-2" width="64" height="64" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M9 12l2 2l4 -4" />
                    </svg>
                    <h3 id="confirmPickupModalTitle" class="modal-title">Konfirmasi Pengambilan Race Pack</h3>
                    <div class="text-muted">
                        Apakah Anda yakin bahwa race pack telah diambil oleh peserta ini?
                    </div>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M12 8v4" />
                                    <path d="M12 16h.01" />
                                </svg>
                            </div>
                            <div class="ms-2">
                                <strong>Catatan Penting:</strong> Setelah dikonfirmasi, status pengambilan race pack tidak dapat diubah kembali. Pastikan peserta telah menerima race pack sebelum mengonfirmasi.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                    Batal
                                </button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-success w-100" id="confirmPickupModalBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    Konfirmasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <!-- Ensure Bootstrap is loaded for modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .toast-container {
            z-index: 9999;
        }
        .toast {
            min-width: 300px;
        }
        @media (max-width: 576px) {
            .toast-container {
                left: 0;
                right: 0;
                padding: 1rem !important;
            }
            .toast {
                width: 100%;
                min-width: auto;
            }
        }
        
        /* Ensure navbar-toggler is clickable on this page */
        .navbar-toggler {
            z-index: 1060 !important;
            position: relative !important;
            pointer-events: auto !important;
            cursor: pointer !important;
        }
        
        /* Scanner controls */
        .scanner-controls {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        #reader {
            position: relative;
        }
        
        .camera-flip-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .camera-flip-btn:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }
    </style>
    <script>
        // Wait for DOM and Bootstrap to be ready
        document.addEventListener('DOMContentLoaded', function() {
            'use strict';
            
            let html5QrcodeScanner = null;
            let currentRegistrationId = null;
            let currentFacingMode = "environment"; // "environment" (back) or "user" (front)

            const barcodeInput = document.getElementById('barcode-input');
            const scanBtn = document.getElementById('scan-btn');
            const scannerContainer = document.getElementById('scanner-container');
            const stopScanBtn = document.getElementById('stop-scan-btn');
            const flipCameraBtn = document.getElementById('flip-camera-btn');
            const loading = document.getElementById('loading');
            const errorMessage = document.getElementById('error-message');
            const registrationCard = document.getElementById('registration-card');
            const emptyState = document.getElementById('empty-state');
            const registrationDetails = document.getElementById('registration-details');
            const confirmPickupBtn = document.getElementById('confirm-pickup-btn');
            
            // Ensure navbar-toggler is clickable on this page
            const navbarToggler = document.querySelector('.navbar-toggler');
            if (navbarToggler) {
                navbarToggler.style.pointerEvents = 'auto';
                navbarToggler.style.zIndex = '1060';
                navbarToggler.style.position = 'relative';
                navbarToggler.style.cursor = 'pointer';
            }

        // Manual input lookup
        barcodeInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                lookupRegistration(this.value);
            }
        });

        scanBtn.addEventListener('click', function() {
            if (scannerContainer.style.display === 'none') {
                startScanner();
            } else {
                stopScanner();
            }
        });

        stopScanBtn.addEventListener('click', stopScanner);

        // Confirmation modal setup
        let modalInstance = null;
        
        // Initialize modal after DOM is ready
        function initModal() {
            const confirmPickupModal = document.getElementById('confirmPickupModal');
            
            if (confirmPickupModal) {
                // Try Bootstrap first
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    modalInstance = new bootstrap.Modal(confirmPickupModal, {
                        backdrop: true,
                        keyboard: true,
                        focus: true
                    });
                } else {
                    // Try jQuery Bootstrap modal as fallback
                    if (typeof $ !== 'undefined' && $.fn.modal) {
                        $(confirmPickupModal).modal({
                            backdrop: true,
                            keyboard: true,
                            show: false
                        });
                        modalInstance = {
                            show: function() { $(confirmPickupModal).modal('show'); },
                            hide: function() { $(confirmPickupModal).modal('hide'); }
                        };
                    }
                }
            }
        }
        
        // Initialize modal when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initModal);
        } else {
            initModal();
        }
        
        confirmPickupBtn.addEventListener('click', function() {
            if (!currentRegistrationId) {
                showToast('Tidak ada data pendaftaran yang dipilih', 'error');
                return;
            }
            
            // Always try to show modal first
            const confirmPickupModal = document.getElementById('confirmPickupModal');
            if (confirmPickupModal && modalInstance) {
                modalInstance.show();
            } else if (confirmPickupModal) {
                // If modal exists but instance not created, try to create it now
                initModal();
                if (modalInstance) {
                    modalInstance.show();
                } else {
                    // Last resort: show custom alert using our own modal HTML
                    confirmPickupModal.style.display = 'block';
                    confirmPickupModal.classList.add('show');
                    confirmPickupModal.setAttribute('aria-hidden', 'false');
                    document.body.classList.add('modal-open');
                    const backdrop = document.createElement('div');
                    backdrop.className = 'modal-backdrop fade show';
                    backdrop.id = 'modal-backdrop';
                    document.body.appendChild(backdrop);
                }
            }
        });
        
        // Handle modal confirm button
        const confirmPickupModalBtn = document.getElementById('confirmPickupModalBtn');
        if (confirmPickupModalBtn) {
            confirmPickupModalBtn.addEventListener('click', function() {
                if (currentRegistrationId) {
                    // Disable button to prevent double click
                    this.disabled = true;
                    this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                    
                    // Close modal
                    const confirmPickupModal = document.getElementById('confirmPickupModal');
                    if (modalInstance) {
                        modalInstance.hide();
                    } else if (confirmPickupModal) {
                        confirmPickupModal.style.display = 'none';
                        confirmPickupModal.classList.remove('show');
                        const backdrop = document.getElementById('modal-backdrop');
                        if (backdrop) backdrop.remove();
                        document.body.classList.remove('modal-open');
                    }
                    
                    // Small delay to allow modal to close smoothly
                    setTimeout(() => {
                        confirmRacePackPickup(currentRegistrationId);
                    }, 300);
                }
            });
        }
        
        // Handle modal close buttons
        const confirmPickupModal = document.getElementById('confirmPickupModal');
        if (confirmPickupModal) {
            // Close on backdrop click
            confirmPickupModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    if (modalInstance) {
                        modalInstance.hide();
                    } else {
                        this.style.display = 'none';
                        this.classList.remove('show');
                        const backdrop = document.getElementById('modal-backdrop');
                        if (backdrop) backdrop.remove();
                        document.body.classList.remove('modal-open');
                    }
                }
            });
            
            // Reset modal button state when modal is hidden
            confirmPickupModal.addEventListener('hidden.bs.modal', function() {
                if (confirmPickupModalBtn) {
                    confirmPickupModalBtn.disabled = false;
                    confirmPickupModalBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                        Konfirmasi
                    `;
                }
            });
            
            // Also handle close button
            const closeButtons = confirmPickupModal.querySelectorAll('[data-bs-dismiss="modal"], .btn-close');
            closeButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    if (modalInstance) {
                        modalInstance.hide();
                    } else {
                        confirmPickupModal.style.display = 'none';
                        confirmPickupModal.classList.remove('show');
                        const backdrop = document.getElementById('modal-backdrop');
                        if (backdrop) backdrop.remove();
                        document.body.classList.remove('modal-open');
                    }
                });
            });
        }

        function startScanner() {
            scannerContainer.style.display = 'block';
            stopScanBtn.style.display = 'block';
            flipCameraBtn.style.display = 'flex';
            scanBtn.style.display = 'none';
            
            html5QrcodeScanner = new Html5Qrcode("reader");
            html5QrcodeScanner.start(
                { facingMode: currentFacingMode },
                {
                    fps: 10,
                    qrbox: { width: 250, height: 250 }
                },
                onScanSuccess,
                onScanError
            ).catch(err => {
                console.error("Error starting scanner:", err);
                showError('Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.');
                stopScanner();
            });
        }
        
        // Flip camera function
        flipCameraBtn.addEventListener('click', function() {
            if (html5QrcodeScanner && html5QrcodeScanner.isScanning) {
                // Stop current scanner
                html5QrcodeScanner.stop().then(() => {
                    html5QrcodeScanner.clear();
                    
                    // Switch camera
                    currentFacingMode = currentFacingMode === "environment" ? "user" : "environment";
                    
                    // Restart with new camera
                    html5QrcodeScanner.start(
                        { facingMode: currentFacingMode },
                        {
                            fps: 10,
                            qrbox: { width: 250, height: 250 }
                        },
                        onScanSuccess,
                        onScanError
                    ).catch(err => {
                        console.error("Error switching camera:", err);
                        showError('Tidak dapat mengganti kamera.');
                    });
                }).catch(err => {
                    console.error("Error stopping scanner:", err);
                });
            }
        });

        function stopScanner() {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.stop().then(() => {
                    html5QrcodeScanner.clear();
                    html5QrcodeScanner = null;
                }).catch(err => console.error(err));
            }
            scannerContainer.style.display = 'none';
            stopScanBtn.style.display = 'none';
            flipCameraBtn.style.display = 'none';
            scanBtn.style.display = 'block';
        }

        function onScanSuccess(decodedText, decodedResult) {
            stopScanner();
            lookupRegistration(decodedText);
        }

        function onScanError(errorMessage) {
            // Ignore scan errors
        }

        function lookupRegistration(code) {
            if (!code || code.trim() === '') return;

            loading.style.display = 'block';
            errorMessage.style.display = 'none';
            registrationCard.style.display = 'none';
            emptyState.style.display = 'none';

            fetch('{{ route("admin.barcode-scan.lookup") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code: code.trim() })
            })
            .then(response => response.json())
            .then(data => {
                loading.style.display = 'none';
                
                if (data.success) {
                    displayRegistration(data.registration);
                    showToast('Data pendaftaran berhasil ditemukan', 'success');
                } else {
                    showError(data.message || 'Pendaftaran tidak ditemukan');
                    showToast(data.message || 'Pendaftaran tidak ditemukan', 'error');
                }
            })
            .catch(error => {
                loading.style.display = 'none';
                const errorMsg = 'Terjadi kesalahan saat mencari data: ' + error.message;
                showError(errorMsg);
                showToast(errorMsg, 'error');
            });
        }

        function displayRegistration(reg) {
            currentRegistrationId = reg.id;
            
            const pickedUpBadge = reg.race_pack_picked_up 
                ? `<span class="badge bg-success text-light">Sudah Diambil (${reg.race_pack_picked_up_at || ''})</span>`
                : `<span class="badge bg-warning text-light">Belum Diambil</span>`;

            registrationDetails.innerHTML = `
                <div class="mb-3">
                    <strong>Status Race Pack:</strong><br>
                    ${pickedUpBadge}
                </div>
                <hr>
                <div class="mb-2"><strong>Nomor Pendaftaran:</strong> ${reg.registration_number}</div>
                <div class="mb-2"><strong>Nama:</strong> ${reg.full_name}</div>
                <div class="mb-2"><strong>Email:</strong> ${reg.email}</div>
                <div class="mb-2"><strong>Telepon:</strong> ${reg.phone}</div>
                <div class="mb-2"><strong>Kategori:</strong> ${reg.category}</div>
                <div class="mb-2"><strong>BIB Name:</strong> ${reg.bib_name}</div>
                <div class="mb-2"><strong>Ukuran Jersey:</strong> ${reg.jersey_size}</div>
            `;

            confirmPickupBtn.disabled = reg.race_pack_picked_up;
            confirmPickupBtn.textContent = reg.race_pack_picked_up 
                ? '✓ Race Pack Sudah Diambil' 
                : 'Konfirmasi Race Pack Diambil';

            registrationCard.style.display = 'block';
            emptyState.style.display = 'none';
            barcodeInput.value = '';
        }

        function showError(message) {
            const errorText = document.getElementById('error-message-text');
            if (errorText) {
                errorText.textContent = message;
            } else {
                errorMessage.textContent = message;
            }
            errorMessage.style.display = 'block';
            registrationCard.style.display = 'none';
            emptyState.style.display = 'block';
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 5000);
        }
        
        function showToast(message, type = 'success') {
            // Check if Bootstrap is available
            if (typeof bootstrap === 'undefined') {
                // Fallback to simple alert if Bootstrap is not available
                alert(message);
                return;
            }
            
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                // Create toast container if it doesn't exist
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
                toastContainer.style.zIndex = '9999';
                document.body.appendChild(toastContainer);
            }
            
            const toastId = 'toast-' + Date.now();
            const bgClass = type === 'success' ? 'bg-success' : type === 'error' ? 'bg-danger' : 'bg-info';
            const icon = type === 'success' 
                ? '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>'
                : type === 'error'
                ? '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>'
                : '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>';
            
            const toastHtml = `
                <div id="${toastId}" class="toast align-items-center text-white ${bgClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body d-flex align-items-center">
                            <span class="me-2">${icon}</span>
                            <span>${message}</span>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;
            
            toastContainer.insertAdjacentHTML('beforeend', toastHtml);
            
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement, {
                autohide: true,
                delay: 4000
            });
            
            toast.show();
            
            // Remove toast element after it's hidden
            toastElement.addEventListener('hidden.bs.toast', function() {
                toastElement.remove();
            });
        }

        function confirmRacePackPickup(registrationId) {
            confirmPickupBtn.disabled = true;
            confirmPickupBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';

            fetch(`{{ url('admin/barcode-scan') }}/${registrationId}/confirm-pickup`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Race pack berhasil dikonfirmasi telah diambil!', 'success');
                    // Reload registration data
                    if (currentRegistrationId) {
                        const regNum = document.querySelector('#registration-details').textContent.match(/Nomor Pendaftaran:\s*([A-Z0-9]+)/)?.[1];
                        if (regNum) {
                            setTimeout(() => {
                                lookupRegistration(regNum);
                            }, 1000);
                        }
                    }
                } else {
                    showToast(data.message || 'Terjadi kesalahan saat mengonfirmasi', 'error');
                    confirmPickupBtn.disabled = false;
                    confirmPickupBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M20 6L9 17l-5-5"></path></svg>Konfirmasi Race Pack Diambil';
                }
            })
            .catch(error => {
                showToast('Terjadi kesalahan: ' + error.message, 'error');
                confirmPickupBtn.disabled = false;
                confirmPickupBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M20 6L9 17l-5-5"></path></svg>Konfirmasi Race Pack Diambil';
            });
        }
        }); // End DOMContentLoaded
    </script>
@endsection

