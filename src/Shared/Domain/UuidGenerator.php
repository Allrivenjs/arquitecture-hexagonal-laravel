<?php

namespace Core\Shared\Domain;

interface UuidGenerator
{
    public function generate(): string;
}
