<?php
require_once __DIR__ . '/app/Core/Bootstrap.php';

$route = $_GET['r'] ?? 'home/index';
\App\Core\Router::dispatch($route, '.');
