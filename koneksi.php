<?php
// koneksi.php - koneksi ke MySQL (root, no password) dan migrasi sederhana
$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'mahasiswa';

try {
    // connect without db to create database if needed
    $tmp = new PDO("mysql:host={$dbHost};charset=utf8mb4", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $tmp->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

    // connect to the database
    $db = new PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // buat tabel jika belum ada
    $db->exec("CREATE TABLE IF NOT EXISTS mahasiswa (
        nim VARCHAR(50) PRIMARY KEY,
        nama VARCHAR(255) NOT NULL,
        kelamin CHAR(1) NOT NULL,
        no_telp VARCHAR(50) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");

} catch (PDOException $e) {
    // tampilkan pesan yang mudah dibaca untuk debugging lokal
    echo '<h2>Koneksi database gagal</h2>';
    echo '<p>' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
    exit;
}

function e($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

?>
