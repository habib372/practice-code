

  {!! Str::limit($item->description, 600, '.. <br/><a class="learn_more" href="/service-provider/'.$item->featuredServiceProviderType->slug.'/'.$item->slug.'">'.trans("text.learn_more").' <i class="fa fa-angle-double-right"></i></a>') !!}

    {!! Str::limit($item->description, 600) !!}
    <a class="learn_more" href="/service-provider/{{ $item->featuredServiceProviderType->slug }}/{{ $item->slug }}">{{ trans("text.learn_more") }} <i class="fa fa-angle-double-right"></i></a>