<?php

namespace Rzhanau\Main\DataManager;

use InitPHP\Database\Exceptions\QueryBuilderException;
use InitPHP\Database\Exceptions\QueryGeneratorException;
use \InitPHP\Database\Facade\DB as DriverPDO;

class DB implements DBInterface
{
    private const DB_SETTING = [
        'db_user' => 'user',
        'db_password' => 'user',
        'db_host' => 'mysql', //127.0.0.1
        'db_port' => '3306',
    ];

    private static ?DB $instance = null;

    public static function getInstance(string $dbName): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($dbName);
        }
        return self::$instance;
    }

    private function __construct(string $dbName)
    {
        if ($dbName === '') {
            throw new \InvalidArgumentException('DB Name is require');
        }

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;port=%s',
            self::DB_SETTING['db_host'],
            $dbName,
            self::DB_SETTING['db_port']
        );

        DriverPDO::createImmutable([
            'dsn' => $dsn,
            'username' => self::DB_SETTING['db_user'],
            'password' => self::DB_SETTING['db_password'],
        ]);
    }

    /**
     * @throws QueryBuilderException
     * @throws QueryGeneratorException
     */
    public function add(array $data, string $tableName): bool
    {
        return DriverPDO::table($tableName)->create($data);
    }

    /**
     * @throws QueryBuilderException
     * @throws QueryGeneratorException
     */
    public function updateActive(string $tableName, array $filter, bool $active = true): bool
    {
        $query = DriverPDO::from($tableName);
        foreach ($filter as $field => $value) {
            $query->where($field, $value);
        }
        return $query->update(['active' => (int)$active]);
    }

    /**
     * @throws QueryBuilderException
     * @throws QueryGeneratorException
     */
    public function delete(string $tableName, int $id): bool
    {
        return DriverPDO::from($tableName)
            ->where('id', $id)
            ->delete();
    }

    /**
     * Тк пагинации я не делаю, то установил ограничение в 100 записей
     */
    public function getAll(string $tableName, string $orderDate = 'DESC', $isAdmin = false): \InitPHP\Database\Result
    {
        $queryBuilder = DriverPDO::select('*')
            ->from($tableName)
            ->orderBy('date', $orderDate)
            ->offset(0)->limit(100);

        if (!$isAdmin) {
            $queryBuilder->where('active', 1);
        }

        return DriverPDO::read();
    }

    public function getLastElement(string $tableName): array
    {
        DriverPDO::select('*')
            ->from($tableName)
            ->orderBy('id', 'DESC')
            ->offset(0)->limit(1);

        return DriverPDO::read()->toAssoc();
    }

    public function query(string $queryString): array
    {
        $result = DriverPDO::getPDO()->query($queryString);

        if (!$result) {
            return [];
        }

        return $result->fetchAll();
    }
}