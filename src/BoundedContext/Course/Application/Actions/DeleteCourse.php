<?php

namespace Core\BoundedContext\Course\Application\Actions;

use Core\BoundedContext\Course\Domain\CourseNotFound;
use Core\BoundedContext\Course\Domain\CourseRepository;
use Core\BoundedContext\Course\Domain\ValueObjects\CourseId;

final readonly class DeleteCourse
{
    public function  __construct(private CourseRepository $repository)
    {

    }

    /**
     * @throws CourseNotFound
     */
    public function __invoke(string $id): void
    {
        $id = new CourseId($id);
        $course = $this->repository->find($id);
        if ($course === null) {
            throw new CourseNotFound();
        }
        $this->repository->delete($id);
    }
}
