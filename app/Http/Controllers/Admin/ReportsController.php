<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Sale\SaleRepository;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(SaleRepository $sale)
    {
      $this->sale = $sale;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function purchaseorder()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receive()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function purchasebyvendor()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function purchasesbyitem()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function billdetails()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentmade()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function salesorder()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoice()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function salesbycustomer()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function salesbyitem()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function salesbysp()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerbalance()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productsales()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productpurchase()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventory()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventoryvaluation()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fifocostlottracking()
    {
        $report_items = [];

        return compact('report_items');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function warehouse()
    {
        $report_items = [];

        return compact('report_items');
    }


}
