<?php

namespace Rzhanau\Main\Reviews;

use Traversable;

class Collection implements CollectionInterface
{
    private array $list = [];

    public function add(\InitPHP\Database\Entity $element): void
    {
        $this->list[] = $element;
    }

    public function remove(int $id): void
    {
        unset($this->list[$id]);
    }

    public function clear(): void
    {
        $this->list = [];
    }

    public function copy(): CollectionInterface
    {
        return clone $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->list);
    }

    public function toArray(): array
    {
        return $this->list;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->list);
    }

    public function count(): int
    {
        return count($this->list); //Итератор можно отдельным полем сделать
    }

    public function jsonSerialize(): string
    {
        //реализации нет,
        return '';
    }
}