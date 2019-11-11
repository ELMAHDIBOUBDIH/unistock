<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CategoryFactory::class,
        Commands\SupplierFactory::class,
        Commands\ProductFactory::class,
        Commands\CustomerGroupFactory::class,
        Commands\CustomerFactory::class,//5
        Commands\PriceProductFactory::class,
        Commands\EmployeeFactory::class,
        Commands\SaleFactory::class,
        Commands\SaleDetailFactory::class,
        Commands\PurchaseFactory::class,//10
        Commands\PurchaseDetailFactory::class,
        Commands\SupplierVersementsFactory::class,
        Commands\CustomerVersementFactory::class,
        Commands\WarehouseFactory::class,
        Commands\WarehouseProductFactory::class,//15
        Commands\WarehouseOutputFactory::class,
        Commands\WarehouseInputFactory::class,
        Commands\CompteFactory::class,
        Commands\BrandFactory::class,
        Commands\InvoicesFactory::class,//20
        Commands\PaymentModeFactory::class,//20

        Commands\FixeTranslation::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
