<?php
require_once '../../../wp-load.php';
$_POST = [
    'action' => 'get_filtered_properties',
    'lang'   => 'en',
    'paged'  => 1,
    'sort'   => 'newest',
    'view'   => 'grid'
];

$handler = new \Estatery\Core\AjaxHandler();
$handler->get_filtered_properties();
