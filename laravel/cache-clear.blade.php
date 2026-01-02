<?php


// <!-- url https://demowebsite.com/clear-cache -->

Route::get('/clear-cache/{token}', function ($token) {
    if ($token !== 'retwu') {
        abort(403, 'Unauthorized');
    }

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return 'Cache Cleared';
});

Route::get('/rebuild-cache/{token}', function ($token) {
    if ($token !== 'devhabib') {
        abort(403, 'Unauthorized');
    }

    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');
    Artisan::call('optimize');

    return 'Caches successfully built';
});


// <!-- terminal command -->
php artisan route:cache
php artisan route:clear
php artisan config:cache
php artisan config:clear
php artisan view:cache
php artisan optimize


Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');
    return 'Cache Cleared';
});


// <!-- ERROR: SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost' (using password: NO) . DB_HOST set to localhost -->



Route::get('/run-cron', function () {
    if (request('token') !== 'hsosd') {
        abort(403, 'Unauthorized');
    }
    Artisan::call('user:delete-data');
    return 'Expired data deleted!';
});






use Illuminate\Support\Facades\Artisan;

Route::post('/delete-user', function () {

    abort_unless(auth()->check() && auth()->user()->admin, 403);

    Artisan::call('user:delete-data');

    return back()->with('success', 'All expired users deleted successfully.');

})->name('admin.users.deleteExpired');


<form action="{{ route('admin.users.deleteExpired') }}" method="POST"
      onsubmit="return confirm('⚠️ Are you sure? This will permanently delete all expired users!');">
    @csrf

    <button type="submit" class="btn btn-danger px-4">
        <i class="fa fa-trash"></i> Delete All Expired Users
    </button>
</form>






