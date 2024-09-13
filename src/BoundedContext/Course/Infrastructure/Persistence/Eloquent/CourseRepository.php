<?php

namespace Core\BoundedContext\Course\Infrastructure\Persistence\Eloquent;
use Core\BoundedContext\Course\Domain\{CourseNotFound,
    CourseRepository as CourseRepositoryContract,
    Course,
    Courses,
    CourseAlreadyExists,
    ValueObjects\CourseId};

use Core\Shared\Infrastructure\Persistence\Eloquent\EloquentException;
use Exception;
use Illuminate\Support\Facades\DB;
final readonly class CourseRepository implements CourseRepositoryContract
{

    public function __construct(private CourseModel $model)
    {

    }

    public function list(): Courses
    {
        $eloquentCourses = $this->model->all();
        $courses = $eloquentCourses->map(fn(CourseModel $eloquentCourseModel) => $this->toDomain($eloquentCourseModel))->toArray();
        return new Courses($courses);
    }

    public function find(CourseId $id): ?Course
    {
        $eloquentCourseModel = $this->model->newQuery()->find($id->value());
        if ($eloquentCourseModel === null) {
            return null;
        }
        return $this->toDomain($eloquentCourseModel);
    }

    /**
     * @throws EloquentException
     * @throws CourseAlreadyExists
     */
    public function save(Course $course): void
    {
        $courseModel = $this->model->newQuery()->find($course->id()->value());
        if ($courseModel === null) {
            $courseModel = new CourseModel();
            $courseModel->id = $course->id()->value();
        }

        $courseModel->name = $course->name()->value();

        DB::beginTransaction();
        try {
            $courseModel->save();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new EloquentException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception->getPrevious()
            );
        }
    }

    /**
     * @throws CourseNotFound
     */
    public function delete(CourseId $id): void
    {
        $course = $this->model->newQuery()->find($id->value());
        if ($this->model === null) {
            throw new CourseNotFound();
        }
        $course->delete();
    }

    private function toDomain(CourseModel $eloquentCourseModel): Course
    {
        return Course::fromPrimitives(
            $eloquentCourseModel->id,
            $eloquentCourseModel->name,
        );
    }
}
