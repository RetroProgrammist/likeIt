<?php

namespace Rzhanau\Main\Controllers;

class Brackets extends \Rzhanau\Main\Controller
{

    protected const BRACKETS_PATTERN = [
        '<>',
        '()',
        '{}',
        '[]',
    ];

    /**
     * Тк в задаче точно не указано что подразумевается под корректным закрытием,
     * то я предположил что корректно это не одинаковое количество скобок, а то что они попарно открыты и закрыты, те
     * ({(})) - тут одинаковое количество открытых и закрытых скобок, но есть не верная вложенность, НЕ ПРАВИЛЬНО
     * ({[({})]}) - а вот тут верно соблюдены и вложенности и количество скобок, ПРАВИЛЬНО
     * @throws \JsonException
     */
    protected function execute(array $data = []): string
    {
        $bracketsString = trim($data['brackets']);
        $lineLength = strlen($bracketsString);
        $answer = ['status' => 0];
        if ($lineLength > 1) {
            while (true) {
                foreach (self::BRACKETS_PATTERN as $bracketsPair) {
                    $bracketsString = str_replace($bracketsPair, '', $bracketsString);
                }

                if (strlen($bracketsString) === $lineLength) {
                    break;
                }

                $lineLength = strlen($bracketsString);
            }

            if (strlen($bracketsString) === 0) {
                $answer = ['status' => 1];
            }
        }

        return json_encode($answer, JSON_THROW_ON_ERROR);
    }

    protected function validateInputData(array $data): void
    {
        $pString = preg_quote(implode('', self::BRACKETS_PATTERN), '/');

        $re = '/[^' . $pString . ']/';
        preg_match($re, trim($data['brackets']), $matches);
        if (isset($matches[0])) {
            throw new \InvalidArgumentException('Wrong input data, only brackets ({}[]()<>)');
        }
    }
}