<?php
$host='localhost';
$user='postgres';
$pass= 'hanifah@pc';
$db= 'konsuldok';
$port = 5432;

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    die("Koneksi gagal: ". $th->getMessage());
}
?>