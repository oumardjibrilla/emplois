<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mailverifycation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $verificationUrl;
    public function __construct($verificationUrl)
    {
        $this->verificationUrl = $verificationUrl;
    }

    /*
     * Get the message envelope.

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mailverifycation',
        );
    }

    /**
     * Get the message content definition.

    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }
 */
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }


    public function build()
    {
        return $this->from('oumardjibrilla18@gmail.com' ,'jobs')
                    ->subject('confirmez votre e-mail')
                    ->view('mail.verifie-mail')
                    ->with([
                        'verificationUrl' => $this->verificationUrl,
                    ]);
    }
}
