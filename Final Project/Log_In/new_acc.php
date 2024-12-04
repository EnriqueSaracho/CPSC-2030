<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'database/database.php';
require_once 'functions/functions.php';

$pdo = db_connect();

$is_valid = true;
$email_pattern = '#^(.+)@([^\.].*)\.([a-z]{2,})$#';
$email = $platform = $username = $password = $other_content_type = $other_content = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && preg_match($email_pattern, $_POST['email'])) {
        $email = $_POST['email'];
    } else {
        echo "You have not given a correct e-mail address.<br>";
        $is_valid = false;
    }


    $platform = $_POST['platform'];
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $other_content_type = $_POST['other_content_type'] ?? null;
    $other_content = $_POST['other_content'] ?? null;

    if (!$platform || !$password) {
        echo "Platform and password are required.<br>";
        $is_valid = false;
    }

    if ($is_valid) {
        $sql = "INSERT INTO accounts (platform, email, username, password, other_content_type, other_content) 
            VALUES (:platform, :email, :username, :password, :other_content_type, :other_content)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'platform' => $platform,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'other_content_type' => $other_content_type,
            'other_content' => $other_content,
        ]);

        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Account</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1 class="title">Add New Account</h1>
        <a href="index.php" class="btn">Home</a>
    </header>

    <main>
        <form method="POST" action="new_acc.php" class="form">
            <label for="platform">Platform:</label>
            <input type="text" name="platform" required class="form-input"><br><br>

            <label for="email">Email (Optional):</label>
            <input type="email" name="email" class="form-input"><br><br>

            <label for="username">Username (Optional):</label>
            <input type="text" name="username" class="form-input"><br><br>

            <label for="password">Password:</label>
            <input type="text" name="password" required class="form-input"><br><br>

            <label for="other_content_type">Other Content Type (Optional):</label>
            <input type="text" name="other_content_type" class="form-input"><br><br>

            <label for="other_content">Other Content (Optional):</label>
            <input type="text" name="other_content" class="form-input"><br><br>

            <input type="submit" value="Add Account" class="btn">
        </form>
    </main>
</body>

</html>