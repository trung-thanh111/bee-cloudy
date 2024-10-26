<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp; // Thêm thuộc tính để lưu mã OTP

    /**
     * Tạo một instance mới.
     *
     * @param int $otp
     */
    public function __construct($otp)
    {
        $this->otp = $otp; // Gán mã OTP vào thuộc tính
    }

    /**
     * Lấy envelope của message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Otp Mail',
        );
    }

    /**
     * Lấy định nghĩa nội dung của message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'auth.mail.otp', // Chỉ định view sẽ sử dụng để gửi email
            with: [
                'otp' => $this->otp, // Truyền mã OTP vào view
            ],
        );
    }

    /**
     * Lấy các file đính kèm cho message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
