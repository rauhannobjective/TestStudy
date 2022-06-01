<?php

namespace Tests\Functional\Cart;

use App\Entities\Cart;
use App\Entities\Product;
use App\Entities\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AddProductControllerFTest extends TestCase
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
     * Adicionando 2 produtos iguais ao carrinho. O comportamento esperado é que apenas a quantidade seja atualizada.
     *
     * @return void
     */
    public function testAddProductSuccess()
    {
        $response = $this->patch("cart/add-product/{$this->cart->id}", [
            'product_id' => $this->product->id,
            'product_quantity' => 1
        ]);

        $response->assertStatus(200);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals($this->product->id, $result['products'][0]['pivot']['product_id']);
        $this->assertEquals(1, $result['products'][0]['pivot']['product_quantity']);

        $this->assertDatabaseHas('carts_products', [
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'product_quantity' => 1
        ]);

        $response = $this->patch("cart/add-product/{$this->cart->id}", [
            'product_id' => $this->product->id,
            'product_quantity' => 4
        ]);

        $response->assertStatus(200);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals($this->product->id, $result['products'][0]['pivot']['product_id']);
        $this->assertEquals(4, $result['products'][0]['pivot']['product_quantity']);

        $this->assertDatabaseHas('carts_products', [
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'product_quantity' => 4
        ]);
    }

    /**
     * Adicionando 2 produtos diferentes ao carrinho.
     *
     * @return void
     */
    public function testAddDiferentProductsSuccess()
    {
        $response = $this->patch("cart/add-product/{$this->cart->id}", [
            'product_id' => $this->product->id,
            'product_quantity' => 1
        ]);

        $response->assertStatus(200);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals($this->product->id, $result['products'][0]['pivot']['product_id']);
        $this->assertEquals(1, $result['products'][0]['pivot']['product_quantity']);

        $this->assertDatabaseHas('carts_products', [
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'product_quantity' => 1
        ]);

        $product2 = Product::factory()->create();

        $response = $this->patch("cart/add-product/{$this->cart->id}", [
            'product_id' => $product2->id,
            'product_quantity' => 2
        ]);

        $response->assertStatus(200);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals($product2->id, $result['products'][1]['pivot']['product_id']);
        $this->assertEquals(2, $result['products'][1]['pivot']['product_quantity']);

        $this->assertDatabaseHas('carts_products', [
            'cart_id' => $this->cart->id,
            'product_id' => $product2->id,
            'product_quantity' => 2
        ]);
    }

    /**
     * Erro ao adicionar zero produtos em um carrinho.
     *
     * @return void
     */
    public function testAddProductWithZeroProductQuantity()
    {
        $response = $this->patch("cart/add-product/{$this->cart->id}", [
            'product_id' => $this->product->id,
            'product_quantity' => 0
        ]);

        $response->assertStatus(422);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals('O product_quantity precisa ser maior que zero', $result['errors']['product_quantity'][0]);

        $this->assertDatabaseMissing('carts_products', [
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'product_quantity' => 0
        ]);
    }

    /**
     * Erro ao adicionar produtos em um carrinho sem passar o id do produto.
     *
     * @return void
     */
    public function testAddProductWithoutProductId()
    {
        $response = $this->patch("cart/add-product/{$this->cart->id}", [
            'product_quantity' => 1
        ]);

        $response->assertStatus(422);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals('O campo product_id é obrigatório', $result['errors']['product_id'][0]);

        $this->assertDatabaseMissing('carts_products', [
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'product_quantity' => 1
        ]);
    }

    /**
     * Erro ao adicionar produtos em um carrinho sem passar a sua quantidade.
     *
     * @return void
     */
    public function testAddProductWithoutProductQuantity()
    {
        $response = $this->patch("cart/add-product/{$this->cart->id}", [
            'product_id' => $this->product->id,
        ]);

        $response->assertStatus(422);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals('O campo product_quantity é obrigatório', $result['errors']['product_quantity'][0]);

        $this->assertDatabaseMissing('carts_products', [
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
        ]);
    }

    /**
     * Erro ao adicionar produtos em um carrinho quando o produto não existe.
     *
     * @return void
     */
    public function testAddProductWithoutProduct()
    {
        $response = $this->patch("cart/add-product/{$this->cart->id}", [
            'product_id' => 12345,
            'product_quantity' => 1
        ]);

        $response->assertStatus(422);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals('O produto não existe no banco de dados', $result['errors']['product_id'][0]);

        $this->assertDatabaseMissing('carts_products', [
            'cart_id' => $this->cart->id,
            'product_id' => 12345
        ]);
    }

    /**
     * Erro ao adicionar produtos em um carrinho quando o produto não existe.
     *
     * @return void
     */
    public function testAddProductWithoutCart()
    {
        $response = $this->patch("cart/add-product/12345", [
            'product_id' => $this->product->id,
            'product_quantity' => 1
        ]);

        $response->assertStatus(400);

        $result = json_decode($response->getContent(), true);

        $this->assertEquals('Carrinho não encontrado', $result['message']);

        $this->assertDatabaseMissing('carts_products', [
            'cart_id' => 12345,
            'product_id' => $this->product->id,
        ]);
    }
}
