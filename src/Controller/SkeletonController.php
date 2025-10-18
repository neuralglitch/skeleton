<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class SkeletonController extends AbstractController
{
    /**
     * @return array<string, mixed>
     */
    #[Route(path: '/', name: 'skeleton_index', alias: ['home', 'index'])]
    #[Template(template: 'skeleton/index.html.twig')]
    public function skeletonIndex(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    #[Route('/_error', name: '_error_index', alias: ['error'])]
    #[Template(template: 'skeleton/error.html.twig')]
    public function errorIndex(): array
    {
        return [];
    }

    /**
     * @return array<string, int|string>
     */
    #[Route('/_error/403', name: '_error_403', alias: ['error_forbidden'])]
    #[Template(template: 'bundles/TwigBundle/Exception/error403.html.twig')]
    public function error403(): array
    {
        return [
            'status_code' => 403,
            'status_text' => 'Forbidden',
        ];
    }

    /**
     * @return array<string, int|string>
     */
    #[Route('/_error/404', name: '_error_404', alias: ['error_not_found'])]
    #[Template(template: 'bundles/TwigBundle/Exception/error404.html.twig')]
    public function error404(): array
    {
        return [
            'status_code' => 404,
            'status_text' => 'Not Found',
        ];
    }

    /**
     * @return array<string, int|string>
     */
    #[Route('/_error/500', name: '_error_500', alias: ['error_internal'])]
    #[Template(template: 'bundles/TwigBundle/Exception/error500.html.twig')]
    public function error500(): array
    {
        return [
            'status_code' => 500,
            'status_text' => 'Internal Server Error',
        ];
    }

    /**
     * @return array<string, int|string>
     */
    #[Route('/_error/503', name: '_error_503', alias: ['error_unavailable'])]
    #[Template(template: 'bundles/TwigBundle/Exception/error503.html.twig')]
    public function error503(): array
    {
        return [
            'status_code' => 503,
            'status_text' => 'Service Unavailable',
        ];
    }

    /**
     * @return array<string, int|string>
     */
    #[Route('/_error/generic', name: '_error_generic', alias: ['error_teapot'])]
    #[Template(template: 'bundles/TwigBundle/Exception/error.html.twig')]
    public function errorGeneric(): array
    {
        return [
            'status_code' => 418,
            'status_text' => "I'm a teapot",
        ];
    }
}

