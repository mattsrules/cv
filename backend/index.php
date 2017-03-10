<?php require "login/loginheader.php";
include "login/dbconf.php";
error_reporting(E_ALL);
ini_set("display_errors", 1);?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class="container">
      <div class="col-md-6">
        <h2>Profilinformationen</h2>
        <h3>My Profile</h3>
        <?php
        $dbc = new mysqli($host, $username, $password, $db_name);
        if ($dbc->connect_error) {
             die("Connection failed: " . $dbc->connect_error);
        }

        $sql = "SELECT * FROM profile WHERE id=1";
        $result = $dbc->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "Firstname: " . $row["firstname"]. " - Lastname: " . $row["lastname"]. " <a href=\"edit_profile.php?id={$row['id']}\">Edit</a>";
            }
        } else {
            echo "0 results";
        }
        $dbc->close();
        ?>


        <h3>Skills</h3>
      <?php
      $dbc = new mysqli($host, $username, $password, $db_name);
      if ($dbc->connect_error) {
           die("Connection failed: " . $dbc->connect_error);
      }

      $sql = "SELECT * FROM skills WHERE type='skills'";
      $result = $dbc->query($sql);
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "Name: " . $row["name"]. " - Level: " . $row["level"]. " <a href=\"edit_skills.php?id={$row['id']}\">Edit</a> <a href=\"delete_skills.php?id={$row['id']}\">Delete</a> <br>";
          }
      } else {
          echo "0 results";
      }
      $dbc->close();
      ?>
      <br>
      <a href="add_skills.php" class="btn btn-primary btn-md">Add Skills</a>
      <hr>
      <h3>Sprachen</h3>
      <?php
      $dbc = new mysqli($host, $username, $password, $db_name);
      if ($dbc->connect_error) {
           die("Connection failed: " . $dbc->connect_error);
      }

      $sql = "SELECT * FROM skills WHERE type='languages'";
      $result = $dbc->query($sql);
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "Name: " . $row["name"]. " - Level: " . $row["level"]. " <a href=\"edit_skills.php?id={$row['id']}\">Edit</a> <a href=\"delete_skills.php?id={$row['id']}\">Delete</a> <br>";
          }
      } else {
          echo "0 results";
      }
      $dbc->close();
      ?>
      <br>
      <a href="add_skills.php" class="btn btn-primary btn-md">Add Languages</a>

      <hr>
      <h3>Hobbies</h3>
      <?php
      $dbc = new mysqli($host, $username, $password, $db_name);
      if ($dbc->connect_error) {
           die("Connection failed: " . $dbc->connect_error);
      }

      $sql = "SELECT * FROM skills WHERE type='hobbies'";
      $result = $dbc->query($sql);
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "Name: " . $row["name"]. " - Level: " . $row["level"]. " <a href=\"edit_skills.php?id={$row['id']}\">Edit</a> <a href=\"delete_skills.php?id={$row['id']}\">Delete</a> <br>";
          }
      } else {
          echo "0 results";
      }
      $dbc->close();
      ?>
      <br>
      <a href="add_skills.php" class="btn btn-primary btn-md">Add Hobbies</a>
    </div>
<div class="col-md-6">
      <h2>My Experience</h2>
      <h3>Erfahrung</h3>
      <?php
      $dbc = new mysqli($host, $username, $password, $db_name);
      if ($dbc->connect_error) {
           die("Connection failed: " . $dbc->connect_error);
      }

      $sql = "SELECT * FROM experience WHERE type='workexperience' ORDER BY start_date DESC";
      $result = $dbc->query($sql);
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "Name: " . $row["name"]. " - Firma: " . $row["institution"]. " <a href=\"edit_experience.php?id={$row['id']}\">Edit</a> <a href=\"delete_experience.php?id={$row['id']}\">Delete</a> <br>";
          }
      } else {
          echo "0 results";
      }
      $dbc->close();
      ?>
      <br>
      <a href="add_experience.php" class="btn btn-primary btn-md">Add Experience</a>
      <hr>
      <h3>Ausbildung</h3>
      <?php
      $dbc = new mysqli($host, $username, $password, $db_name);
      if ($dbc->connect_error) {
           die("Connection failed: " . $dbc->connect_error);
      }

      $sql = "SELECT * FROM experience WHERE type='education' ORDER BY start_date DESC";
      $result = $dbc->query($sql);
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "Name: " . $row["name"]. " - Firma: " . $row["institution"]. " <a href=\"edit_experience.php?id={$row['id']}\">Edit</a> <a href=\"delete_experience.php?id={$row['id']}\">Delete</a> <br>";
          }
      } else {
          echo "0 results";
      }
      $dbc->close();
      ?>
      <br>
      <a href="add_experience.php" class="btn btn-primary btn-md">Add Education</a>
      <br>
      <br>
      <a href="login/logout.php" class="btn btn-default btn-lg btn-block">Logout</a>
    </div>

    </div> <!-- /container -->
  </body>
</html>
