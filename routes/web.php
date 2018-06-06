<?php

Auth::routes();

// View Routes
Route::get('/', 'FrontPageController@index')->name('frontpage');
Route::get('/home', 'AdminController@home')->name('home');
Route::get('/property-search', 'PropertySearchController@index')->name('property.index');
Route::get('/listing/{mlsNumber}', 'PropertySearchController@show')->name('property.show');
Route::get('/my-properties', 'AdminController@myProperties')->name('realtorproperties');
Route::get('/install', 'InstallController@create')->name('install');
Route::get('/facebook', 'FacebookController@redirectToProvider');
Route::get('/facebook/callback', 'FacebookController@handleProviderCallback');

// API Routes
Route::get('/authenticate', 'AuthenticationController@show');
Route::get('/archivedleads', 'ArchivedLeadsController@index');
Route::get('/mylistings', 'RealtorPropertiesController@index');
Route::get('/avatar', 'AvatarsController@index');
Route::get('/broker-logo', 'BrokerLogoController@index');
Route::get('/header-photo', 'HeaderPhotoController@index');
Route::get('/leads/count', 'LeadsCountController@show');
Route::get('/search', 'PropertySearchController@search');
Route::get('/map-search', 'PropertySearchController@mapSearch');
Route::get('/full-listing/{mlsNumber}', 'PropertySearchController@singleListing');
Route::get('/facebook-feed', 'FacebookController@index');
Route::get('/youtube-gallery', 'YoutubeController@index');
Route::get('/youtube-video', 'YoutubeController@show');
Route::get('/modules/map', 'MapModuleController@show');

Route::patch('/users/{id}', 'UsersController@update');

Route::post('/avatar', 'AvatarsController@store');
Route::post('/header-photo', 'HeaderPhotoController@store');
Route::post('/broker-logo', 'BrokerLogoController@store');
Route::post('/configure-install', 'InstallController@configure');
Route::post('/finish-install', 'InstallController@complete');

// Resourceful routes
Route::resource('/leads', 'LeadsController');
Route::resource('/notes', 'NotesController');
Route::resource('/content', 'ContentController');
Route::resource('/metadata', 'MetaDataController');
Route::resource('/mls-numbers', 'MlsNumbersController');

// Misc
Route::get('/leads/{lead}/notes', 'LeadNotesController@index');