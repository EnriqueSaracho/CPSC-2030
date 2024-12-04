<?php

require_once 'config.php';

function db_connect()
{

  try {
    $connectionString = 'mysql:host=' . DBHOST . ';dbname=' . DBNAME;

    $pdo = new PDO($connectionString, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}


function fetch_accounts()
{
  global $pdo;
  global $accounts;

  $sql = "SELECT id, platform FROM accounts";
  $stmt = $pdo->query($sql);

  $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
