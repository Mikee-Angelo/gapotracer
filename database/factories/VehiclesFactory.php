<?php

namespace Database\Factories;

use App\Models\Vehicles;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiclesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'body_no' => $this->faker->word,
        'plate_no' => $this->faker->word,
        'contact_no' => $this->faker->word,
        'address' => $this->faker->text,
        'type' => $this->faker->randomElement(['Bus', 'Tricycle', 'Taxi', 'Van', 'Truck']),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
