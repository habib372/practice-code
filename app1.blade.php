			<div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                     <li class="m-menu__item  m-menu__item--submenu {{ (Request::is('tsr-admin/membership*') || (Request::is('tsr-admin/facility*')) || (Request::is('tsr-admin/all-conditions')) || (Request::is('tsr-admin/condition-update')) || (Request::is('tsr-admin/paid-member')) || (Request::is('tsr-admin/paid-member/*')) )? 'm-menu__item--open' : '' }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
						<a href="javascript:;" class="m-menu__link m-menu__toggle">
							<i class="m-menu__link-icon fa fa-diamond"></i>
							<span class="m-menu__link-text">
								Membership
							</span>
							<i class="m-menu__ver-arrow la la-angle-right"></i>
						</a>
						<div class="m-menu__submenu ">
							<span class="m-menu__arrow"></span>
							<ul class="m-menu__subnav">
								<li class="m-menu__item {{ (Request::is('tsr-admin/paid-member') || (Request::is('tsr-admin/paid-member/*')) )? 'm-menu__item--active' : '' }}" aria-haspopup="true">
									<a href="{{ route('tsr-admin.paid-member.index') }}" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
											<span></span>
										</i>
										<span class="m-menu__link-text">Paid Member List</span>
									</a>
								</li>
								<li class="m-menu__item {{ Request::is('tsr-admin/membership*')? 'm-menu__item--active' : '' }}" aria-haspopup="true">
									<a href="{{ route('tsr-admin.membership.index') }}" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
											<span></span>
										</i>
										<span class="m-menu__link-text"> Membership Plan</span>
									</a>
								</li>
								<li class="m-menu__item {{ Request::is('tsr-admin/facility*')? 'm-menu__item--active' : '' }}" aria-haspopup="true">
									<a href="{{ route('tsr-admin.facility.index') }}" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
											<span></span>
										</i>
										<span class="m-menu__link-text">Membership Facilities</span>
									</a>
								</li>
								<li class="m-menu__item {{ (Request::is('tsr-admin/all-conditions') || (Request::is('tsr-admin/condition-update')) )? 'm-menu__item--active' : '' }}" aria-haspopup="true">
									<a href="{{ route('tsr-admin.all_conditions') }}" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
											<span></span>
										</i>
										<span class="m-menu__link-text">Condition Apply</span>
									</a>
								</li>
							</ul>
						</div>
                    </li>
				</ul>
			</div>