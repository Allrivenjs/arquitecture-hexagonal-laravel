<?php

declare(strict_types=1);

namespace Core\Shared\Domain;

use Core\Shared\Domain\CollectionInterface;

abstract readonly class Collection implements CollectionInterface
{
    public function __construct(private array $items = [])
    {
    }

    public function all(): array
    {
        return $this->items;
    }
}
