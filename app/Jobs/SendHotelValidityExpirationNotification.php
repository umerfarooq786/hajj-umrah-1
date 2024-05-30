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

    protected $Hotel_room;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(HotelRoom $Hotel_room)
    {
        $this->Hotel_room = $Hotel_room;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $validity = Carbon::parse($this->Hotel_room->validity_end);
        $sevenDaysBeforeValidity = $validity->copy()->subDays(7);
        $threeDaysBeforeValidity = $validity->copy()->subDays(3);
        $twoDaysBeforeValidity = $validity->copy()->subDays(2);
        $oneDaysBeforeValidity = $validity->copy()->subDays(1);
        $currentDate = now();
        $alreadySentNotification = false;

        if ($currentDate->isSameDay($sevenDaysBeforeValidity)) {
            if (!$alreadySentNotification) {
                // Uncomment and implement email sending logic if necessary
                $mail = new ValidityNotificationMail($this->Hotel_room);
                $mail->from('example@gmail.com', 'Hajj & Ummrah');
                Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                // Set the flag to true to prevent sending multiple notifications
                $alreadySentNotification = true;
            }
        } elseif ($currentDate->isSameDay($threeDaysBeforeValidity)) {
            if (!$alreadySentNotification) {
                $mail = new ValidityThreeDaysNotificationMail($this->Hotel_room);
                $mail->from('example@gmail.com', 'Hajj & Ummrah');
                Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                $alreadySentNotification = true;
            }
        } elseif ($currentDate->isSameDay($twoDaysBeforeValidity)) {
            if (!$alreadySentNotification) {
                $mail = new ValidityTwoDaysNotificationMail($this->Hotel_room);
                $mail->from('example@gmail.com', 'Hajj & Ummrah');
                Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                $alreadySentNotification = true;
            }
        } elseif ($currentDate->isSameDay($oneDaysBeforeValidity)) {
            if (!$alreadySentNotification) {
                $mail = new ValidityOneDayNotificationMail($this->Hotel_room);
                $mail->from('example@gmail.com', 'Hajj & Ummrah');
                Mail::to('fastlinetraveltours.pk@gmail.com')->send($mail);
                $alreadySentNotification = true;
            }
        }
    }
}
