
<div class="modal fade" id="Bill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pending Bills</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="BillData" style="background-color: #f0f0f0;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reminder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FormReminder">
          <div class="col-6 d-none">
            <input type="text" class="form-control rounded-corner" id="billid">
          </div>
          <div class="col-6 d-none">
            <input type="text" class="form-control rounded-corner" id="branch">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Detail of conversation with branch:</label>
            <textarea  rows="3" class="form-control rounded-corner" id="conversation"></textarea>
          </div>
          <div class="row">
            <div class="col-6">
              <label for="recipient-name" class="col-form-label">Next Reminder Date</label>
              <input type="date" class="form-control rounded-corner" id="NextDate">
            </div>
            <div class="col-6">
              <div class="form-check" style="margin-top: 60px;">
                <input class="form-check-input" type="checkbox" id="Action">
                <label class="form-check-label" for="flexCheckDefault" style="margin-top: -5px;">Action Required</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary SaveReminder" data-bs-dismiss="modal">Save</button>
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="JobcardReminder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner" style="background-color:#f0f0f0">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="jobcardR">
          <input type="text" class="d-none" name="" id="cardnumber">
          <textarea class="form-control rounded-corner" id="JobcardReminderData"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary SaveReminder">Save</button>
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="AddBank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FormAddBank">
          <div class="row">

            <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label">Bank Name</label>
              <input type="text" class="form-control rounded-corner" id="AddBank1" name="AddBank1">
            </div>
            
            <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label">Bank Inital</label>
              <input type="text" class="form-control rounded-corner" id="ini" name="ini">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary SaveBank">Save</button>
          <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="AddZone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FormAddBank">
          <div class="row">

            <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label">Select Bank</label>
              <select id="Bank" class="form-control rounded-corner" name="Bank" required>
                <option value="">Bank</option>
                <?php
                $BankData="Select BankCode, BankName from bank order by BankName";
                $result=mysqli_query($con,$BankData);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['BankCode']; ?>"><?php echo $arr['BankName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label">Zone Name</label>
              <input type="text" class="form-control rounded-corner" id="AddZoneCode2">
            </div>          
            <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label">Branch Name</label>
              <input type="text" class="form-control rounded-corner" id="AddBranchCode2">
            </div>
            <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label">Select Region</label>
              <select id="Region2" class="form-control rounded-corner" required>
                <option value="">Select</option>
                <?php
                $Data="SELECT RegionCode, RegionName from `cyrus regions` order by RegionName";
                $result=mysqli_query($con,$Data);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['RegionCode']; ?>"><?php echo $arr['RegionName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label">Select District</label>
              <select id="District2" class="form-control rounded-corner" required>
                <option value="">Select</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label">Address 2</label>
              <input type="text" class="form-control rounded-corner" id="Address2-2">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary SaveZone">Save</button>
          <button type="reset" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="AddBranch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FormAddBank">
          <div class="row g-3">

            <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label">Select Bank</label>
              <select id="Bank" class="form-control rounded-corner" name="Bank" required>
                <option value="">Bank</option>
                <?php
                $BankData="Select BankCode, BankName from bank order by BankName";
                $result=mysqli_query($con,$BankData);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['BankCode']; ?>"><?php echo $arr['BankName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label">Zone Name</label>
              <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                <option value="">Zone</option>
              </select>
            </div>          
            <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label">Branch Name</label>
              <input type="text" class="form-control rounded-corner" id="AddBranchCode3">
            </div>
            <div class="col-sm-4">
              <label for="recipient-name" class="col-form-label">Select Region</label>
              <select id="Region3" class="form-control rounded-corner" required>
                <option value="">Select</option>
                <?php
                $Data="SELECT RegionCode, RegionName from `cyrus regions` order by RegionName";
                $result=mysqli_query($con,$Data);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['RegionCode']; ?>"><?php echo $arr['RegionName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="recipient-name" class="col-form-label">Select District</label>
              <select id="District3" class="form-control rounded-corner" name="District" required>
                <option value="">Select</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label">Address 2</label>
              <input type="text" class="form-control rounded-corner" id="Address2-3">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary SaveBranch">Save</button>
          <button type="reset" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>