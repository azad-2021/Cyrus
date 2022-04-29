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
            <a href="search.php" target="blank">
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
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Executive</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/cyrus/executive/index.php?user=6" target="_blank">
              <i class="bi bi-circle"></i><span>Abhineet Anand</span>
            </a>
          </li>
          <li>
            <a href="/cyrus/executive/index.php?user=3" target="_blank">
              <i class="bi bi-circle"></i><span>Raj Kamal kapoor</span>
            </a>
          </li>
          <li>
            <a href="/cyrus/executive/index.php?user=3" target="_blank">
              <i class="bi bi-circle"></i><span>Zeeshan Sayeed</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Work Reporting</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Jayant Saxena</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>Shreyansh Awasthi</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->
      <!--
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Jobcard Entry</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Rahul</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Varsha</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>Tarun Singh</span>
            </a>
          </li>
        </ul>
      </li> -->

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

    <li class="nav-item">
      <a class="nav-link collapsed" href="/cyrus/amc/" target="_blank">
        <i class="bi bi-grid"></i>
        <span>AMC Report</span>
      </a>
    </li><!-- End Contact Page Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="/cyrus/reception/" target="_blank">
        <i class="bi bi-grid"></i>
        <span>Reception</span>
      </a>
    </li><!-- End Contact Page Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="/cyrus/inventory/" target="_blank">
        <i class="bi bi-card-list"></i>
        <span>Inventory Release</span>
      </a>
    </li>
    <!-- End Forms Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="">
        <i class="bi bi-card-list"></i>
        <span>Service Engineer</span>
      </a>
    </li> 
    <li class="nav-item">
      <a class="nav-link collapsed" target="_blank" href="/cyrus/reporting/index.php?user=reporting">
        <i class="bi bi-grid"></i>
        <span>Reporting</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="/cyrus/reporting/reporting.php?user=jobcardentry" target="_blank">
        <i class="bi bi-grid"></i>
        <span>Jobacrd Entry</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->





  </ul>

</aside><!-- End Sidebar-->