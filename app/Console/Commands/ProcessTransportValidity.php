<?php

namespace App\Console\Commands;

use App\Models\Transport;
use App\Jobs\SendTransportValidityMails;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
        $today = Carbon::today()->toDateString();

        $transport = Transport::with(['costs', 'vehicles', 'route'])
            ->whereHas('costs', function($query) use ($today) {
                $query->where('validity_end', '>=', $today);
            })
            ->get();

        Log::info('Filtered Transports: ', $transport->toArray());

        foreach ($transport as $transports) {
            SendTransportValidityMails::dispatch($transports);
        }

        $this->info('Transport validity expiration notifications dispatched successfully.');
    }
}
