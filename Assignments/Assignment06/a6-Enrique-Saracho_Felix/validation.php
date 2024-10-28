<?php
// Global result of form validation
$valid = false;
// Global array of validation messages. For valid fields, message is ""
$val_messages = array();

// Output the results if all fields are valid.
function the_results()
{
  global $valid;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($valid) {
      echo '
      <div class="results">
      
        <div class="result-text"> Your email address is: ' . $_POST['email'] . '</div>
      
        <div class="result-text"> Your favorite animals are: <ul>';

      foreach ($_POST['animals'] as $animal) {
        echo '<li>' . $animal . '</li>';
      }

      echo '</ul></div>

        <div class="result-text">Your favourite date is: ' . $_POST['date'] . '</div>
      
      </div>
      ';
    }
  }
}

// Check each field to make sure submitted data is valid. If no boxes are checked, isset() will return false
function validate()
{
  global $valid;
  global $val_messages;

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Email
    $email_pattern = '#^(.+)@([^\.].*)\.([a-z]{2,})$#';
    if (isset($_POST['email']) && preg_match($email_pattern, $_POST['email']))
      $val_messages['email'] = "";
    else
      $val_messages['email'] = "You have not given a correct e-mail address";

    // Date
    $date_pattern = '#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#';
    if (isset($_POST['date']) && preg_match($date_pattern, $_POST['date']))
      $val_messages['date'] = "";
    else
      $val_messages['date'] = "You have not given a correct date";

    // Animals
    if (isset($_POST['animals']) && count($_POST['animals']) >= 3)
      $val_messages['animals'] = "";
    else
      $val_messages['animals'] = "Please choose at least 3 items";

    if (empty($val_messages['email']) && empty($val_messages['date']) && empty($val_messages['animals']))
      $valid = true;
    else
      $valid = false;
  }
}

// Display error message if field not valid. Displays nothing if the field is valid.
function the_validation_message($type)
{

  global $val_messages;

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($val_messages[$type]))
      echo '<p class="failure-message">' . $val_messages[$type] . '</p>';
    else
      echo "";
  }
}
