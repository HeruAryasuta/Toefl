<?php

namespace App\Mail;

use App\Models\Pendaftar;
use App\Models\JadwalTest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftar;
    public $users;
    public $jadwalTests;

    /**
     * Create a new message instance.
     */
    public function __construct($pendaftar, $users, $jadwalTests)
    {
        $this->pendaftar = $pendaftar;  // Sesuaikan penamaan variabel
        $this->users = $users;
        $this->jadwalTests = $jadwalTests;  // Sesuaikan penamaan variabel
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Pendaftaran Tes Berhasil',
    //     );
    // }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Pendaftaran Tes Berhasil')
                    ->view('backend.dashboard-user.pendaftaran_berhasil')
                    ->with([
                        'pendaftar' => $this->pendaftar,
                        'users' => $this->users,
                        'jadwal' => $this->jadwalTests,
                    ]);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'backend.dashboard-user.pendaftaran-user',
        );
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