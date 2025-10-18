<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class VersionExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('lts', [$this, 'formatLts']),
        ];
    }

    /**
     * Adds "LTS" suffix to version numbers ending in .4 (e.g., "6.4" -> "6.4 LTS")
     */
    public function formatLts(string $version): string
    {
        if (preg_match('/\.\d*4$/', $version)) {
            return $version . ' LTS';
        }

        return $version;
    }
}

