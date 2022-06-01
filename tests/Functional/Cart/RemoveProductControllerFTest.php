<?php

namespace Tests\Functional\Cart;

use App\Entities\Cart;
use App\Entities\Product;
use App\Entities\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RemoveProductControllerFTest extends TestCase
{
    use DatabaseTransactions;

    private Product $product;
    private Cart $cart;
    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->product = Product::factory()->create();

        $this->cart = Cart::factory()->create([
            'user_id' => $this->user->id
        ]);
    }

    /**
     * Adicionando 1 produto e depois removendo ele com sucesso.
     *
     * @return void
     */
    public function testRemoveProductSuccess()
    {
        $response = $this->patch("cart/add-product/{$this->cart->id}", [
            'product_id' => $this->product->id,
            'product_quantity' => 3
        ]);

        $response->assertStatus(200);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals($this->product->id, $result['products'][0]['pivot']['product_id']);
        $this->assertEquals(3, $result['products'][0]['pivot']['product_quantity']);

        $this->assertDatabaseHas('carts_products', [
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'product_quantity' => 3
        ]);

        $response = $this->patch("cart/remove-product/{$this->cart->id}", [
            'product_id' => $this->product->id,
        ]);

        $response->assertStatus(200);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals([], $result['products']);

        $this->assertDatabaseMissing('carts_products', [
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'product_quantity' => 3
        ]);
    }
}
