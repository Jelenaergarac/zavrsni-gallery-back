<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'textarea'=> $this->faker->text(50),
            'user_id'=>User::inRandomOrder()->first()->id,
            'gallery_id'=>Gallery::inRandomOrder()->first()->id,
        ];
    }
}
