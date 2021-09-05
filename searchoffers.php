<?php

   // Insert the page header
   $page_title = 'Search and View Offerings';
   require_once('header.php');
   require_once('connectvars.php');
   // Show the navigation menu
   require_once('navmenu.php');
   

   //ALL REQUESTS TABLE
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
           or die('Error connecting to database');
    //get requests from db
    $query1 = "SELECT * FROM resources WHERE type = 'Requesting' order by date_created desc";

    $result1 = mysqli_query($dbc, $query1) or die('error getting request');
    //insert table head
    echo'<h2> All Requests </h2>';
    echo '<table class=”table-dark” id="requests">';
    echo '<thead><tr><th scope=”col”>Title</th><th scope=”col”>Description</th><th scope=”col”>Contact Name</th><th scope=”col”>Email</th><th scope=”col”>Date of Request</th></tr></thead>';
    echo '<tbody>';
    while($row = mysqli_fetch_array($result1))
    {
         echo '<tr><td>' . $row['title'] . '</td>';
         echo '<td>' . $row['description'] . '</td>';
         echo '<td>' . $row['contact_name'] . '</td>';
         echo '<td>' . $row['email'] . '</td>';
         echo '<td>' . $row['date_created'] . '</td></tr>';
     }
     echo '</tbody></table>';


     mysqli_close($dbc);






   // Connect to the database
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
          or die('Error connecting to database');

            //get requests from db
    $query2 = "SELECT * FROM resources WHERE type = 'Offering' order by date_created desc";

    $result2 = mysqli_query($dbc, $query2) or die('error getting offers');
    //insert table head
    echo'<h2> All Offers </h2>';
    echo '<table class=”table-dark” id="offers">';
    echo '<thead><tr><th scope=”col”>Title</th><th scope=”col”>Description</th><th scope=”col”>Contact Name</th><th scope=”col”>Email</th><th scope=”col”>Date of Request</th></tr></thead>';
    echo '<tbody>';
    while($row = mysqli_fetch_array($result2))
    {
         echo '<tr><td>' . $row['title'] . '</td>';
         echo '<td>' . $row['description'] . '</td>';
         echo '<td>' . $row['contact_name'] . '</td>';
         echo '<td>' . $row['email'] . '</td>';
         echo '<td>' . $row['date_created'] . '</td></tr>';
     }
     echo '</tbody></table>';

    mysqli_close($dbc);

   require_once('footer.php');
   ?>
