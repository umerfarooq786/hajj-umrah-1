<?php

namespace App\Jobs;

use App\Models\HotelRoom;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ValidityNotificationMail;
use App\Mail\ValidityThreeDaysNotificationMail;
use App\Mail\ValidityTwoDaysNotificationMail;
use App\Mail\ValidityOneDayNotificationMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendHotelValidityExpirationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $hotelId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($hotelId)
    {
        $this->hotelId = $hotelId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $hotelRoom = HotelRoom::with('hotel')->find($this->hotelId);
            
            if ($hotelRoom && !empty($hotelRoom->hotel)) {
                $validity = Carbon::parse($hotelRoom->validity_end);
                Log::info('Hotel validity: ' . $validity);
                $sevenDaysBeforeValidity = $validity->copy()->subDays(7);
                $threeDaysBeforeValidity = $validity->copy()->subDays(3);
                $twoDaysBeforeValidity = $validity->copy()->subDays(2);
                $oneDaysBeforeValidity = $validity->copy()->subDays(1);
                $currentDate = now();
        
                if ($currentDate->isSameDay($sevenDaysBeforeValidity)) {
        
                    // Uncomment and implement email sending logic if necessary
                    $mail = new ValidityNotificationMail($hotelRoom);
                    $mail->from('example@gmail.com', 'Hajj & Ummrah');
                    Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                    // Set the flag to true to prevent sending multiple notifications
        
        
                } elseif ($currentDate->isSameDay($threeDaysBeforeValidity)) {
        
                    $mail = new ValidityThreeDaysNotificationMail($hotelRoom);
                    $mail->from('example@gmail.com', 'Hajj & Ummrah');
                    Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                } elseif ($currentDate->isSameDay($twoDaysBeforeValidity)) {
        
                    $mail = new ValidityTwoDaysNotificationMail($hotelRoom);
                    $mail->from('example@gmail.com', 'Hajj & Ummrah');
                    Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                } elseif ($currentDate->isSameDay($oneDaysBeforeValidity)) {
        
                    $mail = new ValidityOneDayNotificationMail($hotelRoom);
                    $mail->from('example@gmail.com', 'Hajj & Ummrah');
                    Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                }
            } else {
                Log::info('No valid costs found for Transport ID: ') ;
            }
        } catch (\Exception $e) {
            Log::error('Failed to send emails for Transport ID: ' . $this->hotelId . '. Error: ' . $e->getMessage(), [
                'transportId' => $this->hotelId
            ]);
            throw $e; // Re-throw the exception to ensure the job can be retried
        }
    }
}

  

