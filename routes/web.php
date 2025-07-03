<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Monitoring;
use App\Models\SensorData;
use App\Models\PlantData;
use App\Http\Controllers\DashboardController;


// Users will be redirected to this route if not logged in
Volt::route('/login', 'login')->name('login');
 
// Define the logout
Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
 
    return redirect('/');
});
 
// Protected routes here
Route::middleware('auth')->group(function () {
    Volt::route('/', 'index');
    Volt::route('/users', 'users.index');
    Volt::route('/users/create', 'users.create');
    Volt::route('/users/{user}/edit', 'users.edit');
    // ... more
});
// Public routes
Volt::route('/register', 'register'); 
 
// Protected routes here
Route::middleware('auth')->group(function () {
    // ...
});
// Route to fetch sensor data
Route::get('/dashboard', function () {
    $latest = SensorData::latest()->first();
    $history = SensorData::orderByDesc('created_at')->limit(20)->get();
    return view('livewire.dashboard', compact('latest', 'history'));
});
// Route to fetch sensor data
Route::get('/sensor-latest', function () {
    return SensorData::latest()->first();
});
Route::get('/plant_dashboard', function () {
    $latest = PlantData::latest()->first();
    return view('livewire.plant_dashboard', compact('latest'));
});
// Route to fetch plant data
Route::get('/plant-latest', function () {
    return PlantData::latest()->first();
});



