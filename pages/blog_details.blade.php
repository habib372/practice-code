@extends('layouts.frontend')

@section('title')
Blog Details
@endsection
@section('content')

    <section id="page-title-area">
        <div class=" title mb-5">
           <h2 class="page-title">{{$blog->title}}</h2>
       </div>
    </section>
 <section id="blog-details" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                   
                    <div class="blog-cart">
                        <div class="blog-image">
                            <img style="width:100%;height:300px;" src="{{asset('uploads/blog')}}/{{$blog->image}}" alt="">
                        </div>
                        <div class="blog-desc">
                            <div class="blog-title">
                                <h5>{{$blog->title}}</h5>
                            </div>
                            <div class="blog-date">
                                <!--<p><strong>Posted On: </strong>{{$blog->created_at->format('d M Y')}}<strong>By: </strong> Admin</p>-->
                            </div>
                            <div class="blog-body">
                                <p>{!!$blog->description!!}</p>
                            </div>
                            
                        </div>
                    </div>
                 
                    
                </div>
                <div class="col-md-4">
                    <div class="blog-sidebar">
                        <h3>Latest Post</h3>
                        @foreach($all_blog_list as $list)
                        <div class="sidebar-cart">
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{asset('uploads/blog')}}/{{$list->image}}" alt="">
                                </div>
                                <div class="col-6">
                                    <h6>{{ Illuminate\Support\Str::limit($list->title, 20)}}</h6>
                                    <a href="{{url('blog_details')}}/{{$list->id}}">View Post</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection