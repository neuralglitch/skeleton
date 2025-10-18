<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use PHPUnit\Framework\Attributes\DataProvider;

final class ApplicationAvailabilityTest extends WebTestCase
{
    #[DataProvider('urlProvider')]
    public function testPageIsSuccessful(string $url): void
    {
        $client = self::createClient();
        $client->request('GET', $url);

        self::assertResponseIsSuccessful();
    }

    public static function urlProvider(): \Generator
    {
        yield ['/'];
        yield ['/_error'];
        yield ['/_error/403'];
        yield ['/_error/404'];
        yield ['/_error/500'];
        yield ['/_error/503'];
        yield ['/_error/generic'];
    }
}
