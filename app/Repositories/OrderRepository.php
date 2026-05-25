<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class OrderRepository implements OrderRepositoryInterface
{
    public function executePurchase($productId, $quantity, $userId)
    {
        return DB::transaction(function () use ($productId, $quantity, $userId) {

            $product = Product::lockForUpdate()->find($productId);

            $product->decrement('stock', $quantity);

            Cache::forget('product_all');

            return [
                'product_name' => $product->name,
                'remaining_stock' => $product->stock,
                'purchased_quantity' => $quantity,
                'buyer_id' => $userId
            ];
        });
    }
}