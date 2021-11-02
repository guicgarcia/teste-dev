<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Book;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(BookSeeder::class);

        $categories = Category::Factory(5)->create();
        $categories->each(function($category) {
            $category->books()->createMany(Book::factory(2)->make()->toArray());
        });
    }
}
