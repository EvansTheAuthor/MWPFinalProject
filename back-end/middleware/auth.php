<?php
function checkAuth(){
    $headers = getallheaders() ;
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized"]);
        exit;
    }

    $token = $headers['Authorization'];
    if ($token !== "Bearer rahasia-token") {
        http_response_code(403);
        echo json_encode(["error" => "Forbidden"]);
        exit;
    }
}
?>