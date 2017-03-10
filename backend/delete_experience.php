<?php
require "login/loginheader.php";
include "login/dbconf.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Delete Experience</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </head>
  <body>

        <div class="container">
    <h1>Delete Experience</h1>


    <?php
    $dbc = new mysqli($host, $username, $password, $db_name);
    if ($dbc->connect_error) {
        die("Connection failed: " . $dbc->connect_error);
    }

    if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] >0) ) {
      $query = "SELECT * FROM experience WHERE id={$_GET['id']}";
      if ($result = mysqli_query($dbc,$query)) {
        $row = mysqli_fetch_array($result);
        print '<form action="delete_experience.php" method="post">
        <p>Are you sure you want to delete this record?</p>
        <h3 class="title">' . $row['name']. ' / ' . $row['institution']. '</h3>
               <p class="date"><i class="material-icons" style="font-size:18px">event_note</i>' . date('M Y', strtotime($row['start_date'])). ' bis ' .date('M Y', strtotime($row['end_date'])). '</p>
               <p>' . $row['description']. '</p>
               <input type="hidden" name="id" value="' . $_GET['id'] . '"
               <p><input type="submit" name="submit" value="Delete this record!"></p>
               </form>';
             } else {
               print 'Could not retrieve the record';
             }
           }
             elseif (isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id'] > 0)) {
               $query = "DELETE FROM experience WHERE id={$_POST['id']} LIMIT 1";
               $result = mysqli_query($dbc, $query);
               if (mysqli_affected_rows($dbc) == 1) {
                 $link = "http://$_SERVER[HTTP_HOST]";
               print "<p>The record has been deleted</p>
                       <p><a href=\"$link/backend\" class=\"btn btn-primary btn-md\">Back to the overview</a>";
               } else {
                 print '<p class="error">
                 Could not delete the record
                 </p>';
               }
             } else {
               print '<p class="error">
               This page has been accessed in error.
               </p>';
             }
             mysqli_close($dbc);
             ?>
