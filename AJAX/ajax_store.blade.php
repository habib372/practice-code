


<!--Form  data -->
<form >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- your data -->
     <div class="form-group">
        <label for="end_time" class="form-control-label">End Time:</label>
        <input type="text" class="form-control" id="service_id" name="service_id">
    </div>
</form>

<!--Ajax script -->
    <script>
      ('#saveAppointment').click(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{url('service/store')}}",
                dataType: 'json',
                data: {
                    'service_id': $('#service_id').val()
                },
                beforeSend: function(){
                    // blockUI();
                },
                complete: function(){
                    // $.unblockUI();
                },
                success: function(data) {
                    swal("service created successfully", "success");
                },
                error: function(data) {
                    console.log(data);
                    swal("Something is wrong!", "check your input", "error");
                }
            });
        });
 </script>

<!-- Route-->
Route::post('/service/store', 'Front\ServiceController@store')->name('serviceStore');

<!-- Controller-->
<?php
    public function store(Request $request)
    {
        $data = Service::create([
            'service_id' => $request->service_id,
            // your data
        ]);

        return response()->json($data, 201);
    }

?>
