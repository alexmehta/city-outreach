<?php
$host = "127.0.0.1";
$superusername = "root";
$superpassword = "root";
$database_name = "cityofhayward";
$charset = 'utf8mb4';
$dsn = "mysql:host=mysql8;dbname=cityofhayward;port=3306";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $superusername, $superpassword, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>