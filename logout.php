<?php
if(!isset($_SESSION)) session_start();
unset($_COOKIE['username']);
setcookie('username', null, -1, '/');
session_destroy();
exit("<script>document.location='./login.php';</script>");