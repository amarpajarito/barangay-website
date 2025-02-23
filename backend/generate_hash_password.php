<?php
$plaintextPassword = 'password123';
$hashedPassword = password_hash($plaintextPassword, PASSWORD_DEFAULT);
echo $hashedPassword;
?>
