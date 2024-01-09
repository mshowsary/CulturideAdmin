<?php

Route::group(['prefix' => 'v1', 'as' => 'api.',
             'namespace' => 'Api\V1\Admin',
              'middleware' => ['auth:sanctum']],
               function () {                
});
Route::group(['prefix' => 'v1', 'as' => 'api.',
             'namespace' => 'Api\V1\Front',
              ],
    function () {

    Route::get('/menu',[\App\Http\Controllers\Api\V1\Front\MenuApiController::class, 'index'] )->name('menu');    

    // Route::get('/artists',[\App\Http\Controllers\Api\V1\Front\ArtistApiController::class, 'index'] )->name('artist');    
    Route::get('/artists/{tag?}',[\App\Http\Controllers\Api\V1\Front\ArtistApiController::class, 'artistsBytags'] )->name('artists.tag');        
    Route::get('/artist/{artist}/events',[\App\Http\Controllers\Api\V1\Front\ArtistApiController::class, 'events'] )->name('artist.events');    

    Route::get('/home',[\App\Http\Controllers\Api\V1\Front\HomeApiController::class, 'index'] )->name('home');    
    Route::get('/slider',[\App\Http\Controllers\Api\V1\Front\HomeApiController::class, 'slider'] )->name('slider');  
    
    Route::get('/event/{event}/details',[\App\Http\Controllers\Api\V1\Front\EventApiController::class, 'details'] )->name('event.details');    
    Route::get('/event/{event}/zones',[\App\Http\Controllers\Api\V1\Front\EventApiController::class, 'zones'] )->name('events.zone');    
    Route::get('/events/{param}/{name}',[\App\Http\Controllers\Api\V1\Front\EventApiController::class, 'index'] )->name('events.list');    
    Route::get('/events/search',[\App\Http\Controllers\Api\V1\Front\EventApiController::class, 'search'] )->name('events.list.search');    
    
    //CONTACT
    Route::post('/contact',[\App\Http\Controllers\Api\V1\Front\ContactApiController::class, 'index'] )->name('contact.store');    

    //SIGNUP
    Route::post('/signup',[\App\Http\Controllers\Api\V1\Front\SignupApiController::class, 'index'] )->name('signup.store');    

    //LOGIN 
    Route::post('/login',[\App\Http\Controllers\Api\V1\Front\SigninApiController::class, 'index'] )->name('front.login');

     //LOGOUT
    Route::post('/logout',[\App\Http\Controllers\Api\V1\Front\SigninApiController::class, 'logout'] )->name('front.logout');
    
    //RESET PASWORD
    Route::post('/reset-password',[\App\Http\Controllers\Api\V1\Front\ForgetPasswordApiController::class, 'resetPassword'] )->name('front.reset-password');
    Route::get('/update-password/{token}',[\App\Http\Controllers\Api\V1\Front\ForgetPasswordApiController::class, 'updatePassword'] )->name('front.update-password');

    Route::post('/store-password/{token}',[\App\Http\Controllers\Api\V1\Front\ForgetPasswordApiController::class, 'storePassword'] )->name('front.store-password');

    //VALID AUTH
    Route::post('/auth/valid',[\App\Http\Controllers\Api\V1\Front\SigninApiController::class, 'validToken'] )->name('auth.valid');

    //PAGE CARPOOLING LOCATION    
    Route::get('/carpooling/location',[\App\Http\Controllers\Api\V1\Front\CarpoolingLocationApiController::class, 'index'] )->name('carpooling.location');

    //SCANNER CHECK    
    Route::get('/park/{carpoolingId}/{codebar}/check',[\App\Http\Controllers\Api\V1\Front\ScannerCheckApiController::class, 'parkCheck'] )->name('park.check');
    Route::get('/ticket/{codebar}/check',[\App\Http\Controllers\Api\V1\Front\ScannerCheckApiController::class, 'meetingPointCheck'] )->name('point.check');
     
    //PDF TICKET
     Route::get('/ticket/{codebar}/pdf',[\App\Http\Controllers\Api\V1\Front\ScannerCheckApiController::class, 'pdf'] )->name('ticket.pdf');
});

Route::group(['prefix' => 'v1', 'as' => 'api.',
             'namespace' => 'Api\V1\Front',
             'middleware' => ['cors', 'token']],
    function () {
    //BUY TICKET
    Route::post('/buy/ticket',[\App\Http\Controllers\Api\V1\Front\TicketApiController::class, 'index'] )->name('ticket.buy');
   
    //GET ACCOUNT
    Route::get('/dashboard/account',[\App\Http\Controllers\Api\V1\Front\AccountApiController::class, 'index'] )->name('account.profile');

    //UPDATE PROFILE
    Route::post('/dashboard/account/update/profile',[\App\Http\Controllers\Api\V1\Front\AccountApiController::class, 'updateProfile'] )->name('account.profile.update');

    //UPDATE PASSWORD
    Route::post('/dashboard/account/update/password',[\App\Http\Controllers\Api\V1\Front\AccountApiController::class, 'updatePassword'] )->name('account.password.update');
    
    //DASHBOARD
    Route::get('/dashboard/tickets',[\App\Http\Controllers\Api\V1\Front\DashboardApiController::class, 'index'] )->name('dashboard.tickets');                
    Route::get('/dashboard/carpooling/ticket/{ticket}',[\App\Http\Controllers\Api\V1\Front\DashboardApiController::class, 'carpoolingTickets'] )->name('dashboard.carpooling.tickets');
    Route::post('/dashboard/carpooling/store',[\App\Http\Controllers\Api\V1\Front\DashboardApiController::class, 'carpoolingStore'] )->name('dashboard.carpooling.store');                                

    Route::get('/dashboard/carpooling/requests',[\App\Http\Controllers\Api\V1\Front\DashboardApiController::class, 'carpoolingRequest'] )->name('dashboard.carpooling.requests');
    Route::post('/dashboard/carpooling/{carpoolingRequest}/invitation',[\App\Http\Controllers\Api\V1\Front\DashboardApiController::class, 'carpoolingInvitation'] )->name('dashboard.carpooling.invitation');   
    

});