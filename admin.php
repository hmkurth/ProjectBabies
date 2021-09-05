<?php

    require_once('authorize.php');
    // Insert the page header
    $page_title = 'Project Babies Administration';
    require_once('header.php');
    require_once('connectvars.php');
    // Show the navigation menu
    require_once('navmenu.php');
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Retrieve the resource data from MySQL
    $query = "SELECT * FROM resources ORDER BY date_created DESC";
    $result = mysqli_query($dbc, $query);

    echo'<h2> All Posts </h2>';
    echo '<table class=”table-dark” id="offers">';
    echo '<thead><tr><th scope=”col”>Title</th><th scope=”col”>Description</th><th scope=”col”>Contact Name</th><th scope=”col”>Email</th><th scope=”col”>Date of Request</th><th>Remove</th></tr></thead>';
    echo '<tbody>';
    while($row = mysqli_fetch_array($result))
    {
         echo '<tr><td>' . $row['title'] . '</td>';
         echo '<td>' . $row['description'] . '</td>';
         echo '<td>' . $row['contact_name'] . '</td>';
         echo '<td>' . $row['email'] . '</td>';
         echo '<td>' . $row['date_created'] . '</td>';
         echo '<td><a href="removepost.php?id=' . $row['id'] . '&amp;date_created=' . $row['date_created'] .
           '&amp;contact_name=' . $row['contact_name'] . '&amp;title=' . $row['title'] .
           '&amp;description=' . $row['description'] . '">Remove</a></td></tr>';
     }
     echo '</tbody></table>';


    mysqli_close($dbc);
require_once('footer.php');
?>
