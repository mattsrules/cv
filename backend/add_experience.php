<?php
require "login/loginheader.php";
include "login/dbconf.php";
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
    <h1>Add Experience</h1>


<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $problem = FALSE;
      if (!empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['description']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
        $name = trim(strip_tags($_POST['name']));
        $type = trim(strip_tags($_POST['type']));
        $description = trim(strip_tags($_POST['description'],"<ul><li></li></ul>"));
        $institution = trim(strip_tags($_POST['institution']));
        $start_date = trim(strip_tags($_POST['start_date']));
        $end_date = trim(strip_tags($_POST['end_date']));
      } else {
        print '<p>Please submit all necessary fields</p>';
        $problem = TRUE;
      }

      if (!$problem) {
        $dbc = new mysqli($host, $username, $password, $db_name);
        $query = "INSERT INTO experience (id, name, type, description, institution, start_date, end_date) VALUES (0, '$name', '$type', '$description', '$institution', '$start_date', '$end_date')";
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

      <form action="add_experience.php" method="post">
        <p>Name: <input type="text" name="name"></p>
        <p>Description: <textarea name="description" cols="40" rows="5"></textarea></p>
        <p>Institution: <input type="text" name="institution"></p>
        <p>Start Date: <input type="date" name="start_date"></p>
        <p>End Date: <input type="date" name="end_date"></p>
        <p><select name="type">
    <option value="workexperience">Work Experience</option>
    <option value="education">Education</option>
  </select></p>
          <input type="submit" name="submit" value="Add this Experience">

    </div> <!-- /container -->
  </body>
</html>
