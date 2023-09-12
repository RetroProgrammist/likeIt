<?php

namespace Rzhanau\Main\Controllers;

class Rate extends \Rzhanau\Main\Controller
{

    protected function execute(array $data = []): string
    {
        /**
         * Лучше на curl или другой библиотеке, тут упрощено
         * Упростил тк, в данном случае, можно было все реализовать на js
         * Так же проверки я опустил, кроме валидатора
         */
        return file_get_contents('https://api.nbrb.by/exrates/rates/USD?parammode=2');
    }
}