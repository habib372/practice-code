<td>
    @if($category->status == 1)
    <a href="#statusModal{{$category->id}}" data-toggle="modal" class="btn btn-danger"><i class="fas fa-toggle-off icon-md"></i>Deactive
    </a>
    @else
    <a href="#statusModal{{$category->id}}" data-toggle="modal" class="btn btn-success"><i class="fas fa-toggle-on icon-md"></i></i> Active
    </a>
    @endif
</td>


@if($user->status == 'active') <span class="badge user-badge badge-success">Active</span> @else <span class="badge user-badge badge-danger">Inactive</span> @endif


@php if($basic->gender==1){ echo "Male"; }else{ echo "Female"; } @endphp


<div class="carousel-item {{ $loop->first ? 'active' : ''}}">