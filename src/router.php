<?php
require_once("bootstrap.php");

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$queryString = $_SERVER['QUERY_STRING'];

switch ($path) {
    case 't':
            include(__DIR__ . '/routes/show_ticket.php');
        break;

    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}

