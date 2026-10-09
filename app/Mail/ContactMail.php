<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    /**
     * Tạo instance mới của email
     *
     * @param array $contactData
     */
    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Xác định envelope của email
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Liên hệ từ website'
        );
    }

    /**
     * Xác định nội dung email
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'fontend.mail.contact',  // View cho email
            with: [
                'contactData' => $this->contactData
            ]
        );
    }

    /**
     * Xác định các tệp đính kèm
     */
    public function attachments(): array
    {
        return [];
    }
}
