<?php

namespace Src\BoundedContext\Product\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;


class ProductFactory extends Factory
{
    protected $model = ProductModel::class;

    #[ArrayShape(['name' => "string", 'email' => "string"])]
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cpf' => fake()->numerify('###########')
        ];
    }
}
