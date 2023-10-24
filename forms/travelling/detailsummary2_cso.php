<style>
  .head {
    background-color: #3a7bd5;
    color: white;
  }

  .bigger-icon {
    font-size: 35px;
  }

  .link-dark {
    color: #3a7bd5;
  }

  table {
    counter-reset: tableCount;
  }

  .counterCell:before {
    content: counter(tableCount);
    counter-increment: tableCount;
  }

  body {
    background: url("images/bg.jpg") no-repeat center bottom/cover;
  }

  .second-header {
    margin-top: 20px;
    padding-top: 20px;
  }

  .container2 {
    background-color: #3a7bd5;
    height: 50px;
    width: 100%;
    color: white;
    padding-top: 10px;
    font-size: 20px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    font-weight: bold;
    text-align: center;
    /* margin-right:15%;
    padding-left: 15%;
    width: 50%;  */
  }

  .container-main{
    margin-right:15%;
    padding-left: 20%;
    width: 50%; 
  }

  .containerpdf {
    font-weight: bold;
    text-align: center;
    background-color: #3a7bd5;
    height: 5%;
    width: 100%;
    color: white;
    padding-top: 10px;
    font-size: 20px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  }

  .below-container {
    background-color: white;
    height: 100px;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    padding-top: 20px;
    padding-right: 40px;
    padding-bottom: 50px;
    padding-left: 20px;
  }

  .below-containerpdf {
    background-color: white;
    height: 150px;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    padding-top: 30px;
    padding-right: 10px;
    padding-bottom: 50px;
    padding-left: 20px;
  }

  .cell-gap {
    padding-right: 120px;
  }

  .fa-sharp {

    font-size: 50px;
  }

  .button-4 {
    appearance: none;
    background-color: #990F02;
    border: 1px solid rgba(27, 31, 35, .15);
    border-radius: 6px;
    box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    padding: 6px 16px;
    position: relative;
    text-align: center;
    text-decoration: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    white-space: nowrap;
    margin-top: 5px;
    pointer-events: none;
  }

  .button-4:focus {
    box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
    outline: none;
    pointer-events: none;
  }


  .button-3 {
    appearance: none;
    background-color: #2ea44f;
    border: 1px solid rgba(27, 31, 35, .15);
    border-radius: 6px;
    box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    padding: 6px 16px;
    position: relative;
    text-align: center;
    text-decoration: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    white-space: nowrap;
    margin-top: 5px;
    pointer-events: none;
  }

  .button-3:focus {
    box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
    outline: none;
    pointer-events: none;
  }


  .button-2 {
    appearance: none;
    background-color: #FFA500;
    border: 1px solid rgba(27, 31, 35, .15);
    border-radius: 6px;
    box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    padding: 6px 16px;
    position: relative;
    text-align: center;
    text-decoration: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    white-space: nowrap;
    margin-top: 5px;
    pointer-events: none;

  }

  .button-2:focus {
    box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
    outline: none;
    pointer-events: none;
  }

  
    .remarks table {
        width: 100%; 
    }

    .remarks td {
        background-color: white;
        height: 100%;
        width: 20%; /* Set a fixed width (25%) for each table cell */
        text-align: left; /* Adjust text alignment as needed */
        padding: 50px; /* Add padding for spacing */
        word-break: break-word;
    }
    
</style>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js"></script>
</head>

<body id="printTable">

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

        <?php

        if (logged_in() == 1) {
          $ceo_logged_in = true;
        } elseif (logged_in() == 2) {
          $cso_logged_in = true;
        }

        ?>


  <div class="container-main">
    <table class="table table-striped text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
      <thead class="head">
        <tr style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
          <th scope="col" style="white-space: nowrap;">Staff No</th>
          <th scope="col" style="white-space: nowrap;">Reimbursable</th>
          <th scope="col" style="white-space: nowrap;">Month</th>
          <th scope="col" style="white-space: nowrap;">Class</th>
          


        <?php 

            if ($ceo_logged_in || $cso_logged_in){
              echo '<th scope="col" colspan="2" style="white-space: nowrap;">C.C (Vehicle)</th>';
              echo " <th scope='col' style='white-space: nowrap;'>Project Code</th>";
            }
            else {
              echo '<th scope="col" style="white-space: nowrap;">C.C (Vehicle)</th>';
              echo " <th scope='col' style='white-space: nowrap;'>Project Code</th>";
              echo "<th scope='col' colspan='2' style='white-space: nowrap;'>Project Manager</th>";
            }

        ?>
         
          <th scope="col" colspan="5" style="white-space: nowrap;">Total</th>

        </tr>
      </thead>
      <tbody>
        <?php

        $id = $_GET['id'];
        $sql = "SELECT * FROM travelclaims2 WHERE travel_id = '" . $id . "'";
        $result = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $id2 = $row["travel_id"];
          ?>
          <tr class="table-light">
            <td style="font-weight: bold;"><br>
              <?php echo $row["staffno"] ?>
            </td>
            <td style="font-weight: bold;"><br>
              <?php echo $row["reimbursable"] ?>
            </td>
            <td style="font-weight: bold;"><br>
              <?php
              echo date("F Y", strtotime($row["month"]));
              ?>
            </td>
            <td style="font-weight: bold;"><br>
              <?php
              echo ucfirst($row["class"]);
              ?>
            </td>
            
            
              <?php
              
              
              if ($ceo_logged_in || $cso_logged_in){
                  echo '<td colspan ="2" style="font-weight: bold;"><br>';
                  echo $row["cc"];
                  echo '<td style="font-weight: bold;"><br>'; 
                  echo $row["project_code"];
                  
              }
              else{

                echo '<td style="font-weight: bold;"><br>';
                echo $row["cc"];
                echo '<td style="font-weight: bold;"><br>'; 
                echo $row["project_code"];
              }
              
               ?>
            </td>
            
            <?php
              if ($ceo_logged_in || $cso_logged_in){      
                
              }

              else{
              echo '<td colspan="2" style="font-weight: bold;"><br>';
          
              $sql2 = "SELECT * FROM approval_detail WHERE approval_level_id = 2 AND t_claims_id = " . $id2;
              $result2 = mysqli_query($mysqli, $sql2);
              $row2 = mysqli_fetch_assoc($result2);

              $projectManager = $row2["staffno"];

              $sql4 = "SELECT * FROM hr_employee WHERE staffno = '" . $projectManager . "'";
              $result3 = mysqli_query($mysqli, $sql4);
              $row3 = mysqli_fetch_array($result3);

              echo $row3["name"];
              }

              ?>
            </td>
            <td colspan="4" style="font-weight: bold;"><br>
              <?php echo "RM" . $row['totals'] ?>
            </td>


          </tr>
          <?php
        }
        ?>
      </tbody>

  </div>

  <thead class="head">
    <tr>
      <th scope="col" colspan=11 style="white-space: nowrap; background-color:white;"></th>

    </tr>
  </thead>

  <thead class="head">
    <tr>
      <th scope="col" style="white-space: nowrap;">Place</th>
      <th scope="col" style="white-space: nowrap;">Time of Departure</th>
      <th scope="col" style="white-space: nowrap;">Departure Date</th>
      <th scope="col" style="white-space: nowrap;">Time of Arrival</th>
      <th scope="col" style="white-space: nowrap;">Arrival Date</th>
      <th scope="col" style="white-space: nowrap;">Nature</th>
      <th scope="col" style="white-space: nowrap;">Category</th>
      <th scope="col" style="white-space: nowrap;">Particular of Claims</th>
      <th scope="col" colspan="3" style="white-space: nowrap;">Amount</th>

    </tr>
  </thead>

  <tbody>
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM travel_details WHERE tclaims_id = '" . $id . "'";
    $result_travel_details = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($result_travel_details) > 0) {
      while ($row_travel_details = mysqli_fetch_assoc($result_travel_details)) {
        ?>
        <tr class="table-light">

          <td style="font-weight: bold;"><br>
            <?php echo $array_place[$row_travel_details["place"]] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo date("h:iA", strtotime($row_travel_details["timedeparture"])) ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_travel_details['datearrival'] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo date("h:iA", strtotime($row_travel_details["timearrival"])) ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_travel_details['datedeparture'] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_travel_details["nature"] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo ucfirst($row_travel_details["category"]) ?>
          </td>
          <td style="font-weight: bold;">
            <br>
            <?php
            echo ucfirst($row_travel_details["particular"]);
            if ($row_travel_details["particular"] === "mileage") {
              echo "<br>";
              echo "(" . $row_travel_details["distance"] . "KM)";
            }
            ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo "RM" . $row_travel_details["amount"] ?>
          </td>

          <?php


          $qhod = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id =" . $id);
          $rhod = mysqli_fetch_array($qhod);

          $q = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
          $r = mysqli_fetch_array($q);
          $firstApproverStatus = $r["approval_status"];

          if ($firstApproverStatus === 'pending') {
            $sql2 = "SELECT COUNT(*) AS num_amounts FROM travel_details WHERE tclaims_id = '$id'";
            $result2 = mysqli_query($mysqli, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $numAmounts = $row2['num_amounts'];

            $editUrl = "?page=editTravelling&tclaims_id=" . $id . "&traveldetails_id=" . $row_travel_details['traveldetails_id'];
            $deleteUrl = "?page=detailsummary2&traveldetails_id=" . $row_travel_details['traveldetails_id'] . "&id=" . $id;

            echo '<td><br>';
            echo '<a href="' . $editUrl . '" class="link-dark"><i class="fa-solid fa-pen-to-square"></i></a>';
            echo '</td>';

            if ($numAmounts > 1) {
              echo '<td><br>';
              // echo '<a href="'.$deleteUrl.'" class="link-dark"><i class="fa-solid fa-trash-can"></i></a>';
              print "<a href='javascript:void(0);' class='link-dark' onclick='confirmDelete(" . $id . ", " . $row_travel_details["traveldetails_id"] . ");'><i class='fa-solid fa-trash-can'></i></a>";

              echo '</td>';
            } else {
              echo '<td></td>';
            }

          } else {
            echo "<td></td>";
            echo "<td></td>";
          }
          ?>
        </tr>
        <?php
      }
    } else {

    }
    ?>

    <?php
    if (isset($_GET['traveldetails_id']) && isset($_GET['id'])) {
      $traveldetails_id = $_GET['traveldetails_id'];
      $tclaims_id = $_GET['id'];

      $sql2 = "DELETE FROM travel_details WHERE traveldetails_id = '$traveldetails_id' AND tclaims_id = '$tclaims_id' ";
      mysqli_query($mysqli, $sql2);

      $sql = "SELECT SUM(amount) AS total_amount FROM travel_details WHERE tclaims_id = '$tclaims_id'";
      $result = mysqli_query($mysqli, $sql);
      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $totalAmount = $row['total_amount'];

        $sql3 = "UPDATE travelclaims2 SET totals = '$totalAmount' WHERE travel_id = '$tclaims_id'";
        mysqli_query($mysqli, $sql3);

        if ($totalAmount == 0) {
          $sql4 = "DELETE FROM travel_approval WHERE tclaims_id = '$tclaims_id'";
          mysqli_query($mysqli, $sql4);

          $sql5 = "DELETE FROM travel_details WHERE tclaims_id = '$tclaims_id'";
          mysqli_query($mysqli, $sql5);

          $sql6 = "DELETE FROM travelclaims2 WHERE travel_id = '$tclaims_id'";
          mysqli_query($mysqli, $sql6);

          $goto = "?page=travelsummary";
          $msg = "Deleting <img src='images/loading.gif' />";
          $func->info($msg, $goto);
        } else {
          $goto = "?page=detailsummary2&id=$tclaims_id";
          $msg = "Deleting <img src='images/loading.gif' />";
          $func->info($msg, $goto);
        }
      } else {
        $sql4 = "DELETE FROM travel_approval WHERE tclaims_id = '$tclaims_id'";
        mysqli_query($mysqli, $sql4);

        $sql5 = "DELETE FROM travel_details WHERE tclaims_id = '$tclaims_id'";
        mysqli_query($mysqli, $sql5);

        $sql6 = "DELETE FROM travelclaims2 WHERE travel_id = '$tclaims_id'";
        mysqli_query($mysqli, $sql6);

        $goto = "?page=travelsummary";
        $msg = "Deleting <img src='images/loading.gif' />";
        $func->info($msg, $goto);
      }
    }
    ?>

  </tbody>

  <thead class="head">
    <tr>
      <th scope="col" colspan="12" style="white-space: nowrap; background-color:white;"></th>

    </tr>
  </thead>

  <thead class="head">
    <tr>
      <th scope="col" colspan="12" style="text-align: center; white-space: nowrap; font-size:20px;">Attachment</th>
    </tr>
  </thead>
  

  <tbody>
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM travel_details WHERE tclaims_id = '" . $id . "'";
    $result = mysqli_query($mysqli, $sql);

    $hasAttachments = false;

    while ($row = mysqli_fetch_assoc($result)) {
      $attachment = $row["attachment"];
      if (!empty($attachment)) {
        $hasAttachments = true;
        break;
      }
    }

    if ($hasAttachments) {
      ?>
      <tr class="table-light">
        <td scope="col" colspan="12" style="text-align: center; white-space: nowrap;">
          <div style="display: flex; justify-content: flex-start;">
            <?php
            mysqli_data_seek($result, 0);
            while ($row = mysqli_fetch_assoc($result)) {
              $attachment = $row["attachment"];
              if (!empty($attachment)) {
                ?>
                <div style="margin-right: 20px;">
                  <a href="https://intranet.minconsult.com/sources/E-FORM/<?php echo $attachment; ?>" class="link-dark"
                    target="_blank">
                    <i class="fa-solid fa-paperclip bigger-icon"></i>
                  </a>
                  <br><br>
                  Click to view attachment
                </div>
                <?php
              }
            }
            ?>
          </div>
        </td>
      </tr>
      <?php
    }
    ?>
  </tbody>

  <thead class="head">
    <tr>
      <th scope="col" colspan="12" style="white-space: nowrap; background-color:white;"></th>
    </tr>
  </thead>

    <!-- Apprval Start -->
    <thead class="head">
      <tr>
        <th scope="col" colspan="12" style="text-align: center; white-space: nowrap; font-size:20px;">Approval</th>
      </tr>
    </thead>

    <tr class="table-light" >
      <td scope="col" colspan="12" style="text-align: center; white-space: nowrap;">
    
                  <table style="text-align:center;  margin-left:auto;  margin-right:auto; ">
                    <tr class="tableheader">
                      <!-- Header content -->
                    </tr>

                    <?php
                    //change to approval_detail table
                    //CSO user that uses CEO as approver flow
                    
                    $sl = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = '" . $id . "'");
                    while ($sq = mysqli_fetch_array($sl)) {

                      if ($sq["approval_level_id"] == 36) {
                        //Billing(1)  
                        $billing1_status = $sq["approval_status"];
                        $bil1_remarks = $sq["approval_remarks"];
                      }

                      elseif ($sq["approval_level_id"] == 37) {
                        //Billing(2)
                        $billing2_status = $sq["approval_status"];
                        $bil2_remarks = $sq["approval_remarks"];
                      }

                      elseif ($sq["approval_level_id"] == 38) {
                        //CEO 
                        $ceo_status = $sq["approval_status"];
                        $ceo_remarks = $sq["approval_remarks"];

                      }
                      elseif ($sq["approval_level_id"] == 39) {
                        //Account  
                        $account_status = $sq["approval_status"];
                        $acc_remarks = $sq["approval_remarks"];
                      }

                      else {
                        print "UNKNOWN";
                      }
                    }
                  
                    ?>

                    <tr >
                      <td class="cell-gap" valign="top">Billing(1) Approval : <br><strong>
                            <?php 
                            if ($billing1_status == "Approved") {
                            print "<span class='button-3' role='button'>Approved</button>";
                            } else if ($billing1_status == "Declined") {
                              print "<span class='button-4' role='button'>Declined</button>";
                            } else {
                              print "<span class='button-2' role='button'>Pending</button>";

                            }
                            ?>
                          </strong>
                      </td>

                      <td class="cell-gap" valign="top">Billing(2) Approval: <br><strong>
                          <?php

                          if ($billing2_status == "Approved") {
                            print "<span class='button-3' role='button'>Approved</button>";
                          } else if ($billing2_status == "Declined") {
                            print "<span class='button-4' role='button'>Declined</button>";
                          } else {
                            print "<span class='button-2' role='button'>Pending</button>";

                          }

                          ?>

                          </strong>
                      </td>

                      <td class="cell-gap" valign="top">CEO Approval: <br><strong>
                          <?php

                          if ($ceo_status == "Approved") {
                            print "<span class='button-3' role='button'>Approved</button>";
                          } else if ($ceo_status == "Declined") {
                            print "<span class='button-4' role='button'>Declined</button>";
                          } else {
                            print "<span class='button-2' role='button'>Pending</button>";

                          }

                          ?>
                          </strong>
                      </td>

                      <td class="cell-gap" valign="top">Finance Approval: <br><strong>
                        <?php
                        if ($account_status == "Approved") {
                          print "<span class='button-3' role='button'>Approved</button>";
                        } else if ($account_status == "Declined") {
                          print "<span class='button-4' role='button'>Declined</button>";
                        } else {
                          print "<span class='button-2' role='button'>Pending</button>";
                        }
                        ?>
                        </strong>
                      </td>
                      
                    </tr>

                  </table>
              </div>
      </td>
    </tr>
    <!-- Approval End -->


    <thead class="head">
    <tr>
      <th scope="col" colspan="12" style="white-space: nowrap; background-color:white;"></th>
    </tr>
  </thead>


    <!-- Remarks Start -->
      <thead class="head">
        <tr>
          <th scope="col" colspan="12" style="text-align: center; white-space: nowrap; font-size:20px;">Remarks</th>
        </tr>
      </thead>
      
      <tr class="table-light" >
        <td scope="col" colspan="12" style="text-align: center; white-space: nowrap;">
        
            <div colspan = "3" class="remarks table">
              <?php
              $remarks = array(
                  '<strong> Billing (1) remarks: <br></strong>' . $bil1_remarks,
                  '<strong> Billing (2) remarks: <br></strong>' . $bil2_remarks,
                  '<strong> CEO remarks: <br></strong>' . $ceo_remarks,
                  '<strong> Finance remarks: <br></strong>' . $acc_remarks
              );
              ?>

              <table>
                  <tr>
                      <?php foreach ($remarks as $remark): ?>
                          <td><?php echo $remark; ?></td>
                      <?php endforeach; ?>
                  </tr>
              </table>
            </div>
        
        </td>
      </tr>
    <!-- Remarks End -->

    <thead class="head">
    <tr>
      <th scope="col" colspan="12" style="white-space: nowrap; background-color:white;"></th>
    </tr>
  </thead>

    <!-- Convert PDF Start -->
    <?php
      if ($billing1_status === 'Approved' && $billing2_status === 'Approved' && $ceo_status === 'Approved' && $account_status === 'Approved' ) {
    ?>

    <thead class="head">
        <tr>
          <th scope="col" colspan="12" style="text-align: center; white-space: nowrap; font-size:20px;">Convert to PDF</th>
        </tr>
      </thead>
   
    <tr class="table-light" >
        <td scope="col" colspan="12" style="text-align: center; white-space: nowrap;">
              <table>
                  <tr>
                  
                  <a href="?page=generatePDFcso&id=<?php echo $id; ?>&traveldetails_id=<?php echo $traveldetails; ?>"
                    class="link-dark">
                    <i class="fa-sharp fa-solid fa-file-pdf"></i>
                  </a><br><br>
                    Click to convert to PDF

                  </tr>
              </table>
            
        
        </td>
      </tr> 
    <?php
  }
    ?>
      <thead class="head">
    <tr>
      <th scope="col" colspan="12" style="white-space: nowrap; background-color:white;"></th>
    </tr>
  </thead>
    <!-- Convert PDF End -->

</table>

   
  <?php
  
  ?>
  </div>

  <script>


    function confirmDelete(id, traveldetails) {
      var confirmDelete = confirm("Are you sure you want to delete this item?");
      if (confirmDelete) {
        // If the user confirms, redirect to the delete page or trigger the delete action
        window.location.href = "?page=detailsummary2&id=" + id + "&traveldetails_id=" + traveldetails;
      }
      // If the user cancels, do nothing
    }
  </script>