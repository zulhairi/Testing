<!-- This is CSS is used for the background image of the E-forms -->
<style>
  body {
    background: url("images/bg.jpg") no-repeat center bottom/cover;
  }
</style>

<!--This is what happens when the user presses the submit button-->
<?php
if (isset($_POST["submit"])) {

  if (isset($_GET['edetails_id']) && isset($_GET['id'])) {

    $edetails_id = $_GET['edetails_id'];
    $eclaims_id = $_GET['id'];

    $auq = mysqli_query($mysqli, "SELECT * FROM entertainment_details WHERE edetails_id=" . $edetails_id . " AND eclaims_id=" . $eclaims_id);
    $aur = mysqli_fetch_array($auq);

  }

  $attachment = $aur["attachment"];

  if ($_FILES["attachment"]["name"]) {
    $targetDir = "forms/entertainment/uploads/" . $ses_staffno . "/";
    mkdir($targetDir, 0770);


    $oldFileName = $_FILES["attachment"]["name"]; // Save the old file name
    $target_file = $targetDir . basename($oldFileName); // Use the old file name
    $uploadOK = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
      $attachment = $target_file;
    }
  }


  $sql = "UPDATE entertainment_details SET date = '" . $_POST["date"] . "', bill = '" . $_POST["bill"] . "', company = '" . $_POST["company"] . "', person = '" . $_POST["person"] . "', designation = '" . $_POST["designation"] . "', project = '" . $_POST["project"] . "', amount = '" . $_POST["amount"] . "', remarks = '" . $_POST["remarks"] . "', attachment = '" . $attachment . "' WHERE edetails_id = '" . $_GET['edetails_id'] . "' AND eclaims_id = '" . $_GET['id'] . "'";

  if (mysqli_query($mysqli, $sql)) {

    $sql = "SELECT SUM(amount) AS total_amount FROM entertainment_details WHERE eclaims_id = '" . $_GET['id'] . "'";
    $result = mysqli_query($mysqli, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $totalAmount = $row['total_amount'];

      $sql3 = "UPDATE entertainmentclaim SET total = '$totalAmount' WHERE entertainment_claim = '" . $_GET['id'] . "'";
      mysqli_query($mysqli, $sql3);

      $goto = "?page=entertainmentsummary";
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
      <a class="active" href="?page=entertainmentForm">Entertainment Form</a>
      <ul>
        <li>
          <a href="?page=entertainmentsummary">Requested Entertainment</a>
        </li>
        <?php
        include "layouts/sidebarapproventertainment.php";
        ?>
      </ul>
    </div>
    <a href="?page=idx" class="logout-link" style="background-color:#555; color:white;">
      <img src="images/logout.png" alt="Exam"
        style="display:inline-block; vertical-align:middle; width:30px; height:30px;">
      Back</a>
  </div>

  <div class="form-container">
    <h2>MINCONSULT SDN BHD</h2>
    <h3>
      <strong>
        <center>Entertainment / Gift Claims - External Party </center>
      </strong>
    </h3>
    <!-- <h3><strong><center>TRAVELLING, SUBSISTENCE, LODGING, MILEAGE AND MISCELLANEOUS EXPENSES CLAIMS</center></strong></h3> -->
    <br />

    <form id="travelling-form" name="borang" action="" method="POST" enctype="multipart/form-data">
      <div class="form-row">
        <?php
        if (isset($_GET['edetails_id']) && isset($_GET['id'])) {

          $edetails_id = $_GET['edetails_id'];
          $eclaims_id = $_GET['id'];

          $q = mysqli_query($mysqli, "SELECT * FROM entertainmentclaim WHERE entertainment_claim=" . $eclaims_id);
          $r = mysqli_fetch_array($q);

          $reimbursable_value = $r['reimbursable'];

          $uq = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id=" . $eclaims_id . " AND approval_priority=1");
          $ur = mysqli_fetch_array($uq);

          $auq = mysqli_query($mysqli, "SELECT * FROM entertainment_details WHERE edetails_id=" . $edetails_id . " AND eclaims_id=" . $eclaims_id);
          $aur = mysqli_fetch_array($auq);

          $sq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno = '" . $ses_staffno . "'");
          $sr = mysqli_fetch_array($sq);
        }
        ?>
        <div class="form-row" style="width: 101%;">
          <div class="form-group">
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
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" disabled>
            <div>
            </div>
          </div>
          <div class="form-group">
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" value="<?php echo $designation; ?>" disabled />
          </div>
          <div class="form-group">
            <label for="staff">Staff No:</label>
            <input type="text" id="staff" name="staff" value="<?php echo $staffno; ?>" disabled>
          </div>
        </div>
        <div class="form-row" style="width: 101%;">
          <div class="form-group">
            <label for="department">Department:</label>
            <input type="text" id="department" name="department" value="<?php echo $division; ?>" disabled>
          </div>
          <div class="form-group">
            <label for="HodApprover">HOD Approver:</label>
            <select id="HodApprover" name="HodApprover" disabled>
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
            </select>
          </div>

        </div>

        <br>
        <div class="full-blue"></div>
        <br>

        <div class="form-group">
          <div class="cloned-container" id="cloned-container">
            <div class="cloned" id="cloned">
              <div class="form-number2"></div>
              <div class="form-row">
                <div class="form-group">
                  <label for="date">Date:</label>
                  <input type="date" value="<?php echo $aur["date"]; ?>"
                    min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>" max="<?php echo date('Y-m-d'); ?>"
                    id="date" name="date" required />
                </div>
                <div class="form-group">
                  <label for="bill">Bill No:</label>
                  <input type="text" id="bill" name="bill" value="<?php echo $aur["bill"]; ?>" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="person">Name of Person:</label>
                  <input type="text" id="person" name="person" value="<?php echo $aur["person"]; ?>" required>
                </div>
                <div class="form-group">
                  <label for="designation">Title / Designation:</label>
                  <input type="text" id="designation" name="designation" value="<?php echo $aur["designation"]; ?>"
                    required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="company">Company:</label>
                  <input type="text" id="company" name="company" value="<?php echo $aur["company"]; ?>" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="amount">Amount (RM):</label>
                  <input type="number" class="amount" id="amount" name="amount" value="<?php echo $aur["amount"]; ?>"
                    step="0.01" required />
                </div>

                <div class="form-group">
                  <label for="remarks">Remarks:</label>
                  <select id="remarks" name="remarks" class="remarks">
                    <option value="Existing Client" <?php if ($remarksFromDatabase === "Existing Client")
                      echo "selected"; ?>>Existing Client</option>
                    <option value="Potential Client" <?php if ($remarksFromDatabase === "Potential Client")
                      echo "selected"; ?>>Potential Client</option>
                    <option value="Supplier" <?php if ($remarksFromDatabase === "Supplier")
                      echo "selected"; ?>>Supplier
                    </option>
                    <option value="General" <?php if ($remarksFromDatabase === "General")
                      echo "selected"; ?>>General
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="project">Project & Job Number:</label>
                  <!-- <input type="text" id="project" placeholder="Please input project code" oninput="validateInput()" name="project[]" rows="3" required /> -->
                  <input type="text" value="<?php echo $aur["project"]; ?>" id="project"
                    placeholder="Please input project code" name="project" rows="3" required />
                </div>
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
                  <span>Previous attachment : <a
                      href="https://intranet.minconsult.com/sources/E-FORM/<?php echo $aur["attachment"]; ?>"
                      style="color: white; background-color: #3a7bd5; border-radius: 10px; padding: 5px;"
                      target="_blank">Click here</a></span><br>
                <?php } ?>
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
    </form>
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

    function removeTravel(event) {
      const button = event.target;
      const clonedContainer = button.closest('.cloned-container');
      const clonedContainers = document.querySelectorAll('.cloned-container');

      if (clonedContainers.length > 1) {
        clonedContainer.remove();
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

  $(document).ready(function () {

    $(document).on("input", "#project", function () {
      var currentSection = $(this).closest('.cloned');

      currentSection.find('#project').autocomplete({
        source: "?page=server3"
      });
    });

  });


  function cloneSection() {
    var clonedSection = $('#cloned').clone().prop('id', 'cloned' + count);
    clonedSection.find('.form-number2').text('Item ' + (count + 1));

    var project = clonedSection.find('.project');
    project.prop('id', 'project' + count);


    return clonedSection;
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
</script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> -->