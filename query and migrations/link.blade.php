
  <a class="learn_more" href="/service-provider/{{ $item->featuredServiceProviderType->slug }}/{{ $item->slug }}">{{ trans("text.learn_more") }} <i class="fa fa-angle-double-right"></i></a>

  <a type="button" class="btn btn-info btn-sm text-white" href="{{ url('tsr-admin/patient-visits/bp-rbs-weight/'.$patient->id) }}" class="text-white" target="_blank"> View Data</a>

   <img class="preview_logo" src="/images/doctors/{{ $doctor->id }}_large_{{$doctor->doctor_image}}" alt="{{ $doctor->title_en }}">

    <img  src="{{asset('uploads/header')}}/{{$header->favicon}}" id="output_image" width="50px" style="padding-top: 5px;" />