<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use App\Http\Controllers\ApiController;

class SellerTransactionController extends ApiController
{
    /**
     * SellerTransactionController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @param Seller $seller
     * @return void
     */
    public function index(Seller $seller)
    {
        $transactions = $seller->products()
            ->whereHas('transactions')
            ->with('transactions')->get()
            ->pluck('transactions')
            ->collapse();

        return $this->showAll($transactions);
    }
}
