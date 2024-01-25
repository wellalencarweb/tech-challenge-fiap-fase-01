<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\BoundedContext\Client\Infrastructure\Eloquent\ClientModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ClientModel::newFactoryTimes(2)->create();
    }
}
