<?php

namespace App\Models;

use App\Entities\Cart;
use App\Services\CorreiosService;
use Exception;

class CartModel
{
    private Cart $cartEntity;
    private ProductModel $productModel;
    private CorreiosService $correiosService;

    public function __construct(
        Cart $cartEntity,
        ProductModel $productModel,
        CorreiosService $correiosService
    ) {
        $this->cartEntity = $cartEntity;
        $this->productModel = $productModel;
        $this->correiosService = $correiosService;
    }

    /**
     * Adiciona um produto ao carrinho.
     *
     * @param integer $cartId
     * @param integer $productId
     * @param integer $quantity
     * @return Cart
     */
    public function addProduct(
        int $cartId,
        int $productId,
        int $quantity
    ): Cart {
        $cart = $this->getById($cartId);
        $product = $this->productModel->getById($productId);

        $cart->products()->syncWithoutDetaching([$product->id => ['product_quantity' => $quantity]]);

        return $cart->refresh();
    }

    /**
     * Remove um produto do carrinho.
     *
     * @param integer $cartId
     * @param integer $productId
     * @param integer $quantity
     * @return Cart
     */
    public function removeProduct(
        int $cartId,
        int $productId
    ): Cart {
        $cart = $this->getById($cartId);
        $product = $this->productModel->getById($productId);

        $cart->products()->detach($product->id);

        return $cart->refresh();
    }

    /**
     * Retorna um carrinho pelo id.
     *
     * @param integer $id
     * @return Cart
     */
    public function getById(int $id): Cart
    {
        $cart = $this->cartEntity->with('products')->find($id);

        if (!$cart) {
            throw new Exception('Carrinho não encontrado');
        }

        return $cart;
    }

    /**
     * Calcula o total de um carrinho considerando o frete ou não.
     *
     * @param integer $cartId
     * @param string $zipCode
     * @return float
     */
    public function calculeTotalCart(
        int $cartId,
        string $zipCode
    ): float {
        $cart = $this->getById($cartId);
        $totalProducts = $this->sumAllProducts($cart->products->toArray());
        $total = $this->correiosService->applyFreight($totalProducts, $zipCode);

        return $total;
    }

    /**
     * Soma os valores dos produtos.
     *
     * @param array $products
     * @return float
     */
    private function sumAllProducts(array $products): float
    {
        $total = 0;

        if ($products) {
            foreach ($products as $product) {
                $total += $product['value'] * $product['pivot']['product_quantity'];
            }
        }

        return $total;
    }
}
