<?php
	
  $q = mysqli_query($mysqli,"SELECT * FROM otmealclaim WHERE otmeal_id=".$_GET["id"]);
	$r = mysqli_fetch_array($q);
		
	$auq = mysqli_query($mysqli,"SELECT * FROM otmeal_details WHERE otclaim_id=".$_GET["id"]);
	$aur = mysqli_fetch_array($auq);

  $sq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno = '".$ses_staffno."'");
	$sr = mysqli_fetch_array($sq);

?>

<style type="text/css">
   @media print {
        @page {
          margin: 0;
        }
      }

body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #000;
}
body {
	margin-left: 10px;
	margin-top: 10px;
	margin-right: 10px;
	margin-bottom: 10px;
}
</style>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td colspan="2" valign="top"><img src="images/laterhead.jpg" width="430" height="72">
    <hr /></td>
    <td colspan="2" rowspan="8"> <table width="100%" border="1" cellspacing="0" cellpadding="3">
    <tr>
        <td colspan="10" valign="top" style="height: 50px; padding-top:20px;"><strong><center>For Billings and Accounts Use Only</center></strong></td>
  	</tr>
       
    <!-- <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr> -->
    
    
     <tr>
    <td style="height: 200px; padding-bottom:200px;">&nbsp; Additional Comments : </td>
    </tr>
    
    </table></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><h2>OT MEAL ALLOWANCE FORM</h2><hr /></td>
  </tr>
  <tr>
    <td width="25%"><strong>Name</strong></td>
    <td width="25%"><strong>Staff No</strong></td>
    
  </tr>
  <tr>
    <td><?php print $r["name"];?></td>
    <td><?php print $r["staffno"];?></td>
</td>
  </tr>
  
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  
  <tr>
  <td width="25%"><strong>Department</strong></td>
  </tr>
  
   <tr>
   <td><?php print $r["department"];?></td>
  </tr>
  
 <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
   
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
  
  <tr>
    <td><strong>Date</strong></td>
    <td><strong>Day</strong></td>
    <td><strong>Staff</strong></td>
    <td><strong>Project</strong></td>
  </tr>


   <?php
 $counter = 1;
 $uq = mysqli_query($mysqli, "SELECT * FROM otmeal_details WHERE otclaim_id=" . $_GET["id"]);
 while ($ur = mysqli_fetch_array($uq)) {
  ?>
  <tr>
    <td><?php print $ur["date"]?></td>
    <td><?php print $ur["day"];?></td>
    <td><?php print $ur["staff"];?></td>
    <td><?php print $ur["project"];?></td>
  </tr>
  <?php
 }
  ?>
  
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  
  <tr>
    <td><strong>Time Check-In (Normal Hours)</strong></td>
    <td><strong>Time Out (Normal Hours)</strong></td>
    <td><strong>Time Check-In (Overtime)</strong></td>
    <td><strong>Time Out (Overtime)</strong></td>
  </tr>
  
  <?php
 $counter = 1;
 $uq = mysqli_query($mysqli, "SELECT * FROM otmeal_details WHERE otclaim_id=" . $_GET["id"]);
 while ($ur = mysqli_fetch_array($uq)) {
  ?>
  <tr>
    <td><?php print $ur["time_in_nh"]?></td>
    <td><?php print $ur["time_out_nh"]?></td>
    <td><?php print $ur["time_in_ot"]?></td>
    <td><?php print $ur["time_out_ot"]?></td>
  </tr>
  <?php
 }
  ?>

  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>

  <tr>
    <td><strong>Total OT Hours</strong></td>
    <td><strong>Amount</strong></td>
 
  </tr>
  
  <?php
 $counter = 1;
 $uq = mysqli_query($mysqli, "SELECT * FROM otmeal_details WHERE otclaim_id=" . $_GET["id"]);
 while ($ur = mysqli_fetch_array($uq)) {
  ?>
  <tr>
    <td><?php print $ur["total_ot_hours"]?></td>
    <td><?php print "RM".$ur["amount"]?></td>

  <?php
  
 }
  ?>
  <tr>
     <td><strong>Total :</strong></td>
</tr>
      <td><?php print "RM".$r["total"]?></td>
  </tr>

  
  <tr>
    <td colspan="4"><hr /></td>
  </tr>

  <tr>
    <td><strong>HOD Approval</strong></td>
    <td><strong>Billing 1 Approval</strong></td>
    <td><strong>Billing 2 Approval</strong></td>
    <td><strong>Finance Approval</strong></td>

  </tr>
  
  <tr>
    <td><?php 
$sql5 = mysqli_query($mysqli, "SELECT * FROM otmealclaim WHERE otmeal_id=".$_GET["id"]);
while ($dql5 = mysqli_fetch_array($sql5)) 
{
    $id5 = $dql5["otmeal_id"];

    $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 24";
    $result6 = mysqli_query($mysqli, $sql6);
    $row6 = mysqli_fetch_assoc($result6);

    $hod = $row6["staffno"];
    $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
    $result7 = mysqli_query($mysqli, $sql7);
    $row7 = mysqli_fetch_array($result7);
    echo "<strong>".$row7["name"]."</strong>";

}
    
    ?></td>
    <td><?php
    $sql5 = mysqli_query($mysqli, "SELECT * FROM otmealclaim WHERE otmeal_id=".$_GET["id"]);
    while ($dql5 = mysqli_fetch_array($sql5)) 
    {
        $id5 = $dql5["otmeal_id"];
  
        $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 25";
        $result6 = mysqli_query($mysqli, $sql6);
        $row6 = mysqli_fetch_assoc($result6);
  
        $hod = $row6["staffno"];
        $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
        $result7 = mysqli_query($mysqli, $sql7);
        $row7 = mysqli_fetch_array($result7);
        echo "<strong>".$row7["name"]."</strong>";
  
    }
    
    ?></td>
    <td><?php 
    $sql5 = mysqli_query($mysqli, "SELECT * FROM otmealclaim WHERE otmeal_id=".$_GET["id"]);
    while ($dql5 = mysqli_fetch_array($sql5)) 
    {
        $id5 = $dql5["otmeal_id"];
  
        $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 26";
        $result6 = mysqli_query($mysqli, $sql6);
        $row6 = mysqli_fetch_assoc($result6);
  
        $hod = $row6["staffno"];
        $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
        $result7 = mysqli_query($mysqli, $sql7);
        $row7 = mysqli_fetch_array($result7);
        echo "<strong>".$row7["name"]."</strong>";
  
    }
    
    ?></td>
    <td><?php 
    $sql5 = mysqli_query($mysqli, "SELECT * FROM otmealclaim WHERE otmeal_id=".$_GET["id"]);
    while ($dql5 = mysqli_fetch_array($sql5)) 
    {
        $id5 = $dql5["otmeal_id"];
  
        $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 27";
        $result6 = mysqli_query($mysqli, $sql6);
        $row6 = mysqli_fetch_assoc($result6);
  
        $hod = $row6["staffno"];
        $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
        $result7 = mysqli_query($mysqli, $sql7);
        $row7 = mysqli_fetch_array($result7);
        echo "<strong>".$row7["name"]."</strong>";
  
    }

    ?></td>
  </tr>

  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>

  <tr>
    <td><strong>Payroll Approval</strong></td>
  </tr>
  
  <tr>
  <td><?php
  $sql5 = mysqli_query($mysqli, "SELECT * FROM otmealclaim WHERE otmeal_id=".$_GET["id"]);
  while ($dql5 = mysqli_fetch_array($sql5)) 
  {
      $id5 = $dql5["otmeal_id"];

      $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 28";
      $result6 = mysqli_query($mysqli, $sql6);
      $row6 = mysqli_fetch_assoc($result6);

      $hod = $row6["staffno"];
      $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
      $result7 = mysqli_query($mysqli, $sql7);
      $row7 = mysqli_fetch_array($result7);
      echo "<strong>".$row7["name"]."</strong>";

  }
  ?></td>
  </tr>

  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>

  <tr>
    <td width="25%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
  </tr>
</table>
<script type="text/javascript" language="javascript">
print();
//close();
</script>
