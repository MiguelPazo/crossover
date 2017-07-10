<?php

Route::get('/', 'HomeController@getIndex');

Route::get('/view/{view}', function ($view) {
    if (View::exists($view)) {
        return View::make($view);
    }

    App::abort(404);
});
