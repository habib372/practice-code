

  {!! Str::limit($item->description, 600, '.. <br/><a class="learn_more" href="/service-provider/'.$item->featuredServiceProviderType->slug.'/'.$item->slug.'">'.trans("text.learn_more").' <i class="fa fa-angle-double-right"></i></a>') !!}

    {!! Str::limit($item->description, 600) !!}
    <a class="learn_more" href="/service-provider/{{ $item->featuredServiceProviderType->slug }}/{{ $item->slug }}">{{ trans("text.learn_more") }} <i class="fa fa-angle-double-right"></i></a>


    <!-- Limit to the first two items -->
<div class="cancer-treatment">
    @forelse ($visits as $key => $visit)
    @if ($key < 2) <!-- Limit to the first two items -->
        <div class="cancer-treatment_item">
            <div class="treatment_item-head" role="button" data-toggle="modal" data-target="#visitDetailsModal_{{ $visit->id }}" aria-expanded="false">
                <span class="treatment_item-icon">
                    <i class="fa fa-stethoscope"></i>
                </span>
                <h6 class="treatment_item-title">
                    <span>Doctor's Consultation</span> on <span>{{ date('d-M-Y', strtotime($visit->visit_date)) }}</span>
                </h6>
            </div>
        </div>
        @endif
        @empty
        No Medical History Found
        @endforelse
</div>