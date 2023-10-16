@forelse($patient->chemotherapies as $chemotherapy)
    @if($chemotherapy->status == 'Discharged')
    <div class="m-accordion m-accordion--bordered" id="chemo_accordion_{{ $chemotherapy->id }}" role="tablist">
        <!--begin::Item-->
        <div class="m-accordion__item">
            <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_{{ $chemotherapy->id }}_item_{{ $chemotherapy->id }}_head" data-toggle="collapse" href="#m_accordion_{{ $chemotherapy->id }}_item_{{ $chemotherapy->id }}_body" aria-expanded="false">
                <span class="m-accordion__item-icon">
                    <i class="fa fa-medkit"></i>
                </span>
                <span class="m-accordion__item-title">
                    <strong>Chemotherapy Session</strong> from <strong>{{ date('d-M-Y', strtotime($chemotherapy->date_of_admission)) }}</strong> to <strong>{{ date('d-M-Y', strtotime($chemotherapy->date_of_discharge)) }}</strong>
                </span>
                <span class="m-accordion__item-mode"></span>
            </div>
            <div class="m-accordion__item-body collapse" id="m_accordion_{{ $chemotherapy->id }}_item_{{ $chemotherapy->id }}_body" role="tabpanel" aria-labelledby="m_accordion_{{ $chemotherapy->id }}_item_{{ $chemotherapy->id }}_head" data-parent="#chemo_accordion_{{ $chemotherapy->id }}" style="">
                <div class="m-accordion__item-content">
                    <table class="table table-bordered m-table">
                        <tbody>
                            <tr style="background: #f3f5f4;">
                                <td><strong>Service Provider: </strong> {{$chemotherapy->serviceProvider->name_en ?? ''}}</td>
                            </tr>
                            <tr style="background: #f3f5f4;">
                                <td>
                                    <strong>Consultant: </strong>
                                    @if(!empty($chemotherapy->referralDoctor))
                                    {{$chemotherapy->referralDoctor->title_en.' '.$chemotherapy->referralDoctor->name_en}}
                                    @else
                                    {{$chemotherapy->external_doctor}}
                                    @endif
                                </td>
                            </tr>
                            @if(!empty(strip_tags($chemotherapy->principal_diagnosis)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Principal Diagnosis</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->principal_diagnosis !!}</td>
                            </tr>
                            @endif
                            @if(!empty(strip_tags($chemotherapy->hospital_course)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Hospital Course</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->hospital_course !!}</td>
                            </tr>
                            @endif
                            @if(!empty(strip_tags($chemotherapy->chemotherapy_received)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Chemotherapy Received</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->chemotherapy_received !!}</td>
                            </tr>
                            @endif
                            @if(!empty(strip_tags($chemotherapy->discharge_medications)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Discharge Medications</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->discharge_medications !!}</td>
                            </tr>
                            @endif
                            @if(!empty(strip_tags($chemotherapy->recommendations)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Recommendations</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->recommendations !!}</td>
                            </tr>
                            @endif
                            @if(!empty(strip_tags($chemotherapy->other_diagnosis)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Other Diagnosis</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->other_diagnosis !!}</td>
                            </tr>
                            @endif
                            @if(!empty(strip_tags($chemotherapy->important_investigations)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Important Investigations</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->important_investigations !!}</td>
                            </tr>
                            @endif
                            @if(!empty(strip_tags($chemotherapy->procedures)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Procedures</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->procedures !!}</td>
                            </tr>
                            @endif
                            @if(!empty(strip_tags($chemotherapy->complications)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Complications</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->complications !!}</td>
                            </tr>
                            @endif
                            @if(!empty(strip_tags($chemotherapy->comments)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Any Other Comments</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->comments !!}</td>
                            </tr>
                            @endif
                            @if(!empty(strip_tags($chemotherapy->future_appointment)))
                            <tr style="background: #f3f5f4;">
                                <td><strong>Future Appointments</strong></td>
                            </tr>
                            <tr>
                                <td>{!! $chemotherapy->future_appointment !!}</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Item-->
    </div>
    @endif
@empty
    No Chemo History Found
@endforelse