<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Locations routes
Route::get('/locations', [LocationController::class, 'index'])->name('locations');
Route::get('/locations/seed', [LocationController::class, 'seedLocations'])->name('seedLocations');
Route::get('/locations/select/{id}', [LocationController::class, 'selectLocation'])->name('selectLocation');

Route::get('/visitors', function () {
    // Check if a location has been selected
    if (!session('selected_location_id')) {
        return redirect()->route('locations')
            ->with('error', 'Please select a location first.');
    }
    return view('visitors');
})->name('visitors');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

// Admin location management routes
Route::get('/admin/locations', [LocationController::class, 'adminIndex'])->name('admin.locations');
Route::post('/admin/locations', [LocationController::class, 'store'])->name('admin.locations.store');
Route::delete('/admin/locations/{id}', [LocationController::class, 'destroy'])->name('admin.locations.destroy');
Route::patch('/admin/locations/{id}/toggle', [LocationController::class, 'toggleStatus'])->name('admin.locations.toggle');
Route::post('/admin/locations/seed', [LocationController::class, 'seedLocations'])->name('admin.locations.seed');

Route::get('/admin/visitors', [VisitorController::class, 'adminIndex'])->name('admin.visitors');
Route::post('/admin/visitors', [VisitorController::class, 'store'])->name('admin.visitors.store');
// New visitor routes
Route::get('/newVisitor', [VisitorController::class, 'create'])->name('newVisitor');
Route::post('/newVisitor', [VisitorController::class, 'store']);

// Returning visitor routes
Route::get('/returningVisitor', [VisitorController::class, 'showReturningForm'])->name('returningVisitor');
Route::post('/saveReturningVisitor', [VisitorController::class, 'saveReturningVisitor'])->name('saveReturningVisitor');

// Leaving visitor routes
Route::get('/leavingVisitor', [VisitorController::class, 'showLeavingForm'])->name('leavingVisitor');
Route::post('/leavingVisitor', [VisitorController::class, 'saveLeavingVisitor']);

Route::post('/admin/leavingVisitor', [VisitorController::class, 'adminLeavingVisitor'])->name('admin.leavingVisitor');
