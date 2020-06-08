<?php

namespace ArtisanVersion;

/**
 * Artisan Version
 */
class ConfigManager
{
    private $major;
    private $minor;
    private $patch;

    private $configFile;

    public function __construct()
    {
        $this->configFile = __DIR__.'/config.php';
        $this->major = 0;
        $this->minor = 0;
        $this->patch = 0;

        $this->loadConfigurationFile($this->configFile);
    }

    /**
     * Load configuration file
     * @param  string $configFile Path to the config file
     */
    protected function loadConfigurationFile(string $configFile)
    {
        // if file does not exist, create a brand new one
        if(!file_exists ($configFile)) {
            $this->saveConfigurationFile();
        }
        $version = require $configFile;

        $this->major = $version['major'];
        $this->minor = $version['minor'];
        $this->patch = $version['patch'];
    }

    /**
     * Write configuration file
     * @return boolean Write success or fail
    */
    protected function saveConfigurationFile()
    {
        $content = file_get_contents(__DIR__.'/stubs/version.stub');
        $content = str_replace('{{ major }}', $this->major, $content);
        $content = str_replace('{{ minor }}', $this->minor, $content);
        $content = str_replace('{{ patch }}', $this->patch, $content);

        $write = file_put_contents(
            $this->configFile,
            $content
        );

        return $write;
    }

    /**
     * Get current version
     * @return string Returns a semver formatted string
     */
    public function getCurrentVersion()
    {
        $version = [
            $this->major,
            $this->minor,
            $this->patch,
        ];

        return implode('.', $version);
    }

    /**
     * Increment of 1 to major
     */
    public function setMajor()
    {
        $this->major++;
        $this->saveConfigurationFile();
    }

    /**
     * Increment of 1 to minor
     */
    public function setMinor()
    {
        $this->minor++;
        $this->saveConfigurationFile();
    }

    /**
     * Increment of 1 to patch
     */
    public function setPatch()
    {
        $this->patch++;
        $this->saveConfigurationFile();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/version.php' => config_path('version.php'),
        ]);
    }
}
