<?php
// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Import functions
require_once('validation.php');

// Validate form submission
validate();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Assignment 6</title>

  <link rel="stylesheet" href="style.css">

  <!-- jQuery validtion using plugin from http://www.formvalidator.net/ -->
  <script src="jquery-validation-1.19.3/lib/jquery.js"></script>
  <script src="jquery-validation-1.19.3/dist/jquery.validate.js"></script>


  <script>
    $(function() {
      $("form").validate({

        rules: {
          email: {
            required: true,
            email: true
          },
          "animals[]": {
            required: true,
            maxlength: 3,
            minlength: 3
          },
          date: {
            required: true,
            dateISO: true
          }
        },

        // these are the validation error messages that will display 
        messages: {
          email: {
            required: "Please provide an email",
            email: "please enter a valid email address"
          },
          date: {
            required: "please provide a date",
            dateISO: "date must be in ISO format"
          },
          "animals[]": "please choose three animals"
        },

        // This is a function to fix the weird placement of errors in the checkbox group
        errorPlacement: function(error, element) {
          // note that element and error are jQuery objects - can get native DOM node by adding [0]
          element[0].parentElement.appendChild(error[0]);
        },

        // this is the function that submits the form if there are no errors 
        submitHandler: function(form) {
          form.submit();
        }
      });
    });
  </script>

</head>

<body>

  <div class="wrapper">

    <h1>Assignment 6: Form Validation with jQuery and PHP</h1>

    <form action="a6.php" method="post">

      <label for="email"> Please enter your email address:

        <input type="text" name="email" id="email">

        <!-- Display validation message for email input -->
        <?php the_validation_message('email'); ?>

      </label>

      <fieldset>
        <legend> Please select your three favorite animals:</legend>

        <input type="checkbox" name="animals[]" id="chicken" value="chicken">
        <label for="chicken">Chicken</label>

        <input type="checkbox" name="animals[]" id="cow" value="cow">
        <label for="cow">cow</label>

        <input type="checkbox" name="animals[]" id="whale" value="whale">
        <label for="whale">whale</label>

        <input type="checkbox" name="animals[]" id="bee" value="bee">
        <label for="bee"> bee</label>

        <input type="checkbox" name="animals[]" id="doggo" value="doggo">
        <label for="doggo">doggo</label>

        <input type="checkbox" name="animals[]" id="kitten" value="kitten">
        <label for="kitten">kitten</label>

        <input type="checkbox" name="animals[]" id="jellyfish" value="jellyfish">
        <label for="jellyfish">jellyfish</label>

        <!-- Display validation message checkbox group -->
        <?php the_validation_message('animals'); ?>

      </fieldset>

      <label for="date"> Please enter your favorite date: (yyyy/mm/dd)

        <input type="text" name="date" id="date">

        <!-- Display validation message for date input -->
        <?php the_validation_message("date"); ?>
      </label>

      <input type="reset" name="" value="Reset Form">

      <input type="submit" value="Submit Form">

    </form>

    <!-- Display the results -->
    <?php the_results(); ?>

  </div>
</body>

</html>