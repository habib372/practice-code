use Illuminate\Support\Str;


Str::random(10),

<!-- limit -->
{!! strip_tags(Illuminate\Support\Str::limit($singleNews->excerpt, 200)) !!}

{!! Str::limit($blog->short_description, 250) !!}


<!-- no limit -->
{!!$singleNews->excerpt!!}


@if (isset($news->description_two))
<div class="col-12 mt-5">
    <!--<p style="font-size:18px;">    Our unique vision , mission and values capture the essence of who we are and how we interact with one another. In addition, it speaks to how we go  to market and our commitment to delivering excellence to our customer.</p>-->
    {!!$news->description_two!!}
</div>
@endif

{!! (Illuminate\Support\Str::limit($coach->about, 300, $end="")) !!}

{{ Str::limit($ads->ad_title, 60) }}


{{$product->product_name??''}}

{{$product->product_name??'Null'}}



public function edit(Request $request)
{
FooterBottom::where('id',$request->id)->update([
'icon' => $request->icon,
'short_description' => $request->short_description,
'title' => $request->title,
'created_at' => Carbon::now(),
]);
}
<input type="hidden" name="id" class="form-control" value="{{$footer->id}}" />


{{App\Footer::where('status',0)->first()->map_url}}

{{App\Page::where('parent',28)->first()->page_name}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">