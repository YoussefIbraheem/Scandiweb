<?php
use App\Commands\DatabaseSeeder;

require __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../src/Containers/container.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->safeLoad();

$container->get(DatabaseSeeder::class)->run();