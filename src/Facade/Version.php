<?php
namespace Kennith\Version\Facade;

use Illuminate\Support\Facades\Facade;
use Kennith\Version\ConfigManager;

class Version extends Facade 
{
	protected static function getFacadeAccessor()
	{
	    return (new ConfigManager(config_path('version.php')));
	}
}