<?php

namespace Rzhanau\Main\Reviews;

interface CollectionInterface extends \Countable, \IteratorAggregate, \JsonSerializable
{
    public function clear(): void;
    public function copy(): CollectionInterface;
    public function isEmpty(): bool;
    public function toArray(): array;
}