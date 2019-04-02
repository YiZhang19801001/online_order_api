<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\ProductHelper;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->helper = new ProductHelper();
    }

    public function index(Request $request)
    {
        $language_id = $request->input('language_id', 1);

        $productsList = $this->helper->makeProductsList($language_id);

        return response()->json(compact('productsList'), 200);
    }
}
