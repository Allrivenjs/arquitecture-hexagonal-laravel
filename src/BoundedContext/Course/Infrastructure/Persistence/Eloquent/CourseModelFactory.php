<?php

namespace Core\BoundedContext\Course\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<CourseModel>
 */
class CourseModelFactory extends Factory
{
    protected $model = CourseModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'name' => $this->faker->randomElement([
                'Course A',
                'Course B',
                'Course C',
                'Course D',
                'Course E',
            ])
        ];
    }

}
