<?php
function loadConfig($defaultPath = BASE_PATH . '/config_default.ini', $customPath = BASE_PATH . '/config.ini') {

    if (!file_exists($customPath)) {
        throw new Exception("Custom config not found: $customPath");
    }

    $default = parse_ini_file($defaultPath, true);
    if ($default === false) {
        throw new Exception("Failed to parse default config: $defaultPath");
    }

    $custom = parse_ini_file($customPath, true);
    if ($custom === false) {
        throw new Exception("Failed to parse custom config: $customPath");
    }

    // Merge custom into default (shallow merge per section)
    foreach ($custom as $section => $settings) {
        if (!isset($default[$section])) {
            $default[$section] = $settings;
        } else {
            $default[$section] = array_merge($default[$section], $settings);
        }
    }

    return $default;
}
