<?php

namespace Hammadzafar05\MobileBottomNav\Commands;

use Illuminate\Console\Command;

class MobileBottomNavCommand extends Command
{
    public $signature = 'mobile-bottom-nav';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
