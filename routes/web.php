<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\RegLombaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify', function () {
    return Inertia::render('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/overview');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/', [PagesController::class, 'index']);
Route::get('/kontak', [PagesController::class, 'kontak'])->name('pesan.index');
Route::post('/kontak', [PesanController::class, 'store']);

// Route::get('/{berita}/informasiberita', [BeritaController::class, 'informasiberita']);

Route::get('berita/{berita}/detail', [BeritaController::class, 'detail']);

Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::post('/login', [UsersController::class, 'show']);
Route::get('/daftar', [UsersController::class, 'daftar']);
Route::post('/daftar', [UsersController::class, 'store'])->name('daftar.store');
Route::get('/lupa-password', [UsersController::class, 'lupapassword']);
Route::post('/lupa-password', [UsersController::class, 'showemail']);
Route::get('lupa-password/konfirmasi', [UsersController::class, 'konfirmasi'])->name('konfirmasi');
Route::post('lupa-password/konfirmasi', [UsersController::class, 'updatepw']);
Route::post('/logout', [UsersController::class, 'logout']);
Route::get('/detail/{lomba}', [PagesController::class, 'detailpeserta']);


// Admin hanya bisa mengakses
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard-admin', [PagesController::class, 'dashboard'])->name('dashboard');
    Route::get('/partisipan', [UsersController::class, 'partisipan']);
    Route::get('/pesan', [PesanController::class, 'pesan']);
    Route::post('/pesan/update-status/{id}', [PesanController::class, 'updateStatus'])->name('pesan.updateStatus');


    Route::get('event/lomba/tambah-lomba', [LombaController::class, 'tambahlomba']);
    Route::get('event/lomba', [LombaController::class, 'lomba'])->name('lomba.index');
    Route::post('event/lomba', [LombaController::class, 'store']);
    Route::delete('event/lomba/{lomba}', [LombaController::class, 'destroy']);
    Route::get('event/lomba/{lomba}/edit-lomba', [LombaController::class, 'editlomba']);
    Route::put('event/lomba/{lomba}', [LombaController::class, 'update']);
    Route::get('event/lomba/{lomba}/detail-lomba', [LombaController::class, 'detaillomba']);

    Route::get('event/kriteria/tambah-kriteria', [KriteriaController::class, 'tambahkriteria']);
    Route::get('event/kriteria', [KriteriaController::class, 'kriteria'])->name('kriteria.index');
    Route::post('event/kriteria', [KriteriaController::class, 'store']);
    Route::delete('event/kriteria/{kriteria}', [KriteriaController::class, 'destroy']);
    Route::get('event/kriteria/{kriteria}/edit-kriteria', [KriteriaController::class, 'editkriteria']);
    Route::put('event/kriteria/{kriteria}', [KriteriaController::class, 'update']);
    Route::get('event/kriteria/{kriteria}/detail-kriteria', [KriteriaController::class, 'detailkriteria']);

    Route::get('event/administrator/tambahadministrator', [PagesController::class, 'tambahadministrator']);
    Route::post('event/administrator/tambahadministrator', [UsersController::class, 'store']);
    Route::get('event/administrator', [PagesController::class, 'administrator'])->name('administrator');
    Route::get('event/administrator/editadministrator', [PagesController::class, 'editadministrator']);
    Route::get('event/administrator/{user}/detailadministrator', [PagesController::class, 'detailadministrator']);

    Route::get('event/sponsor/tambah-sponsor', [SponsorController::class, 'tambahsponsor']);
    Route::get('event/sponsor', [SponsorController::class, 'sponsor'])->name('sponsor.index');
    Route::post('event/sponsor', [SponsorController::class, 'store']);
    Route::delete('event/sponsor/{sponsor}', [SponsorController::class, 'destroy']);
    Route::get('event/sponsor/{sponsor}/edit-sponsor', [SponsorController::class, 'editsponsor']);
    Route::put('event/sponsor/{sponsor}', [SponsorController::class, 'update']);
    Route::get('event/sponsor/{sponsor}/detail-sponsor', [SponsorController::class, 'detailsponsor']);

    Route::get('event/berita/tambah-berita', [BeritaController::class, 'tambahberita']);
    Route::get('event/berita', [BeritaController::class, 'berita'])->name('berita.index');
    Route::post('event/berita', [BeritaController::class, 'store']);
    Route::delete('event/berita/{berita}', [BeritaController::class, 'destroy']);
    Route::get('event/berita/{berita}/edit-berita', [BeritaController::class, 'editberita']);
    Route::put('event/berita/{berita}', [BeritaController::class, 'update']);
    Route::get('event/berita/{berita}/detail-berita', [BeritaController::class, 'detailberita']);

    Route::get('event/setting/tambah-setting', [SettingController::class, 'tambahsetting']);
    Route::get('event/setting', [SettingController::class, 'setting'])->name('setting.index');
    Route::post('event/setting', [SettingController::class, 'store']);
    Route::get('event/setting/{setting}/edit-setting', [SettingController::class, 'editsetting']);
    Route::put('event/setting/{setting}', [SettingController::class, 'update']);

    Route::get('/tim', [PagesController::class, 'tim']);
    Route::get('/tim/{lomba}/tabel-tim', [PagesController::class, 'tabeltim']);
    Route::get('/tim/tabel-tim/{reglomba}/detail-tim', [PagesController::class, 'detailtim']);

    Route::get('/rangking', [PagesController::class, 'rangking']);
    Route::get('/rangking/tabelrangking', [PagesController::class, 'tabelrangking']);
});


// juri hanya bisa mengakses
Route::middleware(['juri'])->group(function () {
    Route::get('/dashboard-juri', [PagesController::class, 'dashboardjuri'])->name('dashboardjuri');
    Route::get('/lomba-juri', [PagesController::class, 'lombajuri']);
    Route::get('/lomba-juri/{lomba}/tabel-lomba', [PagesController::class, 'tabellomba']);
    Route::get('/rangking-juri', [PagesController::class, 'rangkingjuri']);
    Route::get('/rangking-juri/tabel-rangking-juri', [PagesController::class, 'tabelrangkingjuri']);
    Route::get('/lomba-juri/tabel-lomba/nilai', [PagesController::class, 'nilai']);
    Route::get('/lomba-juri/tabel-lomba/edit-nilai', [PagesController::class, 'editnilai']);
    Route::get('/lomba-juri/tabel-lomba/{reglomba}/tim-detail', [PagesController::class, 'timdetailjuri']);
});

// Petugas hanya bisa mengakses dashboardadmin
Route::middleware(['petugas'])->group(function () {
    Route::get('/dashboard-petugas', [PagesController::class, 'dashboardpetugas'])->name('dashboardpetugas');
    Route::get('/partisipan-petugas', [PagesController::class, 'partisipanpetugas']);
    Route::get('/tim-petugas', [PagesController::class, 'timpetugas']);
    Route::get('/tim-petugas/{reglomba}/tim-detail', [PagesController::class, 'timdetail']);
    Route::get('/pesan-petugas', [PagesController::class, 'pesanpetugas']);
    Route::post('/pesan-petugas/update-status/{id}', [PagesController::class, 'updateStatus'])->name('pesan.updateStatus');
    Route::get('/rangking-petugas', [PagesController::class, 'rangkingpetugas']);
    Route::get('/rangking-petugas/petugas-rangking/{lomba}', [PagesController::class, 'petugasrangking']);
});

// Peserta hanya bisa mengakses peserta
Route::middleware(['peserta', 'auth', 'verified'])->group(function () {
    Route::get('/overview', [PagesController::class, 'overviewpeserta'])->name('overview');
    Route::get('/profil', [UsersController::class, 'profil'])->name('profil.index');
    Route::put('/profil/{user}', [UsersController::class, 'update']);
    Route::get('/notifikasi', [PagesController::class, 'notifikasipeserta']);
    Route::get('/report', [PagesController::class, 'reportpeserta']);
    Route::get('/detail-tim', [PagesController::class, 'detailtimreport']);
    Route::get('/data-tim', [RegLombaController::class, 'datatim']);
    Route::get('/daftar-lomba', [RegLombaController::class, 'daftarlomba'])->name('reglomba.index');
    Route::post('/daftar-lomba', [RegLombaController::class, 'store']);
    Route::post('/tambah-member', [RegLombaController::class, 'addmember']);
    Route::post('/pengumpulan-karya', [RegLombaController::class, 'kirim']);
    Route::get('/pengumpulan-karya', [RegLombaController::class, 'pengumpulankarya']);
});

Route::get('/search', [UsersController::class, 'search'])->name('users.search');
Route::get('/proses', [PagesController::class, 'proses']);