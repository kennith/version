<?php

use Kennith\Version\BuildFileManager;
use Kennith\Version\BuildManager;

$file = __DIR__ . '/build.php';

beforeEach(function () use ($file) {
    if (file_exists($file)) {
        unlink($file);
    }
});

afterEach(function () use ($file) {
    if (file_exists($file)) {
        unlink($file);
    }
});

test('build number should be 1', function () use ($file) {
    $builFileManager = new BuildFileManager();
    $builFileManager->reset();

    $buildManager = new BuildManager(new BuildFileManager());

    assertEquals(1, $buildManager->number());
});

test('build number should be 2', function () use ($file) {
    $builFileManager = new BuildFileManager();
    $builFileManager->reset();

    $buildManager = new BuildManager(new BuildFileManager());

    $buildManager->increment();

    assertEquals(2, $buildManager->number());
});
