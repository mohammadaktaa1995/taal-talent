<?php

//-- - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - - - - - - - - --
// API Passport Grant
Route::group(['middleware' => 'auth:api'], function () {
    // User Functionality
    Route::post('users/logout', 'API\UsersController@logout');

    Route::get('users/show', 'API\UsersController@show');
    Route::patch('users/update_profile', 'API\UsersController@update_profile');
    
    Route::post('users/change_password', 'API\UsersController@change_password');
    Route::post('users/deactivate', 'API\UsersController@deactivate');
    Route::post('users/reset_password', 'API\UsersController@reset_password');
});

//-- - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - - - - - - - - --
// API Client Grant :: Machine-To-Machine
Route::group(['middleware' => 'client'], function() {
    Route::post('users/signup', 'API\UsersController@signup');
    
    Route::post('users/verify', 'API\UsersController@verify_account');
    Route::post('users/resend_verification_code', 'API\UsersController@resend_verification_code');

    Route::post('forgot_password', 'API\ForgotPasswordController@create');
    Route::post('check_password_reset_code', 'API\ForgotPasswordController@check');
    Route::post('reset_password', 'API\ForgotPasswordController@reset');
});
