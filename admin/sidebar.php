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


      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-grid"></i><span>SaaS</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="/cyrus/SaaS/index.php?user=Order" target="_blank">
            <i class="bi bi-circle"></i><span>Order</span>
          </a>
        </li>
        <li>
          <a href="/cyrus/SaaS/index.php?user=Sim" target="_blank">
            <i class="bi bi-circle"></i><span>Sim Provider</span>
          </a>
        </li>
        <li>
          <a href="/cyrus/SaaS/index.php?user=Production" target="_blank">
            <i class="bi bi-circle"></i><span>Production</span>
          </a>
        </li>
        <li>
          <a href="/cyrus/SaaS/index.php?user=Store" target="_blank">
            <i class="bi bi-circle"></i><span>Store</span>
          </a>
        </li>
        <li>
          <a href="/cyrus/SaaS/index.php?user=Installation" target="_blank">
            <i class="bi bi-circle"></i><span>Installation</span>
          </a>
        </li>
      </ul>
    </li>


    <!-- End Forms Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" target="_blank" href="/cyrus/reporting/reporting.php">
        <i class="bi bi-grid"></i>
        <span>Reporting</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="/cyrus/SaaS/ordertable.php" target="_blank">
        <i class="bi bi-grid"></i>
        <span>SaaS</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="PendingMaterial.php">
        <i class="bi bi-grid"></i>
        <span>Pending Material Confirmation</span>
      </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="InventoryData.php">
        <i class="bi bi-card-list"></i>
        <span>Pending Material at Inventory</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="UnassignedWork.php">
        <i class="bi bi-grid"></i>
        <span>Unassigned Work</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="PendingWork.php">
        <i class="bi bi-grid"></i>
        <span>Pending Work</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="PendingBills.php">
        <i class="bi bi-grid"></i>
        <span>Pending Bills</span>
      </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="multiorders.php">
        <i class="bi bi-grid"></i>
        <span>Multi-Orders Confirmation</span>
      </a>
    </li>
    <!-- End Register Page Nav -->

  </ul>

</aside><!-- End Sidebar-->