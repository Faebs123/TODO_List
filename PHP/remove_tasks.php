<?php

include_once("./db.php");
session_start();

$input_data = file_get_contents("php://input", true);
$to_remove = json_decode($input_data);

foreach ($to_remove as $ix => $id) {
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
die();
?>