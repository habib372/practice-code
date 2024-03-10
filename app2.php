 <div class="modal-body">
     <div class="view_data">
         <div class="row">
             <div class="col-md-4 col-12">
                 <strong>Name : </strong>{{ $data->name }}<br />
                 <strong>Email : </strong>{{ $data->email??'-' }}<br />
                 <strong>Mobile : </strong>{{ $data->mobile }}<br />
                 <strong>Alt Mobile : </strong>{{ $data->alt_mobile??'-' }}
             </div>
             <div class="col-md-8 col-12">
                 <strong>Date of Birth : </strong>{{ $data->date_of_birth??'-' }}
                 <strong>Gender : </strong>{{ $data->gender??'-' }}
                 <strong>Address : </strong>{{ $data->address??'-' }}
             </div>
         </div>
     </div>
 </div>