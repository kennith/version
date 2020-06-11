<?php

namespace Kennith\Version\View\Components;

use Illuminate\View\Component;
use Kennith\Version\ConfigManager;

class VersionComponent extends Component
{
    public $major;
    public $minor;
    public $patch;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $configManager = new ConfigManager(config_path('version.php'));
        $this->major = $configManager->getMajor();
        $this->minor = $configManager->getMinor();
        $this->patch = $configManager->getPatch();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('version::show');
    }
}
