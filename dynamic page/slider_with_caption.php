<style>
    .carousel-indicators .active {
        background-color: #000;
    }

    .carousel-caption {
        bottom: 150px;
    }

    .carousel-caption h5 {
        font-size: 72px;
        color: #ffffff;
        font-weight: 800;
        margin-top: 11px;
        margin-bottom: 18px;
    }

    .carousel-caption p {
        color: #ffffff;
        margin-bottom: 44px;
    }

    .carousel {
        position: relative;
        height: 650px;
    }

    .carousel-indicators {
        bottom: 30px;
    }
</style>

<section id="slider-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 without_slider">
                <div id="carousel1" class="carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">
                        <ol class="carousel-indicators">
                            @foreach($all_slider as $slider)
                            <li data-target="#carousel1" data-slide-to="{{ $slider->id }}" class="{{ $loop->first ? 'active' : ' ' }}"></li>
                            @endforeach
                        </ol>
                    </ol>

                    <div class="carousel-inner">
                        @foreach($all_slider as $slider)
                        <div class="carousel-item {{ $loop->first ? 'active' : ' ' }}">
                            <img class="d-block w-100" src="{{asset('uploads/slider')}}/{{$slider->image}}" alt=" ">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $slider->title }}</h5>
                                <p>{{ $slider->paragraph }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>