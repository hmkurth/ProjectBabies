<?php
// Insert the page header
$page_title = 'Add a request or offer support';
require_once('header.php');
require_once('connectvars.php');
// Show the navigation menu
require_once('navmenu.php');

?>
<header >

</header>
<div >
  <h3 class="feature-title">Submit Resources and Requests Here</h3><br/>
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="form-group">
<label for="what_type">Are you Offering or Requesting assistance?</label>
<div class="form-check">
    <div class="form-group">
  <select id="type" name="type">
    <option value="Offering" <?php if (!empty($type) && $type == 'Offering') echo 'selected = "selected"'; ?>>Offering</option>
    <option value="Requesting" <?php if (!empty($type) && $type == 'Requesting') echo 'selected = "selected"'; ?>>Requesting</option>

</div>
</select>
</div>
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Name" name="contact_name" value="<?php if (!empty($contact_name)) echo $contact_name; ?>">
  </div>
  <div class="form-group">
    <input type="email" class="form-control" placeholder="Email Address" name="email" value="<?php if (!empty($email)) echo $email; ?>">
  </div>

  <div class="form-group">
    <input type="text" class="form-control" placeholder="Quick Title Here" name="title" value="<?php if (!empty($title)) echo $title; ?>">
  </div>
  <div class="form-group">
    <textarea class="form-control" rows="4" name="description" value="<?php if (!empty($description)) echo $description; ; ?>">Please add a detailed description of your need or resource here.</textarea>
  </div>
  <div class="form-group">
    <input type="date" class="form-control" placeholder="Date" name="date_created"value="<?php if (!empty($date_created)) echo $date_created; else echo 'yyy-MM-dd'; ?>">
  </div>
  <input type="submit" class="btn btn-secondary btn-block" value="submit" name="submit">
</div>
</div>
</div>



<?php
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
          or die('Error connecting to database');

        //if the user entered data from the form
        if (isset($_POST['submit']))
        {

        // Grab the  data from the POST
        $type = mysqli_real_escape_string($dbc, trim($_POST['type']));
        $contact_name = mysqli_real_escape_string($dbc, trim($_POST['contact_name']));
        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
        $description = mysqli_real_escape_string($dbc, trim($_POST['description']));
        $date_created = mysqli_real_escape_string($dbc, trim($_POST['date_created']));

       // Validate the entries
       // Update the  data in the database
       //  if they aren't empty
       if ( isset($type) && !empty($title) && !empty($date_created) && !empty($description) && !empty($contact_name))
       {
            //insert into database
            $query = "INSERT INTO resources (type, contact_name, email, title , description, date_created)"
                    . " VALUES ( '$type', '$contact_name', '$email', '$title', '$description', '$date_created')";



            mysqli_query($dbc, $query) or die('error inserting'.mysqli_error($dbc));

            // Confirm success with the user
            echo '<p class="text-success">Your ' . $type .  ' has been successfully added to the database.<br/>
                      Would you like to <a href="searchrequests.php"> view and search requests</a> or <a href="searchoffers.php"> view and search offers?</a></p>';

            mysqli_close($dbc);
            exit();
       }
       else {
       echo '<p class="error">You must enter all of the fields in the form as requested.</p>';
   }
 }


     require_once('footer.php');
  ?>
