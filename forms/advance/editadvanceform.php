<style>
  body {

    background: url("images/bg.jpg") no-repeat center bottom/cover;
  }

  .reason {
    height: 200px;
    border-style: solid;
    border-color: #3a7bd5;
    border-radius: 20px;
    padding-top: 10px;
  }

  .text {
    padding-left: 10px;

  }
</style>
<?php

if (isset($_POST["submit"])) {
  $advanceClaimId = mysqli_insert_id($mysqli);


  $auq = mysqli_query($mysqli, "SELECT * FROM advance_details WHERE aclaims_id=" . $_GET["id"]);
  $aur = mysqli_fetch_array($auq);

  $attachment = $aur["attachment"];
  

  if ($_FILES["attachment"]["name"]) {
    $targetDir = "forms/advance/uploads/ ".$ses_staffno."/";
    mkdir($targetDir, 0770);
    $target_file = $targetDir . basename($_FILES["attachment"]["name"]);
    $uploadOK = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
      $attachment = $target_file; // Update attachment if new file is uploaded
    }
  }

  $reimbursable = ($_POST["reimbursable"] == 1) ? "Yes" : "No";

  $sql = "UPDATE advance_details SET advance_required = '" . $_POST["advancerequired"] . "', when_required = '" . $_POST["advanceDate"] . "', project_code = '" . $_POST["project"] . "', nature = '" . $_POST["nature"] . "', purpose = '" . $_POST["purpose"] . "', previous_advances = '" . $_POST["previousAdvance"] . "', reimbursable = '" . $reimbursable . "', attachment = '" . $attachment . "' WHERE aclaims_id = '" . $_GET['id'] . "'";

  if (mysqli_query($mysqli, $sql)) {
    $goto = "?page=advancesummary";
    $msg = "";
    $func->info($msg, $goto);
  } else {
    if (mysqli_errno($mysqli)) {
      die("Database query failed: " . mysqli_error($mysqli));
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
      <a class="active" href="?page=advance">Advance Form</a>
      <ul>

        <li>
          <a href="?page=advancesummary">Requested Advance</a>
        </li>


      </ul>
    </div>
    <a href="?page=advancesummary" class="logout-link" style="background-color:#555; color:white;">
      <img src="images/logout.png" alt="Exam"
        style="display:inline-block; vertical-align:middle; width:30px; height:30px;">
      Go Back</a>
  </div>

  <div class="form-container">
    <h2>MINCONSULT SDN BHD</h2>
    <h3><strong>
        <center>Application for Advance</center>
      </strong></h3>
    <form id="advance-form" action="" method="POST" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group">
          <?php
          $q = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE advance_id=" . $_GET["id"]);
          $r = mysqli_fetch_array($q);

          $auq = mysqli_query($mysqli, "SELECT * FROM advance_details WHERE aclaims_id=" . $_GET["id"]);
          $aur = mysqli_fetch_array($auq);

          $sq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno = '" . $ses_staffno . "'");
          $sr = mysqli_fetch_array($sq);
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
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?php
          $dq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE status = 1 AND staffno = '" . $r['staffno'] . "'");
          while ($dr = mysqli_fetch_array($dq)) {
            $name = $dr["name"];
          }
          echo $name;
          ?>" readonly="readonly">
          <div>
          </div>
        </div>
        <div class="form-group">
          <label for="staff">Staff No:</label>
          <input type="text" id="staff" name="staff" value="<?php echo $r['staffno']; ?>" readonly="readonly">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="designation">Designation:</label>
          <input type="text" id="designation" name="designation" value="<?php echo $r['designation']; ?>"
            readonly="readonly">
          <div>
          </div>
        </div>
        <div class="form-group">
          <label for="appointment">Date of Appointment:</label>
          <input type="date" id="appointment" name="appointment" value="<?php echo $r['date_appointment']; ?>" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="department">Department:</label>
          <input type="text" id="department" name="department" value="<?php echo $r['department']; ?>"
            readonly="readonly">
          <div>
          </div>
        </div>
      </div>
      <br>
      <div class="full-blue"></div>
      <br>
      <div class="form-row">
        <div class="form-group">
          <label for="advancerequired">Advance Required:</label>
          <input type="number" id="advancerequired" name="advancerequired"
            value="<?php echo $aur['advance_required']; ?>" required>
          <div>
          </div>
        </div>
        <div class="form-group">
          <label for="advanceDate">When Required:</label>
          <input type="date" id="advanceDate" name="advanceDate" value="<?php echo $aur['when_required']; ?>" required>
        </div>
      </div>
      <!-- <div class="form-group">
        <label for="place">Project Code:</label>
        <input type = "text" id="project" name="project" value="<?php echo $aur['project_code']; ?>" >
      </div> -->


      <div class="form-group">
        <label for="place">Nature of Works:</label>
        <textarea id="nature" name="nature" rows="3" required><?php echo $aur['nature']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="place">Purpose of Advance:</label>
        <textarea id="purpose" name="purpose" rows="3" required><?php echo $aur['purpose']; ?></textarea>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="previousAdvance">Previous Advances In Hand (RM):</label>
          <input type="number" id="previousAdvance" name="previousAdvance"
            value="<?php echo $aur['previous_advances']; ?>" required>
          <div>
          </div>
        </div>
        <div class="form-group">
          <label for="reimbursable">Reimbursable or not:</label>
          <select id="reimbursable" name="reimbursable" required>
            <option value="0">Please select</option>
            <option value="1" <?php if ($aur['reimbursable'] == "Yes")
              echo 'selected'; ?>>Yes</option>
            <option value="2" <?php if ($aur['reimbursable'] == "No")
              echo 'selected'; ?>>No</option>
          </select>
        </div>
        <div class="form-group">
          <!-- <label for="HodApprover">HOD Approver:</label>
        <select id ="HodApprover" name = "HodApprover" >
            <option value="">Please select</option>
            <?php
            $sql = "SELECT * FROM `hr_employee` WHERE `status` = 1 AND `intra_level` = 2 ORDER BY `div_code` DESC";
            $result = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_array($result)) {
              $HOD_Name = $row["name"];
              $HOD_staffno = $row["staffno"];
              $selected = ($ur['staffno'] === $HOD_staffno) ? 'selected' : '';
              echo "<option value='" . $HOD_staffno . "' " . $selected . ">" . '(' . "" . $HOD_staffno . "" . ')' . "  " . $HOD_Name . " </option>";
            }

            ?> 
        </select> -->
          <div>
          </div>
          <br>
          <div class="form-group">
            <label>
              <input type="checkbox" name="verification" required>
              I hereby certify that all information above is correct
            </label>
          </div>
          <br>
          <div class="form-group">
            <?php if ($aur["attachment"]) { ?>
              <span><a href="https://intranet.minconsult.com/sources/E-FORM/<?php echo $aur["attachment"]; ?>"
                  style="color: white; background-color: green; border-radius: 5px; padding: 10px;"
                  target="_blank">Previous Attachment</a></span>
              <?php
              // echo "<span><a href= '?page=editTravelling&tclaims_id=".$tclaims_id."&traveldetails_id=".$traveldetails_id."&del_traveldetails_id=".$traveldetails_id."' style=  'text-decoration: none; color: white; background-color: #990F02; border-radius: 5px; padding: 10px;'>Delete Attachment</a></span>";
              print "<span><a href='javascript:void(0);' style=  'text-decoration: none; color: white; background-color: #990F02; border-radius: 5px; padding: 10px;' class='link-dark' onclick='confirmDelete(". $aur["aclaims_id"] .", ".$aur["ad_id"].", ".$aur["ad_id"].");'>Delete Attachment</a></span>";

              ?>
            <?php } ?>
            <div style="margin-right: 400px;">
              <span>
                <?php
                if (isset($_GET["del_advancedetails"]) && isset($_GET["id"]))  {
                  
                  $advancedetails_id = $_GET['del_advancedetails'];
                  $aclaims_id = $_GET['id'];

                  $auq = mysqli_query($mysqli,"SELECT * FROM advance_details WHERE aclaims_id=".$aclaims_id." AND ad_id=".$advancedetails_id);                  
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

                  $sql = "UPDATE advance_details SET attachment = '' WHERE aclaims_id = '" . $_GET['id'] . "' AND ad_id = '" . $_GET['del_advancedetails'] . "'";

                  mysqli_query($mysqli, $sql);

                  $goto = "?page=editadvanceform&id=".$aclaims_id."&ad_id=".$advancedetails_id."";
                  $msg = "";
                  $func->info($msg, $goto);
                }
                ?>
              </span>
              <br>
              <label for="attachment">New attachment (If needed):</label>
              <input type="file" id="attachment" accept=".pdf" name="attachment">
              <small>Only PDF files are allowed.</small>
            </div>
            <hr>
            <div class="form-buttons">
              <button type="submit" name="submit" id="submit">Submit</button>
            </div><br>


          </div>


        </div>
    </form>
  </div>
  <script src="script.js"></script>
</body>

</html>
<script>
  $(function () {
    $("#project").autocomplete({
      source: "?page=server3advance"
    });
  })

  function confirmDelete(id, advancedetails ,del_advancedetails) {
    var confirmDelete = confirm("Are you sure you want to delete this item?");
    if (confirmDelete) {
        // If the user confirms, redirect to the delete page or trigger the delete action
        window.location.href = "?page=editadvanceform&id=" + id + "&advancedetails_id=" + advancedetails + "&del_advancedetails=" + del_advancedetails;
    }
    // If the user cancels, do nothing
}
</script>