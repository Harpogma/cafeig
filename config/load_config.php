<?php
function loadConfig($defaultPath = __DIR__ . '/config_default.ini', $customPath = __DIR__ . '/config.ini') {
    if (!file_exists($defaultPath)) {
        throw new Exception("Default config not found: $defaultPath");
    }

    $default = parse_ini_file($defaultPath, true);
    $custom = file_exists($customPath) ? parse_ini_file($customPath, true) : [];

    // Merge custom into default (deep merge)
    foreach ($custom as $section => $settings) {
        if (!isset($default[$section])) {
            $default[$section] = $settings;
        } else {
            $default[$section] = array_merge($default[$section], $settings);
        }
    }

    return $default;
}