
<div class="row" id="myProfile">
    <button type="button" class="custom-padding btn-primary" onclick="myProfile('edit')"><i class="fa fa-edit"></i> Edit Profile</button>
</div>

<div class="row" id="editMyProfile" style="display: none;">
     <button type="button" class="custom-padding btn-primary" onclick="myProfile('view')"><i class="fa fa-edit"></i> View Profile</button>
</div>



<script>
    function myProfile(action) {

			if(action=='edit'){
				$("#editMyProfile").show('slow');
				$("#myProfile").hide('slow');
			}else if(action=='view'){
				$("#editMyProfile").hide('slow');
				$("#myProfile").show('slow');
			}
		}
</script>