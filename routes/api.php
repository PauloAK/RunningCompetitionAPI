<?php

Route::namespace('API')->group( function() {
    Route::prefix('competition')->name('competition.')->group( function() {
        Route::get('/', 'CompetitionController@index')->name('index');
        Route::post('/', 'CompetitionController@store')->name('store');
        Route::get('/{competition}', 'CompetitionController@show')->name('show');
        Route::post('/{competition}', 'CompetitionController@update')->name('update');
        Route::delete('/{competition}', 'CompetitionController@delete')->name('delete');
    });

    Route::prefix('competitor')->name('competitor.')->group( function() {
        Route::get('/', 'CompetitorController@index')->name('index');
        Route::post('/', 'CompetitorController@store')->name('store');
        Route::get('/{competitor}', 'CompetitorController@show')->name('show');
        Route::post('/{competitor}', 'CompetitorController@update')->name('update');
        Route::delete('/{competitor}', 'CompetitorController@delete')->name('delete');
    });

    Route::prefix('entry')->name('entry.')->group( function() {
        Route::get('/', 'EntryController@index')->name('index');
        Route::post('/', 'EntryController@store')->name('store');
        Route::get('/{entry}', 'EntryController@show')->name('show');
        Route::post('/{entry}', 'EntryController@update')->name('update');
        Route::delete('/{entry}', 'EntryController@delete')->name('delete');
    });

    Route::prefix('leaderboard')->name('leaderboard.')->group( function() {
        Route::get('/', 'LeaderboardController@index')->name('index');
        Route::get('/age', 'LeaderboardController@age')->name('age');
    });
});

?>