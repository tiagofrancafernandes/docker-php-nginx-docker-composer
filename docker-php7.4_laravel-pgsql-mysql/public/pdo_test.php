<?php
$type = 'mysql'; //mysql/postgres

$pdo_config = [
    'pgsql' => [
        'driver'   => 'pgsql',
        'host'     => '127.0.0.1',
        'port'     => 5432,
        'user'     => 'postgres',
        'password' => 'postgres',
        'database' => 'postgres',
        'more'     => '',
    ],
    'mysql' => [
        'driver'   => 'mysql',
        'host'     => 'mysql',
        'port'     => 3306,
        'user'     => 'root',
        'password' => 'mysql',
        'database' => 'mysql',
        'more'     => '',
    ],
];

$driver   = $pdo_config[$type]['driver']    ?? '';
$host     = $pdo_config[$type]['host']      ?? '';
$port     = $pdo_config[$type]['port']      ?? '';
$database = $pdo_config[$type]['database']  ?? '';
$user     = $pdo_config[$type]['user']      ?? '';
$password = $pdo_config[$type]['password']  ?? '';
$more     = $pdo_config[$type]['more']      ?? '';

try {
    $dsn = "$driver:host=$host;port=$port;dbname=$database;$more";

    // make a database connection
    $pdo = new PDO(
        $dsn,
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    if ($pdo)
        echo "<pre>\nConnected to the $database database successfully!</pre>";

} catch (PDOException $e)
{
    die($e->getMessage());
}
