<?php

	include "../../config.php";
	
	$staffno = $_POST["post_by"];
	$cur_staff = $_POST["cur_staff"];
	
	
	$q = mysqli_query($mysqli,"SELECT * FROM intra_friend WHERE friend_a='".$staffno."' OR friend_b='".$staffno."' AND friend_stat='0'");
	$friend_data = array();
	$friend_data[] = "'".$staffno."'";
	
	if($_POST["post_des"]!=""){
		if($staffno==$cur_staff){
			$cat = 1;
		}
		else{
			$cat = 2;
		}
		$insert = mysqli_query($mysqli,"INSERT INTO intra_timeline (tl_cat, tl_date, tl_time, tl_staff, tl_by, tl_des, tl_update_date, tl_update_time) VALUES ('".$cat."', '".date("Y-m-d")."', '".date("H:i:s")."', '".$staffno."','".$cur_staff."', '".mysqli_real_escape_string($mysqli, $_POST["post_des"])."', '".date("Y-m-d")."', '".date("H:i:s")."')");
	
		$q = mysqli_query($mysqli,"SELECT * FROM intra_timeline WHERE tl_staff='".$staffno."' ORDER BY tl_id DESC");
		$r = mysqli_fetch_array($q);
		
		//$q = mysqli_query($mysqli,"SELECT * FROM intra_timeline WHERE tl_id=".$r["tl_id"]);
		//$r = mysqli_fetch_array($q);
		
		$staff_data = staff_details($r["tl_staff"]);
		$staff_by = staff_details($r["tl_by"]);
		
		$post_since = post_duration($r["tl_date"]." ".$r["tl_time"]);
		print "<div style='margin-top:5px;border:1px solid #ccc;padding:5px;'><div style='width:30px;height:30px;float:left;background-image: url(".$staff_data["photo"].");background-size:30px;margin:3px;'></div><a href='?page=staff&act=profile&staff=".$r["tl_staff"]."'>".$staff_data["name"]."</a> [".$staff_data["dept"]."]";
		if($r["tl_cat"]==1){
			print " Updated ".$staff_data["add"]." <a href='?page=staff&act=view_post&id=".$r["tl_id"]."'>Status</a>";
		}
		if($r["tl_cat"]==2){
			print " Posted On <a href='?page=staff&act=profile&staff=".$r["tl_by"]."'>".$staff_by["name"]."</a> [".$staff_by["dept"]."] <a href='?page=staff&act=view_post&id=".$r["tl_id"]."'>Profile</a>";
		}
		print"<br />
		<em>a moment ago.</em><br />
		".nl2br($r["tl_des"])."
		<hr style='clear:both;' />";
			
		display_comment($r["tl_id"]);
			
		print"</div>";
		exit;
	}
?>