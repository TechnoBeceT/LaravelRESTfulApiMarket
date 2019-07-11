<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Transaction;
use App\Http\Controllers\ApiController;

class TransactionSellerController extends ApiController
{
    /**
     * TransactionSellerController constructor.
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
    public function index(Transaction $transaction)
    {
        $seller = $transaction->product->seller;
        return $this->showOne($seller);
    }
}
