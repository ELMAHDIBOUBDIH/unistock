<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\WarehouseProduct;

class WarehouseProductFactory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:warehouse-products';

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
        factory(WarehouseProduct::class, 10)->create();
    }
}
