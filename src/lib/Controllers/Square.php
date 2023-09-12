<?php

namespace Rzhanau\Main\Controllers;

class Square extends \Rzhanau\Main\Controller
{

    /**
     * @throws \Exception
     */
    protected function execute(array $data = []): string
    {
        $colors = [];

        $i = 0;
        while ($i < 9) {
            $colors[] = sprintf( "#%06X", mt_rand( 0, 0xFFFFFF ));
            $i++;
        }

        return json_encode($colors, JSON_THROW_ON_ERROR);
    }
}