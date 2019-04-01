<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sku;
use Illuminate\Http\Request;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sku::all();
    }
}
