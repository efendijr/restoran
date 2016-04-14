<?php

use App\Tesslug;
use Illuminate\Database\Seeder;

class TesSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Tesslug::create([
        	'title' => 'Title First Slug',
        	'description' => 'First Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat ducimus dolorem quia ipsam doloremque commodi dolores, mollitia nisi autem explicabo ullam quod, asperiores voluptates. Dolorem illum iste ullam mollitia, quidem!',
        	'slug' => 'title-first-slug'
        ]);

        Tesslug::create([
        	'title' => 'Title Second Slug',
        	'description' => 'Second Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat ducimus dolorem quia ipsam doloremque commodi dolores, mollitia nisi autem explicabo ullam quod, asperiores voluptates. Dolorem illum iste ullam mollitia, quidem!',
        	'slug' => 'title-second-slug'
        ]);
    }
}
