<!-- Include Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Include Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Include your application CSS -->

<!-- Include Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Include your application JS -->

{{-- composer install --}}
composer require brian2694/laravel-toastr
npm run dev

{{-- // Example Toastr initialization --}}
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        // Add other options as needed
    };
</script>



{{--// Example in a controller --}}
    public function someAction()
    {
        toastr()->success('Success message', 'Title');
        return view('some.view');
    }



{{-- Example in a Blade view --}}
@if(session('success'))
    <script>
        toastr.success("{{ session('success') }}", "Success");
    </script>
@endif





