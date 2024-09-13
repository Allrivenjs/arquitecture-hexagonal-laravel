<?php

namespace Core\BoundedContext\Course\Domain;

use Core\Shared\Domain\DomainException;
use Throwable;

final class CourseAlreadyExists extends DomainException
{
    public function __construct($message = "Course already exists", $code = 409, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
