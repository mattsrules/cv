<?php
include "backend/login/dbconf.php";
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Matthias Ackeret - CV</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet" media="screen">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://use.fontawesome.com/e6c6706ccc.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container cont-border">
      <div class="row">
      <aside class="col-md-4">
        <img src="backend/images/portrait.jpg" class="img-responsive" alt="Responsive image" style="padding-top: 15px">
        <?php
        $dbc = new mysqli($host, $username, $password, $db_name);
        if ($dbc->connect_error) {
             die("Connection failed: " . $dbc->connect_error);
        }

        $sql = "SELECT * FROM profile";
        $result = $dbc->query($sql);

        if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 print "<h2>" . $row["firstname"]. " " . $row["lastname"]. "</h2>
                        <p><span class=\"glyphicon glyphicon-briefcase\" aria-hidden=\"true\"></span> " . $row["job"] ."</p>
                        <p><span class=\"glyphicon glyphicon-home\" aria-hidden=\"true\"></span> " . $row["place"] ."</p>
                        <p><span class=\"glyphicon glyphicon-envelope\" aria-hidden=\"true\"></span> <a href=\"mailto:" . $row["email"] ."\">" . $row["email"] ."</a></p>
                        <p><span class=\"glyphicon glyphicon-earphone\" aria-hidden=\"true\"></span> " . $row["phone"] ."</p>
                        <p><a href=\"" . $row["linkedin"] ."\" target=\"_blank\"><i class=\"fa fa-linkedin-square\" aria-hidden=\"true\" style=\"font-size:3em;\"></i></a>
                        <a href=\"" . $row["xing"] ."\" target=\"_blank\"><i class=\"fa fa-xing-square\" aria-hidden=\"true\" style=\"font-size:3em;\"></i></a></p>
                        <hr>
                        ";
             }
        } else {
             print "<p class=\"error\">Es sind keine Daten hinterlegt</p>";
        }
        $dbc->close();
        ?>
          <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Skills</h2>

          <?php
          $dbc = new mysqli($host, $username, $password, $db_name);
          if ($dbc->connect_error) {
               die("Connection failed: " . $dbc->connect_error);
          }

          $sql = "SELECT * FROM skills WHERE type='skills' ORDER BY name ASC";
          $result = $dbc->query($sql);

          if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                   print "<p>" . $row["name"]. "</p>
                          <div class=\"progress\">
                      <div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"" . $row["level"]."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: " . $row["level"] . "%;\">
                      " . $row["level"]."%
                      </div>
                      </div>
                                ";
               }
          } else {
               print "<p class=\"text-danger\">Es sind keine Daten hinterlegt</p>";
          }
          $dbc->close();
          ?>
          <hr>
          <h2><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Sprachen</h2>

          <?php
          $dbc = new mysqli($host, $username, $password, $db_name);
          if ($dbc->connect_error) {
               die("Connection failed: " . $dbc->connect_error);
          }

          $sql = "SELECT * FROM skills WHERE type='languages' ORDER BY name ASC";
          $result = $dbc->query($sql);

          if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                   print "<p>" . $row["name"]. "</p>
                          <div class=\"progress\">
                      <div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"" . $row["level"]."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: " . $row["level"] . "%;\">
                      " . $row["level"]."%
                      </div>
                      </div>
                                ";
               }
          } else {
               print "<p class=\"error\">Es sind keine Daten hinterlegt</p>";
          }
          $dbc->close();
          ?>
          <hr>
          <h2><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Hobbies</h2>

          <?php
          $dbc = new mysqli($host, $username, $password, $db_name);
          if ($dbc->connect_error) {
               die("Connection failed: " . $dbc->connect_error);
          }

          $sql = "SELECT * FROM skills WHERE type='hobbies'";
          $result = $dbc->query($sql);

          if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                   print "<p>" . $row["name"]. "</p>";
               }
          } else {
               print "<p class=\"error\">Es sind keine Daten hinterlegt</p>";
          }
          $dbc->close();
          ?>
      </aside>
      <main>
        <div class="col-md-8">

        <h2><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Erfahrung</h2>

<?php
$dbc = new mysqli($host, $username, $password, $db_name);
if ($dbc->connect_error) {
     die("Connection failed: " . $dbc->connect_error);
}

$sql = "SELECT * FROM experience WHERE type='workexperience' ORDER BY start_date DESC";
$result = $dbc->query($sql);

if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
         print "<h3>" . $row["name"]. " <small>" . $row["institution"]. "</small></h3>
                <p class=\"date\"><span class=\"glyphicon glyphicon-calendar\" aria-hidden=\"true\"></span> " . date("M Y", strtotime($row["start_date"])). " bis " .date("M Y", strtotime($row["end_date"])). "</p>
                " . $row["description"]. "
                ";
     }
} else {
     print "<p>Es sind keine Daten hinterlegt</p>";
}
$dbc->close();
?>
</div>
<div class="col-md-8">

<h2><span class="glyphicon glyphicon-education" aria-hidden="true"></span> Ausbildung</h2>

<?php
$dbc = new mysqli($host, $username, $password, $db_name);
if ($dbc->connect_error) {
die("Connection failed: " . $dbc->connect_error);
}

$sql = "SELECT * FROM experience WHERE type='education' ORDER BY start_date DESC";
$result = $dbc->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
 print "<h3>" . $row["name"]. " <small> " . $row["institution"]. "</small></h3>
        <p class=\"date\"><span class=\"glyphicon glyphicon-calendar\" aria-hidden=\"true\"></span> " . date("M Y", strtotime($row["start_date"])). " bis " .date("M Y", strtotime($row["end_date"])). "</p>
        <p>" . $row["description"]. "</p>
        ";
}
} else {
print "<p>Es sind keine Daten hinterlegt</p>";
}
$dbc->close();
?>
</div>
</main>
</div>
    </div>
  </body>
</html>
