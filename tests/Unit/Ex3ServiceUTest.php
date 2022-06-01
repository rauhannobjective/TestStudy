<?php

namespace Tests\Unit;

use App\Services\Ex1Service;
use App\Services\Ex2Service;
use App\Services\Ex3Service;
use Tests\TestCase;

class Ex3ServiceUTest extends TestCase
{
    private Ex3Service $ex3Service;

    public function setup(): void
    {
        $this->ex3Service = new Ex3Service(new Ex1Service, new Ex2Service);
    }

    /**
     * Teste exemplo do exercicio para a palavra Usuário
     *
     * @return void
     */
    public function testWordSuccess()
    {
        $response = $this->ex3Service->traductWordToNumber('Usuario');

        $this->assertArrayHasKey('word_value', $response);
        $this->assertArrayHasKey('is_cousin', $response);
        $this->assertArrayHasKey('is_happy', $response);
        $this->assertArrayHasKey('is_multiple_by_3_or_5', $response);

        $this->assertEquals(130, $response['word_value']);
        $this->assertEquals(false, $response['is_cousin']);
        $this->assertEquals(true, $response['is_happy']);
        $this->assertEquals(true, $response['is_multiple_by_3_or_5']);

        $this->assertIsArray($response);

        $this->assertCount(4, $response);
    }

    /**
     * Teste exemplo do exercicio para a palavra abca.
     *
     * @return void
     */
    public function testWordPrimeCheckSuccess()
    {
        $response = $this->ex3Service->traductWordToNumber('abca');

        $this->assertArrayHasKey('word_value', $response);
        $this->assertArrayHasKey('is_cousin', $response);
        $this->assertArrayHasKey('is_happy', $response);
        $this->assertArrayHasKey('is_multiple_by_3_or_5', $response);

        $this->assertEquals(7, $response['word_value']);
        $this->assertEquals(true, $response['is_cousin']);
        $this->assertEquals(true, $response['is_happy']);
        $this->assertEquals(false, $response['is_multiple_by_3_or_5']);

        $this->assertIsArray($response);

        $this->assertCount(4, $response);
    }

    /**
     * Teste exemplo do exercicio para a palavra eec.
     *
     * @return void
     */
    public function testWordCousingSuccess()
    {
        $response = $this->ex3Service->traductWordToNumber('eec');

        $this->assertArrayHasKey('word_value', $response);
        $this->assertArrayHasKey('is_cousin', $response);
        $this->assertArrayHasKey('is_happy', $response);
        $this->assertArrayHasKey('is_multiple_by_3_or_5', $response);

        $this->assertEquals(13, $response['word_value']);
        $this->assertEquals(true, $response['is_cousin']);
        $this->assertEquals(true, $response['is_happy']);
        $this->assertEquals(false, $response['is_multiple_by_3_or_5']);

        $this->assertIsArray($response);

        $this->assertCount(4, $response);
    }

    /**
     * Teste exemplo do exercicio para a palavra if.
     *
     * @return void
     */
    public function testWordIfSuccess()
    {
        $response = $this->ex3Service->traductWordToNumber('if');

        $this->assertArrayHasKey('word_value', $response);
        $this->assertArrayHasKey('is_cousin', $response);
        $this->assertArrayHasKey('is_happy', $response);
        $this->assertArrayHasKey('is_multiple_by_3_or_5', $response);

        $this->assertEquals(15, $response['word_value']);
        $this->assertEquals(false, $response['is_cousin']);
        $this->assertEquals(false, $response['is_happy']);
        $this->assertEquals(true, $response['is_multiple_by_3_or_5']);

        $this->assertIsArray($response);

        $this->assertCount(4, $response);
    }

    /**
     * Teste exemplo do exercicio para a palavra 123
     *
     * @return void
     */
    public function testWordWithNumber()
    {
        $response = $this->ex3Service->traductWordToNumber(123);

        $this->assertArrayHasKey('word_value', $response);
        $this->assertArrayHasKey('is_cousin', $response);
        $this->assertArrayHasKey('is_happy', $response);
        $this->assertArrayHasKey('is_multiple_by_3_or_5', $response);

        $this->assertEquals(0, $response['word_value']);
        $this->assertEquals(false, $response['is_cousin']);
        $this->assertEquals(false, $response['is_happy']);
        $this->assertEquals(false, $response['is_multiple_by_3_or_5']);

        $this->assertIsArray($response);

        $this->assertCount(4, $response);
    }

    /**
     * Teste para validacao correspondencia numerica para a palavra:
     *
     * O   b   j   e   c   t   i   v   e
     * 41  2   10  5   3   20  9   22  5
     *
     * Resultado = 41 + 2 + 10 + 5 + 3 + 20 + 9 + 22 + 5 = 117
     *
     * @return void
     */
    public function testSumOfCorrespondingNumber()
    {
        $class = new \ReflectionClass($this->ex3Service);
        $method = $class->getMethod('sumOfCorrespondingNumber');
        $method->setAccessible(true);
        $response = $method->invoke($this->ex3Service, 'Objective');

        $this->assertEquals(117, $response);
    }
}
