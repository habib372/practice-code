<!-- web.php -->
Route::get('/services/{slug}', 'FrontendController@servicesdetails');

<!-- controller:   -->
public function servicesdetails($slug){
$page_name = str_replace("-", " ",$slug);
$page = Page::where('page_name', $page_name)->first();
$color = Color::where('status',0)->first();
return view('frontend.page',compact('page','color'));
}

<<<<<<< HEAD
{{ (request()->is('page*')) ? 'active' : '' }}

{{ (request()->is('about*')) ? 'active' : '' }}

=======
>>>>>>> 856fc22d979c458a84b741b617e4c34da407f292
<!-- navbar link page: -->
@php
$page = App\Page::where('parent_id', 14)->get();
@endphp
<li style="background-color: transparent">
    <label for="btn-2-services" class="show">Services +</label>
    <a href="#">Services</a>

<<<<<<< HEAD
    <input type="checkbox" id="btn-2-services">
    <ul style="background-color: {{$color->color_code}};">
        @foreach($page as $sub_data)
        <li style="background-color: {{$color->color_code}};"><a href="{{url('services/')}}/{{strtolower(str_replace(" ", "-",$sub_data->page_name))}}">{{$sub_data->page_name}}</a></li>
        @endforeach
    </ul>
</li>
=======
                                <input type="checkbox" id="btn-2-services">
                                <ul style="background-color: {{$color->color_code}};">
                                    @foreach($page as $sub_data)
                                    <li style="background-color: {{$color->color_code}};"><a href="{{url('services/')}}/{{strtolower(str_replace(" ", "-",$sub_data->page_name))}}">{{$sub_data->page_name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
>>>>>>> 856fc22d979c458a84b741b617e4c34da407f292
