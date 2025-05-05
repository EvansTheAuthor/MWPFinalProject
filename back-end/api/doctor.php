<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/JSON");

require_once("../config/db.php");

try {
    $stmt = $conn->query("SELECT id, docname, specialization FROM dokter");
    $data = $stmt->fetchAll();

    echo json_encode($data);
} catch (\PDOException $e) {
    echo json_encode(["error"=> $e->getMessage()]);
}
?>