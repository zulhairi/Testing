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
    color: white;
    padding-top: 10px;
    font-size: 20px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  }

  .containerpdf {
    background-color: #3a7bd5;
    height: 50px;
    color: white;
    padding-top: 10px;
    font-size: 20px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  }

  .below-container {
    background-color: white;
    height: 100px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    padding-top: 20px;
    padding-right: 10px;
    padding-bottom: 50px;
    padding-left: 20px;
  }

  .below-containerpdf {
    background-color: white;
    height: 150px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    padding-top: 30px;
    padding-right: 10px;
    padding-bottom: 50px;
    padding-left: 20px;
  }

  .cell-gap {
    padding-right: 50px;
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
      <a class="active" href="?page=advance">Advance Form</a>
      <ul>

        <li>
          <a href="?page=advancesummary">Requested Advance</a>
        </li>

        <?php
        include "layouts/sidebarapprove.php";
        ?>

      </ul>
    </div>
    <a href="?page=idx" class="logout-link" style="background-color:#555; color:white;">
      <img src="images/logout.png" alt="Exam"
        style="display:inline-block; vertical-align:middle; width:30px; height:30px;">
      Back</a>
  </div>

  <div class="container" style="margin-right:120px;">
    <table class="table table-striped text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
      <thead class="head">
        <tr style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
          <th scope="col" style="white-space: nowrap;">Staff No</th>
          <th scope="col" style="white-space: nowrap;">Designation</th>
          <th scope="col" style="white-space: nowrap;">Appointed Date</th>
          <th scope="col" style="white-space: nowrap;">Department</th>
          <th scope="col" style="white-space: nowrap;">Required Advance</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $id = $_GET['id'];
        $sql = "SELECT * FROM advanceclaim WHERE advance_id = '" . $id . "'";
        $result = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $id2 = $row["travel_id"];
          ?>
          <tr class="table-light">
            <td style="font-weight: bold;"><br>
              <?php echo $row["staffno"] ?>
            </td>
            <td style="font-weight: bold;"><br>
              <?php echo $row["designation"] ?>
            </td>
            <td style="font-weight: bold;"><br>
              <?php echo $row["date_appointment"] ?>
            </td>
            <td style="font-weight: bold;"><br>
              <?php echo $row["department"] ?>
            </td>


            <?php
            $sql2 = "SELECT * from advance_details WHERE aclaims_id = '" . $id . "'";
            $result2 = mysqli_query($mysqli, $sql2);
            while ($row2 = mysqli_fetch_assoc($result2)) {
              ?>
              <td style="font-weight: bold;"><br>
                <?php echo "RM" . $row2["advance_required"] ?>
              </td>
            </tr>
            <?php
            }
        }
        ?>
      </tbody>

  </div>

  <thead class="head">
    <tr>
      <th scope="col" colspan= "5" style="white-space: nowrap; background-color:white;"></th>
 
    </tr>
  </thead>

  <thead class="head">
    <tr>
      <th scope="col" style="white-space: nowrap;">Previous Advance</th>
      <th scope="col" style="white-space: nowrap;">Reimbursable</th>
      <th scope="col" style="white-space: nowrap;">Project Code</th>
      <th scope="col" style="white-space: nowrap;">Nature</th>
      <th scope="col" style="white-space: nowrap;">Purpose</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM advance_details WHERE aclaims_id = '" . $id . "'";
    $result = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr class="table-light">
        <td style="font-weight: bold;"><br>
          <?php echo "RM" . $row["previous_advances"] ?>
        </td>
        <td style="font-weight: bold;"><br>
          <?php echo $row["reimbursable"] ?>
        </td>
        <td style="font-weight: bold;"><br>
          <?php echo $row["project_code"] ?>
        </td>
        <td style="font-weight: bold;"><br>
          <?php echo $row["nature"] ?>
        </td>
        <td style="font-weight: bold;"><br>
          <?php echo $row["purpose"] ?>
        </td>

      </tr>
      <?php
    }
    ?>
  </tbody>

  <thead class="head">
    <tr>
      <th scope="col" colspan = "5" style="white-space: nowrap; background-color:white;"></th>

    </tr>
  </thead>

  <thead class="head">
    <tr>
      <th scope="col" colspan="5" style="text-align: center; white-space: nowrap; font-size:20px;">Attachment</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM advance_details WHERE aclaims_id = '" . $id . "'";
    $result = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr class="table-light">
        <td scope="col" colspan="5" style="text-align: center; white-space: nowrap;">
          <a href="https://intranet.minconsult.com/sources/E-FORM/<?php echo $row["attachment"]; ?>" class="link-dark"
            target="_blank"><i class="fa-solid fa-paperclip bigger-icon"></i></a><br><br>
          Click to view attachment
        </td>
      </tr>
      <?php
    }
    ?>
  </tbody>

  <thead class="head">
    <tr>
      <th scope="col" colspan ="5" style="white-space: nowrap; background-color:white;"></th>

    </tr>
  </thead>

  </table>


  <strong>
    <center>
      <div class="container2">
        Approval Phase

      </div>
  </strong>
  </center>

  <div class="below-container">
    <table align="center">
      <tr class="tableheader">
        <!-- Header content -->
      </tr>

      <?php
      //change to approval_detail table
      
      $sl = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = '" . $id . "' AND form_category = 3");
      while ($sq = mysqli_fetch_array($sl)) {
     
        if ($sq["approval_level_id"] == 21) {  
          $hod_approval = $sq["approval_status"];
     
        }
         elseif ($sq["approval_level_id"] == 15) {
          $pm_approval = $sq["approval_status"];
     
        }
         elseif ($sq["approval_level_id"] == 16) {
          $billing_approval = $sq["approval_status"];

        }
         elseif ($sq["approval_level_id"] == 17) {
          $billing2_approval = $sq["approval_status"];

        }
         elseif ($sq["approval_level_id"] == 18) {
          $finance_approval = $sq["approval_status"];

        
        } elseif ($sq["approval_level_id"] == 19) {
          $ceo_approval = $sq["approval_status"];
       
        }
         elseif ($sq["approval_level_id"] == 20) {
          $account_approval = $sq["approval_status"];

        }
         else {
          // print "UNKNOWN";
        }
    
      }
      ?>
      <tr>
        <td class="cell-gap" valign="top">HOD Approval : <br><strong>

            <?php

            if ($hod_approval == "Approved") {
              print "<span class='button-3' role='button'>Approved</button>";
            } else if ($hod_approval == "Declined") {
              print "<span class='button-4' role='button'>Declined</button>";
            } else {
              print "<span class='button-2' role='button'>Pending</button>";

            }

            ?>

          </strong></td>
        <td class="cell-gap" valign="top">PM Approval:&nbsp;<br><strong>

            <?php

            if ($pm_approval == "Approved") {
              print "<span class='button-3' role='button'>Approved</button>";
            } else if ($pm_approval == "Declined") {
              print "<span class='button-4' role='button'>Declined</button>";
            } else {
              print "<span class='button-2' role='button'>Pending</button>";

            }

            ?>

          </strong></td>

        </strong></td>
        <td class="cell-gap" valign="top">Billing(1) Approval: <br><strong>

            <?php

            if ($billing_approval == "Approved") {
              print "<span class='button-3' role='button'>Approved</button>";
            } else if ($billing_approval == "Declined") {
              print "<span class='button-4' role='button'>Declined</button>";
            } else {
              print "<span class='button-2' role='button'>Pending</button>";

            }

            ?>

          </strong></td>

        <td class="cell-gap" valign="top">Billing(2) Approval: <br><strong>

            <?php

            if ($billing2_approval == "Approved") {
              print "<span class='button-3' role='button'>Approved</button>";
            } else if ($billing2_approval == "Declined") {
              print "<span class='button-4' role='button'>Declined</button>";
            } else {
              print "<span class='button-2' role='button'>Pending</button>";

            }

            ?>

          </strong></td>

        <td class="cell-gap" valign="top">Finance Approval: <br><strong>

            <?php

            if ($finance_approval == "Approved") {
              print "<span class='button-3' role='button'>Approved</button>";
            } else if ($finance_approval == "Declined") {
              print "<span class='button-4' role='button'>Declined</button>";
            } else {
              print "<span class='button-2' role='button'>Pending</button>";

            }

            ?>

          </strong></td>

        <td class="cell-gap" valign="top">CEO Approval: <br><strong>

            <?php

            if ($ceo_approval == "Approved") {
              print "<span class='button-3' role='button'>Approved</button>";
            } else if ($ceo_approval == "Declined") {
              print "<span class='button-4' role='button'>Declined</button>";
            } else {
              print "<span class='button-2' role='button'>Pending</button>";

            }

            ?>

          </strong></td>

          <td class="cell-gap" valign="top">Accounts Approval: <br><strong>

            <?php

            if ($account_approval == "Approved") {
              print "<span class='button-3' role='button'>Approved</button>";
            } else if ($account_approval == "Declined") {
              print "<span class='button-4' role='button'>Declined</button>";
            } else {
              print "<span class='button-2' role='button'>Pending</button>";

            }

            ?>

          </strong></td>

      </tr>
    </table>
  </div>
  <br>
  <?php
  if ($hod_approval === 'Approved' && $pm_approval === 'Approved' && $billing_approval === 'Approved' && $billing2_approval === 'Approved' && $finance_approval === 'Approved' && $ceo_approval === 'Approved' && $account_approval === 'Approved') {
    ?>
    <strong>
      <center>
        <div class="containerpdf">
          Convert to PDF
        </div>
    </strong>
    </center>
    <center>
      <?php
      $sql = "SELECT * FROM travel_details WHERE tclaims_id = '" . $id . "'";
      $result = mysqli_query($mysqli, $sql);
      while ($row2 = mysqli_fetch_array($result)) {
        $traveldetails = $row2['traveldetails_id'];
      }
      ?>
      <div class="below-containerpdf">
        <a href="?page=advancegeneratePDF&id=<?php echo $id; ?>" class="link-dark">
          <i class="fa-sharp fa-solid fa-file-pdf"></i>
        </a><br><br>
        Click to convert to PDF

      </div>
    </center>
    <?php

  }
  ?>
  </div>