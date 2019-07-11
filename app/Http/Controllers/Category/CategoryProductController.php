<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use App\Http\Controllers\ApiController;

class CategoryProductController extends ApiController
{

    /**
     * CategoryProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $products = $category->products;

        return $this->showAll($products);
    }
}
