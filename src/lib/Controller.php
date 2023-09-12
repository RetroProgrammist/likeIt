<?php

namespace Rzhanau\Main;

abstract class Controller
{
    abstract protected function execute(array $data = []): string;

    public function run(array $data): string
    {
        $this->validateInputData($data);
        $answer = $this->execute($data);
        $this->validateOutputData($answer);

        return $answer;
    }


    /**
     * @param array $data
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function validateInputData(array $data): void
    {
        //Validation
    }

    /**
     * @param string $data
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function validateOutputData(string $data): void
    {
        try {
            json_decode($data, false, 512, JSON_THROW_ON_ERROR);
        } catch (\Exception) {
            throw new \InvalidArgumentException('Wrong output data format');
        }
    }
}