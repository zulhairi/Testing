<?php

	include "../../config.php";
	
	$comment_id = $_POST["comment_id"];

	mysqli_query($mysqli,"DELETE FROM intra_timeline_comment WHERE com_id=".$comment_id);	
	exit;
	
?>