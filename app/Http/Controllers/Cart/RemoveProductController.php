<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\RemoveProductRequest;
use App\Models\CartModel;

class RemoveProductController extends Controller
{
    private CartModel $cartModel;

    public function __construct(CartModel $cartModel)
    {
        $this->cartModel = $cartModel;
    }

    /**
     * Controller para remoção de produto do carrinho.
     *
     * @param integer $cartId
     * @param RemoveProductRequest $request
     */
    public function __invoke(int $cartId, RemoveProductRequest $request)
    {
        $response = $this->cartModel->removeProduct(
            $cartId,
            $request->product_id
        );

        return response()->json($response, 200);
    }
}
