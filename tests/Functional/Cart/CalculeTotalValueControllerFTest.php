<?php

namespace Tests\Functional\Cart;

use App\Entities\Cart;
use App\Entities\Product;
use App\Entities\User;
use App\Services\CorreiosService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\MockInterface;
use Tests\TestCase;

class CalculeTotalValueControllerFTest extends TestCase
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

        $this->partialMock(CorreiosService::class, function (MockInterface $mock) {
            $mock->shouldReceive('calculeFreight')->andReturn(10.50);
        });
    }

    /**
     * Adicionando 2 produtos ao carrinho e somando o total com frete.
     *
     * @return void
     */
    public function testSumCartWithFreight()
    {
        $user = User::factory()->create();

        $cart = Cart::factory()->create([
            'user_id' => $user->id
        ]);

        $product1 = Product::factory()->create([
            'value' => 20.25
        ]);

        $product2 = Product::factory()->create([
            'value' => 40.75
        ]);

        $response = $this->patch("cart/add-product/{$cart->id}", [
            'product_id' => $product1->id,
            'product_quantity' => 2
        ]);

        $response->assertStatus(200);

        $response = $this->patch("cart/add-product/{$cart->id}", [
            'product_id' => $product2->id,
            'product_quantity' => 1
        ]);

        $response->assertStatus(200);

        $response = $this->post("cart/total/{$cart->id}", [
            'zipcode' => 37500000,
        ]);

        $response->assertStatus(200);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals(40.50 + 40.75 + 10.50, $result);
        $this->assertIsFloat($result);

    }

    /**
     * Adicionando 2 produtos ao carrinho e somando o total sem frete.
     *
     * @return void
     */
    public function testSumCartWithoutFreight()
    {
        $user = User::factory()->create();

        $cart = Cart::factory()->create([
            'user_id' => $user->id
        ]);

        $product1 = Product::factory()->create([
            'value' => 90.25
        ]);

        $product2 = Product::factory()->create([
            'value' => 120.75
        ]);

        $response = $this->patch("cart/add-product/{$cart->id}", [
            'product_id' => $product1->id,
            'product_quantity' => 2
        ]);

        $response->assertStatus(200);

        $response = $this->patch("cart/add-product/{$cart->id}", [
            'product_id' => $product2->id,
            'product_quantity' => 1
        ]);

        $response->assertStatus(200);

        $response = $this->post("cart/total/{$cart->id}", [
            'zipcode' => 37500000,
        ]);

        $response->assertStatus(200);

        $result = json_decode($response->getContent(), true);

        // 0 é o frete que não considerou devido a regra de negócio
        $this->assertEquals(180.50 + 120.75 + 0, $result);
        $this->assertIsFloat($result);
    }
}
