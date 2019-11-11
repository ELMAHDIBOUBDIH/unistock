<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


    Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);

    //categories
    Route::resource('categories', 'CategoryController', ['except' => ['create']]);

    //brands
    Route::resource('brands', 'BrandController', ['except' => ['create']]);

    //comptes
    Route::resource('comptes', 'CompteController', ['except' => ['create']]);

    //paymentmodes
    Route::resource('paymentmodes', 'PaymentModeController', ['except' => ['create']]);

    //warehouses
    Route::resource('warehouses', 'WarehouseController', ['except' => ['create','show','edit']]);
    Route::resource('warehouseproducts', 'WarehouseProductController', ['except' => ['create','edit']]);

    //products
    Route::get('/products/search', ['as' => 'products.search', 'uses' => 'ProductController@search']);
    Route::resource('products', 'ProductController');
    Route::resource('priceproducts', 'PriceProductController' , ['except' => ['create','show','edit']] );

    //suppliers
    Route::get('/suppliers/search', ['as' => 'suppliers.search', 'uses' => 'SupplierController@search']);
    Route::resource('suppliers', 'SupplierController');
    Route::resource('suppliervers', 'SupplierVersementController');

    //customers
    Route::get('/customers/search', ['as' => 'customers.search', 'uses' => 'CustomerController@search']);
    Route::resource('customers', 'CustomerController');
    Route::resource('customervers', 'CustomerVersementController');
    Route::resource('customergroups', 'CustomerGroupController' , ['except' => ['create','show','edit']] );


    //purchases
    Route::get('/purchases/orders', ['as' => 'purchases.orders', 'uses' => 'PurchaseController@index']);
    Route::get('/purchases/purchase-receives', ['as' => 'purchases.purchase.receives', 'uses' => 'PurchaseController@index']);
    Route::get('/purchases/bills', ['as' => 'purchases.bills', 'uses' => 'PurchaseController@index']);
    Route::get('/purchases/supplier-regulations', ['as' => 'purchases.supplier.regulations', 'uses' => 'PurchaseController@index']);
    Route::get('/purchases/supplier-returns', ['as' => 'purchases.supplier.returns', 'uses' => 'PurchaseController@index']);
    Route::get('/purchases/orders-not-received', ['as' => 'purchases.orders.not.received', 'uses' => 'PurchaseController@index']);
    Route::resource('purchases', 'PurchaseController');
    Route::resource('purchasedetails', 'PurchasedetailController',['except' => ['index','edit','show']]);
    Route::get('/purchasedetails/index/{purchase}', ['as' => 'index', 'uses' => 'PurchasedetailController@index']);
    Route::get('/purchases/create/{type}', ['as' => 'purchases.create.order', 'uses' => 'PurchasedetailController@create']);

    //users
    Route::get('/users/search', ['as' => 'users.search', 'uses' => 'EmployeeController@search']);

    Route::resource('users', 'EmployeeController');

    //sales
    Route::get('/sales/quotations', ['as' => 'sales.quotations', 'uses' => 'SaleController@index']);
    Route::get('/sales/orders', ['as' => 'sales.orders', 'uses' => 'SaleController@index']);
    Route::get('/sales/invoices', ['as' => 'sales.invoices', 'uses' => 'SaleController@index']);
    Route::get('/sales/client-regulations', ['as' => 'sales.client.regulations', 'uses' => 'SaleController@index']);
    Route::get('/sales/client-returns', ['as' => 'sales.client.returns', 'uses' => 'SaleController@index']);
    Route::get('/sales/create/{type}', ['as' => 'sales.create.order', 'uses' => 'SaleController@index']);
    Route::resource('sales', 'SaleController');
    Route::resource('saledetails', 'SaledetailController',['except' => ['index','create','edit','show']]);
    Route::get('/saledetails/index/{sale}', ['as' => 'index', 'uses' => 'SaledetailController@index']);

    /* reports */
    Route::get('/reports', ['as' => 'reports.index', 'uses' => 'ReportsController@index']);
    Route::get('/reports/purchaseorder', ['as' => 'reports.purchaseorder', 'uses' => 'ReportsController@purchaseorder']);
    Route::get('/reports/receive', ['as' => 'reports.receive', 'uses' => 'ReportsController@receive']);
    Route::get('/reports/purchasebyvendor', ['as' => 'reports.purchasebyvendor', 'uses' => 'ReportsController@purchasebyvendor']);
    Route::get('/reports/purchasesbyitem', ['as' => 'reports.purchasesbyitem', 'uses' => 'ReportsController@purchasesbyitem']);
    Route::get('/reports/billdetails', ['as' => 'reports.billdetails', 'uses' => 'ReportsController@billdetails']);
    Route::get('/reports/paymentmade', ['as' => 'reports.paymentmade', 'uses' => 'ReportsController@paymentmade']);
    Route::get('/reports/salesorder', ['as' => 'reports.salesorder', 'uses' => 'ReportsController@salesorder']);
    Route::get('/reports/invoice', ['as' => 'reports.invoice', 'uses' => 'ReportsController@invoice']);
    Route::get('/reports/payment', ['as' => 'reports.payment', 'uses' => 'ReportsController@payment']);
    Route::get('/reports/salesbycustomer', ['as' => 'reports.salesbycustomer', 'uses' => 'ReportsController@salesbycustomer']);
    Route::get('/reports/salesbyitem', ['as' => 'reports.salesbyitem', 'uses' => 'ReportsController@salesbyitem']);
    Route::get('/reports/salesbysp', ['as' => 'reports.salesbysp', 'uses' => 'ReportsController@salesbysp']);
    Route::get('/reports/customerbalance', ['as' => 'reports.customerbalance', 'uses' => 'ReportsController@customerbalance']);
    Route::get('/reports/productsales', ['as' => 'reports.productsales', 'uses' => 'ReportsController@productsales']);
    Route::get('/reports/productpurchase', ['as' => 'reports.productpurchase', 'uses' => 'ReportsController@productpurchase']);
    Route::get('/reports/inventory', ['as' => 'reports.inventory', 'uses' => 'ReportsController@inventory']);
    Route::get('/reports/inventoryvaluation', ['as' => 'reports.inventoryvaluation', 'uses' => 'ReportsController@inventoryvaluation']);
    Route::get('/reports/fifocostlottracking', ['as' => 'reports.fifocostlottracking', 'uses' => 'ReportsController@fifocostlottracking']);
    Route::get('/reports/warehouse', ['as' => 'reports.warehouse', 'uses' => 'ReportsController@warehouse']);

    /* images */
    Route::post('/images/upload', array('as' => 'images.upload', 'uses' => 'ImageController@upload'));
    Route::delete('/images/{item}', array('as' => 'images.delete', 'uses' => 'ImageController@delete'));
