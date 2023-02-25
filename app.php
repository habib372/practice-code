@php
            $rootParent = \App\Category::with('children')->orderBy('order', 'asc')->get();
            $rootCates = \App\Category::with('children')->where('level',1)->where('parent_id',null)->orderBy('order', 'asc')->get();

            $rootSubCates = \App\Category::with('children')->where('level',2)->orderBy('order', 'asc')->get();
            $rootChildCates = \App\Category::with('children')->where('level',3)->where('parent_id',1)->orderBy('order', 'asc')->get();

            $testingCate = \App\Category::with('children')->where('level',1)->where('parent_id',34)->orderBy('order', 'asc')->get();
		@endphp

        <!--navbar active (H)-->
        <div class="navbar-collapse collapse" style="position: sticky">
            <ul class="nav navbar-nav">

                <li class="dropdown ">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        Categories <i class="fa fa-list"></i>
                    </a>
                    <ul class="dropdown-menu subcat">

                        @foreach ($rootCates as $rootCat)
                        <li class="dropdown dropdown-submenu @if(count($rootCat->children) > 0) submenu-caret @endif">
                            <a href="{{ route('categories.show',[$rootCat->id,$rootCat->slug]) }}">{{ $rootCat->title }}</a>

                            <ul class="dropdown-menu subUl" id="sub-ul">
                                @foreach ($rootParent as $item)
                                    @if($rootCat->id == $item->parent_id)
                                    <li class="dropdown dropdown-submenu @if(count($rootCat->children) > 0) submenu-caret @endif">
                                        <a href="{{ route('categories.show',[$item->id,$item->slug]) }} ">{{ $item->title }}</a>

                                        <ul class="dropdown-menu subUl" id="sub-ul">
                                            @foreach ($rootChildCates as $item1)
                                                @if($rootCat->id == $item1->parent_id)
                                                <li class="dropdown dropdown-submenu @if(count($rootCat->children) > 0) submenu-caret @endif">
                                                    <a href="{{ route('categories.show',[$item->id,$item->slug]) }} ">{{ $item->title }}</a>

                                                </li>
                                                @endif
                                            @endforeach
                                        </ul>

                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>