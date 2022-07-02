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
        $authors = $this->qSymfonySkeletonApi->fetchAuthors();
        return view('dashboard',
            [ 'authors' => $authors ]
        );
    }
}
