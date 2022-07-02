<?php

namespace App\Http\Controllers;

use App\Infrastructure\Http\QSymfonySkeletonApiInterface;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private QSymfonySkeletonApiInterface $qSymfonySkeletonApi;

    public function __construct(QSymfonySkeletonApiInterface $qSymfonySkeletonApi)
    {
        $this->qSymfonySkeletonApi = $qSymfonySkeletonApi;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO from Dashboard
    }

    public function show(int $authorId)
    {
        $author = $this->qSymfonySkeletonApi->fetchAuthorById($authorId);
        return view('author', [ 'author' => $author ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
    }
}
