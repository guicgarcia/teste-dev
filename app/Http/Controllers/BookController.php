<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Services\BookService;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

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
        if (!empty($request->category)) {
            $books = $this->bookService->filterCategory($request);
        } elseif (!empty($request->name)) {
            $books = $this->bookService->filterName($request);
        } elseif (!empty($request->type)) {
            $books = $this->bookService->filterType($request);
        }

        //return BookResource::collection($books);

       return response()->json($books);
    }
}
