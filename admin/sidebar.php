<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><img src="img/cyrus logo.png" height="25" width="18"> Cyrus</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"><?php echo $_SESSION['user']; ?></h6>
                <span><?php echo $_SESSION['usertype']; ?></span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" style="font-size:13px" data-bs-toggle="dropdown"><i class="fa fa-search me-2"></i>Find</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#FindBranch" style="font-size:13px">Branch</a>
                    <a style="font-size:13px" class="dropdown-item" href="branchdetails.php" target="_blank">Branch Details</a>
                    <a style="font-size:13px" class="dropdown-item" href="estimate_edit.php">Estimate</a>
                    <a style="font-size:13px" class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#FindEmployee" style="font-size:13px">Employees</a>
                    <a class="dropdown-item" href=""  data-bs-toggle="modal" data-bs-target="#FindOrder" style="font-size:13px">Order</a>
                    <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#FindComplaint" style="font-size:13px">Complaint</a>
                    <a class="dropdown-item" href="/cyrus/reporting/search.php" target="blank" style="font-size:13px">Jobcard</a>
                    <a style="padding-right: 10px; font-size:13px;" data-bs-toggle="modal" data-bs-target="#FindJobcard" class="dropdown-item" href="" style="font-size:13px">Jobcard Details</a>
                </div>
            </div>
            
            <a style="font-size:13px" class="nav-link" href="/cyrus/reporting/reporting.php" target="blank">Reporting</a>
            <a style="font-size:13px" class="nav-link" href="/cyrus/SaaS/ordertable.php" target="blank">SaaS</a>


            <a style="font-size:13px" class="nav-link" href="PendingMaterial.php">Pending Material Confirmation</a>
            <a style="font-size:13px" class="nav-link" href="InventoryData.php">Pending Material at Inventory</a>

            <a style="font-size:13px" href="UnassignedWork.php" class="nav-item nav-link">Unassigned Work</a>

            <a style="font-size:13px" href="PendingWork.php" class="nav-item nav-link">Pending Work</a>

            <a style="font-size:13px" href="PendingPayment.php" class="nav-item nav-link">Pending Payment</a>
            <a style="font-size:13px" href="multiorders.php" class="nav-item nav-link">Multi-Orders Confirmation</a>
                    <!--
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>
                -->
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->