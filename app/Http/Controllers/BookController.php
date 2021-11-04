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

    /**
     * BookController constructor.
     * @param BookService $bookService
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * @return BookResource
     */
    public function index()
    {
         return BookResource::collection(Book::orderBy('id', 'desc')->paginate(20));
    }

    /**
     * @param Book $book
     * @return BookResource
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * @param BookStoreRequest $request
     * @return BookResource
     */
    public function store(BookStoreRequest $request)
    {
        $input = $request->validated();
        $book = Book::Create($input);

        return new BookResource($book);
    }

    /**
     * @param Book $book
     * @param BookUpdateRequest $request
     * @return BookResource
     */
    public function update(Book $book, BookUpdateRequest $request)
    {
        $input = $request->validated();

        $book->fill($input);
        $book->save();

        return new BookResource($book->fresh());
    }

    /**
     * @param Book $book
     */
    public function destroy(Book $book)
    {
        $book->delete();
    }

    /**
     * @param Request $request
     * @return BookResource
     */
    public function filter(Request $request)
    {
        if (!empty($request->name)) {
            $books = $this->bookService->filterName($request);
            return BookResource::collection($books);
        } elseif (!empty($request->category_id)) {
            $books = $this->bookService->filterCategory($request);
            return BookResource::collection($books);
        } elseif (!empty($request->type)) {
            $books = $this->bookService->filterType($request);
            return BookResource::collection($books);
        }
    }

    public function categories()
    {
        $categories = Category::all(); 

        return response()->json($categories);
    }
}
