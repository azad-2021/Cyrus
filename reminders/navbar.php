<?php 
$EXEID=$_SESSION['userid'];


?>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
  <div class="container-fluid" align="center">

    <a class="navbar-brand" href=""><img src="cyrus logo.png" alt="cyrus.com" width="30" height="35">Cyrus Electronics</a>
    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown" align="center">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/cyrus/reminders/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pendingbills.php">Pending Bills</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pendingGstbills.php">Based on next reminder</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="NoGstbills.php">Based on no reminder</a>
        </li>
        <?php 
        if ( $EXEID==11) { 
          ?>
          <li class="nav-item">
            <a class="nav-link" target="blank" href="/cyrus/reception/">Reception</a>
          </li>
          <?php 
        }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="/cyrus/executive/changepass.php">Change Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>

