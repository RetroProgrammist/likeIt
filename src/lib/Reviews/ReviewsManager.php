<?php

namespace Rzhanau\Main\Reviews;

use InitPHP\Database\Exceptions\QueryBuilderException;
use InitPHP\Database\Exceptions\QueryGeneratorException;
use Rzhanau\Main\DataManager\DB;
use Rzhanau\Main\Helper\FileManager;

class ReviewsManager
{
    private DB $db;

    public function __construct()
    {
        $this->db = DB::getInstance('likeit');
    }

    /**
     * @throws QueryBuilderException
     * @throws QueryGeneratorException
     */
    public function add(ReviewsEntity $entity): array
    {
        $data = [
            'name' => $entity->getNameAttribute(),
            'email' => $entity->getEmailAttribute(),
            'active' => $entity->getActiveAttribute(),
            'text' => $entity->getTextAttribute(),
            'images' => $entity->getImagesAttribute(),
        ];

        if ($this->db->add($data, 'user_reviews')) {
            $res = $this->db->getLastElement('user_reviews');
            if (!empty($res)) {
                $fileManager = new FileManager();
                $data = [ //@todo вынести дублирование
                    'id' => $res['id'],
                    'name' => $res['name'],
                    'email' => $res['email'],
                    'active' => $res['active'],
                    'text' => $res['text'],
                    'images' => !empty($res['images']) ? $fileManager->getFiles($res['images']) : [],
                ];
            }
        }

        return $data;
    }

    /**
     * @throws QueryBuilderException
     * @throws QueryGeneratorException
     */
    public function getList($sortOrder = 'DESC', $isAdmin = false): array
    {
        $data = [];
        $fileManager = new FileManager();
        $res = $this->db->getAll('user_reviews', $sortOrder, $isAdmin);

        if ($res->numRows() === 1) {
            $row = $res->toAssoc();
            $data[] = [//@todo вынести дублирование в отдельный метод
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'active' => $row['active'],
                'text' => $row['text'],
                'images' => !empty($row['images']) ? $fileManager->getFiles($row['images']) : [],
            ];
        } elseif ($res->numRows() > 0) {
            foreach ($res->toAssoc() as $row) {
                $data[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'active' => $row['active'],
                    'text' => $row['text'],
                    'images' => !empty($row['images']) ? $fileManager->getFiles($row['images']) : [],
                ];
            }
        }

        return $data;
    }

    /**
     * @throws QueryBuilderException
     * @throws QueryGeneratorException
     */
    public function update(int $id, $active = true): bool
    {
        return $this->db->updateActive('user_reviews', ['id' => $id], $active);
    }

    /**
     * @throws QueryBuilderException
     * @throws QueryGeneratorException
     */
    public function delete(int $id): bool
    {
        return $this->db->delete('user_reviews', $id);
    }
}