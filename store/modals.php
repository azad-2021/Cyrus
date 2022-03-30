    <div class="modal fade" id="Challan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Print Challan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <center>
                <form class="form-control" action="challan.php" method="get" target="blank">
                  <div class="col-md-4">
                    <label for="validationCustom01" class="form-label " align="center">Select Employee</label>
                    <select class="form-select my-select3" aria-label="Default select example" id="EmployeeCodeW" name="EmployeeID" required="">
                      <option value="">Select</option>
                      <?php 
                      $query="SELECT * FROM employees WHERE Inservice=1 order by `Employee Name`";
                      $result=mysqli_query($con4,$query);
                      if (mysqli_num_rows($result)>0)
                      {
                       while ($a=mysqli_fetch_assoc($result))
                       {

                        echo "<option value='".$a['EmployeeCode']."'>".$a['Employee Name']."</option><br>";
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label " align="center">Date</label>
                  <input type="date" class="form-control my-select3" name="SDate" id="Sdate" required>
                </div>
                <!--
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label " align="center">End Date</label>
                  <input type="date" class="form-control my-select3" name="EDate" id="Edate">
                </div>
              -->
                <br>
                <div class="col-md-4">
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="submit">Print</button>
              </div>
              </form>
            </center>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="modal fade" id="FindChallan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Find Challan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <center>
                <form class="form-control" action="challan.php" method="GET" target="blank">
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label " align="center">Enter Challan No.</label>
                  <input type="text" class="form-control my-select3" name="ChallanNo" required>
                </div>
                <br>
                <div class="col-md-4">
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="submit">Find</button>
              </div>
              </form>
            </center>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>