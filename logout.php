<?php
session_name('disdoc');
session_start();
session_destroy();
header("Location: login.php");
exit();