<?php

namespace Kennith\Version;

class BuildManager
{
    private $buildPath;
    private $stubPath;
    private $number;
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
        $this->buildPath = $this->fileManager->path();
        $this->stubPath = $this->fileManager->stub();
        $this->load();
    }

    private function load()
    {
        $build = require $this->buildPath;

        $this->number = $build['number'];
    }

    private function save()
    {
        $content = file_get_contents($this->stubPath);

        $search = ['{{ number }}'];
        $replace = $this->number;

        $content = str_replace($search, $replace, $content);

        $write = file_put_contents($this->buildPath, $content);
    }

    public function number()
    {
        return $this->number;
    }

    public function increment()
    {
        $this->number++;
        $this->save();
    }
}
