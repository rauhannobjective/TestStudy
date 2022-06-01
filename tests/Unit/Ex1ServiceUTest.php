<?php

namespace Tests\Unit;

use App\Services\Ex1Service;
use Tests\TestCase;

class Ex1ServiceUTest extends TestCase
{
    private Ex1Service $ex1Service;

    public function setup(): void
    {
        $this->ex1Service = new Ex1Service();
    }

    /**
     * Teste exemplo do exercicio para o intervalo até 10 de 3 ou 5
     *
     * Resultdo = 23
     *
     * @return void
     */
    public function testMultiple3Or5In10()
    {
        $response = $this->ex1Service->sumMultiplesOfN1OrN2ForNaturalNumber(10, 3, 5);

        $this->assertEquals(23, $response);
    }

    /**
     * Teste exemplo do exercicio para o intervalo até 1000 de 3 ou 5
     *
     * Resultado = 233168
     *
     * @return void
     */
    public function testMultiple3Or5In1000()
    {
        $response = $this->ex1Service->sumMultiplesOfN1OrN2ForNaturalNumber(1000, 3, 5);

        $this->assertEquals(233168, $response);
    }

    /**
     * Teste exemplo do exercicio para o intervalo 0 de 3 ou 5
     *
     * Resultdo = 0
     *
     * @return void
     */
    public function testMultiple3Or5In0()
    {
        $response = $this->ex1Service->sumMultiplesOfN1OrN2ForNaturalNumber(0, 3, 5);

        $this->assertEquals(0, $response);
    }

    /**
     * Teste exemplo do exercicio para o intervalo até 10 de 3 e 5
     *
     * Resultdo = 0
     *
     * @return void
     */
    public function testMultiple3And5In10()
    {
        $response = $this->ex1Service->sumMultiplesOfN1AndN2ForNaturalNumber(10, 3, 5);

        $this->assertEquals(0, $response);
    }

    /**
     * Teste exemplo do exercicio para o intervalo até 1000 de 3 e 5
     *
     * Resultado = 33165
     *
     * @return void
     */
    public function testMultiple3And5In1000()
    {
        $response = $this->ex1Service->sumMultiplesOfN1AndN2ForNaturalNumber(1000, 3, 5);

        $this->assertEquals(33165, $response);
    }

    /**
     * Teste exemplo do exercicio para o intervalo 0 de 3 e 5
     *
     * Resultdo = 0
     *
     * @return void
     */
    public function testMultiple3And5In0()
    {
        $response = $this->ex1Service->sumMultiplesOfN1AndN2ForNaturalNumber(0, 3, 5);

        $this->assertEquals(0, $response);
    }

    /**
     * Teste exemplo do exercicio para o intervalo 0 de (3 ou 5) e 7
     *
     * Resultdo = 0
     *
     * @return void
     */
    public function testMultiple3Or5And7In0()
    {
        $response = $this->ex1Service->sumMultiplesOfN1OrN2AndN3ForNaturalNumber(0, 3, 5, 7);

        $this->assertEquals(0, $response);
    }

    /**
     * Teste exemplo do exercicio para o intervalo 10 de (3 ou 5) e 7
     *
     * Resultdo = 0
     *
     * @return void
     */
    public function testMultiple3Or5And7In10()
    {
        $response = $this->ex1Service->sumMultiplesOfN1OrN2AndN3ForNaturalNumber(10, 3, 5, 7);

        $this->assertEquals(0, $response);
    }

    /**
     * Teste exemplo do exercicio para o intervalo 1000 de (3 ou 5) e 7
     *
     * Resultdo = 33173
     *
     * @return void
     */
    public function testMultiple3Or5And7In1000()
    {
        $response = $this->ex1Service->sumMultiplesOfN1OrN2AndN3ForNaturalNumber(1000, 3, 5, 7);

        $this->assertEquals(33173, $response);
    }

    /**
     * Teste para validacao de multiplos 10 e 5
     *
     * Resultado = true
     *
     * @return void
     */
    public function testIsNaturalMultipleTrue()
    {
        $class = new \ReflectionClass($this->ex1Service);
        $method = $class->getMethod('isNaturalMultiple');
        $method->setAccessible(true);
        $response = $method->invoke($this->ex1Service, 10, 5);

        $this->assertTrue($response);
    }

    /**
     * Teste para validacao de multiplos 10 e 3
     *
     * Resultado = false
     *
     * @return void
     */
    public function testIsNaturalMultipleFalse()
    {
        $class = new \ReflectionClass($this->ex1Service);
        $method = $class->getMethod('isNaturalMultiple');
        $method->setAccessible(true);
        $response = $method->invoke($this->ex1Service, 10, 3);

        $this->assertFalse($response);
    }

    /**
     * Teste para validacao de multiplos 10 e 0
     *
     * Resultado = false
     *
     * @return void
     */
    public function testIsNaturalMultipleInvalidMultiple()
    {
        $class = new \ReflectionClass($this->ex1Service);
        $method = $class->getMethod('isNaturalMultiple');
        $method->setAccessible(true);
        $response = $method->invoke($this->ex1Service, 10, 0);

        $this->assertFalse($response);
    }

    /**
     * Teste se um numero é multiplo de 3 ou 5. Teste com 10
     *
     * Resultdo = true
     *
     * @return void
     */
    public function testMultiple3Or5WithNumber10()
    {
        $response = $this->ex1Service->determineIfItIsMultipleOfN1OrN2(10, 3, 5);

        $this->assertTrue($response);
    }

    /**
     * Teste se um numero é multiplo de 3 ou 5. Teste com 12
     *
     * Resultdo = true
     *
     * @return void
     */
    public function testMultiple3Or5WithNumber12()
    {
        $response = $this->ex1Service->determineIfItIsMultipleOfN1OrN2(12, 3, 5);

        $this->assertTrue($response);
    }

    /**
     * Teste se um numero é multiplo de 3 ou 5. Teste com 7
     *
     * Resultdo = false
     *
     * @return void
     */
    public function testMultiple3Or5WithNumber7()
    {
        $response = $this->ex1Service->determineIfItIsMultipleOfN1OrN2(7, 3, 5);

        $this->assertFalse($response);
    }

    /**
     * Teste se um numero é multiplo de 3 e 5. Teste com 10
     *
     * Resultdo = false
     *
     * @return void
     */
    public function testMultiple3And5WithNumber10()
    {
        $response = $this->ex1Service->determineIfItIsMultipleOfN1AndN2(10, 3, 5);

        $this->assertFalse($response);
    }

    /**
     * Teste se um numero é multiplo de 3 e 5. Teste com 15
     *
     * Resultdo = true
     *
     * @return void
     */
    public function testMultiple3And5WithNumber12()
    {
        $response = $this->ex1Service->determineIfItIsMultipleOfN1AndN2(15, 3, 5);

        $this->assertTrue($response);
    }

    /**
     * Teste se um numero é multiplo de 3. Teste com 9
     *
     * Resultdo = true
     *
     * @return void
     */
    public function testMultiple3WithNumber9()
    {
        $response = $this->ex1Service->determineIfItIsMultipleOfN1AndN2(9, 3);

        $this->assertTrue($response);
    }
}
