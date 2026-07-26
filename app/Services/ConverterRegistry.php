<?php

namespace App\Services;

use App\Contracts\ConverterInterface;
use App\Enums\FileCategory;

class ConverterRegistry
{
    private array $converters = [];

    public function register(ConverterInterface $converter): void
    {
        $this->converters[$converter->category()->value] = $converter;
    }

    public function resolve(FileCategory $category): ConverterInterface
    {
        return $this->converters[$category->value]
            ?? throw new \InvalidArgumentException("No converter registered for category: {$category->value}");
    }

    public function has(FileCategory $category): bool
    {
        return isset($this->converters[$category->value]);
    }

    public function all(): array
    {
        return $this->converters;
    }
}
