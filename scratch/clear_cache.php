<?php
$mysqli = new mysqli('localhost', 'root', '', 'anna_real_estate');
$mysqli->query("DELETE FROM wp_options WHERE option_name LIKE '_transient_estatery%' OR option_name LIKE '_transient_timeout_estatery%'");
echo 'Cache cleared. Rows deleted: ' . $mysqli->affected_rows;
