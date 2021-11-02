<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;

class BookController extends Controller
{
    public function index()
    {
         return BookResource::collection(Book::all());
    }

    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function store(BookStoreRequest $request)
    {
        $input = $request->validated();
        $book = Book::Create($input);

        return new BookResource($book);
    }

    public function update(Book $book, BookUpdateRequest $request)
    {
        $input = $request->validated();

        $book->fill($input);
        $book->save();

        return new BookResource($book->fresh());
    }

    public function destroy(Book $book)
    {
        $book->delete();
    }

    public function filter(Request $request)
    {
        $book = Book::where('name', 'LIKE', '%' . $request->name . '%')->first();
        dd($book->name);
    }
}
