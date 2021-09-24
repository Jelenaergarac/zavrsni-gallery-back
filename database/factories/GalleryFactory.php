<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        return [
           
            'title'=>$this->faker->sentence(4,true),
            'description'=> $this->faker->text(200),
             'user_id'=> User::inRandomOrder()->first()->id,


        ];
    }
}
