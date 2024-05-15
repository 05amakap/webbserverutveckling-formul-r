<?php

$name = $_POST["name"];
$email = $_POST["email"];
$phone = filter_input(INPUT_POST, "phone", FILTER_VALIDATE_INT);
$message = $_POST["message"];

$host = "localhost";
$username = "root";
$password = "";
$dbname = "kontakt_db";

$conn = mysqli_connect(hostname: $host, 
                       username: $username, 
                       password: $password, 
                       database: $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

$sql = "INSERT INTO message (name, email, phone, body)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssis",
                       $name,
                       $email,
                       $phone,
                       $message);
mysqli_stmt_execute($stmt);

echo "Tack för ditt meddelande!";
