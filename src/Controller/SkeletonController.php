<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SkeletonController extends AbstractController
{
    #[Route(path: '/', name: 'skeleton_index')]
    public function skeletonIndex(): Response
    {
        return $this->render('skeleton/index.html.twig');
    }

    #[Route('/_error', name: '_error_index')]
    public function errorIndex(): Response
    {
        return $this->render('skeleton/error.html.twig');
    }

    #[Route('/_error/403', name: '_error_403')]
    public function error403(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error403.html.twig', [
            'status_code' => 403,
            'status_text' => 'Forbidden',
        ]);
    }

    #[Route('/_error/404', name: '_error_404')]
    public function error404(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig', [
            'status_code' => 404,
            'status_text' => 'Not Found',
        ]);
    }

    #[Route('/_error/500', name: '_error_500')]
    public function error500(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error500.html.twig', [
            'status_code' => 500,
            'status_text' => 'Internal Server Error',
        ]);
    }

    #[Route('/_error/503', name: '_error_503')]
    public function error503(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error503.html.twig', [
            'status_code' => 503,
            'status_text' => 'Service Unavailable',
        ]);
    }

    #[Route('/_error/generic', name: '_error_generic')]
    public function errorGeneric(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error.html.twig', [
            'status_code' => 418,
            'status_text' => "I'm a teapot",
        ]);
    }
}

