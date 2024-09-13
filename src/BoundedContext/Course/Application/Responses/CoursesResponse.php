<?php

namespace Core\BoundedContext\Course\Application\Responses;

use Core\BoundedContext\Course\Domain\Courses;

final readonly class CoursesResponse
{
    public function __construct(private array $courses)
    {
    }

    public static function fromCourses(Courses $courses): self
    {
        return new self(
            array_map(function ($course) {
                return CourseResponse::fromCourse($course);
            }, $courses->all())
        );
    }

    public function toArray(): array
    {
        return array_map(function (CourseResponse $courseResponse) {
            return $courseResponse->toArray();
        }, $this->courses);
    }
}
