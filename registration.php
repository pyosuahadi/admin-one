<?php

$conn = mysqli_connect('localhost', 'root', '', 'disdoc');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sections_result = mysqli_query($conn, "SELECT id, name FROM sections ORDER BY name ASC");

?>
<!DOCTYPE html>
<html lang="en" class="form-screen">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Registration - Distribusi Dokumen</title>

  <link rel="stylesheet" href="css/main.css?v=1628755089081">
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>

</head>
<body>

<div id="app">

  <section class="section main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-account-plus"></i></span>
          Register
        </p>
      </header>
      <div class="card-content">
        <form method="post" action="registration_process.php"> <!-- form dikirim ke registration_process.php -->

          <div class="field spaced">
            <label class="label">Name</label>
            <div class="control icons-left">
              <input class="input" type="text" name="name" placeholder="Your Name" required>
              <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
            </div>
            <p class="help">
              Please enter your full name
            </p>
          </div>

          <div class="field spaced">
            <label class="label">Username</label>
            <div class="control icons-left">
              <input class="input" type="text" name="username" placeholder="Username [Max 3 chars]" required>
              <span class="icon is-small left"><i class="mdi mdi-account-box"></i></span>
            </div>
            <p class="help">
              Please enter your username
            </p>
          </div>

          <div class="field spaced">
            <label class="label">Email</label>
            <div class="control icons-left">
              <input class="input" type="email" name="email" placeholder="user@suai.co.id" required>
              <span class="icon is-small left"><i class="mdi mdi-email"></i></span>
            </div>
            <p class="help">
              Please enter your email
            </p>
          </div>

          <div class="field spaced">
            <label class="label">Password</label>
            <div class="control icons-left">
              <input class="input" type="password" name="password" placeholder="Password" required>
              <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
            </div>
            <p class="help">
              Please enter your password
            </p>
          </div>

          <div class="field spaced">
            <label class="label">Section</label>
            <div class="control icons-left">
              <div class="select">
                <select name="section_id" required>
                  <option value="">-- Select Section --</option>
                  <?php
                  if ($sections_result && mysqli_num_rows($sections_result) > 0) {
                      while($sec = mysqli_fetch_assoc($sections_result)) {
                          echo '<option value="' . $sec['id'] . '">' . $sec['name'] . '</option>';
                      }
                  }
                  ?>
                </select>
              </div>
              <span class="icon is-small left"><i class="mdi mdi-menu"></i></span>
            </div>
            <p class="help">
              Please select your section
            </p>
          </div>

          <hr>

          <div class="field grouped">
            <div class="control">
              <button type="submit" class="button blue">
                Register
              </button>
            </div>
            <div class="control">
              <a href="login.php" class="button">
                Kembali ke Login
              </a>
            </div>
          </div>

        </form>
      </div>
    </div>

  </section>


</div>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>
</html>
