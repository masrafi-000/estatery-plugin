<?php
require_once '../../../wp-load.php';
if (function_exists('PLL')) {
    PLL()->model->add_language([
        'name'       => 'Magyar',
        'slug'       => 'hu',
        'locale'     => 'hu_HU',
        'rtl'        => 0,
        'term_group' => 0
    ]);
    echo 'Added Hungarian.';
} else {
    echo 'PLL not found.';
}
