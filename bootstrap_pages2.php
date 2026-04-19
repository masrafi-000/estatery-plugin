<?php
require_once '../../../wp-load.php';
delete_option('estatery_pages_bootstrapped');
\Estatery\Core\ThemeSetup::bootstrap();
echo "Bootstrapped completely.";
