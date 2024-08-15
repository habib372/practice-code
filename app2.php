

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"/>


	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.js"></script>

	<script>
		$(document).ready(function () {
			$("#test_datatable").DataTable({
				responsive: true,
				autoWidth: false,
				processing: true,
				bProcessing: true,
				ordering: false,
			});
		});
    </script>


                <table id="test_datatable" class="table table-bordered table-striped " >
					<thead>
						<tr>
							<th>#ID</th>
							<th width="150">Service Provider Name</th>
							<th width="60">Logo</th>
							<th width="100">Contact Person</th>
							<th width="90">Contact Number</th>
							<th width="70">Featured</th>
							<th width="120">Service Provider Type</th>
							<th width="70">Status</th>
							<th width="80">Action</th>
						</tr>
					</thead>
					<tbody class="data_set">

						@foreach($allData as $data)
						<tr>
							<td>{{ $data->id }}</td>
							<td>English : {{ $data->name_en??'' }}<br/>Bangla : {{ $data->name_bn??'' }}</td>
							<td>
								@if ($data->logo)
								<img src="/images/featured_serviceprovider/{{ $data->logo }}" width="60">
								@else
								<img src="/images/featured_serviceprovider/default_logo.png" width="60">
								@endif
							</td>
							<td>English : {{ $data->contact_person_en??'-' }}<br/>Bangla : {{ $data->contact_person_bn??'-' }}</td>
							<td>{{ $data->contact_number }}</td>
							@if ($data->featured=="yes")
								<td><span class="m-badge m-badge--brand m-badge--wide">Yes</span></td>
							@else
								<td><span class="m-badge m-badge--metal m-badge--wide">No</span></td>
							@endif
							<td>
								@if($data->featuredServiceProviderType !==null)
								English : {{ $data->featuredServiceProviderType->name_en }}<br/>Bangla : {{ $data->featuredServiceProviderType->name_bn }}
								@else
								-
								@endif
							</td>
							@if ($data->status=="active")
								<td><span class="m-badge m-badge--brand m-badge--wide">Active</span></td>
							@else
								<td><span class="m-badge m-badge--metal m-badge--wide">Inactive</span></td>
							@endif
							<td>
								<!-- view -->
								<a href="{{ url('tsr-admin/featured-service-providers')}}/{{ $data->id }}/" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="View details"><i class="la la-eye"></i></a>
								<!-- edit -->
								<a href="{{ url('tsr-admin/featured-service-providers')}}/{{ $data->id }}/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details"><i class="la la-edit"></i></a>
								<!-- delete -->
								<form style="display:inline" id="deleteForm-{{ $data->id }}" action="{{ url('tsr-admin/featured-service-providers') }}/{{ $data->id }}" method="POST">@method('delete') @csrf<a href="javascript:void(0)" data-id="{{ $data->id }}" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill btn-delete" title="Delete"><i class="la la-trash"></i></a></form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>


Image = Intervention\Image\Facades\Image
DB = Illuminate\Support\Facades\DB
File = Illuminate\Support\Facades\File
