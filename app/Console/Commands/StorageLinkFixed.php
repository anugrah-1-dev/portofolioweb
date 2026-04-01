<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StorageLinkFixed extends Command
{
    protected $signature = 'storage:relink';

    protected $description = 'Create storage symlink using PHP native symlink() — works on hosts where exec() is disabled';

    public function handle(): int
    {
        $target = storage_path('app/public');
        $link   = public_path('storage');

        if (is_link($link)) {
            $this->components->info('Storage symlink already exists.');
            return self::SUCCESS;
        }

        if (file_exists($link)) {
            $this->components->error("A file or directory already exists at [{$link}]. Remove it first.");
            return self::FAILURE;
        }

        if (! is_dir($target)) {
            mkdir($target, 0755, true);
            $this->components->info("Created target directory [{$target}].");
        }

        if (symlink($target, $link)) {
            $this->components->info("Storage link [{$link}] created successfully.");
            return self::SUCCESS;
        }

        $this->components->error('Failed to create storage symlink. Check directory permissions.');
        return self::FAILURE;
    }
}
