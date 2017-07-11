<?php

namespace App\Jobs;

use App\Company;
use App\Mail\ReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendReport implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lstCompanies = Company::with(['stands.event', 'user'])->get();
        $data = [];

        foreach ($lstCompanies as $key => $oCompany) {
            if (count($oCompany->stands) > 0) {
                $data[] = [
                    'event' => $oCompany->stands[0]->event->name,
                    'stand' => $oCompany->stands[0]->number,
                    'price' => $oCompany->stands[0]->price,
                    'company' => $oCompany->name,
                    'contact' => $oCompany->user->email
                ];
            }
        }

        usort($data, function ($a, $b) {
            return strnatcmp($a['event'], $b['event']);
        });

        Mail::to(env('MAIL_ADMIN'))->queue(new ReportMail($data));
    }
}
