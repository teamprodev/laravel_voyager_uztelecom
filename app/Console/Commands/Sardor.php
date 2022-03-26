<?php

namespace App\Console\Commands;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Models\SignedDocs;
use App\Observers\SignDocsObserver;
use App\Services\ApplicationService;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class Sardor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sardor:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sardor';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SignedDocs $signedDocs)
    {
        $service = new SignDocsObserver();
        $service->created($signedDocs);
    }
}
