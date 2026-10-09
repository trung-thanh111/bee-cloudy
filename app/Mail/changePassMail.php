<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class changePassMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;

    /**
     * Tạo một instance mới của thông điệp
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Lấy envelope của thông điệp
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Xác nhận thay đổi mật khẩu',
        );
    }

    /**
     * Lấy định nghĩa nội dung thông điệp
     */
    public function content(): Content
    {
        return new Content(
            view: 'fontend.mail.changePass',
            with: [
                'url' => $this->url,
            ]
        );
    }

    /**
     * Lấy các tệp đính kèm cho thông điệp
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
