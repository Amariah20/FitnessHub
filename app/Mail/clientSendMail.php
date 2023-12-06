<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


//used this for help: https://www.youtube.com/watch?v=xigpoxOW1MY (REFER TO IT FOR EXTRA STUFF)

class clientSendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $message;
    public $name;
    public $email;
    public $number;

    /**
     * Create a new message instance.
     */
    public function __construct($name,$email,$number,  $subject,  $message )
    {
        $this->subject= $subject;
        $this->message =$message;
        $this->name= $name;
        $this->email =$email;
        $this->number =$number;
    }

    public function build(){
        return $this->subject($this->subject)->markdown('ClientEmail');
    }

    /**
     * Get the message envelope.
     *//*
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Client Send Mail',
        );
    }*?

    /**
     * Get the message content definition.
     *//*
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }*/

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     *//*
    public function attachments(): array
    {
        return [];
    }*/
}
