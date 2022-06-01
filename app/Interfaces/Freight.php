<?php

namespace App\Interfaces;

interface Freight
{
    /**
     * Calcula o frete através do cep parametrizado.
     *
     * @param int $zipCode
     * @return float
     */
    public function calculeFreight(int $zipCode): float;
}
