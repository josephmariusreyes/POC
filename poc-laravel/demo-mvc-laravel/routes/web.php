<?php

use App\Http\Controllers\DealershipController;
use App\Http\Controllers\VehicleInquiryController;
use Illuminate\Support\Facades\Route;

// Public marketing pages for the dealership demo.
Route::get('/', [DealershipController::class, 'home'])->name('home');
Route::get('/about', [DealershipController::class, 'about'])->name('about');

// Vehicle pages read from the JSON file instead of a database.
Route::get('/vehicles', [DealershipController::class, 'vehicles'])->name('vehicles.index');
Route::get('/vehicles/{vehicle}', [DealershipController::class, 'vehicleDetails'])->name('vehicles.show');
Route::get('/inquiries', [DealershipController::class, 'inquiries'])->name('inquiries.index');

// Inquiry submissions are stored in a JSON file for this demo app.
Route::post('/vehicles/{vehicle}/inquiry', [VehicleInquiryController::class, 'store'])->name('vehicles.inquiry.store');
