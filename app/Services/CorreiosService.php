<?php

namespace App\Services;

use App\Interfaces\Freight;

class CorreiosService implements Freight
{
    const FREIGHT_DETERMINER_VALUE = 100;

    /**
     * Calcula o frete nos correios através do cep parametrizado.
     *
     * @param int $zipCode
     * @return float
     */
    public function calculeFreight(int $zipCode): float
    {
        // Chamada oficial da API dos Correios
        return 25.50;
    }

    /**
     * Aplica frete de acordo com o valor minimo da variavel FREIGHT_DETERMINER_VALUE.
     *
     * @param float $total
     * @param int $zipCode
     * @return float
     */
    public function applyFreight(
        float $total,
        int $zipCode
    ): float {
        if ($total < self::FREIGHT_DETERMINER_VALUE) {
            $total += $this->calculeFreight($zipCode);
        }

        return $total;
    }
}
