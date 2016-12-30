<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            $price = rand(99, 2000);
            $cost  = $price - rand(1, 98);
            DB::table('products')->insert([
                'name'    => $faker->name,
                'price'   => $price,
                'cost'    => $cost,
                'classId' => rand(0, 4),
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            DB::table('productClass')->insert([
                'name' => $faker->name,
            ]);
        }
    }
}
