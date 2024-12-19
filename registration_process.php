<?php
session_name('disdoc');
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'disdoc');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = trim($_POST['name']);
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$section_id = (int)$_POST['section_id'];

if (empty($name) || empty($username) || empty($email) || empty($password) || empty($section_id)) {
    echo '<script>alert("Semua kolom wajib diisi!"); window.location.href="registration.php";</script>';
    exit();
}

if (strlen($username) !== 3) {
    echo '<script>alert("Username hanya boleh 3 karakter inisial nama!"); window.location.href="registration.php";</script>';
    exit();
}

if (!preg_match('/@(suai\.co\.id|id\.yazaki\.com|jp\.yazaki\.com)$/i', $email)) {
    echo '<script>alert("Hanya Email dengan domain @suai.co.id, @id.yazaki.com, atau @jp.yazaki.com yang diperbolehkan."); window.location.href="registration.php";</script>';
    exit();
}

$password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
if (!preg_match($password_pattern, $password)) {
    echo '<script>alert("Password minimal 8 karakter dan mengandung kombinasi huruf besar, huruf kecil, dan angka."); window.location.href="registration.php";</script>';
    exit();
}

$check_user_query = "SELECT id FROM users WHERE username='$username' OR email='$email' LIMIT 1";
$check_user_result = mysqli_query($conn, $check_user_query);

if ($check_user_result && mysqli_num_rows($check_user_result) > 0) {
    echo '<script>alert("Username atau Email sudah ada!"); window.location.href="registration.php";</script>';
    exit();
}

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$insert_query = "INSERT INTO users (name, username, email, password, section_id, status, created_at, updated_at) 
                VALUES ('$name', '$username', '$email', '$hashed_password', '$section_id', 0, NOW(), NULL)";

if (mysqli_query($conn, $insert_query)) {
    echo '<script>alert("Registrasi sukses! Silahkan login."); window.location.href="login.php";</script>';
} else {
    echo '<script>alert("Registrasi gagal! Silahkan coba lagi."); window.location.href="registration.php";</script>';
}

mysqli_close($conn);
