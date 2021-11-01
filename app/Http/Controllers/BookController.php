<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    public function index()
    {
        //return response()->json(Book::all());
         return BookResource::collection(Book::all());
    }

    public function show(Book $book)
    {

    }

    public function store()
    {

    }

    public function update(Book $book)
    {

    }

    public function destroy(Book $book)
    {

    }

    public function filter(Book $book)
    {

    }
}
