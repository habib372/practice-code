<!-- web.php -->
Route::get('/services/{slug}', 'FrontendController@servicesdetails');

<!-- controller: style-1  -->
public function servicesdetails($slug){
    $page_name = str_replace("-", " ",$slug);
    $page = Page::where('page_name', $page_name)->first();
    $color = Color::where('status',0)->first();
    return view('frontend.page',compact('page','color'));
}

<!-- controller: style-2  -->
public function about_pages($slug)
    {
        $slug = Str::of($slug)->replace('-', ' ');
        $pages = Page::where('page_name',$slug)->first();
        return view('frontend.page_details',compact('pages'));
    }


<!-- controller: style-3  -->
 public function blog_details($slug)
    {
        $blog_name = str_replace("-", " ",$slug);
        $blog = Blog::where('title', 'LIKE','%'.$blog_name.'%')->first();
    // dd($blog);
        $all_blog_list = Blog::where('status',0)->orderBy('id','desc')->take(10)->get();
        return view('frontend.blog_details',compact('blog','all_blog_list'));
    }
<!-- demo-2 -->
public function page_details($slug)
    {
        $slug = Str::of($slug)->replace('-', ' ');
        // Str::of('Laravel 6.x')->replace('6.x', '7.x');
       $aboutus = Page::where('page_name',$slug)->first();
       return view('frontend.page_details',compact('aboutus'));
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
        <li><a href="{{url('services/')}}/{{strtolower(str_replace(" ", "-",$->page_name))}}">{{$sub_data->page_name}}</a></li>
        @endforeach
    </ul>
</li>

@foreach($manpower as $data)
<li class="text-left">
    <label for="btn-3-{{$data->id}}" class="show">{{$data->page_name}} +</label>
    <a href="{{url('manpower')}}/{{Illuminate\Support\Str::of(strtolower($data->page_name))->replace(' ', '-')}}">{{$data->page_name}}</a>
</li>
@endforeach

sub_data