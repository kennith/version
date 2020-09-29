<?php

namespace Kennith\Version;

use Kennith\Version\FileManager;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class BuildFileManager implements FileManager
{
    private $path;
    private $filesystem;
    private $filename;

    // Create the config file if does not exists.
    function __construct($path = __DIR__)
    {
        $this->filename = 'build';
        $this->path = $path;

        $adapter = new Local($path);
        $this->filesystem = new Filesystem($adapter);

        if (!$this->filesystem->has($this->configPath())) {
            $this->createFile();
        }
    }

    public function reset()
    {
        $this->filesystem->delete($this->configPath());
    }

    private function configPath(): string
    {
        return '/' . $this->filename . '.php';
    }

    private function stubPath(): string
    {
        return '/stubs/build.stub';
    }

    // Return config path
    public function path(): string
    {
        // return $this->path;
        return $this->path . $this->configPath();
    }

    public function stub(): string
    {
        return $this->path . $this->stubPath();
    }

    private function createFile()
    {
        // create file from stub
        $content = $this->filesystem->read($this->stubPath());

        $search = '{{ number }}';
        $replace = 1;

        $content = str_replace($search, $replace, $content);

        $this->filesystem->write($this->configPath(), $content);
    }
}
