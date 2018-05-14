<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        factory(App\Annonce::class, 50)->create();
//        factory(App\Category::class, 20)->create();

        $faker = \Faker\Factory::create();
        $annonces = \App\Annonce::OrderBy('id', 'desc')->get();

        foreach ($annonces as $annonce) {

            for ($i=0; $i<4; $i++){

                \App\AnnonceImage::create([
                    'annonce_id' => $annonce->id,
                    'picture' => $faker->randomElement(['1.png','2.png','3.png','4.png','5.png','6.png','7.png','8.png','9.png','10.png']),
                ]);

            }
        }
    }
}
