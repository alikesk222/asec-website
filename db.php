<?php
// Veritabanı bağlantı dosyası
$host = 'localhost';
$db   = 'db_asec'; // Veritabanı adını kendi oluşturduğunuz isimle değiştirin
$user = 'root'; // XAMPP için genellikle root
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    exit('Veritabanı bağlantı hatası: ' . $e->getMessage());
}
?>
