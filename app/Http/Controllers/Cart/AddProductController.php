<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\CartModel;

class AddProductController extends Controller
{
    private CartModel $cartModel;

    public function __construct(CartModel $cartModel)
    {
        $this->cartModel = $cartModel;
    }

    /**
     * Controller para adição de produto e/ou quantidade de produto ao carrinho.
     *
     * @param integer $cartId
     * @param CartRequest $request
     */
    public function __invoke(int $cartId, CartRequest $request)
    {

        $response = $this->cartModel->addProduct(
            $cartId,
            $request->product_id,
            $request->product_quantity
        );

        return response()->json($response, 200);
    }
}
