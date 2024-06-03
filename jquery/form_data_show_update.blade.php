d    <div class="row" id="editMyProfile" style="display: none;">
    	<div class="col">
    		<form class="form" id="profileUpdateForm" enctype="multipart/form-data">
    			<div class="col-lg-6 col-md-6 col-12">
    				<div class="form-group">
    					<label for="patient_name">Name <span class="text-danger">*</span></label>
    					<input name="patient_name" id="patient_name" type="text" value="{{auth('patient')->user()->name}}">
    					<span id="invalid-patient_name" class="invalid-response text-danger"></span>
    				</div>
    			</div>
    			<div class="col-lg-6 col-md-6 col-12">
    				<div class="form-group">
    					<label for="patient_mobile">Mobile <span class="text-danger">*</span></label>
    					<input name="patient_mobile" id="patient_mobile" type="text" value="{{auth('patient')->user()->mobile}}">
    				</div>
    			</div>
    		</form>
    		<div class="row">
    			<div class="col text-center">
    				<div class="form-group">
    					<div class="button">
    						<button type="button" class="btn custom-padding" onclick="myProfile('view')">Cancel</button>
    						<button type="submit" class="btn custom-padding" id="profileUpdate">Update Profile Info</button>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="row" id="myProfile">
    	<div class="col">
			view
		</div>
	</div>


    		<script>
    			function myProfile(action) {

    				if (action == 'edit') {
    					$("#editMyProfile").show('slow');
    					$("#myProfile").hide('slow');
    				} else if (action == 'view') {
    					$("#editMyProfile").hide('slow');
    					$("#myProfile").show('slow');
    				}
    			}
    		</script>