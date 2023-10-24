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

  <div class="container" style="margin-center;">
    <table class="table table-striped text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
      <thead class="head">
        <tr style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
          <th scope="col" colspan="4" style="white-space: nowrap;">Name</th>
          <th scope="col" colspan="1" style="white-space: nowrap;">Position</th>
          <th scope="col" colspan="2" style="white-space: nowrap;">Staff No</th>
          <th scope="col" colspan="2" style="white-space: nowrap;">Division</th>
          <th scope="col" colspan="5" style="white-space: nowrap;">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $id = $_GET['id'];
        $sql = "SELECT * FROM entertainmentclaim WHERE entertainment_claim = '" . $id . "'";
        $result = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $id2 = $row["entertainment_claim"];
          ?>
          <tr class="table-light">
            <td colspan="4" style="font-weight: bold;"><br>
              <?php echo $row["name"] ?>
            </td>
            <td colspan="1" style="font-weight: bold;"><br>
              <?php echo $row["position"] ?>
            </td>
            <td colspan="2" style="font-weight: bold;"><br>
              <?php echo $row["staffno"] ?>
            </td>
            <td colspan="2" style="font-weight: bold;"><br>
              <?php echo $row["division"] ?>
            </td>
            <td colspan="6" style="font-weight: bold;"><br>
              <?php echo "RM" . $row["total"] ?>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>

  </div>

  <thead class="head">
    <tr>
      <th colspan="14" scope="col" style="white-space: nowrap; background-color:white;"></th>
    </tr>
  </thead>

  <thead class="head">
    <tr>
      <th scope="col" colspan="2" style="white-space: nowrap;">Date</th>
      <th scope="col" style="white-space: nowrap;">Bill</th>
      <th scope="col" style="white-space: nowrap;">Company</th>
      <th scope="col" style="white-space: nowrap;">Person</th>
      <th scope="col" style="white-space: nowrap;">Designation</th>
      <th scope="col" style="white-space: nowrap;">Project</th>
      <th scope="col" colspan="2" style="white-space: nowrap;">Amount</th>
      <th scope="col" colspan="3" style="white-space: nowrap;">Remarks</th>
      <th scope="col" colspan="4" style="white-space: nowrap;"></th>

    </tr>
  </thead>

  <tbody>
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM entertainment_details WHERE eclaims_id = '" . $id . "'";
    $result_travel_details = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($result_travel_details) > 0) {
      while ($row_entertainment_details = mysqli_fetch_assoc($result_travel_details)) {
        ?>
        <tr class="table-light">
          <td colspan="2" style="font-weight: bold;"><br>
            <?php echo $row_entertainment_details['date'] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_entertainment_details["bill"] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_entertainment_details["company"] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_entertainment_details["person"] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_entertainment_details["designation"] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_entertainment_details["project"] ?>
          </td>
          <td colspan="2" style="font-weight: bold;"><br>
            <?php echo "RM" . $row_entertainment_details["amount"] ?>
          </td>
          <td><br>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_entertainment_details["remarks"] ?>
          </td>
          <td style="font-weight: bold;">
            <br>

          </td>

          <?php


          $qhod = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id =" . $id);
          $rhod = mysqli_fetch_array($qhod);

          $q = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
          $r = mysqli_fetch_array($q);
          $firstApproverStatus = $r["approval_status"];

          if ($firstApproverStatus === 'pending') {
            $sql2 = "SELECT COUNT(*) AS num_amounts FROM entertainment_details WHERE eclaims_id = '$id'";
            $result2 = mysqli_query($mysqli, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $numAmounts = $row2['num_amounts'];

            $editUrl = "?page=editentertainment&edetails_id=" . $row_entertainment_details['edetails_id'] . "&id=" . $id;
            $deleteUrl = "?page=detailsummary3&edetails_id=" . $row_entertainment_details['edetails_id'] . "&id=" . $id;

            echo '<td><br>';
            echo '<a href="' . $editUrl . '" class="link-dark"><i class="fa-solid fa-pen-to-square"></i></a>';
            echo '</td>';

            if ($numAmounts > 1) {
              echo '<td><br>';
              // echo '<a href="' . $deleteUrl . '" class="link-dark"><i class="fa-solid fa-trash-can"></i></a>';
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
    if (isset($_GET['edetails_id']) && isset($_GET['id'])) {
      $traveldetails_id = $_GET['edetails_id'];
      $tclaims_id = $_GET['id'];

      $sql2 = "DELETE FROM entertainment_details WHERE edetails_id = '$traveldetails_id' AND eclaims_id = '$tclaims_id' ";
      mysqli_query($mysqli, $sql2);

      $sql = "SELECT SUM(amount) AS total_amount FROM entertainment_details WHERE eclaims_id = '$tclaims_id'";
      $result = mysqli_query($mysqli, $sql);
      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $totalAmount = $row['total_amount'];

        $sql3 = "UPDATE entertainmentclaim SET total = '$totalAmount' WHERE entertainment_claim = '$tclaims_id'";
        mysqli_query($mysqli, $sql3);

        if ($totalAmount == 0) {

          $sql5 = "DELETE FROM entertainment_details WHERE eclaims_id = '$tclaims_id'";
          mysqli_query($mysqli, $sql5);

          $sql6 = "DELETE FROM entertainment_claim WHERE entertainment_claim = '$tclaims_id'";
          mysqli_query($mysqli, $sql6);

          $goto = "?page=entertainmentsummary";
          $msg = "Deleting <img src='images/loading.gif' />";
          $func->info($msg, $goto);
        } else {
          $goto = "?page=detailsummary3&id=$tclaims_id";
          $msg = "Deleting <img src='images/loading.gif' />";
          $func->info($msg, $goto);
        }
      } else {
        $sql5 = "DELETE FROM entertainment_details WHERE eclaims_id = '$tclaims_id'";
        mysqli_query($mysqli, $sql5);

        $sql6 = "DELETE FROM entertainment_claim WHERE entertainment_claim = '$tclaims_id'";
        mysqli_query($mysqli, $sql6);

        $goto = "?page=entertainmentsummary";
        $msg = "Deleting <img src='images/loading.gif' />";
        $func->info($msg, $goto);
      }
    }
    ?>

  </tbody>
  <thead class="head">
    <tr>
      <th scope="col" colspan="14" style="white-space: nowrap; background-color:white;"></th>
    </tr>
  </thead>

  <thead class="head">
    <tr>
      <th scope="col" colspan="14" style="text-align: center; white-space: nowrap; font-size:20px;">Attachment</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM entertainment_details WHERE eclaims_id = '" . $id . "'";
    $result = mysqli_query($mysqli, $sql);
    ?>

    <tr class="table-light">
      <td scope="col" colspan="14" style="text-align: center; white-space: nowrap;">
        <div style="display: flex; justify-content: flex-start;">
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            $attachment = $row["attachment"];
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
          ?>
        </div>
      </td>
    </tr>

  </tbody>

  <thead class="head">
    <tr>
      <th scope="col" colspan="9" style="white-space: nowrap; background-color:white;"></th>

      <th colspan="5" scope="col" style="white-space: nowrap; background-color:white;"></th>
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
      
      $sl = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = '" . $id . "'");
      while ($sq = mysqli_fetch_array($sl)) {

        if ($sq["approval_level_id"] == 10) {
          $approval_status = $sq["approval_status"];
        }
         elseif ($sq["approval_level_id"] == 11) {
          $billing_approval = $sq["approval_status"];
        }
         elseif ($sq["approval_level_id"] == 12) {
          $billing2_approval = $sq["approval_status"];
        }
         elseif ($sq["approval_level_id"] == 13) {
          $account_approval = $sq["approval_status"];
        
        } elseif ($sq["approval_level_id"] == 14) {
          $payroll_approval = $sq["approval_status"];
        }
         else {
          print "UNKNOWN";
        }

      }

      ?>
      <tr>
        <td class="cell-gap" valign="top">HOD Approval : <br><strong>

            <?php

            if ($approval_status == "Approved") {
              print "<span class='button-3' role='button'>Approved</button>";
            } else if ($approval_status == "Declined") {
              print "<span class='button-4' role='button'>Declined</button>";
            } else {
              print "<span class='button-2' role='button'>Pending</button>";

            }

            ?>

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

        <td class="cell-gap" valign="top">Account Approval: <br><strong>

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

        <td class="cell-gap" valign="top">Payroll Approval: <br><strong>

            <?php

            if ($payroll_approval == "Approved") {
              print "<span class='button-3' role='button'>Approved</button>";
            } else if ($payroll_approval == "Declined") {
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

  if ($approval_status === 'Approved' && $billing_approval === 'Approved' && $billing2_approval === 'Approved' && $account_approval === 'Approved' && $payroll_approval === 'Approved') {
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
      $sql = "SELECT * FROM entertainment_details WHERE eclaims_id = '" . $id . "'";
      $result = mysqli_query($mysqli, $sql);
      while ($row2 = mysqli_fetch_array($result)) {
        $edetails = $row2['edetails_id'];
      }
      ?>
      <div class="below-containerpdf">
        <a href="?page=generatePDFentertain&id=<?php echo $id; ?>&edetails_id=<?php echo $edetails; ?>" 
        class="link-dark">
          <i class="fa-sharp fa-solid fa-file-pdf"></i>
        </a><br><br>
        Click to convert to PDF

      </div>
    </center>
    <?php

  }
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