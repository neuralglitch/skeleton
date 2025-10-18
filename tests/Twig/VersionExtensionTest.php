<?php

namespace App\Tests\Twig;

use App\Twig\VersionExtension;
use PHPUnit\Framework\TestCase;
use Twig\TwigFilter;

class VersionExtensionTest extends TestCase
{
    private VersionExtension $extension;

    protected function setUp(): void
    {
        $this->extension = new VersionExtension();
    }

    public function testGetFiltersReturnsLtsFilter(): void
    {
        $filters = $this->extension->getFilters();

        self::assertCount(1, $filters);
        self::assertInstanceOf(TwigFilter::class, $filters[0]);
        self::assertSame('lts', $filters[0]->getName());
    }

    /**
     * @dataProvider ltsVersionProvider
     */
    public function testFormatLtsAddsLtsSuffixToVersionsEndingInFour(string $version, string $expected): void
    {
        $result = $this->extension->formatLts($version);

        self::assertSame($expected, $result);
    }

    public static function ltsVersionProvider(): \Generator
    {
        // Versions ending in .4 should get LTS suffix
        yield 'Symfony 6.4' => ['6.4', '6.4 LTS'];
        yield 'Symfony 5.4' => ['5.4', '5.4 LTS'];
        yield 'Symfony 7.4' => ['7.4', '7.4 LTS'];
        yield 'Version 1.4' => ['1.4', '1.4 LTS'];
        yield 'Version 10.4' => ['10.4', '10.4 LTS'];
        yield 'Version with patch 6.4.0' => ['6.4.0', '6.4.0'];
        yield 'Version 2.14' => ['2.14', '2.14 LTS'];
        yield 'Version 3.24' => ['3.24', '3.24 LTS'];
        yield 'Version 4.34' => ['4.34', '4.34 LTS'];

        // Versions not ending in .4 should remain unchanged
        yield 'Symfony 6.3' => ['6.3', '6.3'];
        yield 'Symfony 7.0' => ['7.0', '7.0'];
        yield 'Symfony 7.1' => ['7.1', '7.1'];
        yield 'Symfony 7.2' => ['7.2', '7.2'];
        yield 'Symfony 7.5' => ['7.5', '7.5'];
        yield 'Version 1.0' => ['1.0', '1.0'];
        yield 'Version 2.1' => ['2.1', '2.1'];
        yield 'Version 3.14.1' => ['3.14.1', '3.14.1'];
        yield 'Version 6.4.1' => ['6.4.1', '6.4.1'];
        yield 'Version 6.4.12' => ['6.4.12', '6.4.12'];

        // Edge cases
        yield 'Single digit four (no dot)' => ['4', '4'];
        yield 'Single digit non-four' => ['5', '5'];
        yield 'Version ending with 14' => ['1.14', '1.14 LTS'];
        yield 'Version ending with 24' => ['1.24', '1.24 LTS'];
        yield 'Version ending with 44' => ['1.44', '1.44 LTS'];
        yield 'Version with trailing four' => ['6.40', '6.40'];
        yield 'Version 0.4' => ['0.4', '0.4 LTS'];
    }

    public function testFormatLtsHandlesEmptyString(): void
    {
        $result = $this->extension->formatLts('');

        self::assertSame('', $result);
    }

    public function testFormatLtsHandlesNonNumericVersions(): void
    {
        $result = $this->extension->formatLts('stable');

        self::assertSame('stable', $result);
    }
}

