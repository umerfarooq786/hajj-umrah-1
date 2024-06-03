<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function runCommand(Request $request)
    {
        // Example: Run a simple Artisan command
        Artisan::call('cache:clear');

        // Example: Run a custom Artisan command
        // Artisan::call('your:custom-command');

        return response()->json(['message' => 'Command executed successfully']);
    }

    public function runTransportValidityCommand(Request $request)
    {
        Artisan::call('process:transport-validity');

        return response()->json(['message' => 'ProcessTransportValidity command executed successfully']);
    }

    public function runHotelValidityNotificationsCommand(Request $request)
    {
        Artisan::call('process:hotel-validity-notifications');

        return response()->json(['message' => 'ProcessHotelValidityNotifications command executed successfully']);
    }

    public function runQueueWork(Request $request)
    {
        // Running the queue worker as a background process
        exec('php artisan queue:work --daemon > /dev/null &');

        return response()->json(['message' => 'Queue worker started successfully']);
    }
}
