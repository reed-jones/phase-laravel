<?php

namespace ReedJones\Phase\Commands;

use Illuminate\Console\Command;
use ReedJones\Phase\Facades\Phase;

class GeneratePhaseRouter extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'phase:routes {--json}';

    /**
     * Hides the command from the php artisan route helper
     *
     * @return void
     */
    protected function configure()
    {
        $this->setHidden(true);
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('json')) {
            $this->line(json_encode(Phase::getRoutes()));
        } else {
            $this->table(['URI', 'Action', 'Middleware'], Phase::getRoutes());
        }
    }
}
