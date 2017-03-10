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
    <h1>Edit Profile</h1>

<h3>Updating profile information</h3>
<?php
$dbc = new mysqli($host, $username, $password, $db_name);
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}
if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] >0) ) {
  $query = "SELECT * FROM profile WHERE id={$_GET['id']}";
  if ($result = mysqli_query($dbc,$query)) {
    $link = "http://$_SERVER[HTTP_HOST]";
    $row = mysqli_fetch_array($result);
    print '<form action="edit_profile.php" method="post" enctype="multipart/form-data">
    <p><label>First Name <input type="text" name="firstname" value="' . htmlentities($row['firstname']) .'"></label></p>
    <p><label>Last Name <input type="text" name="lastname" value="' . htmlentities($row['lastname']) .'"></label></p>
    <p><label>Phone <input type="text" name="phone" value="' . htmlentities($row['phone']) .'"></label></p>
    <p><label>E-Mail <input type="text" name="email" value="' . htmlentities($row['email']) .'"></label></p>
    <p><label>Place <input type="text" name="place" value="' . htmlentities($row['place']) .'"></label></p>
    <p><label>Job <input type="text" name="job" value="' . htmlentities($row['job']) .'"></label></p>
    <p><label>LinkedIn <input type="text" name="linkedin" value="' . htmlentities($row['linkedin']) .'"></label></p>
    <p><label>Xing <input type="text" name="xing" value="' . htmlentities($row['xing']) .'"></label></p>
    <p><label><input type="hidden" name="id" value="' . $_GET['id'] . '">
    <p><input type="submit" class="btn btn-primary btn-md" name="submit" value="Update my profile"></p>
    </form>
    <p><a href="../backend" class="btn btn-default btn-md">Back to the overview</a>';
  } else {
    print '<p class="error">Could not retrieve the data</p>';
  }
}
elseif (!empty($_POST['firstname']) && !empty($_POST['lastname']) ) {
    $firstname = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['firstname'])));
    $lastname = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['lastname'])));
    $phone = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['phone'])));
    $email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['email'])));
    $place = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['place'])));
    $job = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['job'])));
    $linkedin = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['linkedin'])));
    $xing = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['xing'])));
} else {
    print '<p class="error">Please submit all data</p>';
  }
  if (!empty($_POST['firstname']) && !empty($_POST['lastname']) ) {
    $query = "UPDATE profile SET firstname='$firstname', lastname='$lastname', phone='$phone', email='$email', place='$place', job='$job', linkedin='$linkedin', xing='$xing' WHERE id={$_POST['id']}";
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
