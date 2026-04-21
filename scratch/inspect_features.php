<?php
$json_file = 'c:\xampp\htdocs\anna_real_estate\wp-content\themes\estatery\data\properties.json';
$json_data = file_get_contents($json_file);
$parsed_data = json_decode($json_data, true);
$raw_properties = $parsed_data['root']['property'] ?? [];

$count = 0;
foreach ($raw_properties as $prop) {
    echo "Keys in property:\n";
    print_r(array_keys($prop));
    echo "\nFeatures structure:\n";
    print_r($prop['features'] ?? 'Not set');
    break;
}
