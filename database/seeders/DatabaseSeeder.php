<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\BoundedContext\Client\Infrastructure\Eloquent\ClientModel;
use Src\BoundedContext\Product\Domain\Enums\ProductCategoryEnum;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ClientModel::newFactoryTimes(1)->create(['cpf' => '95162320005']);

        foreach(ProductCategoryEnum::values() as $key => $id) {
            DB::table('product_categories')->updateOrInsert([
                'id' => $id,
                'description' => $key,
            ]);
        }
    }
}
