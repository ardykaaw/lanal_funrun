<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\SettingsController;
use App\Models\Settings;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationApprovedMail;
use App\Models\Registration;


// /login uses the application's login page (auth.login)
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// Root route: show archived homepage if logged in, otherwise show welcome
// Root should always show the public event homepage
Route::view('/', 'archive.index');
Route::view('/category', 'archive.category')->name('archive.category');
Route::view('/event-info', 'archive.event-info')->name('archive.event-info');
Route::view('/gallery', 'archive.gallery')->name('archive.gallery');
Route::view('/contact', 'archive.contact')->name('archive.contact');

// Public registration landing - check if registration is open
Route::get('/event/register', function () {
    if (!\App\Models\Settings::isRegistrationOpen()) {
        return redirect()->route('archive.registration-closed');
    }
    return view('archive.register');
})->name('archive.register');

Route::view('/event/success', 'archive.success')->name('archive.success');
Route::view('/event/registration-closed', 'archive.registration-closed')->name('archive.registration-closed');

// Registration routes
Route::post('/event/register', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/registration/success/{id}', [RegistrationController::class, 'success'])->name('registration.success');
Route::get('/registration/check', [RegistrationController::class, 'check'])->name('registration.check');
Route::get('/registration/{registrationNumber}', [RegistrationController::class, 'show'])->name('registration.show');

// Serve static assets from arsip/Archive/assets safely
Route::get('/assets/{path}', [ArchiveController::class, 'asset'])->where('path', '.*')->name('archive.asset');

// Local-only: quick test endpoint to send approval email
if (app()->environment('local')) {
    Route::get('/test-email', function () {
        // Try to use latest approved registration; otherwise mock one in-memory
        $registration = Registration::where('status', 'approved')->latest()->first();
        if (!$registration) {
            $registration = new Registration([
                'first_name' => 'Ardy',
                'last_name' => 'Kaaw',
                'email' => 'ardykaaw26@gmail.com',
                'category' => '5K - Kategori Umum',
                'registration_number' => 'DNL' . date('Y') . '00001',
            ]);
        } else {
            // Override recipient for test without changing stored email
            $registration = tap(clone $registration, function ($r) {
                $r->email = 'ardykaaw26@gmail.com';
            });
        }

        Mail::to('ardykaaw26@gmail.com')->send(new RegistrationApprovedMail($registration));

        return response()->json(['status' => 'ok', 'message' => 'Test email dikirim ke ardykaaw26@gmail.com']);
    });
}


Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard with real data
    Route::get('/dashboard', function () {
        $registrations = \App\Models\Registration::all();
        $totalRegistrations = $registrations->count();
        $approvedRegistrations = $registrations->where('status', 'approved')->count();
        $pendingRegistrations = $registrations->where('status', 'pending')->count();
        $verifiedPayments = $registrations->where('payment_status', 'verified')->count();
        $pendingPayments = $registrations->where('payment_status', 'pending')->count();
        $todayRegistrations = $registrations->where('created_at', '>=', today())->count();
        
        // Calculate total revenue based on category
        $totalRevenue = $registrations
            ->where('payment_status', 'verified')
            ->sum(function ($registration) {
                // 5K - Presale = Rp199.000
                // 5K - Umum = Rp250.000
                if ($registration->category === '5K - Presale') {
                    return 199000;
                } elseif ($registration->category === '5K - Umum') {
                    return 250000;
                }
                // Default fallback (shouldn't happen, but just in case)
                return 199000;
            });
        
        return view('welcome', compact(
            'totalRegistrations',
            'approvedRegistrations',
            'pendingRegistrations',
            'verifiedPayments',
            'pendingPayments',
            'todayRegistrations',
            'totalRevenue'
        ));
    })->name('dashboard');
    
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::put('/user/reset/{id}', [UserController::class, 'reset'])->name('user.reset');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    
    // Admin Registration routes
    Route::prefix('admin/registrations')->name('admin.registrations.')->group(function () {
        Route::get('/', [AdminRegistrationController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminRegistrationController::class, 'show'])->name('show');
        Route::post('/{id}/approve', [AdminRegistrationController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [AdminRegistrationController::class, 'reject'])->name('reject');
        Route::get('/{registration}/payment-proof', [AdminRegistrationController::class, 'paymentProof'])->name('payment-proof');
    });
    
    // Admin Participant routes (only approved registrations)
    Route::prefix('admin/participants')->name('admin.participants.')->group(function () {
        Route::get('/', [ParticipantController::class, 'index'])->name('index');
        Route::get('/export', [ParticipantController::class, 'export'])->name('export');
        Route::get('/{id}', [ParticipantController::class, 'show'])->name('show');
    });
    
    // Admin Settings routes
    Route::prefix('admin/settings')->name('admin.settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::post('/update-registration-status', [SettingsController::class, 'updateRegistrationStatus'])->name('update-registration-status');
    });
    
    // Admin Barcode Scan routes
    Route::prefix('admin/barcode-scan')->name('admin.barcode-scan.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\BarcodeScanController::class, 'index'])->name('index');
        Route::post('/lookup', [\App\Http\Controllers\Admin\BarcodeScanController::class, 'lookup'])->name('lookup');
        Route::post('/{id}/confirm-pickup', [\App\Http\Controllers\Admin\BarcodeScanController::class, 'confirmPickup'])->name('confirm-pickup');
    });
});