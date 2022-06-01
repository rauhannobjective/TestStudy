<?php

namespace App\Models;

use App\Entities\Product;
use Exception;

class ProductModel
{
    private Product $productEntity;

    public function __construct(Product $productEntity)
    {
        $this->productEntity = $productEntity;
    }

    /**
     * Retorna um produto pelo id.
     *
     * @param integer $id
     * @return Product
     */
    public function getById(int $id): Product
    {
        $product = $this->productEntity->find($id);

        if (!$product) {
            throw new Exception('Produto não encontrado');
        }

        return $product;
    }
}
