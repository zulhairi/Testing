<!-- This is CSS -->
<style>
  body {
    background: url("images/bg.jpg") no-repeat center bottom/cover;
  }

  .claim-number {
    text-align: center;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-weight: bold;
    font-size: 30px;
    color: #fff;
    background-color: #3a7bd5;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
  }
</style>


<!-- This is HTML embedded with PHP -->
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js"></script>
</head>

<!--Change the href and also the "include" in the php section to the correlating sidebar of the forms-->

<body>
  <div class="sidebar">
    <div class="sidebar-links">
      <a class="active" href="?page=travelForm">Travelling Form</a>
      <ul>
        <li>
          <a href="?page=travelsummary">Requested Travelling</a>
        </li>
        <?php
        include "layouts/sidebarapprovetravelling.php";
        ?>
      </ul>
    </div>
    <a href="?page=idx" class="logout-link" style="background-color:#555; color:white;">
      <img src="images/logout.png" alt="Exam"
        style="display:inline-block; vertical-align:middle; width:30px; height:30px;">
      Back</a>
  </div>

  <!-- <------------------------------------------------------------------------------------------------------->

  <!--This is the front-end aspect of the form, it will start from here-->
  <div class="form-container">
    <h2>MINCONSULT SDN BHD</h2>
    <!-- <h3><strong><center>TRAVELLING, SUBSISTENCE, LODGING, MILEAGE AND MISCELLANEOUS EXPENSES CLAIMS</center></strong></h3> -->
    <br />



    <!-- CEO & CSO staffno login section -->

    <?php    
    if (logged_in() == 1) {
      $ceo_logged_in = true;
    } elseif (logged_in() == 2) {
      $cso_logged_in = true;
    }

    if ($act == "idx") {

      if ($ceo_logged_in) {
        header("Location: ?page=travelForm&act=ceoApproval");
      }

      if ($cso_logged_in) {
        header("Location: ?page=travelForm&act=csoApproval");
      }
      ?>

      <form id="travelling-form" name="borang" action="" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <!-- <div class="form-group"> -->

          <?php
          //In order to auto generate generic fields like name, staff no, division and designation inside a form, 
          //we will use $ses_staffno. $ses_staffno is a session variable which stores the staff no of the user
          //when they login into the intranet. This session variable will be used to query from the database
          //to collect information from the user that logged in.
        
          //Here we are querying table hr_employee where the status is 1. Status = 1 meaning the staff is still working
          //for the company and status = 0 means that they have stoppped working and is inactive. Then we will fetch this
          //data based on the $ses_staffno.
          $dq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE status = 1 AND staffno = '" . $ses_staffno . "'");

          //Using while loop to store every information about the user like name, staffno, designation, div_code
          while ($dr = mysqli_fetch_array($dq)) {
            $name = $dr["name"];
            $staffno = $dr["staffno"];
            $designationId = $dr["desig"];
            $designation = '';
            $divisionCode = $dr["div_code"];
            $division = '';

            $dq2 = mysqli_query($mysqli, "SELECT * FROM hr_designation WHERE desg_code = '" . $designationId . "'");
            while ($dr2 = mysqli_fetch_array($dq2)) {
              $designation = $dr2["desg_name"];
            }

            $dq3 = mysqli_query($mysqli, "SELECT * FROM hr_division WHERE div_code = '" . $divisionCode . "'");
            while ($dr3 = mysqli_fetch_array($dq3)) {
              $division = $dr3["div_name"];
            }

          }
          ?>

          <div class="form-row">
            <div class="form-group">
              <label for="reimbursable-by-client">Reimbursable By Client:</label>
              <label for="reimbursable-yes" style="display: inline-block;">
                Yes
                <input type="checkbox" id="reimbursable-yes" name="reimbursable" value="Yes" class="boxy-checkbox"
                  onclick="uncheckOther(this)" />
              </label>
              <label for="reimbursable-no" style="display: inline-block;">
                No
                <input type="checkbox" id="reimbursable-no" name="reimbursable" value="No" class="boxy-checkbox"
                  onclick="uncheckOther(this)" />
              </label>
            </div>

          </div>

          <div class="form-group">
            <label for="month">Month:</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" id="month" name="month" />
          </div>

          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name[]" value="<?php echo $name; ?>" readonly="readonly" />
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="staff-no">Staff No:</label>
              <input type="text" id="staff-no" value="<?php echo $staffno; ?>" name="staffno" readonly="readonly" />
            </div>
            <div class="form-group">
              <label for="vehicle-reg-no">Vehicle Reg No:</label>
              <input type="text" id="vehicle-reg-no" name="vehicle-reg-no" pattern="[A-Za-z0-9-]+" required />
            </div>
            <div class="form-group">
              <label for="division-department">Division / Department:</label>
              <input type="text" id="division-department" value="<?php echo $division; ?>" name="division-department"
                readonly="readonly" />
            </div>
            <div class="form-group">
              <label for="position">Position:</label>
              <input type="text" id="position" name="position" value="<?php echo $designation; ?>" readonly="readonly" />
            </div>
            <div class="form-group">
              <label for="class">Class:</label>
              <select id="class" name="class" required>
                <option value="car">Automobile</option>
                <option value="motorcycle">Motorcycle</option>
              </select>
            </div>
            <div class="form-group">
              <label for="cc">C.C (Vehicle CC):</label>
              <input type="text" id="cc" name="cc" pattern="[0-9]*\.?[0-9]+" required />
            </div>
            <div class="form-group">
              <label for="project">Project & Job Number:</label>
              <input type="text" id="project" placeholder="Please input project code" oninput="validateInput()"
                name="project" rows="3" />
            </div>
            <div class="form-group">
              <label for="projectManager">Project Manager:</label>
              <input type="text" id="projectManager" placeholder="Please enter project manager" name="projectManager"
                rows="3" required />
            </div>
            <div class="form-group">
              <label for="HodApprover">HOD Approver:</label>
              <select id="HodApprover" name="HodApprover" required>
                <option value="">Please select</option>
                <?php
                $sql = "SELECT * FROM `hr_employee` WHERE `status` = 1 AND `intra_level` = 2 ORDER BY `div_code` DESC";
                $result = mysqli_query($mysqli, $sql);
                while ($row = mysqli_fetch_array($result)) {
                  $HOD_Name = $row["name"];
                  $HOD_staffno = $row["staffno"];
                  echo "<option value='" . $HOD_staffno . "'>" . '(' . "" . $HOD_staffno . "" . ')' . "  " . $HOD_Name . " </option>";
                }

                ?>
              </select>
            </div>
          </div>
          <br>
          <div class="full-blue"></div>

          <div class="form-group">
            <div class="cloned-container" id="cloned-container">
              <div class="cloned" id="cloned">
                <div class="form-group">
                  <center>
                    <div class="form-number2">
                      <h2>Claim 1</h2>
                    </div>
                  </center>
                </div>
                <div class="form-group">
                  <label for="place">Place:</label>
                  <select id="place" name="place[]" class="place">
                    <option value="semenanjung">Semenanjung</option>
                    <option value="s/s">Sabah/Sarawak</option>
                    <option value="overseas">Overseas</option>
                  </select>
                </div>
                <div class="form-group country-list" style="display: none;">
                  <label for="country">Country:</label>
                  <select id="country" name="country[]" class="country">
                    <option value="">Select Country</option>
                    <?php
                    // Assuming you have already established a connection to the database
                    $sql = "SELECT * FROM travel_overseas";
                    $result = mysqli_query($mysqli, $sql);

                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $overseas_id = $row['overseas_id'];
                        $country = $row['country'];
                        echo '<option value="' . $overseas_id . '">' . $country . '</option>';
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="departure-time">Location of Departure:</label>
                  <input type="text" id="departure-location" name="departure-location[]" required />
                </div>

                <div class="form-group">
                  <label for="departure-time">Departure Date:</label>
                  <input type="date" value="<?php echo date('Y-m-d'); ?>"
                    min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>" max="<?php echo date('Y-m-d'); ?>"
                    id="departure-date" name="departure-date[]" required />
                </div>

                

                <div class="form-group">
                  <label for="departure-time">Time of Departure:</label>
                  <input type="time" id="departure-time" name="departure-time[]" required />
                </div>
                <div class="form-group">
                  <label for="departure-time">Location of Arrival:</label>
                  <input type="text" id="arrival-location" name="arrival-location[]" required />
                </div>

                <div class="form-group">
                  <label for="arrival-time">Arrival Date:</label>
                  <input type="date" value="<?php echo date('Y-m-d'); ?>"
                    min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>" max="<?php echo date('Y-m-d'); ?>"
                    id="arrival-date" name="arrival-date[]" required />
                </div>

                <div class="form-group">
                  <label for="arrival-time">Time of Arrival:</label>
                  <input type="time" id="arrival-time" name="arrival-time[]" required />
                </div>
                <div class="form-group"></div>
                <div class="form-group">
                  <label for="nature-of-duties">Nature of Duties:</label>
                  <textarea id="nature-of-duties" name="nature[]" rows="3" required></textarea>
                </div>
                <div class="form-group">
                  <label for="category0">Category:</label>
                  <select id="category0" name="category[]" class="category">
                    <option value="default">Please Select a category</option>
                    <option value="business">Business</option>
                    <option value="non-business">Non-business</option>
                  </select>
                </div>
                <div class="form-group claims-business" id="claims-business0" style="display: none;">
                  <label for="">Particulars of Claims:</label>
                  <select id="particulars-of-claims0" name="particulars-of-claims[]" class="particulars-of-claims">
                    <option value="travelling-ehailing">Travelling (E-Hailing)</option>
                    <option value="mileage">Travelling (Mileage)</option>
                    <option value="travelling-carental">Travelling (Car Rental)</option>
                    <option value="petrol">Petrol</option>
                    <option value="toll">Toll</option>
                    <option value="parking">Parking</option>
                    <option value="transport">Transport - Air Fare</option>
                    <option value="subsistence">Subsistence</option>
                    <option value="accomodation">Accomodation</option>
                    <option value="lodging">Lodging</option>
                    <option value="stationary">Stationary</option>
                    <option value="printing">Printing</option>
                    <option value="staffamenities">Staff Amenities</option>
                    <option value="tender">Tender Purchase Fee</option>
                    <option value="process">Processing Fee</option>
                    <option value="computer">Computer Services</option>
                    <option value="postage">Postage</option>
                    <option value="courier">Courier</option>
                    <option value="entertainment">Entertainment</option>
                    <option value="gift">Gift</option>
                    <option value="telephone">Telephone</option>
                    <option value="others1">Others</option>
                  </select>
                </div>
                <div class="form-group claims-non-business" id="claims-non-business" style="display: none;">
                  <label for="">Particulars of Claims:</label>
                  <select id="particulars-of-claims1" name="particulars-of-claims[]" class="particulars-of-claims">
                    <!-- <option value="default">Please Select</option> -->
                    <option value="travelling-ehailing">Travelling (E-Hailing)</option>
                    <option value="travelling-owncar">Travelling (Mileage)</option>
                    <option value="travelling-carental">Travelling (Car Rental)</option>
                    <option value="transport">Transport - Air Fare</option>
                    <option value="subsistence">Subsistence</option>
                    <option value="accomodation">Accomodation</option>
                    <option value="lodging">Lodging</option>
                    <option value="others2">Others</option>
                  </select>
                </div>
                <div class="form-group" style="display: none;">
                  <input type="text" id="others" class="others" name="particulars-of-claimsOthers[]"
                    placeholder="Please enter others" />
                </div>
                <div class="form-group input-distance-travelled" style="display: none;">
                  <label for="distance-travelled">Distance Travelled (KM):</label>
                  <input type="number" class="distance-travelled" name="distance[]" onkeyup="calculateAmount(this)" />
                </div>
                <div class="form-group">
                  <label for="amount">Amount (RM): </label>
                  <input type="number" class="amount" id="amount" name="amount[]" step="0.01" required />
                  <small style="float: right; font-size: smaller; margin-top:2px;">Please Insert Malaysian Conversion Rate
                    Amount</small>
                </div><br>
                <label for="supporting-attachment">Include a supporting attachment:</label>
                <input type="file" id="attachment" accept=".pdf, .zip, .jpg, .png" name="attachment[]">
                <br>
                <small style="float: left; font-size: smaller; margin-top:2px;">*Accept .pdf, .zip, .jpg,
                  .png</small><br>
                <small style="float: left; font-size: smaller; margin-top:2px;">*Compile multiple files in
                  ZIP</small><br>
                <small style="float: left; font-size: smaller; margin-top:2px;">*Mandatory to attach
                  Itinerary/Agenda/Invitation letter, etc.</small><br>
                <small style="float: left; font-size: smaller; margin-top:2px;">*ORIGINAL RECEIPT must
                  be submit to Billing Department before closing deadline every 7th of month.</small><br>


                <hr />
              </div>
            </div>
          </div>
        </div>
        <div id="form-buttons-container">
          <div>
            <a style="color:black;"
              href="https://view.officeapps.live.com/op/view.aspx?src=https%3A%2F%2Fintranet.minconsult.com%2Fdownload%2FHR%2FMINCO_RATE_FOR_ALLOWANCE_AUGUST2021.xls&wdOrigin=BROWSELINK"
              target="_blank">
          </div>
          <div>

            <a><label for="redirectCheckbox"></label>
              <label><input type="checkbox" id="redirectCheckbox" name="verification" required>&nbsp;
                I hereby DECLARE that I have read and understood the contents of the Minco Rate Allowance as
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; stated in this link </label>
          </div></a>

          <div class="form-buttons">

          <button type="button" class="add-travel-btn">+</button>
          <button type="button" class="remove-travel-btn">-</button>
          <button type="submit" name="submit">Submit</button>
          <div class="total-container">
            Total: RM <input type="text" id="totals" name="totals" value="0" style="width: 100px;">
          </div>
        </div>

        </div>
        

      </form>
    </div>
  </body>

  </html>
  <?php
    }


    //CEO & CSO Segment
    if ($act == "ceoApproval" || $act == "csoApproval") {
      if ($ceo_logged_in) {
        print "<h4>Directors Form</h4>";
      }
      if ($cso_logged_in) {
        print "<h4>Directors Form</h4>";
      }
      ?>
  <form id="travelling-form" name="borang" action="" method="POST" enctype="multipart/form-data">
    <div class="form-row">
      <!-- <div class="form-group"> -->

      <?php
      //In order to auto generate generic fields like name, staff no, division and designation inside a form, 
      //we will use $ses_staffno. $ses_staffno is a session variable which stores the staff no of the user
      //when they login into the intranet. This session variable will be used to query from the database
      //to collect information from the user that logged in.
    
      //Here we are querying table hr_employee where the status is 1. Status = 1 meaning the staff is still working
      //for the company and status = 0 means that they have stoppped working and is inactive. Then we will fetch this
      //data based on the $ses_staffno.
      $dq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE status = 1 AND staffno = '" . $ses_staffno . "'");

      //Using while loop to store every information about the user like name, staffno, designation, div_code
      while ($dr = mysqli_fetch_array($dq)) {
        $name = $dr["name"];
        $staffno = $dr["staffno"];
        $designationId = $dr["desig"];
        $designation = '';
        $divisionCode = $dr["div_code"];
        $division = '';

        $dq2 = mysqli_query($mysqli, "SELECT * FROM hr_designation WHERE desg_code = '" . $designationId . "'");
        while ($dr2 = mysqli_fetch_array($dq2)) {
          $designation = $dr2["desg_name"];
        }

        $dq3 = mysqli_query($mysqli, "SELECT * FROM hr_division WHERE div_code = '" . $divisionCode . "'");
        while ($dr3 = mysqli_fetch_array($dq3)) {
          $division = $dr3["div_name"];
        }

      }
      ?>

      <div class="form-row">
        <div class="form-group">
          <label for="reimbursable-by-client">Reimbursable By Client:</label>
          <label for="reimbursable-yes" style="display: inline-block;">
            Yes
            <input type="checkbox" id="reimbursable-yes" name="reimbursable" value="Yes" class="boxy-checkbox"
              onclick="uncheckOther(this)" />
          </label>
          <label for="reimbursable-no" style="display: inline-block;">
            No
            <input type="checkbox" id="reimbursable-no" name="reimbursable" value="No" class="boxy-checkbox"
              onclick="uncheckOther(this)" />
          </label>
        </div>

      </div>

      <div class="form-group">
        <label for="month">Month:</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" id="month" name="month" />
      </div>

      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name[]" value="<?php echo $name; ?>" readonly="readonly" />
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="staff-no">Staff No:</label>
          <input type="text" id="staff-no" value="<?php echo $staffno; ?>" name="staffno" readonly="readonly" />
        </div>
        <div class="form-group">
          <label for="vehicle-reg-no">Vehicle Reg No:</label>
          <input type="text" id="vehicle-reg-no" name="vehicle-reg-no" pattern="[A-Za-z0-9-]+" required />
        </div>
        <div class="form-group">
          <label for="division-department">Division / Department:</label>
          <input type="text" id="division-department" value="<?php echo $division; ?>" name="division-department"
            readonly="readonly" />
        </div>
        <div class="form-group">
          <label for="position">Position:</label>
          <input type="text" id="position" name="position" value="<?php echo $designation; ?>" readonly="readonly" />
        </div>
        <div class="form-group">
          <label for="class">Class:</label>
          <select id="class" name="class" required>
            <option value="car">Automobile</option>
            <option value="motorcycle">Motorcycle</option>
          </select>
        </div>
        <div class="form-group">
          <label for="cc">C.C (Vehicle CC):</label>
          <input type="text" id="cc" name="cc" pattern="[0-9]*\.?[0-9]+" required />
        </div>
        <div class="form-group">
          <label for="project">Project & Job Number:</label>
          <input type="text" id="project" placeholder="Please input project code" oninput="validateInput()" name="project"
            rows="3" />
        </div>
      </div>
      <br>
      <div class="full-blue"></div>

      <div class="form-group">
        <div class="cloned-container" id="cloned-container">
          <div class="cloned" id="cloned">
            <div class="form-group">
              <center>
                <div class="form-number2">
                  <h2>Claim 1</h2>
                </div>
              </center>
            </div>
            <div class="form-group">
              <label for="place">Place:</label>
              <select id="place" name="place[]" class="place">
                <option value="semenanjung">Semenanjung</option>
                <option value="s/s">Sabah/Sarawak</option>
                <option value="overseas">Overseas</option>
              </select>
            </div>
            <div class="form-group country-list" style="display: none;">
              <label for="country">Country:</label>
              <select id="country" name="country[]" class="country">
                <option value="">Select Country</option>
                <?php
                // Assuming you have already established a connection to the database
                $sql = "SELECT * FROM travel_overseas";
                $result = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $overseas_id = $row['overseas_id'];
                    $country = $row['country'];
                    echo '<option value="' . $overseas_id . '">' . $country . '</option>';
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="departure-time">Location of Departure:</label>
              <input type="text" id="departure-location" name="departure-location[]" required />
            </div>

            <div class="form-group">
              <label for="departure-time">Departure Date:</label>
              <input type="date" value="<?php echo date('Y-m-d'); ?>"
                min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>" max="<?php echo date('Y-m-d'); ?>"
                id="departure-date" name="departure-date[]" required />
            </div>

            <div class="form-group">
              <label for="departure-time">Time of Departure:</label>
              <input type="time" id="departure-time" name="departure-time[]" required />
            </div>
            <div class="form-group">
              <label for="departure-time">Location of Arrival:</label>
              <input type="text" id="arrival-location" name="arrival-location[]" required />
            </div>

            <div class="form-group">
              <label for="arrival-time">Arrival Date:</label>
              <input type="date" value="<?php echo date('Y-m-d'); ?>"
                min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>" max="<?php echo date('Y-m-d'); ?>"
                id="arrival-date" name="arrival-date[]" required />
            </div>

            <div class="form-group">
              <label for="arrival-time">Time of Arrival:</label>
              <input type="time" id="arrival-time" name="arrival-time[]" required />
            </div>
            <div class="form-group"></div>
            <div class="form-group">
              <label for="nature-of-duties">Nature of Duties:</label>
              <textarea id="nature-of-duties" name="nature[]" rows="3" required></textarea>
            </div>
            <div class="form-group">
              <label for="category0">Category:</label>
              <select id="category0" name="category[]" class="category">
                <option value="default">Please Select a category</option>
                <option value="business">Business</option>
                <option value="non-business">Non-business</option>
              </select>
            </div>
            <div class="form-group claims-business" id="claims-business0" style="display: none;">
              <label for="">Particulars of Claims:</label>
              <select id="particulars-of-claims0" name="particulars-of-claims[]" class="particulars-of-claims">
                <option value="travelling-ehailing">Travelling (E-Hailing)</option>
                <!-- <option value="mileage">Travelling (Mileage)</option> -->
                <option value="travelling-carental">Travelling (Car Rental)</option>
                <option value="petrol">Petrol</option>
                <option value="toll">Toll</option>
                <option value="parking">Parking</option>
                <option value="transport">Transport - Air Fare</option>
                <option value="subsistence">Subsistence</option>
                <option value="accomodation">Accomodation</option>
                <option value="lodging">Lodging</option>
                <option value="stationary">Stationary</option>
                <option value="printing">Printing</option>
                <option value="staffamenities">Staff Amenities</option>
                <option value="tender">Tender Purchase Fee</option>
                <option value="process">Processing Fee</option>
                <option value="computer">Computer Services</option>
                <option value="postage">Postage</option>
                <option value="courier">Courier</option>
                <option value="entertainment">Entertainment</option>
                <option value="gift">Gift</option>
                <option value="telephone">Telephone</option>
                <option value="others1">Others</option>
              </select>
            </div>
            <div class="form-group claims-non-business" id="claims-non-business" style="display: none;">
              <label for="">Particulars of Claims:</label>
              <select id="particulars-of-claims1" name="particulars-of-claims[]" class="particulars-of-claims">
                <option value="travelling-ehailing">Travelling (E-Hailing)</option>
                <!-- <option value="travelling-owncar">Travelling (Mileage)</option> -->
                <option value="travelling-carental">Travelling (Car Rental)</option>
                <option value="transport">Transport - Air Fare</option>
                <option value="subsistence">Subsistence</option>
                <option value="accomodation">Accomodation</option>
                <option value="lodging">Lodging</option>
                <option value="others2">Others</option>
              </select>
            </div>
            <div class="form-group" style="display: none;">
              <input type="text" id="others" class="others" name="particulars-of-claimsOthers[]"
                placeholder="Please enter others" />
            </div>
            <!-- <div class="form-group input-distance-travelled" style="display: none;">
              <label for="distance-travelled">Distance Travelled (KM):</label>
              <input type="number" class="distance-travelled" name="distance[]" onkeyup="calculateAmount(this)" />   
            </div> -->
            <div class="form-group">
              <label for="amount">Amount (RM): </label>
              <input type="number" class="amount" id="amount" name="amount[]" step="0.01" required />
              <small style="float: right; font-size: smaller; margin-top:2px;">Please Insert Malaysian Conversion Rate
                Amount</small>
            </div><br>
            <label for="supporting-attachment">Include a supporting attachment:</label>
            <input type="file" id="attachment" accept=".pdf, .zip, .jpg, .png" name="attachment[]">
            <br>
            <small style="float: left; font-size: smaller; margin-top:2px;">*Accept .pdf, .zip, .jpg,
              .png</small><br>
            <small style="float: left; font-size: smaller; margin-top:2px;">*Compile multiple files in
              ZIP</small><br>
            <small style="float: left; font-size: smaller; margin-top:2px;">*Mandatory to attach
              Itinerary/Agenda/Invitation letter, etc.</small><br>
            <small style="float: left; font-size: smaller; margin-top:2px;">*ORIGINAL RECEIPT must
              be submit to Billing Department before closing deadline every 7th of month.</small><br>


            <hr />
          </div>
        </div>
      </div>
    </div>
    <div id="form-buttons-container">
      <div>
        <a style="color:black;"
          href="https://view.officeapps.live.com/op/view.aspx?src=https%3A%2F%2Fintranet.minconsult.com%2Fdownload%2FHR%2FMINCO_RATE_FOR_ALLOWANCE_AUGUST2021.xls&wdOrigin=BROWSELINK"
          target="_blank">
      </div>
      <div>

        <a><label for="redirectCheckbox"></label>
          <label><input type="checkbox" id="redirectCheckbox" name="verification" required>&nbsp;
            I hereby DECLARE that I have read and understood the contents of the Minco Rate Allowance as
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; stated in this link </label>
      </div></a>

    </div>
    <div class="form-buttons">

      <button type="button" class="add-travel-btn">+</button>
      <button type="button" class="remove-travel-btn">-</button>
      <button type="submit" name="submit">Submit</button>
      <div class="total-container">
        Total: RM <input type="text" id="totals" name="totals" value="0" style="width: 100px;">
      </div>
    </div>

  </form>
  </div>
  </body>

  </html>
  <?php
    }

    // <!-- To submit the travelling request, the following PHP will handle it. -->
    if (isset($_POST["submit"])) {
      //This is based on the form categories. Travelling Form equals to 1.
    
      //If the form has reimbursable, it will have two options which is Yes or No
      //This will check if the reimbursable has been chosen or not.
      $reimbursable = null;

      if (isset($_POST["reimbursable"])) {
        $reimbursable = $_POST["reimbursable"];
      }

      //Assigning all the form data after submitting into variables.
      $month = $_POST["month"];
      $staffno = $_POST["staffno"];
      $vehiclereg = $_POST["vehicle-reg-no"];
      $division = $_POST["division-department"];
      $position = $_POST["position"];
      $class = $_POST["class"];
      $cc = $_POST["cc"];
      $totals = $_POST["totals"];
      $project = $_POST["project"];



      // CEO or CSO
      if ($ceo_logged_in || $cso_logged_in) {
       
        if ($ceo_logged_in) {
          $form = 5;
        }

        if ($cso_logged_in) {
          $form = 6;
        }


        //Calling out all the columns from the travelclaims2 table 
        mysqli_query($mysqli, "INSERT INTO travelclaims2
              (
              reimbursable,
              month,
              staffno,
              vehiclereg,
              division,
              position,
              class,
              cc,
              totals,
              project_code,
              form_category
              )
            -- Inserting all those form data variables into specific columns that were called
              VALUES
              (
                '" . $reimbursable . "',
                '" . $month . "',
                '" . $staffno . "',
                '" . $vehiclereg . "',
                '" . $division . "',
                '" . $position . "',
                '" . $class . "',
                '" . $cc . "',
                '" . $totals . "',
                '" . $project . "',
                " . $form . "
                )
             ");

        //For debugging purpose if the data is not being inserted or any errors in general, 
        //Please uncomment the code to below.
    
        if (mysqli_query($mysqli, $insertQuery)) {
          echo "Data inserted successfully!";
        } else {
          // echo "Error: " . mysqli_error($mysqli);
        }

        //<--------------------------------------------------------------------------------------->
    
        //Fetching the last inserted unique id (refer travelclaims 2 above) and assigning
        //a variable to it. This will be used as foreign key if we want to make connection
        //between two tables. Here, we will make connection between travelclaims2 and also
        //traveldetails.
        $travelClaimId = mysqli_insert_id($mysqli);

        //<--------------------------------------------------------------------------------------->
        //Assigning variables to form data. This is to collect "Claim Data".
        $datedepartures = $_POST['departure-date']; //Edited
        $datearrivals = $_POST['arrival-date']; //Edited
        $places = $_POST['place'];
        $departurelocas = $_POST['departure-location'];
        $departures = $_POST['departure-time'];
        $arrivallocas = $_POST['arrival-location'];
        $arrivals = $_POST['arrival-time'];
        $natures = $_POST['nature'];
        $countries = $_POST['country'];
        $categories = $_POST['category'];
        $particularsOfClaims = $_POST['particulars-of-claims'];
        $particularsOfClaimsOthers = $_POST['particulars-of-claimsOthers'];
        $amount = $_POST['amount'];
        $distance = $_POST['distance'];

        //The below code is to upload attachment inside the upload folder.
        $targetDir = "forms/travelling/uploads/ " . $ses_staffno . "/";
        //  $targetDir2 = "forms/travelling/uploads/" . $ses_staffno;
        mkdir($targetDir, 0770);
        $attachments = array();
        $secondnameCounter = 1;

        //Using for loops to store all attachments inside an array based on the number of
        //claims that were sent by the user. Any count($insertVariable) can be used. The most
        //important thing is that it loops based on the number on claims that added by the user
        for ($i = 0; $i < count($places); $i++) {

          //This will call out the $targetDir variable that was declared earlier and attach the name
          //of the document that was submmited.
          $target_file = $targetDir . basename($_FILES["attachment"]["name"][$i]);
          //This will change the file to lowercase and PATHINFO_EXTENSION refers to the extension
          //of the file (.pdf, .png, .jpeg)
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

          if (move_uploaded_file($_FILES["attachment"]["tmp_name"][$i], $target_file)) {

            $firstname = $_POST["staffno"];
            $thirdname = date("his");
            $newname = $targetDir . $firstname . "_" . $secondnameCounter . "_" . $thirdname . ".pdf";
            $counter = 0;

            if (rename($target_file, $newname)) {
              $attachments[$i] = $newname;
            }

            $secondnameCounter++;

          }
        }
        //<--------------------------------------------------------------------------------------->
    
        // Loop through the values before insertion. Take any of the variables that falls
        // Under the category of 'claims'. This is because 'claims' can be cloned and
        // inserted multiple times if the user decides to press the 'add' button.
        // This loop will count how many times the user has added a cloned form.
        for ($i = 0; $i < count($places); $i++) {
          $datedeparture = $datedepartures[$i];
          $datearrival = $datearrivals[$i];
          $place = $places[$i];
          $departure = $departures[$i];
          $departureloca = $departurelocas[$i];
          $arrival = $arrivals[$i];
          $arrivalloca = $arrivallocas[$i];
          $nature = $natures[$i];
          $country = $countries[$i];
          $category = $categories[$i];

          $currentParticularsOfClaims = $particularsOfClaims[$i];

          if ($currentParticularsOfClaims === 'others1' || $currentParticularsOfClaims === 'others2') {
            $currentParticularsOfClaims = $particularsOfClaimsOthers[$i];
          }

          $amounts = $amount[$i];
          $distances = $distance[$i];
          $attachment = $attachments[$i];
          
          mysqli_query($mysqli, "INSERT INTO travel_details 
              (tclaims_id,
              datedeparture,
              datearrival,
              place,
              departure_location,
              timedeparture,
              arrival_location,
              timearrival,
              nature,
              category,
              particular,
              amount,
              distance,
              attachment
            ) 
              VALUES 
              (
              '" . $travelClaimId . "',
              '" . $datedeparture . "',
              '" . $datearrival . "',
              '" . $place . "',
              '" . $departureloca . "',
              '" . $departure . "',
              '" . $arrivalloca . "',
              '" . $arrival . "',
              '" . $nature . "',
              '" . $category . "',
              '" . $currentParticularsOfClaims . "',
              '" . $amounts . "',
              '" . $distances . "',
              '" . $attachment . "'
              )
              ");
        }
     

        // $hq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $hod_id");
        // $hq = mysqli_fetch_array($hq);
        // $hPriority = $hq["approval_priority"];
    
        $q = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = $form AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
        $r = mysqli_fetch_array($q);
        $id = $r["approval_priority"];
        $hPriority = $r["approval_priority"];
        $approval_level_id = $r["id"];

        $pq = mysqli_query($mysqli, "SELECT * FROM approval WHERE approval_level_id = $approval_level_id");
        $rq = mysqli_fetch_array($pq);
        $next_approver = $rq["staffno"];

        //Inserting into table approval_detail the details about hod here
        mysqli_query($mysqli, "INSERT INTO approval_detail
            (
            approval_level_id,
            approval_priority,
            t_claims_id,
            staffno,
            approval_status,
            approval_remarks,
            approval_approved_date,
            form_category
            )
            VALUES
            (
            '" . $approval_level_id . "',
            '" . $hPriority . "',
            '" . $travelClaimId . "',
            '" . $next_approver . "', 
            'pending',
            '',
            '" . date("Y-m-d") . "',
            " . $form . "
            )");

        print "INSERT INTO approval_detail
              (
              approval_level_id,
              approval_priority,
              t_claims_id,
              staffno,
              approval_status,
              approval_remarks,
              approval_approved_date,
              form_category
              )
              VALUES
              (
              '" . $hod_id . "',
              '" . $approval_level_id . "',
              '" . $travelClaimId . "',
              '" . $next_approver . "', 
              'pending',
              '',
              '" . date("Y-m-d") . "',
              " . $form . "
              )";

        // mail
        //check sent to who first time
        //Declare the form category here 
        $form = 1;

        $q = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = $form AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
        $r = mysqli_fetch_array($q);
        $id = $r["approval_priority"];

        $sql8 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $travelClaimId AND approval_priority = $id");
        $dql8 = mysqli_fetch_array($sql8);
        $staffno = $dql8['staffno'];

        //<--------------------------------------------------------------------------------------->
    

        //Send mail firstime. All this codes below is to send email to the approver.
        $aq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno='" . $staffno . "'");
        $ar = mysqli_fetch_array($aq);
        if ($ar["imail"] != "") {
          $mto = $ar["imail"];
          $subject = "Travelling Form - Notification" . $app_id;

          $message = "Dear " . recap($ar["name"]) . ",<br /><br />HOD - You Have New Travelling Approval Pending

                      Please Click <a href='https://intranet.minconsult.com/sources/E-FORM/?page=travelForm'>Here</a> To View And Verify
                      <br /><br />
                      Regards
                      <br />
                      E-Form System Services
                      <br />";

          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: No-Reply <no-reply@minconsult.com>' . "\r\n" .
            'Reply-To: no-reply@minconsult.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
          if (mail($mto, $subject, $message, $headers)) {
            // print "Mailed Sent ".$mto;
          } else {
            // print "Mail Sent Failed";
          }
        }

        $goto = "?page=travelsummary";
        $msg = "";
        $func->info($msg, $goto);

        //<--------------------------------------------------------------------------------------->
    


      } else {

        $form = 1;

        $pmanager = $_POST["projectManager"];
        $hod = $_POST["HodApprover"];

        //Calling out all the columns from the travelclaims2 table 
        mysqli_query($mysqli, "INSERT INTO travelclaims2
              (
              reimbursable,
              month,
              staffno,
              vehiclereg,
              division,
              position,
              class,
              cc,
              totals,
              project_code,
              form_category
              )
          -- Inserting all those form data variables into specific columns that were called
              VALUES
              (
                '" . $reimbursable . "',
                '" . $month . "',
                '" . $staffno . "',
                '" . $vehiclereg . "',
                '" . $division . "',
                '" . $position . "',
                '" . $class . "',
                '" . $cc . "',
                '" . $totals . "',
                '" . $project . "',
                " . $form . "
                )
           ");

        //For debugging purpose if the data is not being inserted or any errors in general, 
        //Please uncomment the code to below.
    
        if (mysqli_query($mysqli, $insertQuery)) {
          echo "Data inserted successfully!";
        } else {
          // echo "Error: " . mysqli_error($mysqli);
        }

        //<--------------------------------------------------------------------------------------->
    
        //Fetching the last inserted unique id (refer travelclaims 2 above) and assigning
        //a variable to it. This will be used as foreign key if we want to make connection
        //between two tables. Here, we will make connection between travelclaims2 and also
        //traveldetails.
        $travelClaimId = mysqli_insert_id($mysqli);

        //Assigning variables to form data. This is to collect "Claim Data".
        $datedepartures = $_POST['departure-date']; //Edited
        $datearrivals = $_POST['arrival-date']; //Edited
        $places = $_POST['place'];
        $departurelocas = $_POST['departure-location'];
        $departures = $_POST['departure-time'];
        $arrivallocas = $_POST['arrival-location'];
        $arrivals = $_POST['arrival-time'];
        $natures = $_POST['nature'];
        $countries = $_POST['country'];
        $categories = $_POST['category'];
        $particularsOfClaims = $_POST['particulars-of-claims'];
        $particularsOfClaimsOthers = $_POST['particulars-of-claimsOthers'];
        $amount = $_POST['amount'];
        $distance = $_POST['distance'];

        //The below code is to upload attachment inside the upload folder.
        $targetDir = "forms/travelling/uploads/ " . $ses_staffno . "/";
        //  $targetDir2 = "forms/travelling/uploads/" . $ses_staffno;
        mkdir($targetDir, 0770);
        $attachments = array();
        $secondnameCounter = 1;

        //Using for loops to store all attachments inside an array based on the number of
        //claims that were sent by the user. Any count($insertVariable) can be used. The most
        //important thing is that it loops based on the number on claims that added by the user
        for ($i = 0; $i < count($places); $i++) {

          //This will call out the $targetDir variable that was declared earlier and attach the name
          //of the document that was submmited.
          $target_file = $targetDir . basename($_FILES["attachment"]["name"][$i]);
          //This will change the file to lowercase and PATHINFO_EXTENSION refers to the extension
          //of the file (.pdf, .png, .jpeg)
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

          if (move_uploaded_file($_FILES["attachment"]["tmp_name"][$i], $target_file)) {

            $firstname = $_POST["staffno"];
            $thirdname = date("his");
            $newname = $targetDir . $firstname . "_" . $secondnameCounter . "_" . $thirdname . ".pdf";
            $counter = 0;

            if (rename($target_file, $newname)) {
              $attachments[$i] = $newname;
            }

            $secondnameCounter++;

          }
        }
        //<--------------------------------------------------------------------------------------->
    
        // Loop through the values before insertion. Take any of the variables that falls
        // Under the category of 'claims'. This is because 'claims' can be cloned and
        // inserted multiple times if the user decides to press the 'add' button.
        // This loop will count how many times the user has added a cloned form.
        for ($i = 0; $i < count($places); $i++) {
          $datedeparture = $datedepartures[$i];
          $datearrival = $datearrivals[$i];
          $place = $places[$i];
          $departure = $departures[$i];
          $departureloca = $departurelocas[$i];
          $arrival = $arrivals[$i];
          $arrivalloca = $arrivallocas[$i];
          $nature = $natures[$i];
          $country = $countries[$i];
          $category = $categories[$i];

          $currentParticularsOfClaims = $particularsOfClaims[$i];

          if ($currentParticularsOfClaims === 'others1' || $currentParticularsOfClaims === 'others2') {
            $currentParticularsOfClaims = $particularsOfClaimsOthers[$i];
          }

          $amounts = $amount[$i];
          $distances = $distance[$i];
          $attachment = $attachments[$i];

          mysqli_query($mysqli, "INSERT INTO travel_details 
              (tclaims_id,
              datedeparture,
              datearrival,
              place,
              departure_location,
              timedeparture,
              arrival_location,
              timearrival,
              nature,
              category,
              particular,
              amount,
              distance,
              attachment
            ) 
              VALUES 
              (
              '" . $travelClaimId . "',
              '" . $datedeparture . "',
              '" . $datearrival . "',
              '" . $place . "',
              '" . $departureloca . "',
              '" . $departure . "',
              '" . $arrivalloca . "',
              '" . $arrival . "',
              '" . $nature . "',
              '" . $category . "',
              '" . $currentParticularsOfClaims . "',
              '" . $amounts . "',
              '" . $distances . "',
              '" . $attachment . "'
              )
              ");
        }
        //<--------------------------------------------------------------------------------------->
    
        //The id will be different for both the hod and pm here. Need to discuss with the clients
        //To gather requirements whether the form needs both approval of hod or pm. One just one
        //of them. Each approver here will have different id based on the forms, make sure to
        //check the database.
        $hod_id = 1;
        $pm_id = 2;

        $hq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $hod_id");
        $hq = mysqli_fetch_array($hq);
        $hPriority = $hq["approval_priority"];

        $pq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $pm_id");
        $rq = mysqli_fetch_array($pq);
        $pPriority = $rq["approval_priority"];


        //Inserting into table approval_detail the details about hod here
        mysqli_query($mysqli, "INSERT INTO approval_detail
            (
            approval_level_id,
            approval_priority,
            t_claims_id,
            staffno,
            approval_status,
            approval_remarks,
            approval_approved_date,
            form_category
            )
            VALUES
            (
            '" . $hod_id . "',
            '" . $hPriority . "',
            '" . $travelClaimId . "',
            '" . $hod . "', 
            'pending',
            '',
            '" . date("Y-m-d") . "',
            " . $form . "
            )");

        //<--------------------------------------------------------------------------------------->
        //Inserting into table approval_detail the details about pm here
        mysqli_query($mysqli, "INSERT INTO approval_detail
            (
            approval_level_id,
            approval_priority,
            t_claims_id,
            staffno,
            approval_status,
            approval_remarks,
            approval_approved_date,
            form_category
            )

            VALUES
            (
            '" . $pm_id . "',
            '" . $pPriority . "',
            '" . $travelClaimId . "',
            '" . $pmanager . "', 
            'pending',
            '',
            '" . date("Y-m-d") . "',
            " . $form . "
            )");

        //<--------------------------------------------------------------------------------------->
        // mail
        //check sent to who first time
        //Declare the form category here 
    
        $q = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = $form AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
        $r = mysqli_fetch_array($q);
        $id = $r["approval_priority"];

        $sql8 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $travelClaimId AND approval_priority = $id");
        $dql8 = mysqli_fetch_array($sql8);
        $staffno = $dql8['staffno'];

        //<--------------------------------------------------------------------------------------->
    

        //Send mail firstime. All this codes below is to send email to the approver.
        $aq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno='" . $staffno . "'");
        $ar = mysqli_fetch_array($aq);
        if ($ar["imail"] != "") {
          $mto = $ar["imail"];
          $subject = "Travelling Form - Notification" . $app_id;

          $message = "Dear " . recap($ar["name"]) . ",<br /><br />HOD - You Have New Travelling Approval Pending

                      Please Click <a href='https://intranet.minconsult.com/sources/E-FORM/?page=travelForm'>Here</a> To View And Verify
                      <br /><br />
                      Regards
                      <br />
                      E-Form System Services
                      <br />";

          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: No-Reply <no-reply@minconsult.com>' . "\r\n" .
            'Reply-To: no-reply@minconsult.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
          if (mail($mto, $subject, $message, $headers)) {
            // print "Mailed Sent ".$mto;
          } else {
            // print "Mail Sent Failed";
          }
        }

        $goto = "?page=travelsummary";
        $msg = "";
        $func->info($msg, $goto);

        //<--------------------------------------------------------------------------------------->
    
      }
    }

    ?>


<!-- This is JavasScript -->
<script>
  // Get a reference to the checkbox element
  const checkbox = document.getElementById("redirectCheckbox");

  // Add a click event listener to the checkbox
  checkbox.addEventListener("click", function () {
    // Check if the checkbox is checked
    if (checkbox.checked) {
      // Specify the URL you want to redirect to
      const redirectUrl = "https://view.officeapps.live.com/op/view.aspx?src=https%3A%2F%2Fintranet.minconsult.com%2Fdownload%2FHR%2FMINCO_RATE_FOR_ALLOWANCE_AUGUST2021.xls&wdOrigin=BROWSELINK"; // Change this to your desired URL

      // Open a new tab or window with the specified URL
      window.open(redirectUrl, "_blank");
    }
  });
</script>

<script>
  function updateTotalAmount() {
    const clonedContainers = document.querySelectorAll('.cloned-container .cloned');
    let totalAmount = 0;
    clonedContainers.forEach((cloned) => {
      const amount = parseFloat(cloned.querySelector('.amount').value);
      totalAmount += isNaN(amount) ? 0 : amount;
    });

    document.getElementById('totals').value = totalAmount.toFixed(2);
  }

  const fileInput = document.getElementById('attachment');

  fileInput.addEventListener('change', () => {
    const file = fileInput.files[0];
    const fileType = file.type;

    if (fileType !== 'application/pdf') {
      fileInput.setCustomValidity('Only PDF files are allowed.');
    } else {
      fileInput.setCustomValidity('');
    }
  });

  var count = 1;

  $(document).ready(function () {
    $(document).on("change", ".place", function () {
      var currentCountryList = $(this).closest('.cloned').find('.country-list');
      if ($(this).val() === "overseas") {
        currentCountryList.show();
      } else {
        currentCountryList.hide();
      }
    });

    $(document).on("change", ".category", function () {
      var currentSection = $(this).closest('.cloned');
      var categoryValue = $(this).val();
      var claimsBusiness = currentSection.find('.claims-business');
      var claimsNonBusiness = currentSection.find('.claims-non-business');

      var distanceInput = currentSection.find('.distance-travelled');
      var others = currentSection.find('.others');
      var selectedCategory = $(this).val();
      var selectedClaims = currentSection.find('.particulars-of-claims').val();

      if (selectedCategory === 'business' || selectedCategory === 'non-business') {
        distanceInput.parent().show();
      } else {
        distanceInput.parent().hide();
      }

      if (selectedClaims === 'mileage' || selectedClaims === 'travelling-owncar') {
        distanceInput.parent().show();
      }

      if (selectedClaims === 'others1' || selectedClaims === 'others2') {
        others.parents().show();
      }

      if (categoryValue === "business") {
        claimsBusiness.show();
        claimsNonBusiness.hide();

      } else if (categoryValue === "non-business") {
        claimsBusiness.hide();
        claimsNonBusiness.show();

      } else {
        claimsBusiness.hide();
        claimsNonBusiness.hide();

      }

      currentSection.find('.particulars-of-claims').val('').trigger('change');
      currentSection.find('.display-specify').hide();

      calculateAmount(distanceInput);

    });

    $(document).on("change", ".particulars-of-claims", function () {
      var currentSection = $(this).closest('.cloned');
      var selectedValue = $(this).val();
      var displaySpecify = currentSection.find('.others');
      var distanceInput = currentSection.find('.distance-travelled');


      if (selectedValue === "others1" || selectedValue === "others2") {
        displaySpecify.parent().show();
      } else {
        displaySpecify.parent().hide();
      }

      if (selectedValue === "mileage" || selectedValue === "travelling-owncar") {
        distanceInput.parent().show();
      } else {
        distanceInput.parent().hide();
      }
      calculateAmount(distanceInput);

    });

    function removeSection(element) {
      if (count > 1) {
        $(element).remove();
        count--;
        updateTotalAmount();
      }
    }

    function updateRemoveBtnStatus() {
      if (count > 1) {
        $('.remove-travel-btn').prop('disabled', false);
      } else {
        $('.remove-travel-btn').prop('disabled', true);
      }
    }

    function removeLastClonedSection() {
      if (count > 1) {
        $('#cloned-container').find('.cloned').last().remove();
        count--;
        updateTotalAmount();
        updateRemoveBtnStatus();
      }
    }

    $(".add-travel-btn").click(function () {
      var clonedSection = cloneSection();
      $('#cloned-container').append(clonedSection);
      count++;
    });

    $(".remove-travel-btn").click(function () {
      var lastClonedSection = $('#cloned-container').find('.cloned').last();
      removeSection(lastClonedSection);
    });

    $('form[name="borang"]').submit(function (e) {
      var totalForms = $('[id^="cloned"]').length;

      $('<input>').attr({
        type: 'hidden',
        name: 'count',
        value: count
      }).appendTo($(this));

      $('<input>').attr({
        type: 'hidden',
        name: 'totalForms',
        value: totalForms
      }).appendTo($(this));
    });

    $(document).on('change', '.category', function () {
      var currentSection = $(this).closest('.cloned');
      var selectedCategory = $(this).val();
      var distanceInput = currentSection.find('.distance-travelled');

      if (selectedCategory === 'business' || selectedCategory === 'non-business') {
        distanceInput.parent().show();
      } else {
        distanceInput.parent().hide();
      }

      calculateAmount(distanceInput);
    });

    $(document).on('keyup', '.distance-travelled', function () {
      calculateAmount(this);
    });

  });

  document.addEventListener("DOMContentLoaded", function () {
    const addTravelBtn = document.querySelector(".add-travel-btn");
    const removeTravelBtn = document.querySelector(".remove-travel-btn");
    const formContainer = document.querySelector("#travelling-form");
    const totalAmountDisplay = document.querySelector("#totals");

    removeTravelBtn.addEventListener("click", function () {
      if (formContainer.children.length > 2) {
        formContainer.removeChild(formContainer.lastElementChild);
      }
      updateTotalAmount();
    });

    formContainer.addEventListener("input", updateTotalAmount);


    // Modify the removeTravel function
    function removeTravel(event) {
      const button = event.target;
      const clonedContainer = button.closest('.cloned-container');
      const clonedContainers = document.querySelectorAll('.cloned-container');

      if (clonedContainers.length > 1) {
        clonedContainer.remove();
        // Recalculate the total amount after removing a cloned section
        updateTotalAmount();
      }
    }

    function updateTotalAmount() {
      const amounts = document.querySelectorAll("input[name='amount[]']");
      let totalAmount = 0;

      amounts.forEach(function (amountInput) {
        const amountValue = parseFloat(amountInput.value);
        if (!isNaN(amountValue)) {
          totalAmount += amountValue;
        }
      });

      totalAmountDisplay.textContent = totalAmount;
      totals.value = totalAmount;
    }


  });

  var places = document.querySelectorAll(".place");

  places.forEach(function (place) {
    place.addEventListener("change", function () {
      var currentCountryList = this.parentNode.nextElementSibling;
      if (this.value === "overseas") {
        currentCountryList.style.display = "block";
      } else {
        currentCountryList.style.display = "none";
      }
    });
  });

  function validateInput() {
    var input = document.getElementById('project');
    input.value = input.value.replace(/\s/g, '');
  }

  $(function () {
    $("#projectManager").autocomplete({
      source: "?page=server2"
    });

    $("#project").autocomplete({
      source: "?page=server3"
    });
  });

  function cloneSection() {
    var clonedSection = $('#cloned').clone().prop('id', 'cloned' + count);
    clonedSection.find('.form-number2').text('Claim ' + (count + 1)).addClass('claim-number');

    var placeDropdown = clonedSection.find('.place');
    placeDropdown.prop('id', 'place' + count).prop('name', 'place[]');

    var countryDropdown = clonedSection.find('.country-list');
    countryDropdown.prop('id', 'country' + count).prop('name', 'country[]').hide();

    var categoryDropdown = clonedSection.find('.category');
    categoryDropdown.prop('id', 'category' + count).prop('name', 'category[]');

    var claimsBusiness = clonedSection.find('.claims-business');
    claimsBusiness.prop('id', 'claims-business' + count);

    var claimsNonBusiness = clonedSection.find('.claims-non-business');
    claimsNonBusiness.prop('id', 'claims-non-business' + count);

    var particularsOfClaims = clonedSection.find('.particulars-of-claims');
    particularsOfClaims.prop('id', 'particulars-of-claims' + count);

    var displaySpecify = clonedSection.find('.display-specify');
    displaySpecify.prop('id', 'display-specify' + count).hide();

    clonedSection.find('.distance-travelled').val(''); // Clear the Distance Travelled field
    clonedSection.find('.amount').val('');

    return clonedSection;
  }

  function calculateAmount(input) {
    var currentSection = input.closest('.cloned');
    var distanceInput = parseFloat(currentSection.querySelector('.distance-travelled').value);
    var amountInput = currentSection.querySelector('.amount');

    const selectedClass = document.getElementById('class').value;
    const selectedCategory = currentSection.querySelector('.category').value;

    let rate = 0;
    if (selectedClass === 'car') {
      if (selectedCategory === 'business') {
        if (distanceInput <= 500) {
          rate = distanceInput * 0.85;
        } else {
          rate = 500 * 0.85 + (distanceInput - 500) * 0.75;
        }
      } else if (selectedCategory === 'non-business') {
        if (distanceInput <= 500) {
          rate = distanceInput * 0.85;
        } else {
          rate = 500 * 0.85 + ((distanceInput - 500) * 0.75);
        }
      }
    } else if (selectedClass === 'motorcycle') {
      if (selectedCategory === 'business') {
        if (distanceInput <= 500) {
          rate = distanceInput * 0.55;
        } else {
          rate = 500 * 0.55 + (distanceInput - 500) * 0.45;
        }
      } else if (selectedCategory === 'non-business') {
        if (distanceInput <= 500) {
          rate = distanceInput * 0.55;
        } else {
          rate = 500 * 0.55 + (distanceInput - 500) * 0.45;
        }
      }
    }
  
  


    amountInput.value = rate.toFixed(2);

    // Calculate and update the total amount
    const clonedContainers = document.querySelectorAll('.cloned-container .cloned');
    let totalAmount = 0;
    clonedContainers.forEach((cloned) => {
      const amount = parseFloat(cloned.querySelector('.amount').value);
      totalAmount += isNaN(amount) ? 0 : amount;
    });

    const totalAmountInput = document.getElementById('totals');
    totalAmountInput.value = totalAmount.toFixed(2);
  }

</script>
<script>
  // Get the input elements
  var monthInput = document.getElementById('month');
  var dateInput = document.getElementById('datedeparture');

  // Listen for the 'input' event on the 'month' field
  monthInput.addEventListener('input', function () {
    // Get the value from the 'month' field
    var selectedMonth = new Date(monthInput.value);

    // Calculate the minimum allowed date for 'date' field (2 months before the 'month' field)
    var minAllowedDate = new Date(selectedMonth);
    minAllowedDate.setDate(1); // Set the date to the 1st of the month
    minAllowedDate.setMonth(selectedMonth.getMonth() - 2); // Subtract 2 months

    // Set the 'min' and 'max' attributes for the 'date' field
    dateInput.min = minAllowedDate.toISOString().slice(0, 10);
    dateInput.max = selectedMonth.toISOString().slice(0, 10);

    // If the selected date in 'date' field is beyond the allowed range, reset it to the minimum allowed date
    if (new Date(dateInput.value) < minAllowedDate || new Date(dateInput.value) > selectedMonth) {
      dateInput.value = minAllowedDate.toISOString().slice(0, 10);
    }
  });
</script>
<script>
  // Get references to the departure and arrival date input elements
  const departureDateInput = document.getElementById("departure-date");
  const arrivalDateInput = document.getElementById("arrival-date");

  // Add an event listener to the departure date input
  departureDateInput.addEventListener("input", function () {
    // Set the minimum value of the arrival date input to the selected departure date
    arrivalDateInput.min = departureDateInput.value;
  });
</script>