<?php

namespace App\Jobs;

use App\Mail\EmailForQueuing;
use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $email_id;
    public function __construct($email_id)
    {
        $this->email_id = $email_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailDB = Email::find($this->email_id);
        $mail = new EmailForQueuing();
        $mail = $mail->from($emailDB->user->email)
        ->to($emailDB->destiny)
        ->view('email.email', ['email' => $emailDB]);;
        Mail::send($mail);
        $emailDB->state = 'sended';
        $emailDB->save();
    }
}
