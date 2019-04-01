<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\{Order, User};
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'data.notes' => 'string|nullable',
            'data.skus' => 'array',
            'data.skus.*.id' => 'required|exists:skus,id',
            'data.skus.*.data.text' => 'required|string',
            'data.user.name' => 'required|string',
            'data.user.phone.area' => 'required|digits_between:3,4',
            'data.user.phone.country' => 'required|digits_between:1,2',
            'data.user.phone.number' => 'required|digits_between:6,7',
        ]);

        $userPhone = implode('-', [
            $request->json('data.user.phone.country'),
            $request->json('data.user.phone.area'),
            $request->json('data.user.phone.number'),
        ]);

        $user = User::firstOrCreate(['phone' => $userPhone], [
            'name' => $request->json('data.user.name')
        ]);

        $order = $user->orders()->create();

        if (is_array($request->json('data.skus'))) {
            $order->skus()->sync(array_pluck($request->json('data.skus'), 'id'));

            $order->refresh();

            foreach ($order->skus as $sku) {
                $skuData = collect($request->json('data.skus'))->where('id', $sku->id)->first();
                $sku->pivot->fill($skuData)->save();
            }
        }

        return $order;
    }
}
