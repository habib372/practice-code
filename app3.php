<div class="cancer-treatment">
    <h6 class="mb-2"> Chemotherapy Sessions</h6>
    @foreach($patient->chemotherapies as $chemotherapy)
    @if($chemotherapy->status == 'Discharged')
        <div class="cancer-treatment_item">
            <div class="treatment_item-head" role="button" data-toggle="modal" data-target="#chemotherapyModal_{{ $chemotherapy->id }}" aria-expanded="false">
                <span class="treatment_item-icon">
                    <i class="fa fa-medkit"></i>
                </span>
                <h6 class="treatment_item-title">
                    <span>Chemotherapy Session</span> From
                    <span>{{ date('d-M-Y', strtotime($chemotherapy->date_of_admission)) }}</span>
                    to
                    <span>{{ date('d-M-Y', strtotime($chemotherapy->date_of_discharge)) }}</span>
                </h6>
            </div>
    </div>
    @endif
    @endforeach
</div>