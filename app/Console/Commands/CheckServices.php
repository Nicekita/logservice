<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(private \App\Actions\CheckServices $checkServices)
    {
        parent::__construct();

    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->checkServices->execute();
    }
}
