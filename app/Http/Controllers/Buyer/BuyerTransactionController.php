<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use App\Http\Controllers\ApiController;

class BuyerTransactionController extends ApiController
{
    /**
     * BuyerTransactionController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $transactions = $buyer->transactions;
        return $this->showAll($transactions);
    }
}
