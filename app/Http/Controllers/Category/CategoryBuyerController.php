<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use App\Http\Controllers\ApiController;

class CategoryBuyerController extends ApiController
{
    /**
     * CategoryBuyerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @return void
     */
    public function index(Category $category)
    {
        $buyers = $category->products()
            ->whereHas('transactions')
            ->with('transactions.buyer')->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values();

        return $this->showAll($buyers);
    }
}
