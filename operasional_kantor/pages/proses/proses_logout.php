<?php
session_start();
//unset($_SESSION['id']);
session_destroy();
include "../forms/form_login.php";
?>
