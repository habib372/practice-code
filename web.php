
Route::prefix('company')->name('company.')->group(function () {
    Route::post('/register', 'Company\Auth\RegisterController@register')->name('submit_register');
});




<!------Registation off------>
Auth::routes(['verify' => true, 'register' => false]);

<!-- admin route / auto logout -->
Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(static function () {
        <!-- all admin route here -->
    });
});