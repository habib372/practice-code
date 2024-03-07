https://github.com/brian2694/laravel-toastr


1.  <!-- composer install -->
composer require brian2694/laravel-toastr
npm run dev


2. <!-- Add the service provider to config/app.php  -->
Brian2694\Toastr\ToastrServiceProvider::class,


3. <!-- Optionally include the Facade in config/app.php if you'd like. -->
'Toastr'  => Brian2694\Toastr\Facades\Toastr::class,


4. <!-- You can set custom options for Reminder. Run: -->
php artisan vendor:publish


5. <!-- Controller/route -->
Route::get('/', function () {
    Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
    return view('welcome');
});


6. <!-- view file (root) -->
<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
            </div>
        </div>
		<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

        {!! Toastr::message() !!}

        <!-- custom css -->
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                // Add other options as needed
            };
        </script>

    </body>
</html>









