<?php

namespace Rzhanau\Main\Controllers;

use Rzhanau\Main\Controller;

class Diagonal extends Controller
{

    /**
     * В данном случае я предполагаю что это квадрат, потому rows и columns будут одинакового количества
     * Так же допускаю что все числа являются действительными
     * @throws \JsonException
     */
    protected function execute(array $data = []): string
    {
        $size = count($data);
        $mainDiagonal = $this->countMainDiagonal($data, $size);
        $sideDiagonal = $this->countSideDiagonal($data, $size);

        return json_encode(['main' => $mainDiagonal, 'side' => $sideDiagonal], JSON_THROW_ON_ERROR);
    }

    private function countMainDiagonal(array $matrix, int $size): array
    {
        $diagonal = [
            'sum' => 0,
            'odd' => 0,
            'even' => 0
        ];

        for ($i = 0; $i < $size; $i++) {
            /**
             * Алгоритм получение числа диагонали
             */
            $number = (int)$matrix[$i][$i];
            $this->fillDataArray($number, $diagonal);
        }

        return $diagonal;
    }

    private function countSideDiagonal(array $matrix, int $size): array
    {
        $diagonal = [
            'sum' => 0,
            'odd' => 0,
            'even' => 0
        ];

        for ($i = 0; $i < $size; $i++) {
            /**
             * Алгоритм получение числа диагонали
             */
            $number = (int)$matrix[$i][($size - 1) - $i];
            $this->fillDataArray($number, $diagonal);
        }

        return $diagonal;
    }

    /**
     * Заполнение массива данных
     */
    private function fillDataArray(int $number, array &$array): void
    {
        $array['sum'] += $number;

        if ($number % 2 === 0) {
            $array['even']++;
        } else {
            $array['odd']++;
        }
    }
}