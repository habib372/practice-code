<!-- Our providers Start -->
<section class="container" id="providers">
    <div class="row mb-2">
        <div class="col-12">
            <h3 class="text-center">Our Providers</h3>
        </div>
    </div>
    <div class="row" id="provider-item">
        <div class="col-12">
            <div class="uk-slider-container-offset" uk-slider>
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
                    <div class="uk-slider-items uk-child-width-1-4@s uk-grid">
                        @foreach($teams as $team)
                        <div>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-media-top">
                                    <img src="{{asset('uploads/team')}}/{{$team->image}}" alt="{{$team->name??'image'}}">
                                </div>
                                <div class="uk-card-body">
                                    <h3 class="uk-card-title">{{$team->name??''}}</h3>
                                    <p>{{$team->description??''}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slider-item="next"></a>

                </div>

                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

            </div>
        </div>
    </div>
</section>
<!-- Our providers End -->