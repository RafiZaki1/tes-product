<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function executePurchase($productId, $quantity, $userId);
}