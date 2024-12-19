<?php
session_name('disdoc');
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'disdoc');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($user['status'] == 1) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['section_id'] = $user['section_id'];
                $_SESSION['email'] = $user['email'];

                echo '<script type="text/javascript">
                        alert("Login Sukses!");
                        window.location.href = "index.php";
                      </script>';
                exit();
            } else {
                echo '<script type="text/javascript">
                        alert("Login Gagal! Check email atau password.");
                      </script>';
            }
        } else {
            echo '<script type="text/javascript">
                    alert("Account belum active!");
                  </script>';
        }
    } else {
        echo '<script type="text/javascript">
                alert("Login Gagal! Check email atau password.");
              </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="form-screen">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Login - Distribusi Dokumen</title>

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
          <span class="icon"><i class="mdi mdi-lock"></i></span>
          Login
        </p>
      </header>
      <div class="card-content">
        <form method="post" action="login.php">

          <div class="field spaced">
            <label class="label">Email</label>
            <div class="control icons-left">
              <input class="input" type="email" name="email" placeholder="user@suai.co.id" autocomplete="username">
              <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
            </div>
            <p class="help">
              Please enter your email
            </p>
          </div>

          <div class="field spaced">
            <label class="label">Password</label>
            <p class="control icons-left">
              <input class="input" type="password" name="password" placeholder="Password" autocomplete="current-password">
              <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
            </p>
            <p class="help">
              Please enter your password
            </p>
          </div>

          <hr>

          <div class="field grouped">
            <div class="control">
              <button type="submit" class="button blue">
                Login
              </button>
            </div>
            <div class="control">
              <a href="registration.php" class="button red">
                Buat Akun
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
