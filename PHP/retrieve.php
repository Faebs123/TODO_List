<?php

include_once("./db.php");
session_start();

if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    die();
}

$username = $_SESSION["username"];

// prendo il valore dell'id dell'utente 
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$user_id = $result["id"];
$_SESSION["user_id"] = $user_id;

// prendo tutte le tasks con quell'id
$sql = "SELECT id,descrizione, completato FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$da_inviare = [];

// restituisco un array di json che mi analizzerà il js
while($row = $result->fetch_assoc()){
    $da_inviare[] = $row;
}

echo json_encode($da_inviare);

?>

