@php
    $bannerAds = App\Models\PromotionalAds::where('status', 'active')->where('category', 'banner-ads')->inRandomOrder()->first();
@endphp

@section('content')
<!----top banner---->
<section class="inner-section single-banner"
    style="background-image: url('{{ asset('frontend_assets/images/bg/title-banner.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if ($bannerAds != null)
                <div class="top-banner-ads">
                    <a href="{{ $bannerAds->link }}"  target="_blank"><img src="{{ asset('frontend_assets/images/promotional_ads/'.$bannerAds->image) }}" alt="google-ads"></a>
                </div>
                @else
                <div class="top-banner-ads">
                    <a href="https://www.propertyservice.com.bd/"  target="_blank"><img src="{{ asset('frontend_assets/images/default_ads.gif') }}" alt="google-ads"></a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!----/end top banner---->