<?php
    // Insert the page header
    $page_title = 'Project Babies';
    require_once('header.php');
    require_once('connectvars.php');
    // Show the navigation menu
    require_once('navmenu.php');

?>
<header>
  <div class="jumbotron text-center">
    <h1>Project Babies</h1>
    <p>Project Babies provides information and activities that enable families to become proactive in their children’s health and well being.</p>
  </div>
  <div class="container-fluid bg-2 text-center">
    <img src="images/baby.jpg" class="img-responsive img-circle" style="display:inline" alt="Baby">
  <h3>Need Help?  Have something to offer?</h3>
  <p></p>
  <a href="addresource.php" class="btn btn-default btn-lg">Add your request or offer</a>
</div>
</header>

<div class="container features">
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
      <h3 class="feature-title">Request Assistance</h3>
      <img src="images/bottle.jpg" class="img-fluid" width = 75%>
      <p>We understand that everyone needs a little help now and then.  We are here to help you find the resources you need!</p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <h3 class="feature-title">Provide Resources</h3>
      <img src="images/babystuff.jpeg" class="img-fluid">
      <p>We accept donations of gently used baby items, money, or simply your time.  </p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <h3 class="feature-title">Education</h3>
      <img src="images/desk.jpg" class="img-fluid">
      <p>Programs and activities that highlight the importance of care and nurturing of babies prenatal through 2 years of age, such as:

Nutrition

Literacy

Attachment – Bonding/Social Emotional Development

Brain Development

Parenting skills</p>
    </div>
  </div>
</div>






<?php

    require_once('footer.php');
 ?>
