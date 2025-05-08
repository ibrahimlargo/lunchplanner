<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['CHECK24 Checkito Lunch API'];
});

require __DIR__.'/auth.php';
