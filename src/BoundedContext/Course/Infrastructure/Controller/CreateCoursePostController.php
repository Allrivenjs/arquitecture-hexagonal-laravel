<?php

namespace Core\BoundedContext\Course\Infrastructure\Controller;

use Core\BoundedContext\Course\Application\Actions\CreateCourse;
use Core\BoundedContext\Course\Domain\CourseAlreadyExists;
use Core\BoundedContext\Course\Infrastructure\Persistence\Eloquent\CourseRepository;
use Core\Shared\Domain\UuidGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class CreateCoursePostController
{
    public function __construct(
        private UuidGenerator    $uuidGenerator,
        private CourseRepository $repository
    )
    {
    }

    /**
     * @throws CourseAlreadyExists
     */
    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->get('id', $this->uuidGenerator->generate());
        $courseResponse = (new CreateCourse($this->repository))($id, $request->get('name'));
        return new JsonResponse([
            'course' => $courseResponse->toArray()
        ], Response::HTTP_CREATED);
    }
}
