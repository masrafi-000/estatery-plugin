<?php
$json = file_get_contents('languages/en.json');
$data = json_decode($json, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON Error: " . json_last_error_msg() . "\n";
    exit;
}

function get_nested($data, $path) {
    $keys = explode('.', $path);
    foreach ($keys as $k) {
        if (isset($data[$k])) {
            $data = $data[$k];
        } else {
            return null;
        }
    }
    return $data;
}

$val = get_nested($data, 'pages.properties.filters.all');
echo "Value: " . ($val ?? 'NOT FOUND') . "\n";
