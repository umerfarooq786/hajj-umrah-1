<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Transport;
use App\Mail\TransportThreeDayMail;
use App\Mail\TransportTwoDayMail;
use App\Mail\TransportOneDayMail;
use App\Mail\TransportSevenDayMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class SendTransportValidityMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transports;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transport $transport)
    {
        $this->transports = $transport;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->transports->costs as $cost) {
            $validity = $cost->validity_end;
            $validity = Carbon::parse($validity);
            $sevenDaysBeforeValidity = $validity->copy()->subDays(7);
            $threeDaysBeforeValidity = $validity->copy()->subDays(3);
            $twoDaysBeforeValidity = $validity->copy()->subDays(2);
            $oneDaysBeforeValidity = $validity->copy()->subDays(1);
            $currentDate = now();
            

            if ($currentDate->isSameDay($sevenDaysBeforeValidity)) {
                Log::info('Transport expiration is within 7 days.');
                // Uncomment and implement email sending logic if necessary
                $mail = new TransportSevenDayMail($this->transports);
                $mail->from('example@gmail.com', 'Hajj & Ummrah');
                Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
            } elseif ($currentDate->isSameDay($threeDaysBeforeValidity)) {
                Log::info('Transport expiration is within 3 days.');
                $mail = new TransportThreeDayMail($this->transports);
                $mail->from('example@gmail.com', 'Hajj & Ummrah');
                Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
            } elseif ($currentDate->isSameDay($twoDaysBeforeValidity)) {
                Log::info('Transport expiration is within 2 days.');
                $mail = new TransportTwoDayMail($this->transports);
                $mail->from('example@gmail.com', 'Hajj & Ummrah');
                Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
            } elseif ($currentDate->isSameDay($oneDaysBeforeValidity)) {
                Log::info('Transport expiration is within 1 days.');
                $mail = new TransportOneDayMail($this->transports);
                $mail->from('example@gmail.com', 'Hajj & Ummrah');
                Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
            }
        }
    }
}
