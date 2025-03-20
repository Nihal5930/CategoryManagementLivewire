<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CategoryManager;

Route::get('/', function () {
    return view('welcome');
});