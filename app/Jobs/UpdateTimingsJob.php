<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Timing;
use Illuminate\Support\Facades\Log;

class UpdateTimingsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $selectedTimings;
    protected $newValues;

    /**
     * Create a new job instance.
     *
     * @param array $selectedTimings
     * @param array $newValues
     * @return void
     */
    public function __construct(array $selectedTimings, array $newValues)
    {
        $this->selectedTimings = $selectedTimings;
        $this->newValues = $newValues;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('UpdateTimingsJob handle method called', [
            'selectedTimings' => $this->selectedTimings,
            'newValues' => $this->newValues,
        ]);

        $affectedRows = Timing::whereIn('id', $this->selectedTimings)->update($this->newValues);

        Log::info('Rows affected:', ['count' => $affectedRows]);
    }

}
