<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->text(15),
            'description'=>$this->faker->text(50),
            'tags'=>"日本,絶景",
            'address'=>$this->faker->address(),
            'user_id'=>User::factory(),
        ];
    }
}
