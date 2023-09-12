<?php

namespace Rzhanau\Main\Controllers\Reviews;

use Rzhanau\Main\Reviews\ReviewsManager;

class Delete extends \Rzhanau\Main\Controller
{

    /**
     * @throws \JsonException
     */
    protected function execute(array $data = []): string
    {
        $response = [];
        $reviewManager = new ReviewsManager();
        try {
            $response = ['status'=>$reviewManager->delete((int)$data['id'])];
        } catch (\Exception $exception) {
            $response = ['error' => $exception->getMessage()];
        }

        return json_encode($response, JSON_THROW_ON_ERROR);
    }

    protected function validateInputData(array $data): void
    {
        if (!isset($data['id']) || !is_numeric($data['id'])) {
            throw new \InvalidArgumentException('Fill all require fields');
        }
    }
}