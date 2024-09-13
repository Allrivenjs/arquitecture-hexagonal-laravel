<?php

namespace Core\BoundedContext\Course\Application\Actions;

use Core\BoundedContext\Course\Application\Responses\CourseResponse;
use Core\BoundedContext\Course\Domain\CourseNotFound;
use Core\BoundedContext\Course\Domain\CourseRepository;
use Core\BoundedContext\Course\Domain\ValueObjects\CourseId;

final readonly class GetCourse
{
    public function  __construct(private CourseRepository $repository)
    {

    }

    /**
     * @throws CourseNotFound
     */
    public function __invoke(string $id): CourseResponse
    {
        $id = new CourseId($id);
        $course = $this->repository->find($id);

        if ($course === null) {
            throw new CourseNotFound();
        }

        return CourseResponse::fromCourse($course);
    }
}
