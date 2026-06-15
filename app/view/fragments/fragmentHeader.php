<?php
try {
    $currentUser = Controller::currentUser();
} catch (Throwable $exception) {
    $currentUser = null;
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'BlaBlaCar LO07') ?></title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<?php require VIEW_ROOT . '/fragments/fragmentMenu.php'; ?>
<main class="page">
