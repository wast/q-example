<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Infrastructure\Http\QSymfonySkeletonApiInterface;
use App\Models\Book;
use Illuminate\Http\Request;

final class BookController extends Controller
{
    private QSymfonySkeletonApiInterface $qSymfonySkeletonApi;

    public function __construct(QSymfonySkeletonApiInterface $qSymfonySkeletonApi)
    {
        $this->qSymfonySkeletonApi = $qSymfonySkeletonApi;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = $this->qSymfonySkeletonApi->fetchAuthors();
        return response()->view('book-create', [ 'authors' => $authors ]);
    }

    public function store(StoreBookRequest $storeBookRequest)
    {
        $this->qSymfonySkeletonApi->createBook($storeBookRequest->all());
        return response()->redirectToRoute('author',
            [
                'id' => $storeBookRequest->input('authorId')
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    public function destroy(int $bookId)
    {
        $this->qSymfonySkeletonApi->deleteBookById($bookId);
        return back();
    }
}
