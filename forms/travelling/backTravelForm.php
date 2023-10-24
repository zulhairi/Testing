<style>
    body{

  background: url("images/bg.jpg") no-repeat center bottom/cover;
  }
</style>
  <?php

  if(isset($_POST["submit"]))
  {

    // $category = $_POST["category"];
    // $particularClaims = '';

    // if ($category === "business") {
    //   $particularClaims = $_POST["particulars-of-claims(business)"];
    // } elseif ($category === "non-business") {
    //   $particularClaims = $_POST["particulars-of-claims(non-business)"];
    // }

    // // $hod_staffno = ["HodApprover"];

    // // $sql2 = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE status = 1 AND staffno = '".$hod_staffno."'");
    // // while ($row = mysqli_fetch_array($sql2))
    // // {

    // //    mysqli_query($mysqli, "INSERT INTO travel_approval
    // //  (
    // //  
    // //   hod_staff_no) 
    // //   VALUES
    // //    (
    // //    
    // //     '".$_POST["HodApprover"]."')

    // //     ");

    // // }

    // // $travelApprovalId = mysqli_insert_id($mysqli);

    $reimbursable = null; 

    if (isset($_POST["reimbursable"])) {
      $reimbursable = $_POST["reimbursable"];
    }

    $month = $_POST["month"];
    $staffno = $_POST["staffno"];
    $vehiclereg = $_POST["vehicle-reg-no"];
    $division = $_POST["division-department"];
    $position = $_POST["position"];
    $class = $_POST["class"];
    $cc = $_POST["cc"];
    $totals = $_POST["totals"];
    $project = $_POST["project"];
    $pmanager = $_POST["projectManager"];
    $hod = $_POST["HodApprover"];

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
                      project_code
                      )

                      VALUES
                      (
                        '".$reimbursable."',
                        '".$month."',
                        '".$staffno."',
                        '".$vehiclereg."',
                        '".$division."',
                        '".$position."',
                        '".$class."',
                        '".$cc."',
                        '".$totals."',
                        '".$project."'
                        )
    ");

      $targetDir = "forms/travelling/uploads/"; 
      $target_file = $targetDir . basename($_FILES ["attachment"]["name"]);
      $uploadOK = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file))
      {
        $attachment = $target_file;
      }
      
      $totalForms = $_POST["totalForms"];
      $date = $_POST["date"];
      $place = $_POST["place"];
      $departure = $_POST["departure-time"];
      $arrival = $_POST["arrival-time"];
      $nature = $_POST["nature"];

      $category = $_POST["category0"];

      $amount = $_POST["amount"];
      $distance = $_POST["distance"];
      
      for ($i=0; $i < $totalForms; $i++) {

        if ($category[$i] === "business") {
          $particularClaims  = $_POST["particulars-of-claims(business)"];
        } elseif ($category[$i] === "non-business") {
          $particularClaims = $_POST["particulars-of-claims(non-business)"];
        }

              mysqli_query($mysqli,"INSERT INTO travel_details 
                  (tclaims_id,
                  date,
                  place,
                  timedeparture,
                  timearrival,
                  nature,
                  category,
                  particular,
                  amount,
                  distance,
                  attachment
                ) 
                  VALUES 
                  (LAST_INSERT_ID(),
                  '".$date[$i]."',
                  '".$place[$i]."',
                  '".$departure[$i]."',
                  '".$arrival[$i]."',
                  '".$nature[$i]."',
                  '".$category[$i]."',
                  '".$particularClaims[$i]."',
                  '".$amount[$i]."',
                  '".$distance[$i]."',
                  '".$attachment."'
                  )
                  ");	

              }

    mysqli_query($mysqli, "INSERT INTO travel_approval
                        (
                        tclaims_id,
                        hod_staff_no,
                        hod_update,
                        hod_status,
                        hod_remarks,
                        pm_staff_no,
                        pm_update,
                        pm_status,
                        pm_remarks,
                        billing_staff_no,
                        billing_update,
                        billing_status,
                        billing_remarks,
                        billing2_staff_no,
                        billing2_update,
                        billing2_status,
                        billing2_remarks,
                        account_staff_no,
                        account_update,
                        account_status,
                        account_remarks,
                        payroll_staff_no,
                        payroll_update,
                        payroll_status,
                        payroll_remarks
                        )

                        VALUES
                        (
                          LAST_INSERT_ID(),
                          '".$hod."', 
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test',
                          '".$pmanager."',
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test',
                          '6798',
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test',
                          '6798',
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test',
                          '6798',
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test',
                          '6798',
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test'
                          )
      ");

  }

  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <a href="?page=idx" class="logout-link" style = "background-color:#555; color:white;">
    <img src="images/logout.png" alt="Exam" style="display:inline-block; vertical-align:middle; width:30px; height:30px;">  
    Back</a>
  </div>
    
    <div class="form-container">
      <div class="form-number-container"></div>
      <h2>MINCONSULT SDN BHD</h2>
      <!-- <h3><strong><center>TRAVELLING, SUBSISTENCE, LODGING, MILEAGE AND MISCELLANEOUS EXPENSES CLAIMS</center></strong></h3> -->
      <br />
      <div class="form-row">
          <form id="travelling-form" name="borang" action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                  <?php
                $dq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE status = 1 AND staffno = '".$ses_staffno."'");
                while ($dr = mysqli_fetch_array($dq)) {
                    $name = $dr["name"];
                    $staffno = $dr["staffno"];
                    $designationId = $dr["desig"];
                    $designation = '';
                    $divisionCode = $dr["div_code"];
                    $division = '';
                
                    $dq2 = mysqli_query($mysqli, "SELECT * FROM hr_designation WHERE desg_code = '".$designationId."'");
                    while ($dr2 = mysqli_fetch_array($dq2))
                    {
                    $designation = $dr2["desg_name"];
                    }
                
                    $dq3 = mysqli_query($mysqli, "SELECT * FROM hr_division WHERE div_code = '".$divisionCode."'");
                    while ($dr3 = mysqli_fetch_array($dq3))
                    {
                    $division = $dr3["div_name"];
                    }
                
                }
                ?>
                  
              </div>
              
              <div class="form-row">
              <div class="form-group">
              <label for="reimbursable-by-client">Reimbursable By Client:</label>
                      <label for="reimbursable-yes" style="display: inline-block;">
                          Yes
                          <input type="checkbox" id="reimbursable-yes" name="reimbursable" value="Yes" class="boxy-checkbox" onclick="uncheckOther(this)" />
                      </label>
                      <label for="reimbursable-no" style="display: inline-block;">
                          No
                          <input type="checkbox" id="reimbursable-no" name="reimbursable" value="No" class="boxy-checkbox" onclick="uncheckOther(this)" />
                      </label>
              </div>
              <div class="form-group">
                  <label for="month">Month:</label>
                  <input type="date" id="month" name="month" required />
              </div>
              
              <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" id="name" name="name[]" value="<?php echo $name;?>" readonly="readonly" />
              </div>
                </div>
              <div class="form-row">
                  <div class="form-group">
                      <label for="staff-no">Staff No:</label>
                      <input type="text" id="staff-no" value="<?php echo $staffno;?>" name="staffno" readonly="readonly" />
                  </div>
                  <div class="form-group">
                      <label for="vehicle-reg-no">Vehicle Reg No:</label>
                      <input type="text" id="vehicle-reg-no" name="vehicle-reg-no" pattern="[A-Za-z0-9-]+" required />
                  </div>
                  <div class="form-group">
                      <label for="division-department">Division / Department:</label>
                      <input type="text" id="division-department" value="<?php echo $division;?>" name="division-department" readonly="readonly" />
                  </div>
                  <div class="form-group">
                      <label for="position">Position:</label>
                      <input type="text" id="position" name="position" value="<?php echo $designation;?>" readonly="readonly" />
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
                      <input type="text" id="cc" name="cc" pattern="[0-9]+(\.[0-9]+)?" required />
                  </div>
                  <div class="form-group">
                      <label for="project">Project & Job Number:</label>
                      <input type="text" id="project" placeholder="Please input project code" oninput="validateInput()" name="project" rows="3" required />
                  </div>
                  <div class="form-group">
                      <label for="projectManager">Project Manager:</label>
                      <input type="text" id="projectManager" placeholder="Please enter project manager" name="projectManager" rows="3" required />
                  </div>
                  <div class="form-group">
                      <label for="HodApprover">HOD Approver:</label>
            <select id ="HodApprover" name = "HodApprover" required>

                <option value="">Please select</option>

                <?php

                $sql = "SELECT * FROM `hr_employee` WHERE `status` = 1 AND `intra_level` = 2 ORDER BY `div_code` DESC";
                $result = mysqli_query($mysqli, $sql);
                while ($row = mysqli_fetch_array($result))
                {
                  $HOD_Name = $row["name"];
                  $HOD_staffno = $row["staffno"];
                  echo "<option value='". $HOD_staffno ."'>".'('."".$HOD_staffno."".')'."  " . $HOD_Name . " </option>";
                }
                
                ?>
            </select>
                  </div>
              </div>
              <div class="full-blue"></div>
                            <br>
              
                            <div class="cloned" id="cloned">
                                <div class="form-group">
                                    <div class="form-number2"></div>
                                    <label for="date">Date:</label>
                                    <input type="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>" max="<?php echo date('Y-m-d'); ?>" id="date" name="date[]"  required />
                                    
                                </div>
                                <div class="form-group">
                                    <label for="place">Place:</label>
                                    <select id="place" name="place[]" >
                                        <option value="semenanjung">Semenanjung</option>
                                        <option value="s/s">Sabah/Sarawak</option>
                                        <option value="overseas">Overseas</option>
                                    </select>
                                </div>
                                <div class="form-group" id="country-list" style="display: none;">
                                    <label for="country">Country:</label>
                                    <select id="country" name="country[]" >
                                        <option value="">Select Country</option>
                                        <option value="nepal">Nepal</option>
                                        <option value="poland">Poland</option>
                                        <option value="zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="place">Place:</label>
                                    <select class="place-dropdown" name="place[]" >
                                        <option value="semenanjung">Semenanjung</option>
                                        <option value="s/s">Sabah/Sarawak</option>
                                        <option value="overseas">Overseas</option>
                                    </select>
                                </div>

                                <div class="form-group country-list" style="display: none;">
                                    <label for="country">Country:</label>
                                    <select class="country-dropdown" name="country[]" >
                                        <option value="">Select Country</option>
                                        <option value="nepal">Nepal</option>
                                        <option value="poland">Poland</option>
                                        <option value="zimbabwe">Zimbabwe</option>
                                    </select>
                                </div> -->

                                <div class="form-group">
                                    <label for="departure-time">Time of Departure:</label>
                                    <input type="time" id="departure-time" name="departure-time[]" required />
                                </div>
                                <!-- <div class="form-group">
                                    <label for="place-departure">Place of Departure:</label>
                                    <input type="text" id="place-departure" name="place-departure[]"  />
                                </div> -->
                                <div class="form-group">
                                    <label for="arrival-time">Time of Arrival:</label>
                                    <input type="time" id="arrival-time" name="arrival-time[]" required />
                                </div>
                                <!-- <div class="form-group">
                                    <label for="place-arrival">Place of Arrival:</label>
                                    <input type="text" id="place-arrival" name="place-arrival"  />
                                </div> -->
                                <div class="form-group"></div>
                                <div class="form-group">
                                    <label for="nature-of-duties">Nature of Duties:</label>
                                    <textarea id="nature-of-duties" name="nature[]" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category0">Category:</label>
                                    <select id="category0" onchange="selectData(this)" name="category0[]" class ="0" required>
                                        <option value="default">Please Select a category</option>
                                        <option value="business">Business</option>
                                        <option value="non-business">Non-business</option>
                                    </select>
                                </div>
                                <div class="form-group" id="claims-business0" style="display: none;">
                                    <label for="">Particulars of Claims:</label>
                                    <select id="particulars-of-claims(business)" name="particulars-of-claims(business)[]">
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
                                        <option value="printing">printing</option>
                                        <option value="staffamenities">Staff Amenities</option>
                                        <option value="tender">Tender Purchase Fee</option>
                                        <option value="process">Processing Fee</option>
                                        <option value="computer">Computer Services</option>
                                        <option value="postage">postage</option>
                                        <option value="courier">courier</option>
                                        <option value="entertainment">Entertainment</option>
                                        <option value="gift">Gift</option>
                                        <option value="telephone">Telephone</option>
                                        <option value="others1">Others</option>
                                    </select>
                                    <div class="form-group" id="display-specify1" style="display: none;">
                                        <label for="specify1">Amount (RM):</label>
                                        <input type="text" id="specify1" name="specify1[]" />
                                    </div>
                                </div>
                                <div class="form-group" id="claims-non-business0" style="display: none;">
                                    <label for="">Particulars of Claims:</label>
                                    <select id="particulars-of-claims(non-business)" name="particulars-of-claims(non-business)[]">
                                        <option value="travelling-ehailing">Travelling (E-Hailing)</option>
                                        <option value="travelling-owncar">Travelling (Own Car)</option>
                                        <option value="travelling-carental">Travelling (Car Rental)</option>
                                        <option value="transport">Transport - Air Fare</option>
                                        <option value="subsistence">Subsistence</option>
                                        <option value="accomodation">Accomodation</option>
                                        <option value="lodging">Lodging</option>
                                        <option value="others2">Others</option>
                                    </select>
                                    <div class="form-group" id="display-specify1" style="display: none;">
                                        <label for="specify2">Amount (RM):</label>
                                        <input type="text" id="specify2" name="specify2[]" />
                                    </div>
                                </div>
                                <div class="form-group" id="input-distance-travelled0" style="display: none;">
                                    <label for="distance-travelled">Distance Travelled (KM):</label>
                                    <input type="number" id="distance-travelled" name="distance[]" onkeyup="calculateAmount()"  />
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount (RM):</label>
                                    <input type="number" id="amount" name="amount[]" required />
                                </div>
                                <label for="supporting-attachment">Include a supporting attachment:</label>
                                <input type="file" id="attachment" accept=".pdf" name="attachment" required>
                                <hr />
                            </div>
                            <div id="form-buttons-container">
                                <div class="form-buttons">
                                    <button type="button" class="add-travel-btn">+</button>
                                    <button type="button" class="remove-travel-btn">-</button>
                                    <button type="submit"  name="submit">Submit</button>
                                    <div class="total-container">
                                        <input type="text" name="totals" id="totals" hidden />
                                        <span>Total: RM</span><span id="total-amount">0</span>
                                    </div>    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </body>
    </html>

    <script>

      const fileInput = document.getElementById('attachment');

      fileInput.addEventListener('change', () => {

        const file = fileInput.files[0];
        const fileType = file.type;

        if (fileType !== 'application/pdf')
        {
          fileInput.setCustomValidity('Only PDF files are allowed.');
        }
        else{
          fileInput.setCustomValidity('');
        }
      });

      var count = 1;
      $(document).ready(function() {
          $('.add-travel-btn').click(function() {
              var clonedSection = $('#cloned').clone().prop('id', 'cloned' + count);
              clonedSection.find('.form-number2').text('Item ' + (count + 1));
  
              clonedSection.find('#category' + (count - 1 )).prop('id', 'category' + count).prop('class', count);
              clonedSection.find('#claims-business'+ (count - 1 )).prop('id', 'claims-business' + count);
              clonedSection.find('#claims-non-business'+ (count - 1 )).prop('id', 'claims-non-business' + count);
              clonedSection.find('#input-distance-travelled'+ (count - 1 )).prop('id', 'input-distance-travelled' + count);
              $('#form-buttons-container').before(clonedSection); 

              count++;

          });

          $('.remove-travel-btn').click(function() {
          if (count > 1) {
              $('#cloned' + (count - 1)).remove();
              count--;
          }
          });

          $('form[name="borang"]').submit(function(e) {
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

  function selectData(el){
      var catData = el.className;
      var category = $("#category" + catData).find(':selected').val();
      var claimsB = $("#claims-business" + catData); 
      var claimsNB = $("#claims-non-business" + catData);
      var distance = $("#input-distance-travelled" + catData); 

      if (category == "business") {
          console.log('bis');

          claimsB.attr('style','display:block');
          claimsNB.attr('style','display:none');
          
      }else if (category == "non-business")
      {                
          claimsB.attr('style','display:none');
          claimsNB.attr('style','display:block');
          distance.attr('style','display:none');

      }else {

          claimsB.attr('style','display:none');
          claimsNB.attr('style','display:none');
      }

    }

  document.addEventListener("DOMContentLoaded", function () {
    const addTravelBtn = document.querySelector(".add-travel-btn");
    const removeTravelBtn = document.querySelector(".remove-travel-btn");
    const formContainer = document.querySelector("#travelling-form");
    const totalAmountDisplay = document.querySelector("#total-amount");
    
    removeTravelBtn.addEventListener("click", function () {
      if (formContainer.parentNode.children.length > 2) {
        formContainer.parentNode.removeChild(formContainer.parentNode.lastChild);
      }
      updateTotalAmount(); 
    });

    formContainer.addEventListener("input", updateTotalAmount); 

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

  function uncheckOther(checkbox) {
    const otherCheckbox = checkbox.id === "reimbursable-yes"
      ? document.querySelector("#reimbursable-no")
      : document.querySelector("#reimbursable-yes");
    otherCheckbox.checked = !checkbox.checked;
  }

  function calculateAmount() {
    var distanceInput = document.getElementById("distance-travelled").value;
    var amountInput = document.getElementById("amount");

    const departureTime = document.getElementById("departure-time").value;
    const arrivalTime = document.getElementById("arrival-time").value;

    const departureDateTime = new Date(`01/01/2000 ${departureTime}`);
    const arrivalDateTime = new Date(`01/01/2000 ${arrivalTime}`);
    const timeDifferenceMs = arrivalDateTime.getTime() - departureDateTime.getTime();
    const hoursDifference = timeDifferenceMs / 3600000;
    const roundedHoursDifference = hoursDifference.toFixed(2);

    const selectedClass = document.querySelector("#class").value;
    let rate = 0;
    let price = 0;
    let price2 = 0;

    if (selectedClass === "car") {
      if (distanceInput <= 500) {
        rate = distanceInput * 0.85 + price + price2;
      } else if (distanceInput >= 501) {
        rate = 500 * 0.85;
        rate += (distanceInput - 500) * 0.75 + price + price2;
      }
    } else if (selectedClass === "motorcycle") {
      if (distanceInput <= 500) {
        rate = distanceInput * 0.55 + price + price2;
      } else if (distanceInput >= 501) {
        rate = 500 * 0.55;
        rate += (distanceInput - 500) * 0.45 + price + price2;
      }
    }

    amountInput.value = rate.toFixed(2);
  
  }

  var places = document.querySelectorAll("#place");

  for (var i = 0; i < places.length; i++) {
      places[i].addEventListener("change", function() {
          var currentCountryList = this.parentNode.nextElementSibling;
          if (this.value === "overseas") {
              currentCountryList.style.display = "block";
          } else {
              currentCountryList.style.display = "none";
          }
      });
  }


  // var placeDropdowns = document.querySelectorAll(".place-dropdown");
  // var countryDropdowns = document.querySelectorAll(".country-list");

  // for (var i = 0; i < placeDropdowns.length; i++) {
  //     placeDropdowns[i].addEventListener("change", function() {
  //         var countryList = this.nextElementSibling;
  //         if (this.value == "overseas") {
  //             countryList.style.display = "block";
  //         } else {
  //             countryList.style.display = "none";
  //         }
  //     });
  // }


    var category = document.getElementById("category0");
    var claimsB = document.getElementById("claims-business");
    var claimsNB = document.getElementById("claims-non-business");
    var business = document.getElementById("particulars-of-claims(business)");
    var Nbusiness = document.getElementById("particulars-of-claims(non-business)");
    var distance = document.getElementById("input-distance-travelled");

    category.addEventListener("change", function() {
      if (category.value == "business") {
        claimsB.style.display = "block";
        claimsNB.style.display = "none";
        distance.style.display = "none";
      } 

      else if (category.value == "non-business")
      {
        claimsB.style.display = "none";
        claimsNB.style.display = "block";
      }
      
      else {
        claimsB.style.display = "none";
        claimsNB.style.display = "none";
      }

      if (claimsB.style.display === "none") {
      business.selectedIndex = 0;
    }

    if (claimsNB.style.display === "none") {
      Nbusiness.selectedIndex = 0;
    }

      
    });

    business.addEventListener("change", function(){

      if(business.value == "mileage"){
        distance.style.display = "block";
      }
      else{
        distance.style.display = "none";
      }

  });

    function validateInput()
    {
      var input = document.getElementById('project');
      input.value = input.value.replace(/\s/g, '');     
    }

    // function validateInput2()
    // {
    //   var input = document.getElementById('projectManager');
    //   input.value = input.value.replace(/\s/g, ''); 
    // }

  $(function() {
      $("#projectManager").autocomplete({
        source: "?page=server2"
      });
    })

    $(function() {
      $("#project").autocomplete({
        source: "?page=server3"
      });
    })

  </script>