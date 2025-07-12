<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_input = $_POST["username_or_email"];
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
  $stmt->bind_param("ss", $user_input, $user_input);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row["password"])) {
      $_SESSION["username"] = $row["username"];
      echo "Login successful!";
    } else {
      echo "Incorrect password.";
    }
  } else {
    echo "User not found.";
  }
}
?>
