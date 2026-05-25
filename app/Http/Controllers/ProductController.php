<?php

namespace App\Http\Controllers;

use App\Handlers\ProductHandler; 
use App\Http\Requests\ProductRequest; 
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productHandler;

    public function __construct(ProductHandler $productHandler)
    {
        $this->productHandler = $productHandler;
    }
public function index()
    {
        $products = $this->productHandler->getAllProducts();

        if ($products->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Admin belum mengisi products. Silahkan menunggu beberapa saat lagi',
                'data'    => []
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Daftar produk berhasil diambil',
            'data'    => $products
        ], 200);
    }
    
    public function store(ProductRequest $request)
    {
        $dataBersih = $request->validated();

        $product = $this->productHandler->createProduct($dataBersih);

        return response()->json([
            'success' => true,
            'message' => 'Produk baru berhasil ditambahkan',
            'data'    => $product
        ], 201);
    }

    public function show($id)
    {
        $product = $this->productHandler->getProductById($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail produk berhasil diambil',
            'data'    => $product
        ], 200);
    }

    public function update(ProductRequest $request, $id)
    {
        $dataBersih = $request->validated();
        $product = $this->productHandler->updateProduct($id, $dataBersih);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data'    => $product
        ], 200);
    }

    public function destroy($id)
    {
        $deleted = $this->productHandler->deleteProduct($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }
}