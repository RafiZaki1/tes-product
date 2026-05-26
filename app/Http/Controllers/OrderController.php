<?php

namespace App\Http\Controllers;

use App\Handlers\ProductHandler;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $productHandler;

    public function __construct(ProductHandler $productHandler)
    {
        $this->productHandler = $productHandler;
    }

    public function store(OrderRequest $request)
    {
        $data = $request->validated();
        $userId = $request->user()->id; 

        try {
            $receipt = $this->productHandler->buyProduct($data['product_id'], $data['quantity'], $userId);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil! Stok produk otomatis diperbarui.',
                'data'    => $receipt
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}