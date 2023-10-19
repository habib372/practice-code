
	<!-- BEGIN .main-heading -->
	<header class="main-heading">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
					<div class="page-icon">
						<i class="icon-laptop_windows"></i>
					</div>
					<div class="page-title">
						<h5>Dashboard</h5>
						<h6 class="sub-heading">Welcome to Career Bangladesh</h6>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
					<div class="right-actions">
						<a href="#" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Download Reports">
							<i class="icon-download4"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- END: .main-heading -->
	<!-- BEGIN .main-content -->
	<div class="main-content app-main-approve">
		<div class="row gutters">
			<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
			    <div class='card'>
    			    <div class='card-header'>
    			        Contact Request
    			    </div>
    			    <div class='card-body'>
    			        <div class='table-responsive'>
    			            <table class='table table-bordered '>
    			                <thead>
    			                    <tr>
    			                        <th style='width:5%;'>SL</th>
    			                        <th>Date</th>
    			                        <th>Employeer Name(Company Name)</th>
    			                        <?php
        								if($this->session->userdata('role')==1){
        								?>
    			                        <th>Contact No</th>
    			                        <th>Email</th>
    			                        <?php } ?>
    			                        <th>Adress</th>
    			                        <th>Note</th>
    			                        <th>Employee Info</th>
    			                        <th>Status</th>
    			                        <th>Action</th>
    			                    </tr>
    			                </thead>
    			                <tbody>
    			                    <?php
    			                        foreach($result as $seeker){
    			                            @$sl++;
    			                            $this->db->where('user_id',$seeker->user_id);
    			                            $user = $this->db->get('users');
    			                            $this->db->where('user_id',$seeker->user_id);
    			                            $users_inter = $this->db->get('users_inter');
    			                            $this->db->where('user_id',$seeker->user_id);
    			                            $users_basic = $this->db->get('users_basic');
    			                    ?>
    			                    <tr>
    			                        <td><?= $sl?></td>
    			                        <td><?= date('Y-m-d',strtotime($seeker->created_at))?></td>
    			                        <td><?= $seeker->name?> (<?= $seeker->company?>)</td>
    			                        <?php
        								if($this->session->userdata('role')==1){
        								?>
    			                        <td><?= $seeker->mobile?></td>
    			                        <td><?= $seeker->email?></td>
    			                        <?php } ?>
    			                        <td><?= $seeker->address?></td>
    			                         <td><?= $seeker->comment?></td>
    			                        <td>
    			                            <p>
        			                            <?php 
        			                                if($user->num_rows() > 0){
        			                                    echo $user->row(0)->full_name."<br>";
        			                                    echo $user->row(0)->username."<br>";
        			                                }
        			                            ?>
        			                            <?php 
        			                                if($users_basic->num_rows() > 0){
        			                                    echo $users_basic->row(0)->phone."<br>";
        			                                    echo $users_basic->row(0)->email."<br>";
        			                                }
        			                            ?>
        			                            <?php 
        			                                if($users_inter->num_rows() > 0){
        			                                    echo $users_inter->row(0)->experience."<br>";
        			                                    echo " Preffred Area: ".$users_inter->row(0)->area."<br>";
        			                                    echo ucwords(str_replace('-',' ',$users_inter->category));
        			                                    
        			                                }
        			                            ?>
        			                            <a style='color:green; text-decoration:underline;' target='_blank' href='<?= base_url()?>profile/category/<?= $seeker->user_id?>'>
        			                                View Details
        			                            </a>
    			                            </p>
    			                        </td>
    			                        <td><?php if($seeker->status ==0){?> <a class='btn btn-xs btn-warning' href="javascript:void(0)">Pending</a> <?php }else{?>
    			                            <a class='btn btn-xs btn-success' href="javascript:void(0)">Approved</a>
    			                        <?php }?></td>
    			                        <td>
    			                            <div class='btn-group'>
    			                                <a class='btn btn-success btn-sm' href='<?= base_url()?>dashboard/approveContactInterview/<?= $seeker->id?>'>
    			                                    <?php 
    			                                    if($seeker->status ==0){
    			                                        echo 'Approve';
    			                                    }
    			                                    else{
    			                                        echo 'Resend';
    			                                    }
    			                                    ?>
    			                                </a>
    			                                <a onclick='return confirm("Are You Sure ?")' class='btn btn-danger btn-sm' href='<?= base_url()?>dashboard/deleteContactRequest/<?= $seeker->id?>'>
    			                                    Delete
    			                                </a>
    			                            </div>
    			                        </td>
    			                    </tr>
    			                    <?php }?>
    			                </tbody>
    			                <tfoot>
    			                    <tr>
    			                        <td colspan='8'><?= $this->pagination->create_links();?></td>
    			                    </tr>
    			                </tfoot>
    			            </table>
    			        </div>
    			    </div>
    			</div>
			</div>
		</div>
	</div>
	<!-- END: .main-content -->