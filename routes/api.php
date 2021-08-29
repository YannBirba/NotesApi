<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('note','App\Http\Controllers\NoteController');
Route::get('note-search','App\Http\Controllers\NoteController@search');