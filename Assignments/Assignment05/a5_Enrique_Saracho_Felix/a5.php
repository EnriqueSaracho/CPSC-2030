<?php
$my_name = "Enrique Saracho";
$description = "Enrique is a full stack software developer. His hobbies include watching the NBA and playing video games.";
$favorite_animals = array("the sarcastic fringehead", "the argentinian pink fairy armadillo", "the Madagascar aye-aye", "the tasselled wobbegong shark", "the spiny lumpsucker fish", "the (not to be confused with the mimic octopus) wunderpus photogenicus", "the magestic mountain chicken frog of the Caribbean islands of Dominica and Monserrat");

function the_developer_profile()
{
  global $my_name, $description, $favorite_animals;
  $last_index = count($favorite_animals) - 1;
  echo '<div class="developer-profile">
      <h2>Developer Profile: ' . $my_name . '</h2>
      <p>Description: ' . $description . '<br>
      <p>His favorite animals are ';
  foreach ($favorite_animals as $index => $animal) {
    if ($index !== $last_index)
      echo $animal . ", ";
    else
      echo " and " . $animal . ".";
  }
  echo '</div>';
}

function the_color_form()
{
  echo '<div class="page-color">
    <form action="a5.php" method="POST">
      Which color do you prefer for the text of this page?
      <input type="color" name="color"/>
      <input type="submit" value="Submit" />
    </form>
  </div>';
}

function get_color()
{
  if (isset($_POST["color"]))
    return $_POST["color"];
  else
    return "black";
}
?>
<!DOCTYPE html>
<html style="color: <?php echo get_color(); ?>;">

<head>
  <meta charset="utf-8">
  <title>Assigment 5: Hello PHP World!</title>

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="icomoon/style.css">

</head>

<body>

  <header>
    <h1>Hello PHP World!</h1>
    <div class="subtitle">
      An Introduction to Server-Side Scripting.
    </div>
  </header>

  <main>
    <?php
    the_developer_profile();
    the_color_form();
    ?>
  </main>

</body>

</html>