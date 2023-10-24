<style>
   body{
   background: url("images/bg.jpg") no-repeat center bottom/cover;
   }
</style>
<?php
   if(isset($_POST["submit"]))
   {

    $dates = $_POST['date'];
    $places = $_POST['place'];
    $departures = $_POST['departure-time'];
    $arrivals = $_POST['arrival-time'];
    $natures = $_POST['nature'];
    $countries = $_POST['country'];
    $categories = $_POST['category'];
    $particularsOfClaims = $_POST['particulars-of-claims'];
    $amount = $_POST['amount'];
    $distance = $_POST['distance'];

    $targetDir = "forms/travelling/uploads/";
    $attachments = array();

    $targetDir = "forms/travelling/uploads/";
    $target_file = $targetDir . basename($_FILES["attachment"]["name"]);
    $uploadOK = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file))
    {
        $attachment = $target_file;
    }

$sql = "UPDATE travel_details SET date = '".$_POST["date"]."', place = '".$_POST["place"]."', timedeparture = '".$_POST["departure-time"]."', timearrival = '".$_POST["arrival-time"]."', nature = '".$_POST["nature"]."', category = '".$_POST["category"]."', particular = '".$_POST["particulars-of-claims"]."', amount = '".$_POST["amount"]."', distance = '".$_POST['distance']."', attachment = '".$attachment."' WHERE tclaims_id = '".$_GET['tclaims_id']."' AND traveldetails_id = '".$_GET['traveldetails_id']."'";

if (mysqli_query($mysqli, $sql)) {

  $sql = "SELECT SUM(amount) AS total_amount FROM travel_details WHERE tclaims_id = '".$_GET['tclaims_id']."'";
  $result = mysqli_query($mysqli, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $totalAmount = $row['total_amount'];

    $sql3 = "UPDATE travelclaims2 SET totals = '$totalAmount' WHERE travel_id = '".$_GET['tclaims_id']."'";
    mysqli_query($mysqli, $sql3);

    $goto = "?page=travelsummary";
    $msg = "";
    $func->info($msg, $goto);

  }

} 
else {
  if(mysqli_errno($mysqli)) 
  {
      die("Database query failed: " . mysqli_error($mysqli));
  }
   else {
  }
}
    
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
            <div class="form-row">
                <?php
                    if (isset($_GET['tclaims_id'])) {
                      
                        $traveldetails_id = $_GET['traveldetails_id'];
                        $tclaims_id = $_GET['tclaims_id'];
                    
                        $q = mysqli_query($mysqli,"SELECT * FROM travelclaims2 WHERE travel_id=".$tclaims_id);
                        $r = mysqli_fetch_array($q);
                    
                        $reimbursable_value = $r['reimbursable'];
                    
                        $uq = mysqli_query($mysqli,"SELECT * FROM travel_approval WHERE tclaims_id=".$tclaims_id);
                        $ur = mysqli_fetch_array($uq);
                    
                        $auq = mysqli_query($mysqli,"SELECT * FROM travel_details WHERE tclaims_id=".$tclaims_id." AND traveldetails_id=".$traveldetails_id);
                        $aur = mysqli_fetch_array($auq);
                    
                        $sq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno = '".$ses_staffno."'");
                        $sr = mysqli_fetch_array($sq);
                    } 
              ?>

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
                  
                <div class="form-row">
                <div class="form-group">
                     <label for="reimbursable-by-client">Reimbursable By Client:</label>
                     <label for="reimbursable-yes" style="display: inline-block;">
                     Yes
                     <input type="checkbox" id="reimbursable-yes" name="reimbursable" value="Yes" class="boxy-checkbox" onclick="uncheckOther(this)" <?php echo ($reimbursable_value === 'Yes') ? 'checked' : ''; ?> />
                     </label>
                     <label for="reimbursable-no" style="display: inline-block;">
                     No
                     <input type="checkbox" id="reimbursable-no" name="reimbursable" value="No" class="boxy-checkbox" onclick="uncheckOther(this)" <?php echo ($reimbursable_value === 'No') ? 'checked' : ''; ?> />
                     </label>
                  </div>
                </div>

                <div class="form-group">
                    <label for="month">Month:</label>
                    <input type="date" id="month" value="<?php echo $r['month'];?>" name="month" required  readonly/>
                </div>
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name[]" value="<?php echo $name;?>" readonly="readonly" />
                </div>
             
              
              <div class="form-row">
                    <div class="form-group">
                        <label for="staff-no">Staff No:</label>
                        <input type="text" id="staff-no" value="<?php echo $staffno;?>" name="staffno" readonly="readonly" />
                    </div>
                    <div class="form-group">
                        <label for="vehicle-reg-no">Vehicle Reg No:</label>
                        <input type="text" id="vehicle-reg-no" value="<?php echo $r['vehiclereg'];?>" name="vehicle-reg-no" pattern="[A-Za-z0-9-]+" />
                    </div>
                    <div class="form-group">
                        <label for="division-department">Division / Department:</label>
                        <input type="text" id="division-department" value="<?php echo $division;?>" name="division-department" readonly="readonly" />
                    </div>
                    <div class="form-group">
                        <label for="position">Position:</label>
                        <input type="text" id="position" name="position" value="<?php echo $r['position'];?>" readonly="readonly" />
                    </div>
                    <div class="form-group">
                        <label for="class">Class:</label>
                        <select id="class" name="class" required>
                          <option value="car"  <?php if ($r['class'] === 'car') echo 'selected'; ?>>Automobile</option>
                          <option value="motorcycle"   <?php if ($r['class'] === 'motorcycle') echo 'selected'; ?>>Motorcycle</option>
                   
                        </select> 
                    </div>
                    <div class="form-group">
                      <label for="cc">C.C (Vehicle CC):</label>
                      <input type="text" id="cc" value="<?php echo $r['cc'];?>" name="cc" pattern="[0-9]+" readonly="readonly"  />
                    </div>

                  <div class="form-group">
                      <label for="project">Project & Job Number:</label>
                      <input type="text" id="project" value="<?php echo $r['project_code'];?>" placeholder="Please input project code" oninput="validateInput()" name="project" rows="3" readonly="readonly"  />
                  </div>
                  <div class="form-group">
                      <label for="projectManager">Project Manager:</label>
                      <input type="text" id="projectManager" value="<?php echo $ur['pm_staff_no'];?>" placeholder="Please enter project manager" name="projectManager" rows="3" readonly="readonly"  />
                  </div>
                  <div class="form-group">
                      <label for="HodApprover">HOD Approver:</label>
                    <select id ="HodApprover" name = "HodApprover" required readonly="readonly" >
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
              <div class = "full-blue"></div>
                        
                          <hr />
                 
            <div id="form-buttons-container">
              <div class="form-buttons">
                <button type="submit"  name="submit">Submit</button> 
              </div>
            </div>
            
          </form>
         </div>
      </div>
   </body>
</html>
<script>
    function toggleCategoryVisibility() {
    
      var currentSection = $(this).closest('.cloned');
      var categoryValue = $(this).val();
      var claimsBusiness = currentSection.find('.claims-business');
      var claimsNonBusiness = currentSection.find('.claims-non-business');
      var distanceInput = currentSection.find('.distance-travelled');
      var selectedCategory = $(this).val();
      var selectedClaims = currentSection.find('.particulars-of-claims').val();

      // Toggle visibility of the distanceInput based on selectedCategory and selectedClaims
      if (selectedCategory === 'business' || selectedCategory === 'non-business' || selectedClaims === 'mileage' || selectedClaims === 'travelling-owncar') {
        distanceInput.parent().show();
      } else {
        distanceInput.parent().hide();
      }

      // Toggle visibility of claimsBusiness and claimsNonBusiness based on categoryValue
      if (categoryValue === "business") {
        claimsBusiness.show();
        claimsNonBusiness.hide();
      } else if (categoryValue === "non-business") {
        claimsNonBusiness.show();
        claimsBusiness.hide();
      } else {
        claimsBusiness.hide();
        claimsNonBusiness.hide();
      }

      // Reset the value of .particulars-of-claims and trigger 'change' event
      // currentSection.find('.particulars-of-claims').val('').trigger('change');

      // Hide the element with class .display-specify
      currentSection.find('.display-specify').hide();

      // Calculate the amount based on distanceInput (assuming there's a function called calculateAmount)
      calculateAmount(distanceInput);
    }
    
    function toggleParticularsVisibility() {
      var currentSection = $(this).closest('.cloned');
      var selectedValue = $(this).val();
      var displaySpecify = currentSection.find('.display-specify');
      var distanceInput = currentSection.find('.distance-travelled');

      // Toggle visibility of the displaySpecify based on selectedValue
      if (selectedValue === "others1" || selectedValue === "others2") {
        displaySpecify.show();
      } else {
        displaySpecify.hide();
      }

      // Toggle visibility of the distanceInput based on selectedValue
      if (selectedValue === "mileage" || selectedValue === "travelling-owncar") {
        distanceInput.parent().show();
      } else {
        distanceInput.parent().hide();
      }

      // Calculate the amount based on distanceInput (assuming there's a function called calculateAmount)
      calculateAmount(distanceInput);
    }

    $(document).ready(function() {
     // Function to toggle the visibility of elements based on the selected values in .category
     $(".category").each(toggleCategoryVisibility);
   
    });

    $(document).ready(function() {
     $(".particulars-of-claims").each(toggleParticularsVisibility);
    });
   
    function updateTotalAmount() {
      const clonedContainers = document.querySelectorAll('.cloned-container .cloned');
      let totalAmount = 0;
      clonedContainers.forEach((cloned) => {
        const amount = parseFloat(cloned.querySelector('.amount').value);
        totalAmount += isNaN(amount) ? 0 : amount;
      });
    
      document.getElementById('total-amount').innerText = totalAmount.toFixed(2);
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
   
     $(document).ready(function() {
      
        // Function to toggle the visibility of the country list based on the selected value
        function toggleCountryList() {
          var currentCountryList = $(this).closest('.cloned').find('.country-list');
          if ($(this).val() === "overseas") {
            currentCountryList.show();
          } else {
            currentCountryList.hide();
          }
        }

        // Trigger the event when the page loads to apply the initial visibility based on the selected value
        $(".place").each(toggleCountryList);
        
        // Bind the "change" event to the elements with class "place"
        $(document).on("change", ".place", toggleCountryList);

        $(document).on("change", ".category", toggleCategoryVisibility);
     
        $(document).on("change", ".particulars-of-claims", toggleParticularsVisibility);
      
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
   
       $(".add-travel-btn").click(function() {
         var clonedSection = cloneSection();
         $('#cloned-container').append(clonedSection);
         count++;
       });
           
       $(".remove-travel-btn").click(function() {
         var lastClonedSection = $('#cloned-container').find('.cloned').last();
         removeSection(lastClonedSection);  
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
   
       $(document).on('change', '.category', function() {
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
   
         $(document).on('keyup', '.distance-travelled', function() {
           calculateAmount(this);
         });
   
     });
   
      document.addEventListener("DOMContentLoaded", function () {
       const addTravelBtn = document.querySelector(".add-travel-btn");
       const removeTravelBtn = document.querySelector(".remove-travel-btn");
       const formContainer = document.querySelector("#travelling-form");
       const totalAmountDisplay = document.querySelector("#total-amount");
   
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
   
        
     });
   
     var places = document.querySelectorAll(".place");
   
     places.forEach(function (place) {
       place.addEventListener("change", function() {
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
   
     $(function() {
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
       const selectedCategory  = currentSection.querySelector('.category').value;
       
       let rate = 0;
   
       if (selectedClass === 'car')
       {
        if (selectedCategory === 'business' ) {
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
       }else if (selectedClass === 'motorcycle') {
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
   
       document.getElementById('total-amount').innerText = totalAmount.toFixed(2);
     }
 
</script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> -->