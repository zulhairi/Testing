<style>
  body {
    background: url("images/bg.jpg") no-repeat center bottom/cover;
  }

  a {
    text-decoration: none;
  }
</style>
<?php

    // check logged in as who MIT90016
    if ($ses_staffno == "6810") {
      $ceo_logged_in = true;
    } elseif ($ses_staffno == "MIT90016") {
      $cso_logged_in = true;
    }
    

if (isset($_POST["submit"])) {


  if (isset($_GET['traveldetails_id']) && isset($_GET['tclaims_id'])) {

    $traveldetails_id = $_GET['traveldetails_id'];
    $tclaims_id = $_GET['tclaims_id'];

    $auq = mysqli_query($mysqli, "SELECT * FROM travel_details WHERE tclaims_id=" . $tclaims_id . " AND traveldetails_id=" . $traveldetails_id);
    $aur = mysqli_fetch_array($auq);

  }

  $datedepartures = $_POST['departure-date']; 
  $datearrivals = $_POST['arrival-date']; 
  $places = $_POST['place'];
  $departurelocas = $_POST['departure-location'];
  $departures = $_POST['departure-time'];
  $arrivallocas = $_POST['arrival-location'];
  $arrivals = $_POST['arrival-time'];
  $natures = $_POST['nature'];
  $countries = $_POST['country'];
  $categories = $_POST['category'];
  $particularsOfClaims = $_POST['particulars-of-claims'];
  $particularsOfClaims2 = $_POST['particulars-of-claims2'];

  $amount = $_POST['amount'];
  $distance = $_POST['distance'];


  $attachment = $aur["attachment"];


  if ($_FILES["attachment"]["name"]) {
    $targetDir = "forms/travelling/uploads/ " . $ses_staffno . "/";
    mkdir($targetDir, 0770);
    $target_file = $targetDir . basename($_FILES["attachment"]["name"]);
    $uploadOK = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
      $attachment = $target_file;
    }
  }

  if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
    $attachment = $target_file;
  }

  $particularToUpdate = ($particularsOfClaims !== 'others1') ? $particularsOfClaims : $particularsOfClaims2;

  $sql = "UPDATE travel_details SET datedeparture ='" . $_POST["departure-date"] . "', datearrival ='" . $_POST["arrival-date"] . "', place = '" . $places . "', departure_location = '" . $_POST["departure-location"] . "', timedeparture = '" . $_POST["departure-time"] . "', arrival_location = '" . $_POST["arrival-location"] . "', timearrival = '" . $_POST["arrival-time"] . "', nature = '" . $_POST["nature"] . "', category = '" . $_POST["category"] . "', particular = '" . $particularToUpdate . "', amount = '" . $_POST["amount"] . "', distance = '" . $_POST['distance'] . "', attachment = '" . $attachment . "' WHERE tclaims_id = '" . $_GET['tclaims_id'] . "' AND traveldetails_id = '" . $_GET['traveldetails_id'] . "'";

  if (mysqli_query($mysqli, $sql)) {

    $sql = "SELECT SUM(amount) AS total_amount FROM travel_details WHERE tclaims_id = '" . $_GET['tclaims_id'] . "'";
    $result = mysqli_query($mysqli, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $totalAmount = $row['total_amount'];

      $sql3 = "UPDATE travelclaims2 SET totals = '$totalAmount' WHERE travel_id = '" . $_GET['tclaims_id'] . "'";
      mysqli_query($mysqli, $sql3);

      $goto = "?page=travelsummary";
      $msg = "";
      $func->info($msg, $goto);

    }

  } else {
    if (mysqli_errno($mysqli)) {
      die("Database query failed: " . mysqli_error($mysqli));
    } else {
    }
  }

}
?>
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
    <a href="?page=travelsummary" class="logout-link" style="background-color:#555; color:white;">
      <img src="images/logout.png" alt="Exam"
        style="display:inline-block; vertical-align:middle; width:30px; height:30px;">
      Back</a>
  </div>
  <div class="form-container">
    <div class="form-number-container"></div>
    <h2>MINCONSULT SDN BHD</h2>
    <!-- <h3><strong><center>TRAVELLING, SUBSISTENCE, LODGING, MILEAGE AND MISCELLANEOUS EXPENSES CLAIMS</center></strong></h3> -->
    <br />
    <div class="form-row">
      <form id="travelling-form" name="borang" action="" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <?php
          if (isset($_GET['traveldetails_id']) && isset($_GET['tclaims_id'])) {

            $traveldetails_id = $_GET['traveldetails_id'];
            $tclaims_id = $_GET['tclaims_id'];

            $q = mysqli_query($mysqli, "SELECT * FROM travelclaims2 WHERE travel_id=" . $tclaims_id);
            $r = mysqli_fetch_array($q);

            $reimbursable_value = $r['reimbursable'];

            $uq = mysqli_query($mysqli, "SELECT * FROM travel_approval WHERE tclaims_id=" . $tclaims_id);
            $ur = mysqli_fetch_array($uq);

            $auq = mysqli_query($mysqli, "SELECT * FROM travel_details WHERE tclaims_id=" . $tclaims_id . " AND traveldetails_id=" . $traveldetails_id);
            $aur = mysqli_fetch_array($auq);

            $sq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno = '" . $ses_staffno . "'");
            $sr = mysqli_fetch_array($sq);
          }
          ?>

          <?php
          $dq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE status = 1 AND staffno = '" . $ses_staffno . "'");
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
                  onclick="uncheckOther(this)" <?php echo ($reimbursable_value === 'Yes') ? 'checked' : ''; ?> />
              </label>
              <label for="reimbursable-no" style="display: inline-block;">
                No
                <input type="checkbox" id="reimbursable-no" name="reimbursable" value="No" class="boxy-checkbox"
                  onclick="uncheckOther(this)" <?php echo ($reimbursable_value === 'No') ? 'checked' : ''; ?> />
              </label>
            </div>
          </div>

          <div class="form-group">
            <label for="month">Month:</label>
            <input type="date" id="month" value="<?php echo $r['month']; ?>" name="month" required />
          </div>

          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name[]" value="<?php echo $name; ?>" disabled />
          </div>


          <div class="form-row">
            <div class="form-group">
              <label for="staff-no">Staff No:</label>
              <input type="text" id="staff-no" value="<?php echo $staffno; ?>" name="staffno" disabled />
            </div>
            <div class="form-group">
              <label for="vehicle-reg-no">Vehicle Reg No:</label>
              <input type="text" id="vehicle-reg-no" value="<?php echo $r['vehiclereg']; ?>" name="vehicle-reg-no"
                pattern="[A-Za-z0-9-]+" disabled />
            </div>
            <div class="form-group">
              <label for="division-department">Division / Department:</label>
              <input type="text" id="division-department" value="<?php echo $division; ?>" name="division-department"
                disabled />
            </div>
            <div class="form-group">
              <label for="position">Position:</label>
              <input type="text" id="position" name="position" value="<?php echo $r['position']; ?>" disabled />
            </div>
            <div class="form-group">
              <label for="class">Class:</label>
              <select id="class" name="class" required disabled>
                <option value="car" <?php if ($r['class'] === 'car')
                  echo 'selected'; ?>>Automobile</option>
                <option value="motorcycle" <?php if ($r['class'] === 'motorcycle')
                  echo 'selected'; ?>>Motorcycle</option>
              </select>
            </div>
            <div class="form-group">
              <label for="cc">C.C (Vehicle CC):</label>
              <input type="text" id="cc" value="<?php echo $r['cc']; ?>" name="cc" pattern="[0-9]+" disabled />
            </div>

            <div class="form-group">
              <label for="project">Project & Job Number:</label>
              <input type="text" id="project" disabled value="<?php echo $r['project_code']; ?>"
                placeholder="Please input project code" oninput="validateInput()" name="project" rows="3"
                readonly="readonly" />
            </div>
            <div class="form-group">
              <label for="projectManager">Project Manager:</label>
              <input type="text" id="projectManager" disabled value="<?php echo $ur['pm_staff_no']; ?>"
                placeholder="Please enter project manager" name="projectManager" rows="3" readonly="readonly" />
            </div>
            <div class="form-group">
              <label for="HodApprover">HOD Approver:</label>
              <select id="HodApprover" name="HodApprover" required disabled>
                <option value="">Please select</option>
                <?php
                $sql = "SELECT * FROM `hr_employee` WHERE `status` = 1 AND `intra_level` = 2 ORDER BY `div_code` DESC";
                $result = mysqli_query($mysqli, $sql);
                while ($row = mysqli_fetch_array($result)) {
                  $HOD_Name = $row["name"];
                  $HOD_staffno = $row["staffno"];
                  $selected = ($ur['hod_staff_no'] === $HOD_staffno) ? 'selected' : '';
                  echo "<option value='" . $HOD_staffno . "' " . $selected . ">" . '(' . "" . $HOD_staffno . "" . ')' . "  " . $HOD_Name . " </option>";
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
                <div class="form-group"></div>

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
                        <select id="place" name="place" class="place">
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
                        <input type="text" value="<?php echo $aur['departure_location']; ?>" id="departure-location"
                          name="departure-location" required />
                      </div>

                      <div class="form-group">
                        <label for="departure-date">Departure Date:</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>"
                          min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>"
                          max="<?php echo date('Y-m-d'); ?>" id="departure-date" name="departure-date" required />
                      </div>

                      <div class="form-group">
                        <label for="departure-time">Time of Departure:</label>
                        <input type="time" value="<?php echo $aur['timedeparture']; ?>" id="departure-time"
                          name="departure-time" required />
                      </div>

                      <div class="form-group">
                        <label for="departure-time">Location of Arrival:</label>
                        <input type="text" value="<?php echo $aur['arrival_location']; ?>" id="arrival-location"
                          name="arrival-location" required />
                      </div>

                      <div class="form-group">
                        <label for="arrival-time">Arrival Date:</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>"
                          min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>"
                          max="<?php echo date('Y-m-d'); ?>" id="arrival-date" name="arrival-date" required />
                      </div>


                      <div class="form-group">
                        <label for="arrival-time">Time of Arrival:</label>
                        <input type="time" value="<?php echo $aur['timearrival']; ?>" id="arrival-time"
                          name="arrival-time" required />
                      </div>

                      <div class="form-group"></div>
                      <div class="form-group">
                        <label for="nature-of-duties">Nature of Duties:</label>
                        <textarea id="nature-of-duties" name="nature" rows="3"
                          required><?php echo $aur['nature']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="category">Category:</label>
                        <select id="category" name="category" class="category">
                          <option value="default" <?php if ($aur['category'] === 'default')
                            echo 'selected'; ?>>Please
                            Select a
                            category</option>
                          <option value="business" <?php if ($aur['category'] === 'business')
                            echo 'selected'; ?>>Business
                          </option>
                          <option value="non-business" <?php if ($aur['category'] === 'non-business')
                            echo 'selected'; ?>>
                            Non-business</option>
                        </select>
                      </div>
                      <div class="form-group claims-business" id="claims-business" style="display: none;">
                        <label for="">Particulars of Claims:</label>
                        <select id="particulars-of-claims" name="particulars-of-claims" class="particulars-of-claims">
                          <!-- <option value="default">Please Select</option> -->
                          <option value="travelling-ehailing" <?php if ($aur['particular'] === 'travelling-ehailing')
                            echo 'selected'; ?>>Travelling (E-Hailing)</option>
                          <option value="mileage" <?php if ($aur['particular'] === 'mileage')
                            echo 'selected'; ?>>Travelling
                            (Mileage)</option>
                          <option value="travelling-carental" <?php if ($aur['particular'] === 'travelling-carental')
                            echo 'selected'; ?>>Travelling (Car Rental)</option>
                          <option value="petrol" <?php if ($aur['particular'] === 'petrol')
                            echo 'selected'; ?>>Petrol
                          </option>
                          <option value="toll" <?php if ($aur['particular'] === 'toll')
                            echo 'selected'; ?>>Toll</option>
                          <option value="parking" <?php if ($aur['particular'] === 'parking')
                            echo 'selected'; ?>>Parking
                          </option>
                          <option value="transport" <?php if ($aur['particular'] === 'transport')
                            echo 'selected'; ?>>Transport
                            - Air Fare</option>
                          <option value="subsistence" <?php if ($aur['particular'] === 'subsistence')
                            echo 'selected'; ?>>
                            Subsistence</option>
                          <option value="accomodation" <?php if ($aur['particular'] === 'accomodation')
                            echo 'selected'; ?>>
                            Accomodation</option>
                          <option value="lodging" <?php if ($aur['particular'] === 'lodging')
                            echo 'selected'; ?>>Lodging
                          </option>
                          <option value="stationary" <?php if ($aur['particular'] === 'stationary')
                            echo 'selected'; ?>>
                            Stationary</option>
                          <option value="printing" <?php if ($aur['particular'] === 'printing')
                            echo 'selected'; ?>>Printing
                          </option>
                          <option value="staffamenities" <?php if ($aur['particular'] === 'staffamenities')
                            echo 'selected'; ?>>
                            Staff Amenities</option>
                          <option value="tender" <?php if ($aur['particular'] === 'tender')
                            echo 'selected'; ?>>Tender
                            Purchase
                            Fee</option>
                          <option value="process" <?php if ($aur['particular'] === 'process')
                            echo 'selected'; ?>>Processing Fee
                          </option>
                          <option value="computer" <?php if ($aur['particular'] === 'computer')
                            echo 'selected'; ?>>Computer
                            Services</option>
                          <option value="postage" <?php if ($aur['particular'] === 'postage')
                            echo 'selected'; ?>>Postage
                          </option>
                          <option value="courier" <?php if ($aur['particular'] === 'courier')
                            echo 'selected'; ?>>Courier
                          </option>
                          <option value="entertainment" <?php if ($aur['particular'] === 'entertainment')
                            echo 'selected'; ?>>
                            Entertainment</option>
                          <option value="gift" <?php if ($aur['particular'] === 'gift')
                            echo 'selected'; ?>>Gift</option>
                          <option value="telephone" <?php if ($aur['particular'] === 'telephone')
                            echo 'selected'; ?>>Telephone
                          </option>
                          <option value="others1">Others</option>
                        </select>
                      </div>
                      <div class="form-group claims-non-business" id="claims-non-business" style="display: none;">
                        <label for="">Particulars of Claims:</label>
                        <select id="particulars-of-claims2" name="particulars-of-claims2"
                          class="particulars-of-claims2">
                          <!-- <option value="default">Please Select</option> -->
                          <option value="travelling-ehailing" <?php if ($aur['particular'] === 'travelling-ehailing')
                            echo 'selected'; ?>>Travelling (E-Hailing)</option>
                          <option value="travelling-owncar" <?php if ($aur['particular'] === 'travelling-owncar')
                            echo 'selected'; ?>>Travelling (Own Car)</option>
                          <option value="travelling-carental" <?php if ($aur['particular'] === 'travelling-carental')
                            echo 'selected'; ?>>Travelling (Car Rental)</option>
                          <option value="transport" <?php if ($aur['particular'] === 'transport')
                            echo 'selected'; ?>>Transport
                            - Air Fare</option>
                          <option value="subsistence" <?php if ($aur['particular'] === 'subsistence')
                            echo 'selected'; ?>>
                            Subsistence</option>
                          <option value="accomodation" <?php if ($aur['particular'] === 'accomodation')
                            echo 'selected'; ?>>
                            Accomodation</option>
                          <option value="lodging" <?php if ($aur['particular'] === 'lodging')
                            echo 'selected'; ?>>Lodging
                          </option>
                          <option value="others2" <?php if ($aur['particular'] === 'others2')
                            echo 'selected'; ?>>Others
                          </option>
                        </select>
                      </div>

                      <div class="form-group input-distance-travelled" style="display: none;">
                        <label for="distance-travelled">Distance Travelled (KM):</label>
                        <input type="number" value="<?php echo $aur['distance']; ?>" class="distance-travelled"
                          name="distance" onkeyup="calculateAmount(this)" />
                      </div>
                      <div class="form-group">
                        <label for="amount">Amount (RM):</label>
                        <input type="number" value="<?php echo $aur['amount']; ?>" class="amount" id="amount"
                          name="amount" step="0.01" required />
                      </div>
                      <br>
                      <div class="form-group">
                        <?php if ($aur["attachment"]) { ?>
                          <div style="display: flex; justify-content: space-between;">
                            <div>
                              <span><a
                                  href="https://intranet.minconsult.com/sources/E-FORM/<?php echo $aur["attachment"]; ?>"
                                  style=" text-decoration: none; color: white; background-color: green; border-radius: 5px; padding: 10px;"
                                  target="_blank">Previous Attachment</a></span>
                            </div>

                            <?php
                            // echo "<span><a href= '?page=editTravelling&tclaims_id=".$tclaims_id."&traveldetails_id=".$traveldetails_id."&del_traveldetails_id=".$traveldetails_id."' style=  'text-decoration: none; color: white; background-color: #990F02; border-radius: 5px; padding: 10px;'>Delete Attachment</a></span>";
                            print "<span><a href='javascript:void(0);' style=  'text-decoration: none; color: white; background-color: #990F02; border-radius: 5px; padding: 10px;' class='link-dark' onclick='confirmDelete(" . $tclaims_id . ", " . $traveldetails_id . " , " . $traveldetails_id . ");'>Delete Attachment</a></span>";

                            ?>

                            <div style="margin-right: 400px;">
                              <span>
                                <?php
                                if (isset($_GET['del_traveldetails_id']) && isset($_GET['tclaims_id'])) {

                                  $traveldetails_id = $_GET['del_traveldetails_id'];
                                  $tclaims_id = $_GET['tclaims_id'];

                                  $auq = mysqli_query($mysqli, "SELECT * FROM travel_details WHERE tclaims_id=" . $tclaims_id . " AND traveldetails_id=" . $traveldetails_id);
                                  $aur = mysqli_fetch_array($auq);

                                  $attachment = $aur["attachment"];

                                  if (file_exists($attachment) && is_writable($attachment)) {
                                    if (unlink($attachment)) {
                                      // echo "File deleted successfully!";
                                    } else {
                                      // echo "Error deleting the file.";
                                    }
                                  } else {
                                    // echo "File not found or not deletable.";
                                  }

                                  $sql = "UPDATE travel_details SET attachment = '' WHERE tclaims_id = '" . $_GET['tclaims_id'] . "' AND traveldetails_id = '" . $_GET['traveldetails_id'] . "'";
                                  mysqli_query($mysqli, $sql);

                                  $goto = "?page=editTravelling&tclaims_id=" . $tclaims_id . "&traveldetails_id=" . $traveldetails_id . "";
                                  $msg = "";
                                  // $func->info($msg, $goto);
                                }
                                ?>
                              </span>

                              <?php

                              ?>

                            </div>
                          </div>
                        <?php }
                        ?>
                        <br>
                        <label for="attachment">New attachment (If needed):</label>
                        <input type="file" id="attachment" accept=".pdf" name="attachment">
                        <small>Only PDF files are allowed.</small>
                      </div>
                      <hr />
                    </div>
                  </div>
                </div>
              </div>

              <div id="form-buttons-container">
                <div class="form-buttons">
                  <button type="submit" name="submit">Submit</button>
                </div>
              </div>

      </form>
    </div>
  </div>
</body>

</html>
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
    clonedSection.find('.form-number2').text('Item ' + (count + 1));

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
          rate = 500 * 0.55 + (distanceInput - 500) * 0.75;
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
  var dateInput = document.getElementById('date');

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


  function confirmDelete(id, traveldetails, del_traveldetails) {
    var confirmDelete = confirm("Are you sure you want to delete this item?");
    if (confirmDelete) {
      // If the user confirms, redirect to the delete page or trigger the delete action
      window.location.href = "?page=editTravelling&tclaims_id=" + id + "&traveldetails_id=" + traveldetails + "&del_traveldetails_id=" + del_traveldetails;
    }
    // If the user cancels, do nothing
  }
</script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> -->