<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use App\Http\Controllers\ApiController;

class CategorySellerController extends ApiController
{
    /**
     * CategorySellerController constructor.
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
    public function index(Category $category)
    {
        $sellers = $category->products()
            ->with('seller')->get()
            ->pluck('seller')
            ->unique('id')
            ->values();

        return $this->showAll($sellers);
    }
}
