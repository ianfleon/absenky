<?php

session_start();
unset($_SESSION['ADMIN_LOGINED']);
session_destroy();

header('Location: index.php');

?>