<?php

namespace App\Jobs;

use App\Events\ImportDataJobFinished;
use App\Events\ImportDataJobStarted;
use App\Imports\ImportData;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ImportDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    /**
     * Create a new job instance.
     *
     * @param string $filePath
     * @return void
     */
    public function __construct($filePath)
    {
        Log::info("From ImportDataJob cpnstrunct");
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try{
            Log::info('Starting import from: ' . $this->filePath);
            event(new ImportDataJobStarted);
            // Initialize Spout reader
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->open($this->filePath);

            $rows = [];
            $chunkSize = 100;
            $importData = new ImportData();

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();
                    $rowArray = [];

                    foreach ($cells as $cell) {
                        $rowArray[] = $cell->getValue();
                    }

                    $rows[] = $rowArray;

                    // When chunk size is reached, process the chunk
                    if (count($rows) >= $chunkSize) {
                        $this->processChunk($rows, $importData);
                        $rows = []; // Reset rows for the next chunk
                    }
                }

                // Process any remaining rows
                if (!empty($rows)) {
                    $this->processChunk($rows, $importData);
                }
            }

            $reader->close();
            event(new ImportDataJobFinished);
        }  catch (Throwable $e) {
            Log::error('Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Process a chunk of rows
     *
     * @param array $rows
     * @param ImportData $importData
     * @return void
     */
    protected function processChunk(array $rows, ImportData $importData)
    {
        Log::info("From process chunck");
        foreach ($rows as $row) {
            $importData->model($row);
        }
    }
}
