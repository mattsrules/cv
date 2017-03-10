<?php
require "login/loginheader.php";
include "login/dbconf.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Edit Experience</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
  </head>
  <body>

        <div class="container">
    <h1>Edit Skill</h1>

<?php
$dbc = new mysqli($host, $username, $password, $db_name);
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] >0) ) {
  $query = "SELECT * FROM skills WHERE id={$_GET['id']}";
  if ($result = mysqli_query($dbc,$query)) {
    $row = mysqli_fetch_array($result);
    print '<form action="edit_skills.php" method="post">
    <p><label>Name <input type="text" name="name" value="' . htmlentities($row['name']) .'"></label></p>
    <p><label>Level <input type="text" name="level" value="' . htmlentities($row['level']) .'"></label></p>
    <select name="type">
<option value="skills">Skills</option>
<option value="languages">Languages</option>
<option value="hobbies">Hobbies</option>
</select>
    <p><label><input type="hidden" name="id" value="' . $_GET['id'] . '">
    <p><input type="submit" name="submit" value="Update!"></p>
    </form>';
  } else {
    print '<p class="error">Could not retrieve the data</p>';
  }
}


elseif (!empty($_POST['name']) ) {
    $name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['name'])));
    $level = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['level'])));
    $type = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['type'])));
} else {
    print '<p class="error">Please submit all data</p>';
  }
  if (!empty($_POST['name']) ) {
    $query = "UPDATE skills SET name='$name', level='$level', type='$type' WHERE id={$_POST['id']}";
    if ($result = mysqli_query($dbc, $query)) {
      $link = "http://$_SERVER[HTTP_HOST]";
      print "<p>The record has been updated.</p>
              <p><a href=\"$link/backend\" class=\"btn btn-primary btn-md\">Back to the overview</a>";
    } else {
      print '<p>Could not update the the record</p>';
    }

}


mysqli_close($dbc);
 ?>
