<?php

	include "../../config.php";
	
	$post_id = $_POST["post_id"];
	mysqli_query($mysqli,"DELETE FROM intra_timeline WHERE tl_id=".$post_id);	
	mysqli_query($mysqli,"DELETE FROM intra_timeline_comment WHERE com_post=".$post_id);	
	exit;
	
?>