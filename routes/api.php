<?php

Route::get('/events', 'EventController@getAll');
Route::get('/events/{id}', 'EventController@getDetails');
Route::get('/events/{id}/stands', 'EventController@getStands');
Route::get('/stand/{id}', 'StandController@getDetails');