<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'database/database.php';
require_once 'functions/functions.php';

$pdo = db_connect();
$accounts = [];

fetch_accounts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1 class="title">Log In</h1>
        <h2 class="subtitle">Manage your passwords here</h2>
        <a href="documentation.php" class="btn">Documentation</a>
    </header>
    <main>
        <a href="new_acc.php" class="btn">Add a new account</a>
        <ul class="acc-list">
            <?php display_accounts() ?>
        </ul>
    </main>
</body>

</html>