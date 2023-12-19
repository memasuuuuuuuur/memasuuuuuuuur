<?php

$is_imvalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $mysqli = require __DIR__ . "/database.php";

  $sql = sprintf("SELECT * FROM user
                  WHERE email = '%s'",
                 $mysqli->real_escape_string($_POST["email"]));

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();

  if ($user) {
      if (password_verify($_POST["password"], $user["password_hush"])) {
          session_start();
        
          session_regenerate_id();
        
          $_SESSION["user_id"] = $user["id"];
        
          header("Location: index.php");
          exit;
      }
  }
  
  $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://"
</head>
