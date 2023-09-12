<?php

namespace Rzhanau\Main\Controllers;

use Rzhanau\Main\Helper\FileManager;
use Rzhanau\Main\Reviews\ReviewsEntity;
use Rzhanau\Main\Reviews\ReviewsManager;

class Reviews extends \Rzhanau\Main\Controller
{

    /**
     * @throws \JsonException
     */
    protected function execute(array $data = []): string
    {
        $response = [];
        $sort = $data['sort'] ?? 'DESC';
        $isAdmin = isset($data['admin']) && $data['admin'] === '1';

        $reviewManager = new ReviewsManager();
        try {
            $response = $reviewManager->getList($sort, $isAdmin);
        } catch (\Exception $exception) {
            $response = ['error' => $exception->getMessage()];
        }

        return json_encode($response, JSON_THROW_ON_ERROR);
    }
}