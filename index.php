<?php
session_start();

$_SESSION['login_id'] = null;
$_SESSION['flash'] = null;

header('Location: router.php?action=accueil');
exit();
