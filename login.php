<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $mysqli = require __DIR__ . "/database.php";

  $sql = sprintf("SELECT * FROM user
                  WHERE email = '%s'",
                 $mysqli->real_escape_string($_POST["email"]));

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();

  if ($user) {

      if (password_verify($_POST["password"], $user["password_hash"])) {

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <script src="location.js"></script>
  <link rel="stylesheet" href="first.css">
  <link rel="stylesheet" href="homepage.css">
  <title>Login</title>
</head>
<body>

  <div class="headingnginamo">
    <img class="logo" src="https://tse1.mm.bing.net/th?id=OIP.Qre1eBihuhI9hw-ZXSJC3AHaHa&pid=Api&P=0&h=220">
    <p class="left-name"> C O F F E E</p>
    <li class="namingnginamo" onclick="homeInLogin()">
      HOME
    </li>
    <li class="namingnginamo1" onclick="aboutMeHome()">
      ABOUT ME
    </li>
    <li class="namingnginamo2" onclick="infoHome()">
      INFO
    </li>
    <li class="namingnginamo3" onclick="contactHome()">
      CONTACT
    </li>
  </div>

  <img class="photo-image" src="https://tse1.mm.bing.net/th?id=OIP.Qre1eBihuhI9hw-ZXSJC3AHaHa&pid=Api&P=0&h=220">


  <h1>
    Login Form
  </h1>

  <?php if ($is_invalid): ?>
      <em><span style="color: white;">Invalid Login</span></em>
  <?php endif; ?>

  <form method="post">
    <label class="login-line1" for="email">Email</label>
    <input type="email" name="email" id="email" style="margin-left: 240px;"
           value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

    <label class="login-line1" for="password">Password</label>
    <input type="password" name="password" id="password" style="margin-left: 240px; margin-bottom: 30px;">

    <button style="margin-right: 215px;"> Log in </button>
  </form>

</body>
</html>
