<?php

namespace Core\BoundedContext\Course\Domain;

use Core\Shared\Domain\DomainException;
use Throwable;

final class CourseNotFound extends DomainException
{
    public function __construct($message = "Course not found", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
