 <!--navbar active (H)-->
 <div class="navbar-collapse collapse" style="position: sticky">
     <ul class="nav navbar-nav">

         <li class="dropdown ">
             <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                 Categories <i class="fa fa-list"></i>
             </a>
             <ul class="dropdown-menu subcat">

                 @foreach ($rootCats as $rootCat)
                 <li class="dropdown dropdown-submenu @if(count($rootCat->children) > 0) submenu-caret @endif">
                     <a href="{{ route('categories.show',[$rootCat->id,$rootCat->slug]) }}">{{ $rootCat->title }}</a>

                     <ul class="dropdown-menu subUl" id="sub-ul">
                         @foreach ($rootParent as $item)
                         @if($rootCat->id == $item->parent_id)
                         <li>
                             <a href="{{ route('categories.show',[$item->id,$item->slug]) }}">{{ $item->title }}</a>
                         </li>
                         @endif
                         @endforeach
                     </ul>
                 </li>
                 @endforeach
             </ul>
         </li>
    </ul>
</div>