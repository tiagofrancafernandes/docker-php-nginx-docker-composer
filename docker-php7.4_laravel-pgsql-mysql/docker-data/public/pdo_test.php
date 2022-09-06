<?php
$type = 'mysql'; //mysql/postgres

$pdoConfig = [
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

$driver   = $pdoConfig[$type]['driver']    ?? '';
$host     = $pdoConfig[$type]['host']      ?? '';
$port     = $pdoConfig[$type]['port']      ?? '';
$database = $pdoConfig[$type]['database']  ?? '';
$user     = $pdoConfig[$type]['user']      ?? '';
$password = $pdoConfig[$type]['password']  ?? '';
$more     = (string)$pdoConfig[$type]['more']      ?? '';

try {
    $dsn = "{$driver}:host={$host};port={$port};dbname={$database};{$more}";

    // make a database connection
    $pdo = new PDO(
        $dsn,
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    if ($pdo)
        echo "<pre>\nConnected to the ${database} database successfully!</pre>";
} catch (PDOException $e) {
    die($e->getMessage());
}
