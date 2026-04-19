<?php
require_once '../../../wp-load.php';
$json_path = get_template_directory() . '/data/properties.json';
$data = json_decode(file_get_contents($json_path), true);
$prop = $data['root']['property'][0];
echo "Keys: " . implode(', ', array_keys($prop)) . "\n\n";
echo "New Build: " . (isset($prop['new_build'][0]) ? $prop['new_build'][0] : 'N/A') . "\n";
echo "Beds: " . (isset($prop['beds'][0]) ? $prop['beds'][0] : 'N/A') . "\n";
echo "Baths: " . (isset($prop['baths'][0]) ? $prop['baths'][0] : 'N/A') . "\n";
echo "Surface Area Built: " . (isset($prop['surface_area'][0]['built'][0]) ? $prop['surface_area'][0]['built'][0] : 'N/A') . "\n";
echo "Pool: " . (isset($prop['pool'][0]) ? $prop['pool'][0] : 'N/A') . "\n";
