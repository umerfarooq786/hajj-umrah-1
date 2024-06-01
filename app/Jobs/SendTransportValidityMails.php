<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Transport;
use App\Mail\TransportThreeDayMail;
use App\Mail\TransportTwoDayMail;
use App\Mail\TransportOneDayMail;
use App\Mail\TransportSevenDayMail;
use App\Models\HotelRoom;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendTransportValidityMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transportId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transportId)
    {
        $this->transportId = $transportId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info('Transport ID: ' . $this->transportId);
            $transport = Transport::with(['costs', 'vehicles', 'route'])->find($this->transportId);

            if ($transport && !empty($transport->costs)) {
                foreach ($transport->costs as $cost) {
                    if ($cost->validity_end) {
                        $validity = Carbon::parse($cost->validity_end);

                        $sevenDaysBeforeValidity = $validity->copy()->subDays(7);
                        $threeDaysBeforeValidity = $validity->copy()->subDays(3);
                        $twoDaysBeforeValidity = $validity->copy()->subDays(2);
                        $oneDayBeforeValidity = $validity->copy()->subDays(1);
                        $currentDate = now();
                        Log::info('No valid costs found for Transport ID: ' . $sevenDaysBeforeValidity);

                        if ($currentDate->isSameDay($sevenDaysBeforeValidity)) {
                            Log::info('Seven days before validity: ' . $sevenDaysBeforeValidity);
                            $mail = new TransportSevenDayMail($transport);
                            $mail->from('example@gmail.com', 'Hajj & Ummrah');
                            Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                        } elseif ($currentDate->isSameDay($threeDaysBeforeValidity)) {
                            Log::info('Three days before validity: ' . $threeDaysBeforeValidity);
                            $mail = new TransportThreeDayMail($transport);
                            $mail->from('example@gmail.com', 'Hajj & Ummrah');
                            Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                        } elseif ($currentDate->isSameDay($twoDaysBeforeValidity)) {
                            Log::info('Two days before validity: ' . $twoDaysBeforeValidity);
                            $mail = new TransportTwoDayMail($transport);
                            $mail->from('example@gmail.com', 'Hajj & Ummrah');
                            Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                        } elseif ($currentDate->isSameDay($oneDayBeforeValidity)) {
                            Log::info('One day before validity: ' . $oneDayBeforeValidity);
                            $mail = new TransportOneDayMail($transport);
                            $mail->from('example@gmail.com', 'Hajj & Ummrah');
                            Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                        }
                    } else {
                        Log::info('Cost validity_end is null for cost ID: ' . $cost->id);
                    }
                }
            } else {
                Log::info('No valid costs found for Transport ID: ' . $this->transportId);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send emails for Transport ID: ' . $this->transportId . '. Error: ' . $e->getMessage(), [
                'transportId' => $this->transportId
            ]);
            throw $e; // Re-throw the exception to ensure the job can be retried
        }
    }
}



