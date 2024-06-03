<?php

use App\Models\Link;
use App\Models\Quicklink;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\FeaturedServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class Custom
{

    public static function get_service_provider_info()
    {
        $result = ServiceProvider::where('id', auth()->user()->service_provider_id)->first();
        return $result;
    }

    public static function generateNavLinks(){
        $lang = session()->get('locale') ?? 'bn';
        App::setLocale($lang);

        // $links = Link::with(['content', 'category'])
        //     ->where('status', 'active')
        //     ->select('id', DB::raw('name_'.config('app.locale').' as name'), 'type', 'category_id', 'content_id', 'link', 'parent_id', 'page_banner_image', 'link_target')
        //     ->orderBy(DB::raw('-`parent_id`'), 'asc')
        //     ->orderBy('order', 'asc')
        //     ->get();

        $links = Link::with(['content',
                'featuredServiceProviderType' => function($query){
                        $query->with(['serviceProviders'=> function($query){
                            $query->where('status', 'active')
                                ->select(['id', 'name_'.config('app.locale').' as title', 'slug', 'featured_service_provider_type_id']);
                        }])
                        ->select('id', 'name_'.config('app.locale').' as title', 'slug');
                    },
                    'category'=> function($query){
                        $query->with(['contents'=> function($query){
                                        $query->where('status', 'active')
                                            ->select('id', 'title_'.config('app.locale').' as title', 'slug', 'content_category_id');
                                            //->orderBy('order', 'ASC');
                                    },
                                    'interviews'=> function($query){
                                        $query->where('status', 'active')
                                            ->select('id', 'title_'.config('app.locale').' as title', 'description_'.config('app.locale').' as description', 'video_id', 'video_thumb', 'slug', 'content_category_id', 'created_at');
                                    }
                                ])
                            ->where('status', 'active')
                            ->select('id', 'title_'.config('app.locale').' as title', 'slug', 'parent_id');
                        }])
                    ->where('status', 'active')
                    ->select('id', DB::raw('name_'.config('app.locale').' as name'), 'type', 'featured_service_provider_type_id', 'category_id', 'content_id', 'link', 'parent_id', 'page_banner_image', 'link_target')
                    ->orderBy('parent_id', 'asc')
                    ->orderBy('order', 'asc')
                    ->get();
        //dd($links);

        $menuArr = [];
        if(!$links->isEmpty()){
            foreach($links as $link){
                if(empty($link->parent_id)){

                    $menuArr[$link->id]['name'] = $link->name;
                    $menuArr[$link->id]['banner_image'] = $link->page_banner_image??'';

                    if($link->type == 'Link'){
                        $menuArr[$link->id]['link'] =  $link->link;
                        $menuArr[$link->id]['link_target'] =  $link->link_target??'_self';
                    }

                    if($link->type == 'Content'){
                        $menuArr[$link->id]['link'] = 'content/'.($link->content? $link->content->slug:'');
                    }

                    if($link->type == 'Category'){
                        $menuArr[$link->id]['link'] = 'category/'.($link->category? $link->category->slug:'');

                        //If category has content
                        if(isset($link->category->contents) && count($link->category->contents) > 0){
                            foreach($link->category->contents as $content){
                                $menuArr[$link->id]['contents'][$content->id]['title'] = $content->title;
                                $menuArr[$link->id]['contents'][$content->id]['link'] = 'content/'.$content->slug;
                                $menuArr[$link->id]['contents'][$content->id]['content_category_id'] = $content->content_category_id;
                            }
                        }
                        //If category has interviews
                        if(isset($link->category->interviews) && count($link->category->interviews) > 0){
                            foreach($link->category->interviews as $interview){
                                $menuArr[$link->id]['contents'][$interview->id]['title'] = $interview->title;
                                $menuArr[$link->id]['contents'][$interview->id]['link'] = 'interviews/'.$interview->slug;
                                $menuArr[$link->id]['contents'][$interview->id]['content_category_id'] = $interview->content_category_id;
                            }
                        }
                    }
                    //$menuArr[$link->id]['link'] = ($link->type == 'Content') ? 'content/'.($link->content? $link->content->slug:'') : 'category/'.($link->category? $link->category->slug:'');


                }else{
                    $menuArr[$link->parent_id]['sub'][$link->id]['name'] = $link->name;
                    $menuArr[$link->parent_id]['sub'][$link->id]['banner_image'] = $link->page_banner_image??'';

                    if($link->type == 'Link'){
                        $menuArr[$link->parent_id]['sub'][$link->id]['link'] =  $link->link;
                        $menuArr[$link->parent_id]['sub'][$link->id]['link_target'] =  $link->link_target??'_self';
                    }
                    // else{
                    //     $menuArr[$link->parent_id]['sub'][$link->id]['link'] = ($link->type == 'Content') ? 'content/'.($link->content? $link->content->slug:''): 'category/'.($link->category? $link->category->slug:'');
                    // }
                    if($link->type == 'Content'){
                        $menuArr[$link->parent_id]['sub'][$link->id]['link'] = 'content/'.($link->content? $link->content->slug:'');
                    }
                    if($link->type == 'Category'){
                        $menuArr[$link->parent_id]['sub'][$link->id]['link'] = 'category/'.($link->category? $link->category->slug:'');

                        //If category has content
                        if(isset($link->category->contents) && count($link->category->contents) > 0){
                            foreach($link->category->contents as $content){
                                $menuArr[$link->parent_id]['sub'][$link->id]['contents'][$content->id]['title'] = $content->title;
                                $menuArr[$link->parent_id]['sub'][$link->id]['contents'][$content->id]['link'] = 'content/'.$content->slug;
                                $menuArr[$link->parent_id]['sub'][$link->id]['contents'][$content->id]['content_category_id'] = $content->content_category_id;
                            }
                        }
                    }
                    if($link->type == 'Service Provider'){
                        $menuArr[$link->parent_id]['sub'][$link->id]['link'] = 'service-provider/'.($link->featuredServiceProviderType? $link->featuredServiceProviderType->slug:'');

                        //If Type has service provider
                        if(isset($link->featuredServiceProviderType->serviceProviders) && count($link->featuredServiceProviderType->serviceProviders) > 0){
                            foreach($link->featuredServiceProviderType->serviceProviders as $serviceProvider){
                                $menuArr[$link->parent_id]['sub'][$link->id]['contents'][$serviceProvider->id]['title'] = $serviceProvider->title;
                                $menuArr[$link->parent_id]['sub'][$link->id]['contents'][$serviceProvider->id]['link'] = 'service-provider/'.$link->featuredServiceProviderType->slug.'/'.$serviceProvider->slug;
                                $menuArr[$link->parent_id]['sub'][$link->id]['contents'][$serviceProvider->id]['service_provider_type_id'] = $serviceProvider->service_provider_type_id;
                            }
                        }
                    }
                }
            }
        }
        return $menuArr;
    }

    //Generate Breadcrumb
    public static function generateBreadCrumb(){

        $menus = Custom::generateNavLinks();

        $breadcrumbs = [];
        foreach($menus as $menu){
            if(isset($menu['sub']) && count($menu['sub'])>0){

                $breadcrumbs[$menu['link']]['title'] = $menu['name'];
                $breadcrumbs[$menu['link']]['banner_image'] = $menu['banner_image']??'';
                $breadcrumbs[$menu['link']]['link'] = '<li><a href="/">'.trans('text.home').'</a></li><li><i class="icofont-simple-right"></i></li><li  class="active">'.$menu['name'].'</li>';

                foreach($menu['sub'] as $sub){
                    $link = URL::to($menu['link']);
                    $breadcrumbs[$sub['link']]['title'] = $sub['name'];
                    $breadcrumbs[$sub['link']]['banner_image'] = $sub['banner_image'];
                    $breadcrumbs[$sub['link']]['link'] = '<li><a href="/">'.trans('text.home').'</a></li><li><i class="icofont-simple-right"></i></li><li><a href="'.$link.'">'. $menu['name'].'</a></li><li><i class="icofont-simple-right"></i></li><li class="active">'.$sub['name'].'</li>';

                    if(isset($sub['contents'])){

                        foreach($sub['contents'] as $content){
                            $link = URL::to($menu['link']);
                            $subLink = URL::to($sub['link']);
                            $breadcrumbs[$content['link']]['title'] = $content['title'];
                            $breadcrumbs[$content['link']]['link'] = '<li><a href="/">'.trans('text.home').'</a></li><li><i class="icofont-simple-right"></i></li><li><a href="'.$link.'">'. $menu['name'].'</a></li>
                                                                        <li><i class="icofont-simple-right"></i></li><li><a href="'.$subLink.'">'. $sub['name'].'</a></li><li><i class="icofont-simple-right"></i></li><li class="active">'.$content['title'].'</li>';
                        }
                        //dd($sub['contents']);
                    }
                }
            }else{
                $breadcrumbs[$menu['link']]['title'] = $menu['name'];
                $breadcrumbs[$menu['link']]['banner_image'] = $menu['banner_image']??'';
                $breadcrumbs[$menu['link']]['link'] = '<li><a href="/">'.trans('text.home').'</a></li><li><i class="icofont-simple-right"></i></li><li class="active">'.$menu['name'].'</li>';

                if(isset($menu['contents'])){
                    foreach($menu['contents'] as $content){
                        $link = URL::to($menu['link']);
                        $breadcrumbs[$content['link']]['title'] = $content['title'];
                        $breadcrumbs[$content['link']]['link'] = '<li><a href="/">'.trans('text.home').'</a></li><li><i class="icofont-simple-right"></i></li><li><a href="'.$link.'">'. $menu['name'].'</a></li>
                                                                    <li><i class="icofont-simple-right"></i></li><li class="active">'.$content['title'].'</li>';
                    }
                }
            }
        }
        return $breadcrumbs;
    }

    public static function getQuicklinks(){
        $lang = session()->get('locale') ?? 'bn';
        App::setLocale($lang);

        return Quicklink::select('id', 'name_'.config('app.locale').' as title', 'link', 'link_target', 'status', 'order')
            ->where('status', 'active')
            ->orderBy('order', 'asc')
            ->get();
    }

    public static function getAuth(){
        if(!empty(auth()->user())){
            return auth()->user();
        }else{
            return auth('doctor')->user();
        }
    }

    public static function calculateAgeToday($date){

        //Take patient's dob and return age today
        if(empty($date)){
            return '';
        }

        $datetime1 = new DateTime($date);
        $datetime2 = new DateTime(date('Y-m-d'));
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%yY %mM');

    }



}
