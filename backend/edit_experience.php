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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet" media="screen">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </head>
  <body>

        <div class="container">


<?php
$dbc = new mysqli($host, $username, $password, $db_name);
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] >0) ) {
  $query = "SELECT * FROM experience WHERE id={$_GET['id']}";
  if ($result = mysqli_query($dbc,$query)) {
    $row = mysqli_fetch_array($result);
    print '<form class="form" action="edit_experience.php" method="post">
    <div class="form-group"><h1>Edit Experience</h1></div>
    <div class="form-group">
    <label for="Name">Name</label>
    <input type="text" class="form-control" placeholder="Name of the Experience or Education" name="name" value="' . htmlentities($row['name']) .'">
    </div>
    <div class="form-group">Description<textarea name="description" class="form-control" rows="3">' . htmlentities($row['description']) .'</textarea></div>
    <div class="form-group">
    <label for="Institution">Institution</label>
    <input type="text" name="institution" class="form-control" placeholder="Institution" value="' . htmlentities($row['institution']) .'"></div>
    <div class="form-group">
    <label>Date</label>
    <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="' . $row['start_date'] .'">
    <input type="date" class="form-control" placeholder="End Date" name="end_date" value="' . $row['end_date'] .'">
    </div>
    <p><input type="hidden" name="id" value="' . $_GET['id'] . '"></p>
    <div class="form-group">
    <label for="Type of Experience">Type of Experience</label>
    <select name="type" class="form-control">
    <option value="workexperience"';
    if ($row['type'] == 'workexperience') {
      print ' selected';
    }
    print '>Work Experience</option>
    <option value="education"';
    if ($row['type'] == 'education') {
      print ' selected';
    }
    print '>Education</option>
    </select>
    </div>
    <div class="form-group">
    <input type="submit" class="btn btn-primary" name="submit" value="Update!">
    </div>
    </form>';
  } else {
    print '<p class="error">Could not retrieve the data</p>';
  }
}


elseif (!empty($_POST['name']) ) {
    $name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['name'])));
    $type = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['type'])));
    $description = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['description'],"<ul><li></li></ul>")));
    $institution = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['institution'])));
    $start_date = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['start_date'])));
    $end_date = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['end_date'])));
} else {
    print '<p class="error">Please submit all data</p>';
  }
  if (!empty($_POST['name']) ) {
    $query = "UPDATE experience SET name='$name', type='$type', description='$description', institution='$institution', start_date='$start_date', end_date='$end_date' WHERE id={$_POST['id']}";
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
 </div>
