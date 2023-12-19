<?php

session_start();
if (isset($_SESSION["user_id"])) {

  $mysqli = require __DIR__ . "database.php";

  $sql = "SELECT * FROM user
          WHERE id = {$_SESSION["user_id"]}";

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <title>Home</title>
</head>
<body>
  <h1>
    Welcome!
  </h1>

  <?php if (isset($user)): ?>

        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
        <a href=""https://127.0.0.1:5501/fourth.html">Continue to next page.</a>
  <?php else: ?>

        <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>

  <?php endif; ?>
</body>
</html>
