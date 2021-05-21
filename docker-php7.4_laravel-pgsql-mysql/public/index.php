<style>
body { background-color: #fff; color: #222; font-family: sans-serif; }
</style>
<?php
echo "Now is " . date("Y-m-d H:i:s") . "<br>";

if (isset($_GET['pdo']) && $_GET['pdo'] === 'show')
{
    echo "<li><a href='/?pdo=hide'>Hide PDO connection test</a></li>";
    require_once(__DIR__ . '/pdo_test.php');
} else
    echo "<li><a href='/?pdo=show'>Show PDO connection test</a></li>";

if (isset($_GET['info']) && $_GET['info'] === 'show')
{
    echo "<li><a href='/?info=hide'>Hide Info</a></li>";
    require_once(__DIR__ . '/info.php');
} else
    echo "<li><a href='/?info=show'>Show Info</a></li>";