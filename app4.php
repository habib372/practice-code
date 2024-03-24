<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content custom_model">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel"> Create New Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="appointment_date" class="form-control-label">Date:</label>
                        <input type="text" class="form-control m-input--solid" id="appointment_date" name="appointment_date" readonly>
                    </div>
                    <div class="form-group">
                        <label for="start_time" class="form-control-label">Start Time:</label>
                        <input type="text" class="form-control m-input--solid" id="start_time" name="start_time" readonly>
                    </div>
                    <div class="form-group">
                        <label for="end_time" class="form-control-label">End Time:</label>
                        <input type="text" class="form-control" id="end_time" name="end_time">
                    </div>
                    <div class="form-group">
                        <label for="remarks" class="form-control-label">Remarks:</label>
                        <textarea class="form-control" id="remarks" name="remarks"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="saveAppointment">
                    Save Appointment
                </button>
                <button type="button" class="btn btn-danger" id="deleteAppointment">
                    Delete
                </button>
                <input type="hidden" id="appointment_id" name="appointment_id" value="" />
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel">
                    Create New Appointment
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="appointment_date" class="form-control-label">Date:</label>
                        <input type="text" class="form-control m-input--solid" id="appointment_date" name="appointment_date" readonly>
                    </div>
                    <div class="form-group">
                        <label for="start_time" class="form-control-label">Start Time:</label>
                        <input type="text" class="form-control m-input--solid" id="start_time" name="start_time" readonly>
                    </div>
                    <div class="form-group">
                        <label for="end_time" class="form-control-label">End Time:</label>
                        <input type="text" class="form-control" id="end_time" name="end_time">
                    </div>
                    <div class="form-group">
                        <label for="remarks" class="form-control-label">Remarks:</label>
                        <textarea class="form-control" id="remarks" name="remarks"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="saveAppointment">
                    Save Appointment
                </button>
                <button type="button" class="btn btn-danger" id="deleteAppointment">
                    Delete
                </button>
                <input type="hidden" id="appointment_id" name="appointment_id" value="" />
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->


