<?php

namespace App\Mail;

use App\Models\AdmissionEnquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewEnquiryAlert extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public AdmissionEnquiry $enquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New admission enquiry from '.$this->enquiry->parent_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.enquiry-alert',
        );
    }
}
