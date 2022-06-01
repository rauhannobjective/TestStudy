<?php

namespace Tests\Unit;

use App\Services\Ex2Service;
use Tests\TestCase;

class Ex2ServiceUTest extends TestCase
{
    private Ex2Service $ex2Service;

    public function setup(): void
    {
        $this->ex2Service = new Ex2Service();
    }

    /**
     * Teste exemplo do exercicio para o numero 7
     *
     * Resultdo = true
     *
     * @return void
     */
    public function testHappyNumber7()
    {
        $response = $this->ex2Service->determinesHappyNumber(7);

        $this->assertTrue($response);
    }

    /**
     * Teste exemplo do exercicio para o numero -7
     *
     * Resultdo = true
     *
     * @return void
     */
    public function testHappyNumber7Negative()
    {
        $response = $this->ex2Service->determinesHappyNumber(-7);

        $this->assertTrue($response);
    }

    /**
     * Teste exemplo do exercicio para o numero 10
     *
     * Resultdo = true
     *
     * @return void
     */
    public function testHappyNumber10()
    {
        $response = $this->ex2Service->determinesHappyNumber(10);

        $this->assertTrue($response);
    }

    /**
     * Teste exemplo do exercicio para o numero 2
     *
     * Resultdo = false
     *
     * @return void
     */
    public function testHappyNumber2()
    {
        $response = $this->ex2Service->determinesHappyNumber(2);

        $this->assertFalse($response);
    }

    /**
     * Teste exemplo do exercicio para o numero -2
     *
     * Resultdo = false
     *
     * @return void
     */
    public function testHappyNumber2Negative()
    {
        $response = $this->ex2Service->determinesHappyNumber(-2);

        $this->assertFalse($response);
    }

    /**
     * Teste exemplo do exercicio para o numero 0
     *
     * Resultdo = false
     *
     * @return void
     */
    public function testHappyNumber0()
    {
        $response = $this->ex2Service->determinesHappyNumber(0);

        $this->assertFalse($response);
    }

    /**
     * Teste para validacao de soma dos quadrados de 7
     *
     * Resultado = 49
     *
     * @return void
     */
    public function testSumOfSquares7True()
    {
        $class = new \ReflectionClass($this->ex2Service);
        $method = $class->getMethod('sumOfSquares');
        $method->setAccessible(true);
        $response = $method->invoke($this->ex2Service, 7);

        $this->assertEquals(49, $response);
    }

    /**
     * Teste para validacao de soma dos quadrados de 7
     *
     * Resultado = 49
     *
     * @return void
     */
    public function testSumOfSquares7False()
    {
        $class = new \ReflectionClass($this->ex2Service);
        $method = $class->getMethod('sumOfSquares');
        $method->setAccessible(true);
        $response = $method->invoke($this->ex2Service, 7);

        $this->assertNotEquals(40, $response);
    }

    /**
     * Teste para validacao de soma dos quadrados de 16
     *
     * Resultado = 37
     *
     * @return void
     */
    public function testSumOfSquares16True()
    {
        $class = new \ReflectionClass($this->ex2Service);
        $method = $class->getMethod('sumOfSquares');
        $method->setAccessible(true);
        $response = $method->invoke($this->ex2Service, 16);

        $this->assertEquals(37, $response);
    }

    /**
     * Teste para validacao de soma dos quadrados de 83
     *
     * Resultado = 73
     *
     * @return void
     */
    public function testSumOfSquares83False()
    {
        $class = new \ReflectionClass($this->ex2Service);
        $method = $class->getMethod('sumOfSquares');
        $method->setAccessible(true);
        $response = $method->invoke($this->ex2Service, 83);

        $this->assertNotEquals(72, $response);
    }

    /**
     * Teste para validacao de soma dos quadrados de -43
     *
     * Resultado = 25
     *
     * @return void
     */
    public function testSumOfSquares43NegativeTrue()
    {
        $class = new \ReflectionClass($this->ex2Service);
        $method = $class->getMethod('sumOfSquares');
        $method->setAccessible(true);
        $response = $method->invoke($this->ex2Service, -43);

        $this->assertEquals(25, $response);
    }
}
