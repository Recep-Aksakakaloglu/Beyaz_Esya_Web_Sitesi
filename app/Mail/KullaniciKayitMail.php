<?php

namespace App\Mail;

use App\Models\Models\Kullanici;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KullaniciKayitMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kullanici;

    /**
     * Create a new message instance.
     */
    public function __construct(Kullanici $kullanici)
    {
        $this->kullanici = $kullanici;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kullanici Kayit Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            //view: 'view.name',
            //$this->subject(config('app.name').'Kullanıcı Kaydı')->view('mails.kullanici_kayit'),
            //subject(config('app.name').'Kullanıcı Kaydı'),
            view : 'mails.kullanici_kayit',
        );
        //return $this->subject(config('app.name').'Kullanıcı Kaydı')->view('mails.kullanici_kayit');
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

    public function build(){
        return $this->subject(config('app.name').'Kullanıcı Kaydı')->view('mails.kullanici_kayit');
    }
}
