<?php
use Illuminate\Support\Facades\Route;
use App\Models\PlantData;

Route::get('/plant-latest', function () {
    return PlantData::latest()->first();
});
