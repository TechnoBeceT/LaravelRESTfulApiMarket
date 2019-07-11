<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Transaction;
use App\Http\Controllers\ApiController;

class TransactionController extends ApiController
{
    /**
     * TransactionController constructor.
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
    public function index()
    {
        $transactions = Transaction::all();

        return $this->showAll($transactions);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return $this->showOne($transaction);
    }
}
