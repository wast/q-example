<?php

namespace App\Http\Controllers;

use App\Infrastructure\Http\QSymfonySkeletonApiInterface;

final class DashboardController extends Controller
{
    private QSymfonySkeletonApiInterface $qSymfonySkeletonApi;

    public function __construct(QSymfonySkeletonApiInterface $qSymfonySkeletonApi)
    {
        $this->qSymfonySkeletonApi = $qSymfonySkeletonApi;
    }

    /**
     * Display the Dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO to AuthorController
        $authors = $this->qSymfonySkeletonApi->fetchAuthors();
        // TODO pagination
        return view('dashboard',
            [ 'authors' => $authors ]
        );
    }
}
