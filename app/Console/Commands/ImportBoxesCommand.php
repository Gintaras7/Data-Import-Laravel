<?php

namespace App\Console\Commands;

use App\Contracts\SensorClientContract;
use App\Jobs\ImportBoxesJob;
use App\Services\OpenSenseBoxService;
use App\Utils\OpenSenseMap\OpenSenseMapUtils;
use Exception;
use Illuminate\Console\Command;

class ImportBoxesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:boxes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from service and create jobs';

    /**
     * Execute the console command.
     */
    public function handle(SensorClientContract $client)
    {
        $this->info('Fetching data');

        try {
            $fetched = $client->fetchBoxes();
            $boxes = $client->transformResponseToDto($fetched);

            collect($boxes)->chunk(2000)->each(function ($chunk) {
                ImportBoxesJob::dispatch($chunk);
            });

            $this->info('Jobs dispatched successfully!');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
