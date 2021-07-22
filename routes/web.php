<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('generate-pdf','PDFController@generatePDF');

// Route::resource('users', 'UserController');