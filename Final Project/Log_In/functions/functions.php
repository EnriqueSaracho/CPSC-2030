<?php

function display_accounts()
{
    global $accounts;

    foreach ($accounts as $account)
        echo "<li><span>" . htmlspecialchars($account['platform']) . '</span> <a href="account.php?id=' . urlencode($account['id']) . '" class="acc-view">View</a> ' . "</li>";
}

function display_account_info($account)
{
    echo '<header><h1>Account: ' . htmlspecialchars($account['platform']) . '</h1><a href="index.php" class="btn">Home</a></header>';

    echo "<main><form method='post' action='account.php?id=" . $account['id'] . "' class='form'>
        <label for='platform'>Platform:</label>
        <input type='text' name='platform' value='" . (($account['platform']) ?? "") . "' class='form-input' />";


    echo "<label for='email'>Email:</label><input type='text' name='email' value='" . (($account['email']) ?? "") . "' class='form-input' />";

    echo "<label for='username'>Username:</label><input type='text' name='username' value='" . (($account['username']) ?? "") . "' class='form-input' />";

    echo "<label for='password'>Password:</label><input type='text' name='password' value='" . (($account['password']) ?? "") . "' class='form-input' />";


    echo "<label for='other_content-type'>Other Content Type:</label><input type='text' name='other_content_type' value='" . (($account['other_content_type']) ?? "") . "' class='form-input' />";


    echo "<label for='other_content'>Other Content:</label><input type='text' name='other_content' value='" . (($account['other_content']) ?? "") . "' class='form-input' />";

    echo "<input type='submit' name='save_changes' value='Save Changes' class='btn' />";
    echo "<input type='submit' name='delete_account' value='Delete Account' class='btn' />";
    echo "</form></main>";
}
