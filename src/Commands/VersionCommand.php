<?php

namespace Kennith\Version\Commands;

use Illuminate\Console\Command;
use Kennith\Version\ConfigManager;

class VersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version {core=patch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update version number';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ConfigManager $configManager)
    {
        $core = $this->argument('core');

        if (in_array($core, ['major', 'minor', 'patch'])) {
            (new ConfigManager(config_path('version.php')))->set($core);
        }

        $this->info((new ConfigManager(config_path('version.php')))->getCurrentVersion());
    }
}
