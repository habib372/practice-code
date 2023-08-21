<!--begin::Section-->
<div class="m-section">
    <div class="m-section__content">
        {{-- <h5>Patient Info</h5> --}}

        <table class="table table-bordered m-table">
            <tbody>
                <tr>
                    <td rowspan="10" width="125">
                        @if(!empty($patient->photo))
                        <img src="/images/patients/{{$patient->photo}}" height="120" width="120" style="border-radius: 50%;" />
                        @else
                        <img src="/images/avatar.jpg" height="120" width="120" />
                        @endif
                    </td>
                    <td colspan="2">
                        <h1>{{$patient->name}}</h1>
                    </td>
                </tr>
                <tr>
                    <td><strong>Gender: </strong> {{ $patient->gender }}</td>
                    <td><strong>Patient ID: </strong> {{ $patient->id }}</td>
                </tr>
                <tr>

                    <td><strong>Date of Birth: </strong> {{ $patient->date_of_birth }}</td>
                    <td>
                        <strong>Disease Type: </strong> {{ $patient->disease_type->name_en }}<br />
                        <strong>Disease </strong> {{ $patient->disease->name_en }}<br />
                        @if(($patient->stage))
                        <strong>Stage: </strong> {{isset($patient->stage) ? $patient->stage->stage_en : null}}
                        @endif
                    </td>
                </tr>
                <tr>

                    <td>
                        <strong>Mobile: </strong> {{ $patient->mobile }}<br />
                        <strong>Email: </strong> {{ $patient->email }}<br />
                        <strong>Phone: </strong> {{ $patient->phone }}<br />
                    </td>
                    <td>
                        <strong>Address: </strong> {{ $patient->address }}<br />
                        <strong>District: </strong> {{isset($patient->district) ? $patient->district->name : null}}<br />
                        <strong>Country: </strong> {{isset($patient->country) ? $patient->country->name : null}}<br />
                    </td>
                </tr>
                <tr>

                    <td><strong>Profession: </strong> {{ $patient->profession }}</td>
                    <td><strong>Allergies: </strong> {{ $patient->allergies }}</td>
                </tr>
                <tr>

                    <td><strong>Registration Date: </strong> {{ $patient->registration_date }}</td>

                </tr>
                <tr>

                    {{-- <td colspan="2">
								<strong>Referral Doctor: </strong> {{isset($patient->referredDoctor) ? $patient->referredDoctor->name : null}}
                    </td> --}}

                </tr>
                @foreach($patient->carers as $carer)
                <tr>

                    <td><strong>Guardian: </strong> {{ $carer->name }}</td>
                    <td><strong>Mobile: </strong> {{ $carer->mobile }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <br />


        <h5 class="margin-left-10">Medical History</h5>
        @forelse($visits as $visit)

        @php
        $sc_Comment = App\Models\SuperConsultantComment::where('patient_visit_id',$visit->id)->first();
        @endphp

        <div class="m-accordion m-accordion--bordered" id="m_accordion_{{ $visit->id }}" role="tablist">
            <!--begin::Item-->
            <div class="m-accordion__item">
                <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_{{ $visit->id }}_item_{{ $visit->id }}_head" data-toggle="collapse" href="#m_accordion_{{ $visit->id }}_item_{{ $visit->id }}_body" aria-expanded="false">
                    <span class="m-accordion__item-icon">
                        <i class="fa fa-stethoscope"></i>
                    </span>
                    <span class="m-accordion__item-title">
                        <strong>Doctor's Consultation</strong> on <strong>{{ date('d-M-Y', strtotime($visit->visit_date)) }}</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                    </span>

                    @if(!empty($sc_Comment->comment))
                    <span class="m-accordion__item-icon">
                        <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                            <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger m-animate-blink"></span>
                            <span class="m-nav__link-icon m-animate-shake">
                                <i class="flaticon-music-2"></i>
                            </span>
                        </a>
                    </span>
                    @endif

                    <span class="m-accordion__item-mode"></span>
                </div>
                <div class="m-accordion__item-body collapse" id="m_accordion_{{ $visit->id }}_item_{{ $visit->id }}_body" role="tabpanel" aria-labelledby="m_accordion_{{ $visit->id }}_item_{{ $visit->id }}_head" data-parent="#m_accordion_{{ $visit->id }}" style="">
                    <div class="m-accordion__item-content">
                        <table class="table table-bordered m-table">
                            <tbody>
                                <tr style="background: #f3f5f4;">
                                    <td><strong>Branch: </strong> {{$visit->serviceProvider->name_en ?? ''}}</td>
                                </tr>
                                <tr style="background: #f3f5f4;">
                                    <td><strong>Consultant: </strong> {{$visit->doctor->name_en ?? ''}}</td>
                                </tr>
                                @if(!empty($visit->history))
                                <tr style="background: #f3f5f4;">
                                    <td><strong>History</strong></td>
                                </tr>
                                <tr>
                                    <td>{!! $visit->history !!}</td>
                                </tr>
                                @endif
                                @if(!empty($visit->examination))
                                <tr style="background: #f3f5f4;">
                                    <td><strong>Examination</strong></td>
                                </tr>
                                <tr>
                                    <td>{!! $visit->examination !!}</td>
                                </tr>
                                @endif
                                @if(!empty($visit->recommendation))
                                <tr style="background: #f3f5f4;">
                                    <td><strong>Recommendation</strong></td>
                                </tr>
                                <tr>
                                    <td>{!! $visit->recommendation !!}</td>
                                </tr>
                                @endif
                                @if(!empty($visit->diagnosis))
                                <tr style="background: #f3f5f4;">
                                    <td><strong>Diagnosis</strong></td>
                                </tr>
                                <tr>
                                    <td>{!! $visit->diagnosis !!}</td>
                                </tr>
                                @endif

                                <tr style="background: #f3f5f4;">
                                    <td><strong>Vital signs at the time of the Consultation</strong></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="table table-bordered m-table">
                                            <tr>
                                                <td><strong>Weight : </strong> {{ $visit->weight }}</td>
                                                <td><strong>Creatinine : </strong> {{ $visit->creatinine }}</td>
                                                <td><strong>HB : </strong> {{ $visit->hb }}</td>
                                                <td><strong>WCC : </strong> {{ $visit->wcc }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Height : </strong> {{ $visit->height }}</td>
                                                <td><strong>BSA/BMI : </strong> {{ $visit->bsa }}</td>
                                                <td><strong>BP : </strong> {{ $visit->bp }}</td>
                                                <td><strong>RBS : </strong> {{ $visit->rbs }}</td>
                                            </tr>
                                            <tr>
                                                @if($visit->pregnency_status)
                                                <td><strong>Pregnency Status : </strong> {{ $visit->pregnency_status }}</td>
                                                @endif
                                                @if($visit->smoker)
                                                <td><strong>Smoker : </strong> {{ $visit->smoker }}</td>
                                                @endif
                                                @if($visit->drinker)
                                                <td><strong>Drinker : </strong> {{ $visit->drinker }}</td>
                                                @endif
                                                @if($visit->vaccination_status)
                                                <td><strong>Vaccination Status : </strong> {{ $visit->vaccination_status }}</td>
                                                @endif
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr style="background: #f3f5f4;">
                                    <td><strong>Investigations</strong></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="table table-bordered m-table">
                                            <tr>
                                                <td>Investigation</td>
                                                <td>Reason/Findings</td>
                                            </tr>
                                            @forelse($visit->examinations as $examination)
                                            <tr>
                                                <td>{{($examination->examination_name == '[ Insert Investigation ] --') ? $examination->other_name : $examination->examination_name}}</td>
                                                <td>{{$examination->reason}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="2">No Investigation Prescribed</td>
                                            </tr>
                                            @endforelse
                                        </table>
                                    </td>
                                </tr>

                                <tr style="background: #f3f5f4;">
                                    <td><strong>Medicines</strong></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="table table-bordered m-table">
                                            <tr>
                                                <td>Medicine</td>
                                                <td>Strength</td>
                                                <td>Route</td>
                                                <td>Solution</td>
                                                <td>Duration</td>
                                            </tr>
                                            @forelse($visit->medicines as $medicine)
                                            <tr>
                                                <td>{{($medicine->medicine_name == '-- [ Insert Medicine ] --') ? $medicine->other_name : $medicine->medicine_name}}</td>
                                                <td>{{$medicine->dosage}}</td>
                                                <td>{{$medicine->repeat}}</td>
                                                <td>{{$medicine->remarks}}</td>
                                                <td>{{$medicine->duration}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4">No Medicine Prescribed</td>
                                            </tr>
                                            @endforelse
                                        </table>
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                        <!---super consultant comment-->
                        <div class="borders_color">
                            <table class="table m-table">
                                <tr style="background: #f3f5f4;">
                                    <td class="sc_title">Super Consultant Comment</td>
                                </tr>
                                <tr>
                                    <td>
                                        @if(empty($sc_Comment->comment))
                                        <textarea class="sc_comment" name="comment" rows="1" value="" id="super_comment_{{$sc_Comment->id ?? $visit->id}}" disabled>{{ $sc_Comment->comment ?? 'No comment' }} </textarea>
                                        @else
                                        <textarea class="sc_comment" name="comment" rows="4" value="" id="super_comment_{{$sc_Comment->id ?? $visit->id}}" disabled>{{ $sc_Comment->comment ?? 'No comment' }} </textarea>
                                        @endif

                                        @if(!auth('doctor')->check() && (auth()->user()->user_role_id==5))
                                        @if(!empty($sc_Comment->comment))
                                        <div class="comment-button">
                                            <a data-name="{{$sc_Comment->comment
																}}" data-id="{{ $sc_Comment->id }}" class="commentData btn btn-primary btn-sm" href="#" role="button" title="Edit details" data-toggle="modal" data-target="#exampleModalCenter">Edit Comment</a>&nbsp;&nbsp;

                                            <form action="{{ route('tsr-admin.send_comment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="doctor_name" value="{{ $visit->doctor->name_en  }}">
                                                <input type="hidden" name="consultation_date" value="{{ $visit->visit_date  }}">
                                                <input type="hidden" name="patient_name" value="{{ $patient->name }}">
                                                <input type="hidden" name="doctor_email" value="{{ $visit->doctor->email  }}">
                                                <input type="hidden" name="comment" value="{{ $sc_Comment->comment  }}">
                                                <input type="hidden" name="super_consultant_name" value="{{ auth()->user()->name  }}">

                                                <button type="submit" class=" btn btn-primary btn-sm comment_send" id="" title="Send mail to doctor"><i class="fa fa-envelope"></i></button>&nbsp;
                                            </form>
                                        </div>

                                        @else
                                        <a class="addData btn btn-primary btn-sm" href="#" role="button" data-patient_id="{{ $visit->id }}" title="Add Comment" data-toggle="modal" data-target="#exampleModalCenter">Add Comment</a>&nbsp;&nbsp;
                                        @endif
                                        @endif
                                        @if(!auth('doctor')->check() && (auth()->user()->user_role_id==1))
                                        @if(!empty($sc_Comment->comment))
                                        <a id="" data-id="{{ $sc_Comment->id }}" class="btn btn-primary btn-sm delete_btn" href="#" role="button" title="Delete"><i class="la la-trash"></i></a>
                                        @endif
                                        @endif

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Comment</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" id="form_submit">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="sc-comment">Comment</label>
                                                                <textarea class="form-control" id="sc-comment" rows="6" name="comment"></textarea>
                                                            </div>
                                                            <input type="hidden" id="comment_id" name="comment_id" value="">
                                                            <input type="hidden" id="visit_id" name="visit_id">
                                                            <input type="hidden" id="visit_doctor" name="visit_doctor" value="{{ $visit->doctor->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                    </td>
                                </tr>

                            </table>
                        </div>


                    </div>
                </div>


            </div>
            <!--end::Item-->
        </div>
        @empty
        No Medical History Found
        @endforelse
        <br />

    </div>
</div>
<!--end::Section-->
<script>
    $(document).ready(function() {
        $(document).on('click', '.commentData', function() {
            var id = $(this).data('id');
            var comment = $(this).data('name');
            $('#sc-comment').val(comment);
            $('#comment_id').val(id);
            $('#visit_id').val('');
            $('#exampleModalCenter').modal('show');
        });
        $(document).on('click', '.addData', function() {
            var id = $(this).data('patient_id');
            $('#exampleModalCenter').modal('show');
            $('#visit_id').val(id);
            $('#comment_id').val();
        });
        // $(document).on('click', '.comment_send', function(){
        // 	var id = $(this).data('id');
        // 	var dr_name = $('input[name="doctor_name_"+id]').val();
        // 	alert(dr_name);

        // });

        $(document).on('submit', '#form_submit', function(e) {
            e.preventDefault();

            var url = "{{ route('tsr-admin.edit_comment') }}";
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url, // Replace 'your-route' with the actual route name
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.message) {
                        $('#form_submit')[0].reset();

                        $('#super_comment_' + response.data.id).val(response.data.comment);
                        $('#exampleModalCenter').modal('hide');
                    }
                },
                error: function(error) {
                    console.log(error); // Handle any errors
                }

            });
        });
        $(document).on('click', '.closecomment', function(e) {
            e.preventDefault();
            $('#exampleModalCenter').modal('hide');
        });

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault;
            var id = $(this).data('id');
            var userConfirmed = confirm('Area you Sure to delete this?There is no undo');
            var url = "{{ route('tsr-admin.delete_comment') }}";
            if (userConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: url, // Replace 'your-route' with the actual route name
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.message) {

                            $('#super_comment_' + id).val('No comment');
                            // $('#exampleModalCenter').modal('hide');
                        }
                    },
                    error: function(error) {
                        console.log(error); // Handle any errors
                    }

                });
            }
        })
    });
</script>