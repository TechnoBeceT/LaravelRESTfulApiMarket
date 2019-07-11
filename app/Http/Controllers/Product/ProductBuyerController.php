<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Http\Controllers\ApiController;

class ProductBuyerController extends ApiController
{
    /**
     * ProductBuyerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $buyers = $product->transactions()
            ->with('buyer')->get()
            ->pluck('buyer')
            ->unique('id')
            ->values();

        return $this->showAll($buyers);
    }
}
