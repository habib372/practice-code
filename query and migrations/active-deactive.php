<td>
    @if($category->status == 1)
    <a href="#statusModal{{$category->id}}" data-toggle="modal" class="btn btn-danger"><i class="fas fa-toggle-off icon-md"></i>Deactive
    </a>
    @else
    <a href="#statusModal{{$category->id}}" data-toggle="modal" class="btn btn-success"><i class="fas fa-toggle-on icon-md"></i></i> Active
    </a>
    @endif
</td>


@php if($basic->gender==1){ echo "Male"; }else{ echo "Female"; } @endphp