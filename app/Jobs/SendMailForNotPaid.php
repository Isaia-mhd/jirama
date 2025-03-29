<?php

namespace App\Jobs;

use App\Mail\SendMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailForNotPaid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */


    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $status = 'Non Payé';
        $mail_sent = false;
        $today = Carbon::today()->toDateString();

        $clients = User::whereHas('releve', function ($query) use ($status, $mail_sent) {
            $query->where('status', $status)
                  ->where('email_sent', $mail_sent);
        })->get();

        foreach ($clients as $client) {
            foreach ($client->releve as $releve) {
                // Vérifiez que l'email n'a pas encore été envoyé et que la date correspond
                if (!$releve->email_sent && $releve->date_limite == $today) {
                    try {
                        Mail::to($client->email)->send(new SendMail($client));

                        $releve->update([
                            'email_sent' => true,
                        ]);

                        logger()->info("Ok mail was sent to " . $client->email);
                    } catch (\Exception $e) {
                        logger()->error("Failed to send mail to " . $client->email . ": " . $e->getMessage());
                    }
                }
            }
        }

    }

}
