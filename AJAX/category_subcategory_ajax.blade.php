<!-- route -->
Route::get('get-disease-list/{id}', 'PatientController@getDisease');
<!--PatientController-->
 public function getDisease($id){
        $diseases =  Disease::where('disease_type_id', $id)->select('name_en', 'id')->get();
            return response()->json($diseases);
    }

<!-- create page -->
<div class="col-md-4">
    <label for="patient_disease_type_id">
        Disease Type<span class="text-danger">*</span>
    </label>
    {!! Form::select('patient_disease_type_id', $diseases_type, null, ['class' => 'form-control m-input select2', 'id' => 'patient_disease_type_id']) !!}
    @error('patient_disease_type_id')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="col-md-4">
    <label for="patient_disease_id">
        Disease <span class="text-danger">*</span>
    </label>
    {!! Form::select('patient_disease_id', $diseases, null, ['class' => 'form-control m-input select2', 'id' => 'patient_disease_id']) !!}
    @error('patient_disease_id')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="col-md-4" id="stage_id">
    <label for="patient_stage_id">
        Stage
    </label>
    {!! Form::select('patient_stage_id', $stages, null, ['class' => 'form-control m-input select2', 'id' => 'patient_stage_id']) !!}
    @error('patient_stage_id')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

 <script>

    // show / hide
	$(document).ready(function() {
    $('#stage_id').hide();

		$(document).on('change', '#patient_disease_type_id', function() {
			var disease = $(this).val();

			if (disease == '1') {
				$('#stage_id').show('slow');
			} else {

				$('#stage_id').hide('slow');
			}

		});
	});



    // disease type wise show
	$('#patient_disease_type_id').change(function(){
		var countryID = $(this).val();

		if(countryID){
			$.ajax({
			type:"GET",
			url:"{{url('tsr-admin/get-disease-list') }}"+"/"+countryID,
			data : {"_token":"{{ csrf_token() }}"},
			dataType: "json",
			success:function(res){
				console.log(res);
			if(res){
				$("#patient_disease_id").empty();
				$("#patient_disease_id").append('<option value=""> --Select Disease-- </option>');
				$.each(res,function(key,value){
				$("#patient_disease_id").append('<option value="'+value.id+'">'+value.name_en+'</option>');
				});

			}else{
				$("#patient_disease_id").empty();
			}
			}
			});
		}else{
			$("#patient_disease_id").empty();
			$("#patient_disease_id").append('<option value=""> --Select Disease-- </option>');

		}
  	});


</script>


