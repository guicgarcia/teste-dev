<?php

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::all()->each(function ($category) {
            $category->books()->saveMany(factory(Book::class, 10)->make())
        });
    }
}
