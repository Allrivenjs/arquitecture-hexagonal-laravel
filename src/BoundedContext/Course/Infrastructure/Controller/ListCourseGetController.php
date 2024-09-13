<?php

namespace Core\BoundedContext\Course\Infrastructure\Controller;

use Core\BoundedContext\Course\Application\Actions\CreateCourse;
use Core\BoundedContext\Course\Application\Actions\ListCourses;
use Core\BoundedContext\Course\Domain\CourseAlreadyExists;
use Core\BoundedContext\Course\Infrastructure\Persistence\Eloquent\CourseRepository;
use Core\Shared\Domain\UuidGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class ListCourseGetController
{
    public function __construct(
        private CourseRepository $repository
    )
    {
    }


    public function __invoke(Request $request): JsonResponse
    {

        $coursesResponse = (new ListCourses($this->repository))();
        return new JsonResponse([
            'courses' => $coursesResponse->toArray()
        ], Response::HTTP_CREATED);
    }
}
