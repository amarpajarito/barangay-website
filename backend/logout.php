<?php
session_start();
session_destroy();
header("Location: /front-website/login.php");
exit();
?>