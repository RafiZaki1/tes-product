<?php

namespace App\Handlers;

use App\Repositories\ProductRepositoryInterface;

class ProductHandler
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
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
}