<?php

namespace App\Handlers;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\OrderRepositoryInterface; 

class ProductHandler
{
    protected $productRepo;
    protected $orderRepo;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        OrderRepositoryInterface $orderRepo
    ) {
        $this->productRepo = $productRepo;
        $this->orderRepo = $orderRepo;
    }

    public function getAllProducts()
    {
        return $this->productRepo->getAll();
    }

    public function createProduct($data)
    {
        return $this->productRepo->create($data);
    }

    public function getProductById($id)
    {
        return $this->productRepo->getById($id);
    }

    public function updateProduct($id, $data)
    {
        return $this->productRepo->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepo->delete($id);
    }

    public function buyProduct($productId, $quantity, $userId)
    {
        $product = $this->productRepo->getById($productId);

        if (!$product) {
            throw new \Exception("Produk tidak ditemukan.");
        }

        if ($product->stock === 0) {
            throw new \Exception("Maaf, produk '" . $product->name . "' sudah habis terjual.");
        }

        if ($quantity > $product->stock) {
            throw new \Exception("Stok tidak mencukupi. Sisa stok tersedia: " . $product->stock . " pcs.");
        }
        return $this->orderRepo->executePurchase($productId, $quantity, $userId);
    }
}