<!-- This is CSS is used for the background image of the E-forms -->
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

<!--This is what happens when the user presses the submit button in the form-->
<?php
if (isset($_POST["submit"])) {
      
  $form = 2;  
  //All the datas from the form will be fetched here and stored inside these variables
  $name = $_POST["name"];
  $position = $_POST["position"];
  $staffno = $_POST["staff"];
  $department = $_POST["department"];
  $total = $_POST['totals'];
  $hod = $_POST["HodApprover"];
  
  //Inserting into the table entertainmentclaim by fetching all the post data from the form
  $insertQuery =  "INSERT INTO entertainmentclaim
                       (
                       name,
                       position,
                       staffno,
                       division,
                       total,
                       form_category
                       )
   
                       VALUES
                       (
                         '" . $name . "',
                         '" . $position . "',
                         '" . $staffno . "',
                         '" . $department . "',
                         '" . $total . "',
                         '" . $form . "'
                        )";
     


  if (mysqli_query($mysqli, $insertQuery)) {
    echo "";
  } else {
    echo "Error: " . mysqli_error($mysqli);
  }

  //mysqli_insert_id will take the latest id from the table entertainmentclaim to be inserted 
  //inside entertainment_details with foreign key property
  $entertainmentClaimId = mysqli_insert_id($mysqli);

  //Fetching other sets of data from the form and storing them inside their respective variables
  $dates = $_POST['date'];
  $bills = $_POST['bill'];
  $companies = $_POST['company'];
  $persons = $_POST['person'];
  $designations = $_POST['designation'];
  $projects = $_POST['project'];
  $amounts = $_POST['amount'];
  $remarks = $_POST['remarks'];


  //Uploading the attachment inside the uploads folder
  $targetDir = "forms/entertainment/uploads/ " . $ses_staffno . "/";
  mkdir($targetDir, 0770);
  $attachments = array();
  $secondnameCounter = 1;

  //Looping several times to upload the attachments inside the folder.
  //This is based on the number of claims the user has submitted.
  for ($i = 0; $i < count($companies); $i++) {
    $target_file = $targetDir . basename($_FILES["attachment"]["name"][$i]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["attachment"]["tmp_name"][$i], $target_file)) {

      $firstname = $_POST["staff"];
      $thirdname = date("his");
      $newname = $targetDir . $firstname . "_" . $secondnameCounter . "_" . $thirdname . ".pdf";
      $counter = 0;

      if (rename($target_file, $newname)) {
        $attachments[$i] = $newname;
      }

      $secondnameCounter++;

    }
  }

  //Inserting inside the table entertainment_details multiple times with
  //the same different foreign key that connects with the table entertainmentclaim
  //but with the same primary key
  for ($i = 0; $i < count($companies); $i++) {
    $date = $dates[$i];
    $bill = $bills[$i];
    $company = $companies[$i];
    $person = $persons[$i];
    $designation = $designations[$i];
    $project = $projects[$i];
    $amount = $amounts[$i];
    $remark = $remarks[$i];
    $attachment = $attachments[$i];

    mysqli_query($mysqli, "INSERT INTO entertainment_details 
                   (eclaims_id,
                   date,
                   bill,
                   company,
                   person,
                   designation,
                   project,
                   amount,
                   remarks,
                   attachment
                 ) 
                   VALUES 
                   (
                     '" . $entertainmentClaimId . "',
                   '" . $date . "',
                   '" . $bill . "',
                   '" . $company . "',
                   '" . $person . "',
                   '" . $designation . "',
                   '" . $project . "',
                   '" . $amount . "',
                   '" . $remark . "',
                   '" . $attachment . "'
                   )
                   ");

    if (mysqli_errno($mysqli)) {
      die("Database query failed: " . mysqli_error($mysqli));
    }

  }

  $hod_id = 10;
  
  $hq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $hod_id");
  $hq = mysqli_fetch_array($hq);
  $hPriority = $hq["approval_priority"];
  

  $insertQueryApprovalDetail = "INSERT INTO approval_detail
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
          '" . $entertainmentClaimId . "',
          '" . $hod . "', 
          'pending',
          '',
          '" . date("Y-m-d") . "',
          " . $form . "
        )";

  if (mysqli_query($mysqli, $insertQueryApprovalDetail)) {
    echo "";
  } else {
    echo "Error: " . mysqli_error($mysqli);
  }

  // mail
  //check sent to who first time

  $q = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = $form AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
  $r = mysqli_fetch_array($q);
  $id = $r["approval_priority"];

  $sql8 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $entertainmentClaimId AND approval_priority = $id");
  $dql8 = mysqli_fetch_array($sql8);
  $staffno = $dql8['staffno'];

  //send mail firstime


  //Fetching the $hod variable to query and sent out email to the respestive hod that was chosen
  $aq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno='" . $hod . "'");
  $ar = mysqli_fetch_array($aq);
  if ($ar["imail"] != "") {
    $mto = $ar["imail"];
    $subject = "Entertainment Form - Notification";

    $message = "Dear " . recap($ar["name"]) . ",<br /><br />HOD - You Have New Entertainment Approval Pending

       Please Click <a href='https://intranet.minconsult.com/sources/E-FORM/?page=entertainmentForm'>Here</a> To View And Verify
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

    } else {
      print "Mail Sent Failed";
    }
  }

  $goto = "?page=entertainmentsummary";
  $msg = "";
  $func->info($msg, $goto);

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
    <br />

    <form id="travelling-form" name="borang" action="" method="POST" enctype="multipart/form-data">
      <div class="form-row">
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
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly="readonly">
            <div>
            </div>
          </div>
          <div class="form-group">
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" value="<?php echo $designation; ?>" readonly="readonly" />
          </div>
          <div class="form-group">
            <label for="staff">Staff No:</label>
            <input type="text" id="staff" name="staff" value="<?php echo $staffno; ?>" readonly="readonly">
          </div>
        </div>
        <div class="form-row" style="width: 101%;">
          <div class="form-group">
            <label for="department">Department:</label>
            <input type="text" id="department" name="department" value="<?php echo $division; ?>" readonly="readonly">
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
        <br>

        <div class="form-group">
          <div class="cloned-container" id="cloned-container">
            <div class="cloned" id="cloned">
              <center>
                <div class="form-number2">
                  <h2>Claim 1</h2>
                </div>
              </center>
              <div class="form-row">
                <div class="form-group">
                  <label for="date">Date:</label>
                  <input type="date" value="<?php echo date('Y-m-d'); ?>"
                    min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>" max="<?php echo date('Y-m-d'); ?>"
                    id="date" name="date[]" required />
                </div>
                <div class="form-group">
                  <label for="bill">Bill No:</label>
                  <input type="text" id="bill" name="bill[]" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="person">Name of Person:</label>
                  <input type="text" id="person" name="person[]" required>
                </div>
                <div class="form-group">
                  <label for="designation">Title / Designation:</label>
                  <input type="text" id="designation" name="designation[]" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="company">Company:</label>
                  <input type="text" id="company" name="company[]" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="amount">Amount (RM):</label>
                  <input type="number" class="amount" id="amount" name="amount[]" step="0.01" required />
                </div>

                <div class="form-group">
                  <label for="remarks">Remarks:</label>
                  <select id="remarks" name="remarks[]" class="remarks">
                    <option value="Existing Client">Existing Client</option>
                    <option value="Potential Client">Potential Client</option>
                    <option value="Supplier">Supplier</option>
                    <option value="General">General</option>
                  </select>
                </div>

              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="project">Project & Job Number:</label>
                  <!-- <input type="text" id="project" placeholder="Please input project code" oninput="validateInput()" name="project[]" rows="3" required /> -->
                  <input type="text" id="project" placeholder="Please input project code" name="project[]" rows="3"
                    required />
                </div>
              </div>
              <br>

              <br>
              <label for="supporting-attachment">Include a supporting attachment:</label>
              <input type="file" id="attachment" accept=".pdf" name="attachment[]">
              <small>Only PDF files are allowed.</small>
              <hr />
            </div>
          </div>
        </div>

      </div>

      <div id="form-buttons-container">
        <div class="form-group">
          <label>
            <input type="checkbox" name="verification" required>
            I hereby certify that all information above is correct
          </label>
        </div><br>
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
    clonedSection.find('.form-number2').text('Claim ' + (count + 1)).addClass('claim-number');

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