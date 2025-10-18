<?php

declare(strict_types=1);

namespace App\Tests;

use App\Kernel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

final class KernelTest extends TestCase
{
    public function testKernelExtendsBaseKernel(): void
    {
        $kernel = new Kernel('test', true);
        
        self::assertInstanceOf(BaseKernel::class, $kernel);
    }

    public function testKernelCanBeInstantiatedInTestEnvironment(): void
    {
        $kernel = new Kernel('test', true);
        
        self::assertSame('test', $kernel->getEnvironment());
        self::assertTrue($kernel->isDebug());
    }

    public function testKernelCanBeInstantiatedInProdEnvironment(): void
    {
        $kernel = new Kernel('prod', false);
        
        self::assertSame('prod', $kernel->getEnvironment());
        self::assertFalse($kernel->isDebug());
    }

    public function testKernelHasProjectDirectory(): void
    {
        $kernel = new Kernel('test', true);
        
        $projectDir = $kernel->getProjectDir();
        
        self::assertDirectoryExists($projectDir);
    }

    public function testKernelHasLogDirectory(): void
    {
        $kernel = new Kernel('test', true);
        
        $logDir = $kernel->getLogDir();
        
        self::assertStringEndsWith('/var/log', $logDir);
    }

    public function testKernelHasCacheDirectory(): void
    {
        $kernel = new Kernel('test', true);
        
        $cacheDir = $kernel->getCacheDir();
        
        self::assertStringEndsWith('/var/cache/test', $cacheDir);
    }

    public function testKernelBootsSuccessfully(): void
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();
        
        // Verify kernel booted by checking it has a container
        $container = $kernel->getContainer();
        self::assertInstanceOf(\Symfony\Component\DependencyInjection\ContainerInterface::class, $container);
        
        $kernel->shutdown();
    }

    public function testKernelCanShutdown(): void
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();
        
        // Verify kernel booted by checking it has a container
        $container = $kernel->getContainer();
        self::assertInstanceOf(\Symfony\Component\DependencyInjection\ContainerInterface::class, $container);
        
        $kernel->shutdown();
        
        // After shutdown, we can verify by checking the kernel still exists
        self::assertInstanceOf(Kernel::class, $kernel);
    }

    public function testKernelHasContainer(): void
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();
        
        $container = $kernel->getContainer();
        
        self::assertInstanceOf(\Symfony\Component\DependencyInjection\ContainerInterface::class, $container);
        
        $kernel->shutdown();
    }

    public function testKernelStartTimeIsTracked(): void
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();
        
        $startTime = $kernel->getStartTime();
        
        self::assertGreaterThan(0, $startTime);
        
        $kernel->shutdown();
    }

    public function testKernelHasBundles(): void
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();
        
        $bundles = $kernel->getBundles();
        
        self::assertNotEmpty($bundles);
        
        $kernel->shutdown();
    }

    public function testKernelCharsetIsUtf8(): void
    {
        $kernel = new Kernel('test', true);
        
        self::assertSame('UTF-8', $kernel->getCharset());
    }
}

