<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Transformers\TransactionTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    /**
     * ProductBuyerTransactionController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:' . TransactionTransformer::class)->only('store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $buyer
     * @param Product $product
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Product $product, User $buyer)
    {
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request, $rules);

        if ($buyer->id == $product->seller_id) {
            return $this->errorResponse('The buyer must be different from the seller.', 409);
        }

        if (!$buyer->isVerified()) {
            return $this->errorResponse('The buyer must be verified user', 409);
        }

        if (!$product->seller->isVerified()) {
            return $this->errorResponse('The seller must be verified user', 409);
        }

        if (!$product->isAvailable()) {
            return $this->errorResponse('Product is not available', 409);
        }

        if ($product->quantity < $request->quantity) {
            return $this->errorResponse('The product does not have enough units for this transaction', 409);
        }

        return DB::transaction(function () use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);

            return $this->showOne($transaction);
        });

    }
}
