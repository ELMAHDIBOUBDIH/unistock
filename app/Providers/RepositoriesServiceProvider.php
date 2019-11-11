<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton(
                'App\Repositories\Category\CategoryRepository', 'App\Repositories\Category\EloquentCategoryRepository'
        );
        $this->app->singleton(
                'App\Repositories\Customer\CustomerRepository', 'App\Repositories\Customer\EloquentCustomerRepository'
        );
        $this->app->singleton(
                'App\Repositories\CustomerGroup\CustomerGroupRepository', 'App\Repositories\CustomerGroup\EloquentCustomerGroupRepository'
        );
        $this->app->singleton(
                'App\Repositories\CustomerVersement\CustomerVersementRepository', 'App\Repositories\CustomerVersement\EloquentCustomerVersementRepository'
        );
        $this->app->singleton(
                'App\Repositories\Answer\AnswerRepository', 'App\Repositories\Answer\EloquentAnswerRepository'
        );
        $this->app->singleton(
                'App\Repositories\Employee\EmployeeRepository', 'App\Repositories\Employee\EloquentEmployeeRepository'
        );
        $this->app->singleton(
                'App\Repositories\PriceProduct\PriceProductRepository', 'App\Repositories\PriceProduct\EloquentPriceProductRepository'
        );
        $this->app->singleton(
                'App\Repositories\Product\ProductRepository', 'App\Repositories\Product\EloquentProductRepository'
        );
        $this->app->singleton(
                'App\Repositories\Purchase\PurchaseRepository', 'App\Repositories\Purchase\EloquentPurchaseRepository'
        );
        $this->app->singleton(
                'App\Repositories\PurchaseDetail\PurchaseDetailRepository', 'App\Repositories\PurchaseDetail\EloquentPurchaseDetailRepository'
        );
        $this->app->singleton(
                'App\Repositories\Sale\SaleRepository', 'App\Repositories\Sale\EloquentSaleRepository'
        );
        $this->app->singleton(
                'App\Repositories\SaleDetail\SaleDetailRepository', 'App\Repositories\SaleDetail\EloquentSaleDetailRepository'
        );
        $this->app->singleton(
                'App\Repositories\Supplier\SupplierRepository', 'App\Repositories\Supplier\EloquentSupplierRepository'
        );
        $this->app->singleton(
                'App\Repositories\SupplierVersement\SupplierVersementRepository', 'App\Repositories\SupplierVersement\EloquentSupplierVersementRepository'
        );
        $this->app->singleton(
                'App\Repositories\Warehouse\WarehouseRepository', 'App\Repositories\Warehouse\EloquentWarehouseRepository'
        );
        $this->app->singleton(
                'App\Repositories\WarehouseInput\WarehouseInputRepository', 'App\Repositories\WarehouseInput\EloquentWarehouseInputRepository'
        );
        $this->app->singleton(
                'App\Repositories\WarehouseOutput\WarehouseOutputRepository', 'App\Repositories\WarehouseOutput\EloquentWarehouseOutputRepository'
        );
        $this->app->singleton(
                'App\Repositories\WarehouseProduct\WarehouseProductRepository', 'App\Repositories\WarehouseProduct\EloquentWarehouseProductRepository'
        );
         $this->app->singleton(
                'App\Repositories\Compte\CompteRepository', 'App\Repositories\Compte\EloquentCompteRepository'
        );
          $this->app->singleton(
                'App\Repositories\PaymentMode\PaymentModeRepository', 'App\Repositories\PaymentMode\EloquentPaymentModeRepository'
        );
          $this->app->singleton(
                'App\Repositories\Brand\BrandRepository', 'App\Repositories\Brand\EloquentBrandRepository'
        );
    }

}
