<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\WarehouseOutput;

class WarehouseOutputFactory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:warehouse-outputs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        factory(WarehouseOutput::class, 10)->create();
    }
}
