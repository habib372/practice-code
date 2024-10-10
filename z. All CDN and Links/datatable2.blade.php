

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"/>


	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.js"></script>
	<script>
		$(document).ready(function() {
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
							<th >Name</th>
							<th >Satus</th>
							<th >Action</th>
						</tr>
					</thead>
					<tbody class="data_set">

						@foreach($allData as $data)
						<tr>
							<td>{{ $data->id }}</td>
							<td>{{ $data->name??'-' }}</td>
							<td>English : {{ $data->name_en??'' }}<br/>Bangla : {{ $data->name_bn??'' }}</td>
							<td>{{ $data->mobile??'-' }}</td>
							<td>{{ $data->username??'-' }}</td>
							<td>{{ $data->patient->name??'-' }}</td>
							<td>
								@if ($data->logo)
								<img src="/images/featured/{{ $data->logo }}" width="60">
								@else
								<img src="/images/featured/default_logo.png" width="60">
								@endif
							</td>

							@if ($data->status=="active")
								<td><span class="m-badge m-badge--brand m-badge--wide">Active</span></td>
							@else
								<td><span class="m-badge m-badge--metal m-badge--wide">Inactive</span></td>
							@endif

							<td>
								<!-- view -->
								<a href="{{ url('admin/featured')}}/{{ $data->id }}/" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="View details"><i class="la la-eye"></i></a>
								<!-- edit -->
								<a href="{{ url('admin/featured')}}/{{ $data->id }}/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details"><i class="la la-edit"></i></a>
								<!-- delete -->
								<form style="display:inline" id="deleteForm-{{ $data->id }}" action="{{ url('admin/featured') }}/{{ $data->id }}" method="POST">@method('delete') @csrf<a href="javascript:void(0)" data-id="{{ $data->id }}" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill btn-delete" title="Delete"><i class="la la-trash"></i></a></form>
							</td>

						</tr>
						@endforeach
					</tbody>
				</table>


use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\DB;

