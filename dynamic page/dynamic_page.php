<!-- web.php -->
Route::get('/services/{slug}', 'FrontendController@servicesdetails');

<!-- controller:   -->
public function servicesdetails($slug){
    $page_name = str_replace("-", " ",$slug);
    $page = Page::where('page_name', $page_name)->first();
    $color = Color::where('status',0)->first();
    return view('frontend.page',compact('page','color'));
}

 public function blog_details($slug)
    {
        $blog_name = str_replace("-", " ",$slug);
        $blog = Blog::where('title', 'LIKE','%'.$blog_name.'%')->first();
    // dd($blog);
        $all_blog_list = Blog::where('status',0)->orderBy('id','desc')->take(10)->get();
        return view('frontend.blog_details',compact('blog','all_blog_list'));
    }

<!-- navbar link page: -->
@php
$page = App\Page::where('parent_id', 14)->get();
@endphp
<li style="background-color: transparent">
    <label for="btn-2-services" class="show">Services +</label>
    <a href="#">Services</a>

    <input type="checkbox" id="btn-2-services">
    <ul style="background-color: {{$color->color_code}};">
        @foreach($page as $sub_data)
        <li><a href="{{url('services/')}}/{{strtolower(str_replace(" ", "-",$sub_data->page_name))}}">{{$sub_data->page_name}}</a></li>
        @endforeach
    </ul>
</li>

@foreach($manpower as $data)
<li class="text-left">
    <label for="btn-3-{{$data->id}}" class="show">{{$data->page_name}} +</label>
    <a href="{{url('manpower')}}/{{Illuminate\Support\Str::of(strtolower($data->page_name))->replace(' ', '-')}}">{{$data->page_name}}</a>
</li>
@endforeach

