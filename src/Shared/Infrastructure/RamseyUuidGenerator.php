<?php

namespace Core\Shared\Infrastructure;

use Core\Shared\Domain\UuidGenerator;
use Ramsey\Uuid\Uuid;

class RamseyUuidGenerator implements UuidGenerator
{

    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
