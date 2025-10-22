<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'app:install',
    description: 'Create .env.local with APP_SECRET'
)]
final class InstallCommand extends Command
{
    private const ENV_LOCAL_FILE = '.env.local';

    public function __construct(
        private readonly string $projectDir,
        private readonly Filesystem $filesystem
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption(
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force overwrite of existing .env.local file'
            )
            ->setHelp(
                <<<'HELP'
The <info>%command.name%</info> command creates .env.local with APP_SECRET:

  <info>php %command.full_name%</info>

Use the <info>--force</info> option to overwrite existing .env.local:
  <info>php %command.full_name% --force</info>
HELP
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $envLocalPath = $this->projectDir . '/' . self::ENV_LOCAL_FILE;
        $force = $input->getOption('force');

        // Check if .env.local already exists
        if ($this->filesystem->exists($envLocalPath) && !$force) {
            $io->note('.env.local already exists. Use --force to overwrite.');
            return Command::SUCCESS;
        }

        // Generate APP_SECRET
        $appSecret = bin2hex(random_bytes(16));

        // Create .env.local content
        $content = <<<ENV
###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=$appSecret
###< symfony/framework-bundle ###

ENV;

        // Write .env.local file
        try {
            $this->filesystem->dumpFile($envLocalPath, $content);
            $io->success('.env.local created successfully!');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error(sprintf('Failed to create .env.local: %s', $e->getMessage()));
            return Command::FAILURE;
        }
    }
}

