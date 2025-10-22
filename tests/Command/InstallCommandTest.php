<?php

declare(strict_types=1);

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

class InstallCommandTest extends KernelTestCase
{
    private Filesystem $filesystem;
    private string $projectDir;
    private string $envLocalPath;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->projectDir = $kernel->getProjectDir();
        $this->filesystem = new Filesystem();
        $this->envLocalPath = $this->projectDir . '/.env.local';

        // Backup existing .env.local if it exists
        if ($this->filesystem->exists($this->envLocalPath)) {
            $this->filesystem->copy(
                $this->envLocalPath,
                $this->envLocalPath . '.backup'
            );
        }
    }

    protected function tearDown(): void
    {
        // Restore .env.local backup if it exists
        if ($this->filesystem->exists($this->envLocalPath . '.backup')) {
            $this->filesystem->rename(
                $this->envLocalPath . '.backup',
                $this->envLocalPath,
                true
            );
        } elseif ($this->filesystem->exists($this->envLocalPath)) {
            // Clean up test .env.local if no backup exists
            $this->filesystem->remove($this->envLocalPath);
        }

        parent::tearDown();
    }

    public function testExecuteSuccessfully(): void
    {
        // Remove .env.local to simulate fresh install
        if ($this->filesystem->exists($this->envLocalPath)) {
            $this->filesystem->remove($this->envLocalPath);
        }

        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('.env.local created successfully!', $output);

        // Check that .env.local was created
        $this->assertFileExists($this->envLocalPath);

        // Check that .env.local contains APP_SECRET and APP_ENV
        $envContent = file_get_contents($this->envLocalPath);
        $this->assertNotFalse($envContent);
        $this->assertStringContainsString('APP_SECRET=', $envContent);
        $this->assertStringContainsString('APP_ENV=dev', $envContent);
        $this->assertStringNotContainsString('DATABASE_URL=', $envContent);
        $this->assertStringNotContainsString('MAILER_DSN=', $envContent);
    }

    public function testExecuteWithExistingEnvLocal(): void
    {
        // Create a test .env.local
        $testContent = "APP_SECRET=test_secret_123\nAPP_ENV=test\n";
        $this->filesystem->dumpFile($this->envLocalPath, $testContent);

        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('.env.local already exists', $output);

        // Check that .env.local was NOT overwritten
        $envContent = file_get_contents($this->envLocalPath);
        $this->assertNotFalse($envContent);
        $this->assertStringContainsString('test_secret_123', $envContent);
    }

    public function testExecuteWithForceOption(): void
    {
        // Create a test .env.local
        $testContent = "APP_SECRET=old_secret\nAPP_ENV=test\n";
        $this->filesystem->dumpFile($this->envLocalPath, $testContent);

        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['--force' => true]);

        $commandTester->assertCommandIsSuccessful();

        // Check that .env.local was overwritten
        $envContent = file_get_contents($this->envLocalPath);
        $this->assertNotFalse($envContent);
        $this->assertStringNotContainsString('old_secret', $envContent);
        $this->assertStringContainsString('APP_SECRET=', $envContent);
        $this->assertStringContainsString('APP_ENV=dev', $envContent);
    }

    public function testGeneratedSecretIsRandom(): void
    {
        // Remove .env.local to simulate fresh install
        if ($this->filesystem->exists($this->envLocalPath)) {
            $this->filesystem->remove($this->envLocalPath);
        }

        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $envContent = file_get_contents($this->envLocalPath);
        $this->assertNotFalse($envContent);

        // Extract APP_SECRET value
        preg_match('/APP_SECRET=([a-f0-9]+)/', $envContent, $matches);
        $this->assertCount(2, $matches);
        $secret1 = $matches[1];

        // Generate another secret with --force
        $commandTester->execute(['--force' => true]);

        $envContent = file_get_contents($this->envLocalPath);
        $this->assertNotFalse($envContent);

        preg_match('/APP_SECRET=([a-f0-9]+)/', $envContent, $matches);
        $this->assertCount(2, $matches);
        $secret2 = $matches[1];

        // Secrets should be different (extremely unlikely to be the same)
        $this->assertNotEquals($secret1, $secret2);

        // Secret should be 32 characters (16 bytes hex encoded)
        $this->assertEquals(32, strlen($secret2));
    }

    public function testCommandHasCorrectName(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:install');

        $this->assertEquals('app:install', $command->getName());
        $this->assertEquals(
            'Create .env.local with APP_SECRET',
            $command->getDescription()
        );
    }

    public function testCommandHasForceOption(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:install');
        $definition = $command->getDefinition();

        $this->assertTrue($definition->hasOption('force'));

        $option = $definition->getOption('force');
        $this->assertEquals('f', $option->getShortcut());
        $this->assertFalse($option->acceptValue());
    }
}

