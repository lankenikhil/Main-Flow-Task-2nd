<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirm = $_POST["confirm_password"];

  if ($password !== $confirm) {
    die("Passwords do not match.");
  }

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $email, $hashed_password);

  if ($stmt->execute()) {
    echo "Signup successful!";
  } else {
    echo "Error: Username or Email already exists.";
  }
}
?>
