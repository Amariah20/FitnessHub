<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope; 
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


//used this for help: https://www.youtube.com/watch?v=xigpoxOW1MY (REFER TO IT FOR EXTRA STUFF)

class Marketing extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $message;
   // public $from;
   public $gymName;
   //public $gymURL;
   public  $gymEmail;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $message, $gymName, $gymEmail )
    {
        $this->subject= $subject;
        $this->message =$message;
        $this->gymName = $gymName;
        $this->gymEmail =  $gymEmail;
        //$this->gymURL=  $gymURL;
       // $from = "test@gmail.com"
    }

    public function build(){
        return $this->subject($this->subject)->markdown('MarketingEmail');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->gymEmail, $this->gymName),
        );
           
        
    }

    /*
    /**
     * Get the message content definition.
     *//*
    public function content(): Content
    {
        return new Content(
            markdown: 'MarketingEmail',
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
    } */
}
