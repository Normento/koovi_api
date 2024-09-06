<?php

namespace App\Jobs;

use App\Mail\CampaignMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $recipients;

    /**
     * Create a new job instance.
     *
     * @param  mixed  $email
     * @param  array  $recipients
     * @return void
     */
    public function __construct($email, array $recipients)
    {
        $this->email = $email;
        $this->recipients = $recipients;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $subject = $this->email->subject;
        $content = $this->email->content;

        foreach ($this->recipients as $recipient) {
            Mail::to($recipient)
                ->send(new CampaignMail($subject, $content));
        }

        $this->email->update(['status'=>'sent']);
    }
}
