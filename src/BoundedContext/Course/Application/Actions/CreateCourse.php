<?php

namespace Core\BoundedContext\Course\Application\Actions;

use Core\BoundedContext\Course\Application\Responses\CourseResponse;
use Core\BoundedContext\Course\Domain\Course;
use Core\BoundedContext\Course\Domain\CourseAlreadyExists;
use Core\BoundedContext\Course\Domain\CourseRepository;
use Core\BoundedContext\Course\Domain\ValueObjects\CourseId;
use Core\BoundedContext\Course\Domain\ValueObjects\CourseName;

final readonly class CreateCourse
{
     public function  __construct(private CourseRepository $repository)
     {

     }

    /**
     * @throws CourseAlreadyExists
     */
    public function __invoke(string $id, string $name): CourseResponse
     {
         $id = new CourseId($id);
         $course = $this->repository->find($id);

         if ($course !== null) {
             throw new CourseAlreadyExists();
         }

         $name = new CourseName($name);

         $course = Course::create($id, $name);
         $this->repository->save($course);
         return CourseResponse::fromCourse($course);
     }
}
