<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $filePath;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $filePath)
    {
        $this->data = $data;
        $this->filePath = $filePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['subject'], // Menggunakan subject dari data
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.send_email', // Pastikan file view ada di resources/views/emails/send_email.blade.php
            with: ['content' => $this->data['content']], // Data content dikirim ke view
        );
    }

    public function build()
    {
        // Menambahkan attachment PDF
        $message = $this->subject($this->data['subject'])
                        ->view('emails.send_email', ['content' => $this->data['content']]);

        // Melampirkan PDF dari path yang disediakan
        $message->attach(Storage::disk('public')->path($this->filePath), [
            'as' => 'invitation_' . basename($this->filePath),
            'mime' => 'application/pdf',
        ]);

        return $message;
    }
}
