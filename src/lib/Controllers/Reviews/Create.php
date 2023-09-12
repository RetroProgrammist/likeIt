<?php

namespace Rzhanau\Main\Controllers\Reviews;

use Rzhanau\Main\Helper\FileManager;
use Rzhanau\Main\Reviews\ReviewsEntity;
use Rzhanau\Main\Reviews\ReviewsManager;

class Create extends \Rzhanau\Main\Controller
{

    /**
     * @throws \JsonException
     */
    protected function execute(array $data = []): string
    {
        $response = [];
        $reviewManager = new ReviewsManager();
        $fileManager = new FileManager();

        try {
            /**
             * Добавляем новый элемент
             */
            $path = $fileManager->getRootUserFilePath($data['email'], $data['name']);
            if (!empty($_FILES['images']['tmp_name'][0])) {
                $fileManager->uploadFiles($path);
            } else {
                $path = '';
            }

            $entity = new ReviewsEntity([
                'name' => $data['name'],
                'email' => $data['email'],
                'active' => $data['active'] ?? 1,
                'text' => $data['text'],
                'images' => $path,
            ]);

            $response = $reviewManager->add($entity);
        } catch (\Exception $exception) {
            $response = ['error' => $exception->getMessage()];
        }

        return json_encode($response, JSON_THROW_ON_ERROR);
    }

    protected function validateInputData(array $data): void
    {
        if (!isset($data['name'], $data['email'], $data['text'])) {
            throw new \InvalidArgumentException('Fill all require fields');
        }
    }
}