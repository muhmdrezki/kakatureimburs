<?php
session_start();
//unset($_SESSION['id']);
session_destroy();
include "../form/form_login.php";
?>
