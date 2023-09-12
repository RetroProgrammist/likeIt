<?php

namespace Rzhanau\Main\DataManager;

interface DBInterface
{
    public static function getInstance(string $dbName): self;
    public function query(string $queryString): array;
}