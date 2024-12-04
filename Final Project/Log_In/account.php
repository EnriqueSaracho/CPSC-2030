<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'database/database.php';
require_once 'functions/functions.php';

$pdo = db_connect();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM accounts WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$account)
        echo "Account not found.";
} else {
    echo "No account selected.";
}

$is_valid = true;
$email_pattern = '#^(.+)@([^\.].*)\.([a-z]{2,})$#';
$email = $platform = $username = $password = $other_content_type = $other_content = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_changes'])) {

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
            $sql = "UPDATE accounts 
                SET platform = :platform, email = :email, username = :username, password = :password, 
                    other_content_type = :other_content_type, other_content = :other_content 
                WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'platform' => $platform,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'other_content_type' => $other_content_type,
                'other_content' => $other_content,
                'id' => $id
            ]);

            header('Location: account.php?id=' . $id);
            exit;
        }
    } elseif (isset($_POST['delete_account'])) {
        $sql = "DELETE FROM accounts WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        echo "Account deleted successfully.";
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
    <title>Log In</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php display_account_info($account) ?>
</body>

</html>