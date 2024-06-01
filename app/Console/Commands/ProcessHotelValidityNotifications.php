<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendHotelValidityExpirationNotification;
use App\Models\HotelRoom;
use App\Models\Room;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ProcessHotelValidityNotifications extends Command
{
    protected $signature = 'process:hotel-validity-notifications';

    protected $description = 'Dispatch hotel validity expiration notifications';

    public function handle()
    {



        $hotelRooms = HotelRoom::with('hotel')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MIN(id)'))
                    ->from('hotel_rooms')
                    ->groupBy('hotel_id');
            })
            ->get();

        Log::info('Filtered hotels count: ' . count($hotelRooms));
        foreach ($hotelRooms as $hotelRoom) {
            try {
                // Pass the id of the transport
                SendHotelValidityExpirationNotification::dispatch($hotelRoom->id);
            } catch (\Exception $e) {
                Log::error('Failed to dispatch job: ' . $e->getMessage());
            }
        }


        $this->info('Hotel validity expiration notifications dispatched successfully.');
    }
}
