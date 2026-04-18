<?php
$locales = ['en', 'es', 'fr', 'ru'];
$en_data = json_decode(file_get_contents('languages/en.json'), true);
$new_props = $en_data['pages']['properties'];

foreach (['es', 'fr', 'ru'] as $l) {
    $f = "languages/$l.json";
    if (!file_exists($f)) continue;
    $data = json_decode(file_get_contents($f), true);
    
    // Sync the structures
    $data['pages']['properties']['filters'] = $new_props['filters'];
    $data['pages']['properties']['categories'] = $new_props['categories'];
    $data['pages']['properties']['cta'] = $new_props['cta'];
    $data['pages']['properties']['items'] = $new_props['items']; // Also sync items for consistency
    
    file_put_contents($f, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "Synced $l.json\n";
}
