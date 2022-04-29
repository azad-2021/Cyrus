  <!-- ======= Sidebar ======= -->
  <?php 
  if (isset($_SESSION['QueryType'])) {
    $QueryType=$_SESSION['QueryType'];
  }
  
  ?>
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
       <?php 

       if ($Type=='Executive') {

        echo '<a class="nav-link " href="/cyrus/executive/index.php">';
      }elseif ($Type=='Dataentry') {
        echo '<a class="nav-link " href="reporting.php">';
      }else{
        echo '<a class="nav-link " href="index.php">';
      }
      ?>
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <?php 

  if ($Type=='Reporting' or ($Type=='Super User' and $QueryType=='reporting')) {

   ?>
   <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-search"></i><span>Find</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="" data-bs-toggle="modal" data-bs-target="#FindBranch">
          <i class="bi bi-circle"></i><span>Find Branch</span>
        </a>
      </li>
      <li>
        <a href="branchdetails.php" target="_blank">
          <i class="bi bi-circle"></i><span>Branch Details</span>
        </a>
      </li>
      <li>
        <a href="estimate_edit.php">
          <i class="bi bi-circle"></i><span>Estimate</span>
        </a>
      </li>
      <li>
        <a href="" data-bs-toggle="modal" data-bs-target="#FindEmployee">
          <i class="bi bi-circle"></i><span>Employees</span>
        </a>
      </li>
      <li>
        <a href=""  data-bs-toggle="modal" data-bs-target="#FindOrder">
          <i class="bi bi-circle"></i><span>Order</span>
        </a>
      </li>
      <li>
        <a href="" data-bs-toggle="modal" data-bs-target="#FindComplaint">
          <i class="bi bi-circle"></i><span>Complaints</span>
        </a>
      </li>
      <li>
        <a href="/cyrus/reporting/search.php" target="blank">
          <i class="bi bi-circle"></i><span>Job Cards</span>
        </a>
      </li>
      <li>
        <a href="" data-bs-toggle="modal" data-bs-target="#FindJobcard">
          <i class="bi bi-circle"></i><span>Job Card Details</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="reporting.php">
      <i class="bi bi-grid"></i>
      <span>Reporting</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="rejectedData.php" target="_blank">
      <i class="bi bi-grid"></i>
      <span>Rejected Verifications</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="Work.php">
      <i class="bi bi-grid"></i>
      <span>Unassigned & Pending Work</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="InventoryData.php">
      <i class="bi bi-card-list"></i>
      <span>Pending Materials at Inventory</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="multiamc.php">
      <i class="bi bi-grid"></i>
      <span>Multi-AMC Assigning</span>
    </a>
  </li>
  <?php 
  if (isset($Edit)) {
    ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="/technician/editjobcard.php?apid=<?php echo $enApprovalID.'&cardno='.$enJobcard;  ?>">
        <i class="bi bi-grid"></i>
        <span>Edit Jobcard</span>
      </a>
    </li>
    <?php 
  }
}elseif($Type=='Dataentry' or ($Type=='Super User' and $QueryType=='jobcardentry')){
  ?>
  <li class="nav-item">
    <a class="nav-link collapsed" href="search.php">
      <i class="bi bi-grid"></i>
      <span>Search Jobcard</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="addjobcard.php">
      <i class="bi bi-grid"></i>
      <span>Add Jobcard</span>
    </a>
  </li>

  <?php 
}elseif($Type=='Executive'){
  ?>

  <li class="nav-item">
    <a class="nav-link collapsed" href="Work.php">
      <i class="bi bi-grid"></i>
      <span>Unassigned & Pending Work</span>
    </a>
  </li>
  <?php 
}
?>
</ul>
</aside>
<!-- End Sidebar-->