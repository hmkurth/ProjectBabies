<?php
    // Insert the page header
    $page_title = 'Project Babies Administration';
    require_once('header.php');
    require_once('connectvars.php');
    // Show the navigation menu
    require_once('navmenu.php');
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



if (isset($_GET['id']) && isset($_GET['date_created']) && isset($_GET['contact_name']) && isset($_GET['title']) && isset($_GET['description'])) {
  // Grab the post data from the GET
  $id = $_GET['id'];
  $date_created = $_GET['date_created'];
  $contact_name = $_GET['contact_name'];
  $title = $_GET['title'];
  $description = $_GET['description'];

}
else if (isset($_POST['id']) && isset($_POST['contact_name']) && isset($_POST['title']) && isset($_POST['description'])) {
  // Grab the post data from the POST
  $id = $_POST['id'];
  $title = $_POST['title'];
  $contact_name = $_POST['contact_name'];
  $description = $_POST['description'];

}
else {
  echo '<p class="error">Sorry, no post was specified for removal.</p>';
}

if (isset($_POST['submit'])) {
  if ($_POST['confirm'] == 'Yes') {
      // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Delete the post data from the database
    $query = "DELETE FROM resources WHERE id = $id LIMIT 1";
    mysqli_query($dbc, $query)
            or die('error removing post from db');
    mysqli_close($dbc);

    // Confirm success with the user
    echo '<p>The post ' . $title . ' for ' . $contact_name . ' was successfully removed.';
  }
  else {
    echo '<p class="error">The post was not removed.</p>';
  }
}
else if (isset($id) && isset($contact_name) && isset($date_created) && isset($description)) {
  echo '<p>Are you sure you want to delete the following post?</p>';
  echo '<p><strong>Name: </strong>' . $contact_name . '<br /><strong>Date: </strong>' . $date_created .
    '<br /><strong>Title: </strong>' . $title . '</p>';
  echo '<form method="post" action="removepost.php">';
  echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
  echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
  echo '<input type="submit" value="Submit" name="submit" />';
  echo '<input type="hidden" name="id" value="' . $id . '" />';
  echo '<input type="hidden" name="title" value="' . $title . '" />';
  echo '<input type="hidden" name="contact_name" value="' . $contact_name . '" />';
  echo '<input type="hidden" name="description" value="' . $description . '" />';
  echo '</form>';
}

echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';

    require_once('footer.php');
 ?>
