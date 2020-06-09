<?php

namespace Kennith\Version;

/**
 * Config Manager
 */
class ConfigManager
{
    private $major;
    private $minor;
    private $patch;

    private $configFile;

    public function __construct($configPath = 'version.php')
    {
        $this->configFile = $configPath;

        $this->major = 0;
        $this->minor = 0;
        $this->patch = 0;

        $this->loadConfigurationFile();
    }

    /**
     * Load configuration file
     * @param  string $configFile Path to the config file
     */
    protected function loadConfigurationFile()
    {
        // if file does not exist, create a brand new one
        if (!file_exists($this->configFile)) {
            $this->saveConfigurationFile();
        }
        $version = require $this->configFile;

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

    public function set($core)
    {
        switch ($core) {
            case 'major':
            $this->setMajor();
            break;
            case 'minor':
            $this->setMinor();
            break;
            case 'patch':
            $this->setPatch();
            break;
        }
        return;
    }
}
