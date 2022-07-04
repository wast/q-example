<?php

namespace App\Http\Controllers;

use App\Infrastructure\Http\QSymfonySkeletonApiInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

final class AuthorController extends Controller
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

    public function destroy(int $authorId)
    {
        $author = $this->qSymfonySkeletonApi->fetchAuthorById($authorId);

        if (empty($author->books))
        {
            $this->qSymfonySkeletonApi->deleteAuthorById($authorId);
            return response()->redirectToRoute('dashboard');
        }

        return new BadRequestException("Author can't be deleted because it has related books");
    }
}
