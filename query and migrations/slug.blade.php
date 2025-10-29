<!-- view file  -->
 @foreach( $alldata as $data)

 @php
 $url = url('project-details', urlencode(strtolower(str_replace(" ", "-", $data->name))));
 @endphp

 <div class="cs-portfolio__item js-portfolio-item style-3 no-space masonry col-12 filter-{{($data->is_featured == 1) ? 'featured': 'notfeatured' }}  year-{{$data->year}} status-{{($data->is_completed == 1) ? 'completed': 'incompleted' }} cs-5-col"
     data-row="1" data-col="1">
     <div class="cs-portfolio__item-wrap">
         <a href="{{ $url }}" target="_self" class="cs-portfolio__item-link"></a>
         <div class="cs-portfolio__image">
             <img src="#" data-src="{{asset('uploads/project/'.$data->showcase_square_image??'')}}"
                 alt="Simpletree Anarkali" class="js-portfolio-switch ">
         </div>
         <div class="cs-portfolio__content">
             <h4 class="cs-portfolio__item-title">{{$data->name??''}}</h4>
             <div class="cs-portfolio__category">{{$data->category_id??''}}</div>
             <a href="{{ $url }}" target="_self" class="cs-portfolio__link">
                 View more</a>
         </div>
     </div>
 </div>
 <!--showcase_vertical_image-->
@endforeach


<?php
//  <!-- route -->
Route::get('/project-details/{slug}','CommonController@projectDetails')->name('projectDetails');


// <!-- controller -->
public function projectDetails($slug) {
        // Decode the URL parameter
        $name = urldecode(str_replace("-", " ", $slug));

        // Use parameter binding to handle special characters
        $data = Project::with('projectimage')
            ->where('name', $name)
            ->first();

        return view('website.page.projectDetails', compact('data'));
    }


    // slug function
    public static function bn_slug($string = null, $separator = "-") {
        $string = strtolower($string);
        $string = str_replace(' ',$separator, $string);
        $string = str_replace('--',$separator, $string);
        $string = str_replace('&',$separator, $string);
        $string = str_replace('*',$separator, $string);
        $string = str_replace('/',$separator, $string);
        return $string;
    }



//Generate slug automatically when saving:
// In your Blog model (app/Models/Blog.php):

use Illuminate\Support\Str;

protected static function boot()
{
    parent::boot();

    static::saving(function ($blog) {
        if (empty($blog->slug)) {
            $blog->slug = Str::slug($blog->title);
        }
    });
}