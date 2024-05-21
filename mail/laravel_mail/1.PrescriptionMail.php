<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PrescriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->from(config('mail.from.address'), $this->data['sp_name'])
            ->subject('Your prescription from ' . $this->data['sp_name'])
            ->view('mail.prescription_send')
            ->with([
                'patient_id' => $this->data['patient_id'],
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'mobile' => $this->data['mobile'],
                'visit_date' => $this->data['visit_date'],
                'sp_logo' => $this->data['sp_logo'],
                'sp_name' => $this->data['sp_name'],
                'prescription_download' => $this->data['prescription_download'],
            ]);

        // Attach the PDF file if it exists
        if (isset($this->data['prescription_file']) && file_exists($this->data['prescription_file'])) {
            $email->attach($this->data['prescription_file']);
        }

        return $email;
    }
}
