<?php
// Should return a PDO
function db_connect() {

  try {
    // TODO
    // try to open database connection using constants set in config.php
    // return $pdo;

  }
  catch (PDOException $e)
  {
    die($e->getMessage());
  }
}

// Handle form submission
function handle_form_submission() {
  global $pdo;

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // TODO
    // Prepare the submitted form data and insert it to the database
  }
}

// Get all comments from database and store in $comments
function get_comments() {
  global $pdo;
  global $comments;

  //TODO

}

// Get unique email addresses and store in $commenters
function get_commenters() {
  global $pdo;
  global $commenters;

  //TODO

}
