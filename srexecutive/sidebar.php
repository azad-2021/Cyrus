  <?php 
  $EXEID=$_SESSION['userid'];


  ?>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-grid"></i><span>Add</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="" data-bs-toggle="modal" data-bs-target="#AddBank">
              <i class="bi bi-circle"></i><span>Bank</span>
            </a>
          </li>
          <li>
            <a href=""  data-bs-toggle="modal" data-bs-target="#AddZone">
              <i class="bi bi-circle"></i><span>Zone</span>
            </a>
          </li>
          <li>
            <a href="" data-bs-toggle="modal" data-bs-target="#AddBranch">
              <i class="bi bi-circle"></i><span>Branch</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/cyrus/reception/" target="_blank">
          <i class="bi bi-grid"></i>
          <span>Reception</span>
        </a>
      </li><!-- End Contact Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="PendingBills.php">
          <i class="bi bi-card-list"></i>
          <span>All Pending Bills</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pendingGstbills.php">
          <i class="bi bi-card-list"></i>
          <span>Based on next reminder</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="NoGstbills.php">
          <i class="bi bi-card-list"></i>
          <span>Based on no reminder</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="branchdetails.php" target="_blank">
          <i class="bi bi-grid"></i>
          <span>Branch Detail</span>
        </a>
      </li>

    </ul>

</aside><!-- End Sidebar-->