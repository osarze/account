<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => config('account.route.prefix'),
        'middleware' => config('account.route.middleware'),
        'namespace' => config('account.route.namespace'),
    ],
    function () {
        Route::post('', 'AccountController@createAccount');
        Route::post('credit', 'AccountController@creditAccount');
        Route::post('debit', 'AccountController@debitAccount');
        Route::get('{accountNo}/balance', 'AccountController@getBalance');
    }
);
