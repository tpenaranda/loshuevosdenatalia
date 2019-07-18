<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function get()
    {
        return app('store');
    }

    public function open()
    {
        return app('store')->open();
    }

    public function close()
    {
        return app('store')->close();
    }
}
