<?php

use Kennith\Version\ConfigManager;

$file = __DIR__.'/version.php';

beforeEach(function () use ($file) {
    if(file_exists($file)) {
        unlink($file);
    }
});

afterEach(function () use ($file) {
    if(file_exists($file)) {
        unlink($file);
    }
});

test('version should be 0.0.0', function () use ($file) {
    $configManager = new ConfigManager($file);
    assertEquals('0.0.0', $configManager->getCurrentVersion());
});

test('should increment major from version 1 to major version 2', function () use ($file) {
    $configManager = new ConfigManager($file);
    assertEquals('0.0.0', $configManager->getcurrentVersion());
	$configManager->setMajor();
    assertEquals('1.0.0', $configManager->getcurrentVersion());
});

test('should increment minor to 0.1.0', function() use ($file) {
    $configManager = new ConfigManager($file);
    assertEquals('0.0.0', $configManager->getcurrentVersion());
    $configManager->setMinor();
    assertEquals('0.1.0', $configManager->getcurrentVersion());
});

test('should increment major.minor.patch to 3.1.8', function() use ($file) {
    $configManager = new ConfigManager($file);
    assertEquals('0.0.0', $configManager->getcurrentVersion());

    foreach(range(0,2) as $key => $value) {
        $configManager->setMajor();
    }

    $configManager->setMinor();

    foreach(range(0,7) as $key => $value) {
        $configManager->setPatch();
    }

    assertEquals('3.1.8', $configManager->getcurrentVersion());
});
