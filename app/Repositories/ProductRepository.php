<?php
namespace App\Repositories;

use App\Models\Product;
use Override;

class ProductRepository implements ProductRepositoryInterface
{
 
    public function getAll()
    {
        return Product::all();
    }

    #[Override]
    public function getById($id)
    {
        return Product::find($id);
    }

    #[Override]
    public function create(array $data)
    {
        return Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
        ]);
    }

    #[Override]
    public function update($id, array $data)
    {
        $product = Product::find($id);
        if (!$product) {
            return null;
        }
        $product->update($data);
        return $product;
    }

    #[Override]
    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return false;
        }
        return $product->delete();
    }
}