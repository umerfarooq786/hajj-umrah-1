<?php

namespace App\Console\Commands;

use App\Models\Transport;
use App\Jobs\SendTransportValidityMails;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ProcessTransportValidity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:transport-validity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process transport validity and dispatch notifications.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $transports = Transport::with(['costs', 'vehicles', 'route'])->get();

        Log::info('Filtered Transports: ' . count($transports));
        foreach ($transports as $transport) {
            try {
                // Pass the id of the transport
                SendTransportValidityMails::dispatch($transport->id);
            } catch (\Exception $e) {
                Log::error('Failed to dispatch job: ' . $e->getMessage());
            }
        }

        $this->info('Transport validity expiration notifications dispatched successfully.');
    }
}
