<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Override;

class ProductRepository implements ProductRepositoryInterface
{
    protected $cacheKey = 'product_all';

    public function getAll()
    {

        return Cache::remember($this->cacheKey, 3600, function () {
            return Product::all();
        });
    }

    #[Override]
    public function getById($id)
    {
        return Product::find($id);
    }

    #[Override]
    public function create(array $data)
    {
        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
        ]);

        Cache::forget($this->cacheKey);

        return $product;
    }

    #[Override]
    public function update($id, array $data)
    {
        $product = Product::find($id);
        if (!$product) {
            return null;
        }
        $product->update($data);

        Cache::forget($this->cacheKey);

        return $product;
    }

    #[Override]
    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return false;
        }
        
        $deleted = $product->delete();

        if ($deleted) {
            Cache::forget($this->cacheKey);
        }

        return $deleted;
    }
}