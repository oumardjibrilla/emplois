<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class candidatureMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $prenom ,$titre;
    public function __construct($prenom , $titre)
    {
        $this->prenom = $prenom;
        $this->titre = $titre;
    }


   /*  /**
     * Get the message envelope.

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Candidature Mail',
        );
    }

    /**
     * Get the message content definition.

    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    } */

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

        return $this->from('oumardjibrilla18@gmail.com' , 'jobs')
                     ->subject('Candidature reçue – [Nom du poste]')
                     ->view('mail.candidature-candidat')
                     ->with([
                        'prenom' => $this->prenom,
                        'titre' => $this->titre,
                    ]);
    }
}
