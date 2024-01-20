{{-- desing --}}
<input type="text" class="linkUrl" id="customEmail" placeholder="Enter custom email" value=""><button class="join-btn" id="customEmailSend">Send </button>

{{-- ajax --}}
<script>
// Custom email send
  $('#customEmailSend').click(function () {
      var customEmail = $('#customEmail').val();

      // Regular expression for basic email validation
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (customEmail != null && customEmail.trim() !== '') {
          if (emailRegex.test(customEmail)) {
              emailSend();
              alert('Meeting link has been sent to the email');
          } else {
              alert('Please enter a valid email address');
          }
      } else {
          alert('Please enter an email address');
      }
  });
  //email send function
  function emailSend(){
    var url = "{{url('meeting-link-sent')}}";
    var patientName = "{{session()->get('patinet_name')}}" ;
    var patientEmail = "{{session()->get('patinet_email')}}" ;
    var linkUrl = $('#linkUrl').val();
    var customEmail = $('#customEmail ').val();
    $.ajax({
      url : url,
      headers:{
        'X-CSRF-TOKEN':'{{csrf_token()}}'
      },
      data:{
        'url' : linkUrl,
        'patient_name':patientName,
        'patient_email':patientEmail,
        'custom_email':customEmail
      },
      type:'post',
      success:function (result){

      }
    })
  }
  </script>

  {{-- route --}}
  Route::post('meeting-link-sent', 'MeetingController@meetingSent')->name('meetingSent');

  {{-- controller --}}
   public function meetingSent(Request $request)
    {
        $username = $request->subject_username ?? ' Roaming'; // Default to 'admin' if not provided

        \Mail::send(
            'emails.meeting_sent',
            array(
                'url' => $request->url,
                'patient_name' => $request->patient_name,
                'patient_email' => $request->patient_email,
                'custom_email' => $request->custom_email
            ),
            function ($message) use ($request, $username) {
                $message->from('admin@domain.com', $username);
                if ($request->custom_email !=null) {
                    $message->to($request->custom_email)->subject('Video Consultation Meeting Link from' . $username);
                }else{
                    $message->to($request->patient_email)->subject('Video Consultation Meeting Link from '. $username);
                }
            }
        );
    }