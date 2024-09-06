<?php

namespace App\Observers;

use App\Models\Email;
use App\Jobs\SendEmailCampaign;

class EmailObserver
{
    /**
     * Handle the Email "created" event.
     */
    public function created(Email $email)
    {
        $recipients = $email->newsletters->pluck('email')->toArray(); // Assurez-vous que vous obtenez les e-mails correctement
        $subject = $email->subject;
        $content = $email->content;

        // Dispatch the job to send emails
        SendEmailCampaign::dispatch($email, $recipients)
            ->delay($email->scheduled_at ? $email->scheduled_at : now());
    }

    /**
     * Handle the Email "updated" event.
     */
    public function updated(Email $email): void
    {
        //
    }

    /**
     * Handle the Email "deleted" event.
     */
    public function deleted(Email $email): void
    {
        //
    }

    /**
     * Handle the Email "restored" event.
     */
    public function restored(Email $email): void
    {
        //
    }

    /**
     * Handle the Email "force deleted" event.
     */
    public function forceDeleted(Email $email): void
    {
        //
    }
}
