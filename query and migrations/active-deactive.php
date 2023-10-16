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


@if (auth()->user()->user_role_id == '1')
    <li class="m-menu__item  m-menu__item--submenu {{ Request::is('tsr-admin/membership*')? 'm-menu__item--open' : '' }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
        <a href="javascript:;" class="m-menu__link m-menu__toggle">
            <i class="m-menu__link-icon fa fa-diamond"></i>
            <span class="m-menu__link-text">
                Manage Membership
            </span>
            <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu ">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item {{ Request::is('tsr-admin/membership') || Request::is('tsr-admin/membership/create')|| Request::is('tsr-admin/membership/*/edit')|| Request::is('tsr-admin/membership/*')? 'm-menu__item--active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('tsr-admin.membership.index') }}" class="m-menu__link ">
                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            <span></span>
                        </i>
                        <span class="m-menu__link-text"> Membership List</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
@endif