<?php
require "login/loginheader.php";
include "login/dbconf.php";
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Add Experience</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
  </head>
  <body>

        <div class="container">
    <h1>Add Skills</h1>


<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $problem = FALSE;
      if (!empty($_POST['name'])) {
        $name = trim(strip_tags($_POST['name']));
        $level = trim(strip_tags($_POST['level']));
        $type = trim(strip_tags($_POST['type']));
      } else {
        print '<p>Please submit all necessary fields</p>';
        $problem = TRUE;
      }

      if (!$problem) {
        $dbc = new mysqli($host, $username, $password, $db_name);
        $query = "INSERT INTO skills (id, name, level, type) VALUES (0, '$name', '$level', '$type')";
        if (mysqli_query($dbc, $query)) {
          $link = "http://$_SERVER[HTTP_HOST]";
          print "<p>The record has been added</p>
                  <p><a href=\"$link/backend\" class=\"btn btn-primary btn-md\">Back to the overview</a>";
        } else {
          print '<p>Could not add the entry</p>';
        }
        mysqli_close($dbc);
      }
    }
    ?>

      <form action="add_skills.php" method="post">
        <p>Name of the skill <input type="text" name="name"></p>
        <p>Skillevel <input type="text" name="level"> %</p>
        <p><select name="type">
    <option value="skills">Skills</option>
    <option value="languages">Languages</option>
    <option value="hobbies">Hobbies</option>
  </select></p>
          <input type="submit" name="submit" value="Add this Skill">
    </div> <!-- /container -->
  </body>
</html>
