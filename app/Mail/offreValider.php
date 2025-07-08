<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class offreValider extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $titre ,$prenom;
    public function __construct($titre ,$prenom)
    {
        $this->titre = $titre;
        $this->prenom= $prenom;
    }

    /**
     * Get the message envelope.
     */
    public function build(){
            return $this->from('oumardjibrilla18@gmail.com')
                                ->subject('Votre offre d’emploi est en ligne')
                                ->view('mail.valider-offres')
                                ->with([
                                    'titre'=>$this->titre,
                                    'prenom'=>$this->prenom,
                                ]);
                }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
