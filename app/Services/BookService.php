<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Category;

class BookService
{	
	/**
     * @param $request
     * @return $books
     */
	public function filterName($request)
	{
		$books = Book::where('name', 'LIKE', '%' . $request->name . '%')->get();

		return $books;
	}

	/**
     * @param $request
     * @return $books
     */
	public function filterCategory($request)
	{
		$books = Book::with('Category')->where('category_id', $request->category_id)->get();

		return $books;
	}

	/**
     * @param $request
     * @return $books
     */
	public function filterType($request)
	{
		$books = Book::where('type', 'LIKE', '%' . $request->type . '%')->get();

		return $books;
	}
}