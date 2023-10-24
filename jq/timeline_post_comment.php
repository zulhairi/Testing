<?php

	include "../../config.php";
	
	$post_id = $_POST["post_id"];
	$post_des = $_POST["post_des"];
	$staffno = $_POST["post_by"];
	
	
	$q = mysqli_query($mysqli,"SELECT * FROM intra_friend WHERE friend_a='".$staffno."' OR friend_b='".$staffno."' AND friend_stat='0'");
	$friend_data = array();
	$friend_data[] = "'".$staffno."'";
	
	$pq = mysqli_query($mysqli,"SELECT * FROM intra_timeline WHERE tl_id=".$post_id);
	$pr = mysqli_fetch_array($pq);
	
	if($post_des!=""){
		//$insert = mysqli_query($mysqli,"INSERT INTO intra_timeline (tl_cat, tl_date, tl_time, tl_staff, tl_by, tl_des) VALUES ('".$cat."', '".date("Y-m-d")."', '".date("H:i:s")."', '".$staffno."','".$cur_staff."', '".mysqli_real_escape_string($mysqli, $_POST["post_des"])."')");
		mysqli_query($mysqli,"INSERT INTO intra_timeline_comment (com_post, com_date, com_time, com_staff, com_des) VALUES ('".$post_id."', '".date("Y-m-d")."', '".date("H:i:s")."', '".$staffno."', '".addslashes($post_des)."')");
		mysqli_query($mysqli,"UPDATE intra_timeline SET tl_update_date='".date("Y-m-d")."', tl_update_time='".date("H:i:s")."' WHERE tl_id=".$post_id);
		
		$subject = "Chill Room Notification";
		$content = "Hi,<br /><br />Someone commented on post \"".$pr["tl_des"]."\"<br />You can read it <a href=\'?page=staff&act=view_post&id=".$post_id."\'>here</a><br /><br />Regards<br />Intranet Services<br /><em>* Intranet Is Evolving. If You Found Error Or Got Any Suggetion, Please Inform IT Team</em>";
		//send to main author a
		if($pr["tl_staff"]!=$staffno){
		$query = "INSERT INTO intra_msg 
		(msg_date, msg_time, msg_staff, msg_from, msg_title, msg_des, msg_stat) 
		VALUES 
		('".date("Y-m-d")."', '".date("H:i:s")."', '".$pr["tl_staff"]."', 'admin', '".$subject."', '".$content."','0')";
		mysqli_query($mysqli,$query);
		}
		//send to main author b
		if($pr["tl_staff"]!=$pr["tl_by"]){
		$query = "INSERT INTO intra_msg 
		(msg_date, msg_time, msg_staff, msg_from, msg_title, msg_des, msg_stat) 
		VALUES 
		('".date("Y-m-d")."', '".date("H:i:s")."', '".$pr["tl_by"]."', 'admin', '".$subject."', '".$content."','0')";
		}
		//send to commentor
		$cq = mysqli_query($mysqli,"SELECT * FROM intra_timeline_comment WHERE com_post=".$post_id." AND com_staff!='".$staffno."' AND com_staff!='".$pr["tl_staff"]."' AND com_staff!='".$pr["tl_by"]."' GROUP BY com_staff");
		while($cr = mysqli_fetch_array($cq)){
			$query = "INSERT INTO intra_msg 
			(msg_date, msg_time, msg_staff, msg_from, msg_title, msg_des, msg_stat) 
			VALUES 
			('".date("Y-m-d")."', '".date("H:i:s")."', '".$cr["com_staff"]."', 'admin', '".$subject."', '".$content."','0')";
			mysqli_query($mysqli,$query);
		}
		display_comment($post_id);
		exit;
	}
?>