<?php

namespace Core\BoundedContext\Course\Domain;

use Core\BoundedContext\Course\Domain\ValueObjects\CourseId;

interface CourseRepository
{
    public function list(): Courses;
    public function find(CourseId $id): ?Course;
    public function save(Course $course): void;
    public function delete(CourseId $id): void;

}
