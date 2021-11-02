<?php

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category::all()->each(function ($category) {
        //     $category->books()->saveMany(factory(Book::class, 10)->make())
        // });

        $categories = Category::Factory(10)->create();
        $categories->each(function($category) {
            $category->books()->createMany(Book::factory(2)->make()->toArray());
        });
    }
}
