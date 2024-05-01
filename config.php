<?php
// Define the base folder
$base_folder = basename(dirname(__DIR__));

// Define the base URL
define('BASE_URL', '/' . $base_folder . '/');
// echo BASE_URL;
// Define the base directory path
define('BASE_DIR', $_SERVER['DOCUMENT_ROOT'] . BASE_URL);  //shows till C:/xampp/htdocs/2024-projects/
// echo BASE_DIR; //
?>
