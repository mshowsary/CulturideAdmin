<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // City
    Route::delete('cities/destroy', 'CityController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CityController');

    // Slider
    Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SliderController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    Route::resource('sliders', 'SliderController');

    // Artist
    Route::delete('artists/destroy', 'ArtistController@massDestroy')->name('artists.massDestroy');
    Route::post('artists/media', 'ArtistController@storeMedia')->name('artists.storeMedia');
    Route::post('artists/ckmedia', 'ArtistController@storeCKEditorImages')->name('artists.storeCKEditorImages');
    Route::resource('artists', 'ArtistController');

    // Type
    Route::delete('types/destroy', 'TypeController@massDestroy')->name('types.massDestroy');
    Route::resource('types', 'TypeController');

    // Contact
    Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
    Route::resource('contacts', 'ContactController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Tag
    Route::delete('tags/destroy', 'TagController@massDestroy')->name('tags.massDestroy');
    Route::resource('tags', 'TagController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventController');

    // Customer
    Route::delete('customers/destroy', 'CustomerController@massDestroy')->name('customers.massDestroy');
    Route::resource('customers', 'CustomerController', ['except' => ['create', 'store']]);

    // Ticket
    Route::delete('tickets/destroy', 'TicketController@massDestroy')->name('tickets.massDestroy');
    Route::resource('tickets', 'TicketController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Zone
    Route::delete('zones/destroy', 'ZoneController@massDestroy')->name('zones.massDestroy');
    Route::resource('zones', 'ZoneController');

    // Carpooling
    Route::delete('carpoolings/destroy', 'CarpoolingController@massDestroy')->name('carpoolings.massDestroy');
    Route::resource('carpoolings', 'CarpoolingController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Carpooling Request
    Route::delete('carpooling-requests/destroy', 'CarpoolingRequestController@massDestroy')->name('carpooling-requests.massDestroy');
    Route::resource('carpooling-requests', 'CarpoolingRequestController', ['except' => ['create', 'store', 'edit', 'update']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});