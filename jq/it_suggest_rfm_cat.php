<?php
include "../../config.php";
if(isset($_GET["cat"])){
	$cat = $_GET["cat"];
}
else{
	$cat = 1;
}
$top_dept = $_GET["top_dept"];
//$query = "SELECT * FROM it_rfm_cat_sub WHERE cat_cat='".$cat."' AND cat_id!=26 AND cat_id!=27 ORDER BY cat_sub";
	$query = "SELECT * FROM it_rfm_cat_sub WHERE cat_cat='".$cat."' AND cat_id!=26 ORDER BY cat_sub";
$result = mysqli_query($mysqli,$query);
//print "<option value=''>Please Select</option>";		
while ($row = mysqli_fetch_array($result)) {
   	echo "<option value='".$row{'cat_id'}."'>".$row{'cat_sub'}."</option>";
	
	
	
}
?>