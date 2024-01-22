Route::prefix('company')->name('company.')->group(function () {
    Route::post('/register', 'Company\Auth\RegisterController@register')->name('submit_register');
});
