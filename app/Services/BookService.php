<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Category;

class BookService
{
	public function filterCategory($request)
	{
		$category = Category::where('name', 'LIKE', '%' . $request->category . '%')->first();

		$books = Book::with('Category')->where('id', $category->id)->first();

		return $books;
	}

	public function filterName($request)
	{
		$books = Book::where('name', 'LIKE', '%' . $request->name . '%')->get();

		return $books;
	}

	public function filterType($request)
	{

	}
}