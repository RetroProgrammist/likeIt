<?php

namespace Rzhanau\Main\Reviews;

class ReviewsEntity extends \InitPHP\Database\Entity
{
    public function getNameAttribute(): string
    {
        return $this->name;
    }

    public function setNameAttribute(string $value): void
    {
        $this->name = $value;
    }

    public function getEmailAttribute(): string
    {
        return $this->email;
    }

    public function setEmailAttribute(string $value): void
    {
        $this->email = $value;
    }

    public function getActiveAttribute(): int
    {
        return $this->active;
    }

    public function setActiveAttribute(int $value): void
    {
        $this->active = $value;
    }

    public function getTextAttribute(): string
    {
        return $this->text;
    }

    public function setTextAttribute(string $value): void
    {
        $this->text = $value;
    }

    public function getImagesAttribute(): string
    {
        return $this->images;
    }

    public function setImagesAttribute(string $value): void
    {
        $this->images = $value;
    }

    public function getDataAttribute(): string
    {
        return $this->data;
    }

    public function setDataAttribute(string $value): void
    {
        $this->data = $value;
    }

}