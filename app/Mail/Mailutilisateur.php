<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mailutilisateur extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $nom ,$prenom;


    public function __construct($nom , $prenom )
    {
        $this->nom = $nom;
        $this->prenom = $prenom;


    }

    /**
     * Get the message envelope.
     */
 /*    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mailutilisateur',
        );
    } */

    /**
     * Get the message content definition.
     */
/*     public function content(): Content
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

    public function build(){
            return $this->from('oumardjibrilla18@gmail.com' , 'jobs')
                        ->subject('Bienvenue !')
                        ->view('mail.bienvenue')
                        ->with([
                            'nom' =>$this->nom,
                            'prenom' =>$this->prenom

                          ]);



    }
}
