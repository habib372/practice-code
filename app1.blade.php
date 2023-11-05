<div class="tab-pane" id="tab_new_visit" role="tabpanel">
									<div id="visit-info">

										<div class="form-group m-form__group">
											<div class="row">
												<div class="col-md-6">
													<label for="name">
														Doctor Type <span class="text-danger">*</span>
													</label>
													<div class="m-radio-inline">
														<label class="m-radio">
															<input type="radio" name="visit_type" id="visit_type_internal_doctor" class="visit-type" value="Internal Doctor" <?= old('visit_type') == 'Internal Doctor' ? 'checked='.'"checked"' : ''; ?> />
															Internal Doctor
															<span></span>
														</label>
														<label class="m-radio">
															<input type="radio" name="visit_type" id="visit_type_external_doctor" class="visit-type" value="External Doctor" <?= old('visit_type') == 'External Doctor' ? 'checked='.'"checked"' : ''; ?>>
															External Doctor
															<span></span>
														</label>
													</div>
													@error('visit_type')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
												<div class="col-md-6">
													<div id="doctorHolder" <?= old('visit_type') == 'Internal Doctor' ? 'style="display:block"' : 'style="display:none"'; ?>>
														<label for="visit_doctor_id">
															Select Internal Doctor <span class="text-danger">*</span>
														</label>
														{!! Form::select('visit_doctor_id', $doctors, null, ['class' => 'form-control m-input', 'id' => 'visit_doctor_id']) !!}
														@error('visit_doctor_id')
															<span class="text-danger">{{$message}}</span>
														@enderror
													</div>
													<div id="outDoctorHolder" <?= old('visit_type') == 'External Doctor' ? 'style="display:block"' : 'style="display:none"'; ?>>
														<label for="external_doctor">
															External Doctor <span class="text-danger">*</span>
														</label>
														<textarea name="external_doctor" class="form-control m-input" id="external_doctor" rows="3">{{ old('external_doctor') }}</textarea>

														@error('external_doctor')
															<span class="text-danger">{{$message}}</span>
														@enderror
													</div>
												</div>
											</div>
										</div>

										<div class="form-group m-form__group ">
											<div class="row">

												<div class="col-md-6">
													<label for="visit_service_provider_id">
														Branch <span class="text-danger">*</span>
													</label>
													@if(auth()->user()->user_role_id==3)
														<input type="text" class="form-control m-input" value="{{ Custom::get_service_provider_info()->name_en }}" readonly />
														<!-- {!! Custom::get_service_provider_info()->name_en !!} -->
													@else
														{!! Form::select('visit_service_provider_id', $serviceProviders, null, ['class' => 'form-control m-input', 'id' => 'visit_service_provider_id']) !!}
														@error('visit_service_provider_id')
															<span class="text-danger">{{$message}}</span>
														@enderror
													@endif
												</div>
												<div class="col-md-6">
													<label for="visit_service_id">
														Service <span class="text-danger">*</span>
													</label>
													{!! Form::select('visit_service_id', $services, null, ['class' => 'form-control m-input', 'id' => 'visit_service_id']) !!}
													@error('visit_service_id')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>
										<div class="form-group m-form__group">
											<div class="row">
												<div class="col-md-6">
													<label for="visit_date">
														Visit Date<span class="text-danger">*</span>
													</label>
													<div class="input-group date">
														<input type="text" class="form-control m-input datepicker" readonly="" placeholder="Select date" name="visit_date" id="visit_date" value="{{ old('visit_date') }}">
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-calendar-check-o"></i>
															</span>
														</div>
													</div>
													@error('visit_date')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
												<div class="col-md-6">
													<label for="visit_age">Age<span class="text-danger">*</span></label>
													<input type="text" name="visit_age" class="form-control m-input" id="visit_age" value="{{ old('visit_age') }}" />
													@error('visit_age')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>
										<div class="form-group m-form__group">
											<div class="row">
												<div class="col-md-6">
													<label for="visit_reason">Reason</label>
													<textarea name="visit_reason" class="form-control m-input" id="visit_reason" rows="3">{{ old('visit_reason') }}</textarea>
													@error('visit_reason')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
												<div class="col-md-6">
													<label for="visit_recommendation">Recommendation</label>
													<textarea name="visit_recommendation" class="form-control m-input" id="visit_recommendation" rows="3">{{ old('visit_recommendation') }}</textarea>
													@error('visit_recommendation')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>

										<div class="form-group m-form__group">
											<div class="row">
												<div class="col-md-12" id="attributesHolder">
													<!--Ajax Content will load here-->
													{{-- <label for="visit_reason">Other Attributes</label>
													@for($i=0;$i<3;$i++)
													<div class="row patient-attributes">
														<div class="col-md-4">
															<input type="text" class="form-control m-input" name="visit_attributes_name[{{$i}}]" id="visit_attributes_name_{{$i}}">
														</div>
														<div class="col-md-4">
															<input type="text" class="form-control m-input" name="visit_attributes_value[{{$i}}]" id="visit_attributes_value_{{$i}}">
														</div>
														@if($i==2)
														<div class="col-md-2">
															<a href="javascript:void(0)" id="addMoreAttributes" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
																<span>
																	<i class="la la-plus"></i>
																	<span>Add More</span>
																</span>
															</a>
														</div>
														@endif
													</div>
													<br />
													@endfor --}}

												</div>

											</div>
										</div>



										<div class="form-group m-form__group">
											<label for="visit_note">Note</label>
											<textarea name="visit_note" class="form-control m-input" id="visit_note" rows="3">{{ old('visit_note') }}</textarea>
											@error('visit_note')
												<span class="text-danger">{{$message}}</span>
											@enderror
										</div>


									</div>
								</div>