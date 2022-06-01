<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartTotalRequest;
use App\Models\CartModel;

class CalculeTotalValueController extends Controller
{
    private CartModel $cartModel;

    public function __construct(CartModel $cartModel)
    {
        $this->cartModel = $cartModel;
    }

    public function __invoke(int $cartId, CartTotalRequest $request)
    {
        $response = $this->cartModel->calculeTotalCart(
            $cartId,
            $request->zipcode
        );

        return response()->json($response, 200);
    }
}
