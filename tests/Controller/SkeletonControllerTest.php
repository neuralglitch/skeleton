<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SkeletonControllerTest extends WebTestCase
{
    #[DataProvider('routeProvider')]
    public function testRouteIsSuccessful(string $url, int $expectedStatusCode = 200): void
    {
        $client = self::createClient();
        $client->request('GET', $url);

        self::assertResponseStatusCodeSame($expectedStatusCode);
    }

    public static function routeProvider(): \Generator
    {
        yield 'Homepage' => ['/'];
        yield 'Error index' => ['/_error'];
        yield 'Error 403' => ['/_error/403'];
        yield 'Error 404' => ['/_error/404'];
        yield 'Error 500' => ['/_error/500'];
        yield 'Error 503' => ['/_error/503'];
        yield 'Error generic' => ['/_error/generic'];
    }

    public function testHomepageRendersCorrectTemplate(): void
    {
        $client = self::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('html');
    }

    public function testErrorIndexPageRendersCorrectly(): void
    {
        $client = self::createClient();
        $client->request('GET', '/_error');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('html');
    }

    #[DataProvider('errorPageProvider')]
    public function testErrorPageRendersWithCorrectStatusCode(
        string $url,
        int $expectedStatusCode
    ): void {
        $client = self::createClient();
        $crawler = $client->request('GET', $url);

        self::assertResponseIsSuccessful();
        
        // Check that the page contains the status code somewhere in the content
        $content = $crawler->text();
        self::assertStringContainsString((string) $expectedStatusCode, $content);
    }

    public static function errorPageProvider(): \Generator
    {
        yield '403 Forbidden' => ['/_error/403', 403];
        yield '404 Not Found' => ['/_error/404', 404];
        yield '500 Internal Server Error' => ['/_error/500', 500];
        yield '503 Service Unavailable' => ['/_error/503', 503];
        yield '418 Generic Error' => ['/_error/generic', 418];
    }

    public function testError403PageVariables(): void
    {
        $client = self::createClient();
        $client->request('GET', '/_error/403');

        self::assertResponseIsSuccessful();
        
        $crawler = $client->getCrawler();
        $content = $crawler->text();
        
        self::assertStringContainsString('403', $content);
        self::assertStringContainsString('Access Denied', $content);
    }

    public function testError404PageVariables(): void
    {
        $client = self::createClient();
        $client->request('GET', '/_error/404');

        self::assertResponseIsSuccessful();
        
        $crawler = $client->getCrawler();
        $content = $crawler->text();
        
        self::assertStringContainsString('404', $content);
        self::assertStringContainsString('Not Found', $content);
    }

    public function testError500PageVariables(): void
    {
        $client = self::createClient();
        $client->request('GET', '/_error/500');

        self::assertResponseIsSuccessful();
        
        $crawler = $client->getCrawler();
        $content = $crawler->text();
        
        self::assertStringContainsString('500', $content);
        self::assertStringContainsString('Internal Server Error', $content);
    }

    public function testError503PageVariables(): void
    {
        $client = self::createClient();
        $client->request('GET', '/_error/503');

        self::assertResponseIsSuccessful();
        
        $crawler = $client->getCrawler();
        $content = $crawler->text();
        
        self::assertStringContainsString('503', $content);
        self::assertStringContainsString('Service Unavailable', $content);
    }

    public function testErrorGenericPageVariables(): void
    {
        $client = self::createClient();
        $client->request('GET', '/_error/generic');

        self::assertResponseIsSuccessful();
        
        $crawler = $client->getCrawler();
        $content = $crawler->text();
        
        self::assertStringContainsString('418', $content);
        self::assertStringContainsString("I'm a teapot", $content);
    }

    public function testAllRoutesReturnHtmlResponse(): void
    {
        $client = self::createClient();
        
        $routes = [
            '/',
            '/_error',
            '/_error/403',
            '/_error/404',
            '/_error/500',
            '/_error/503',
            '/_error/generic',
        ];

        foreach ($routes as $route) {
            $client->request('GET', $route);
            self::assertResponseIsSuccessful("Route {$route} should be successful");
            self::assertResponseHeaderSame('Content-Type', 'text/html; charset=UTF-8', "Route {$route} should return HTML");
        }
    }

    public function testHomepageResponseFormat(): void
    {
        $client = self::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('html');
    }

    public function testErrorPagesResponseFormat(): void
    {
        $client = self::createClient();
        
        $errorRoutes = [
            '/_error/403',
            '/_error/404',
            '/_error/500',
            '/_error/503',
            '/_error/generic',
        ];

        foreach ($errorRoutes as $route) {
            $client->request('GET', $route);
            self::assertResponseIsSuccessful("Route {$route} should be successful");
            self::assertResponseFormatSame('html', "Route {$route} should return HTML format");
        }
    }
}

