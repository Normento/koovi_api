<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $subject;
    public $content;

    /**
     * Create a new message instance.
     *
     * @param  string  $subject
     * @param  string  $content
     * @return void
     */
    public function __construct($subject, $content)
    {
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('normento229@gmail.com', 'KOOVI')
            ->subject($this->subject)
            ->view('emails.campaign');
    }
}
