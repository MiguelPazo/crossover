<?php

Route::get('/events', 'EventController@getAll');
Route::get('/events/{id}', 'EventController@getDetails');
Route::get('/events/{id}/stands', 'EventController@getStands');
Route::get('/stand/{id}', 'StandController@getDetails');
Route::get('/stand/{id}/photo', 'StandController@getPhoto');
Route::get('/stand/{id}/full-details', 'StandController@getFullDetails');
Route::post('/stand/upload/documents', 'StandController@postUploadDocuments');
Route::post('/stand/upload/logo', 'StandController@postUploadLogo');
Route::post('/stand', 'StandController@postSave');
Route::get('/company/{id}/logo', 'CompanyController@getLogo');
Route::get('/document/{id}/download', 'DocumentController@getDownload');
