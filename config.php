<?php
#database connection
//define the host
if ((strtotime(date("Y-m-d"))) > (strtotime(date("2020-10-12")))) {
    //websvr03
    define("SQL_URL", "10.10.6.21");
} else {
    //localhost
    define("SQL_URL", "10.10.6.20");
}

//define the user ( usually root for the localhost )
define("SQL_ID", "root");

//define the password ( usually empty for the localhost )
define("SQL_PWD", "2907database");

//define the databse that you used
define("SQL_DB", "minconsult_new");

define("num", 0);

error_reporting(E_ALL ^ E_NOTICE);

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "idx";
}

if (isset($_GET["act"])) {
    $act = $_GET["act"];
} else {
    $act = "idx";
}

class MFUNC
{
    public function info($msg, $goto)
    {
        print "<meta HTTP-EQUIV='REFRESH' CONTENT='1; URL=" . $goto . "'>" . $msg;
    }
    public function infos($msg, $goto)
    {
        print "<meta HTTP-EQUIV='REFRESH' CONTENT='1; URL=" . $goto . "'>" . $msg;
    }
    public function log_act($log_staff, $log_query)
    {
        global $mysqli;
        mysqli_query($mysqli, "INSERT INTO log_hr (log_staff,log_date,log_time,log_query) VALUES
				('" . $log_staff . "','" . date("Y-m-d") . "','" . date("h:i:s A") . "','" . $log_query . "')");
    }
    public function dateDiff($start, $end)
    {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
}
$func = new MFUNC();
$mysqli = mysqli_connect(SQL_URL, SQL_ID, SQL_PWD, SQL_DB) or die("Sorry... There's not connected");
//$project = 2;
/*

//select the catabase that you want to use
//mysqli->select_db(SQL_DB) or die ("Sorry...cannot reached the database");
 */
$egoto = $_SERVER['PHP_SELF'];
$emsg = "System Refresing...";
//mysqli_connect(SQL_URL, SQL_ID, SQL_PWD) or die($func    -> info($emsg,$egoto));
//mysqli_select_db(SQL_DB) or die($func    -> info($emsg,$egoto));

date_default_timezone_set('Asia/Kuala_Lumpur');
setlocale(LC_MONETARY, 'en_US');
$date = date('d-m-Y');
$altdate = date('Y-m-d');
$hour = date("h:i A");

$tday = date('d');
$tmonth = date('m');
$tyear = date('Y');
$thour = date('h');
$tmin = date('i');
$wday = date('l');

function validateDate($date ,$staffno)
{
    $format = 'Y-m-d';
   
    
    global $mysqli;
    $q = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno ='".$staffno."'");
    $r = mysqli_fetch_array($q);

    if ($r["date_resigned"] != "0000-00-00") {
        
        return $r["date_resigned"];
    }else{
        $d = DateTime::createFromFormat($format, $date);
        if($d && $d->format($format) == $date){
            return $date;
        }else{
            return date("Y-m-d");
        }
    }

}

function recap($name)
{
    $name = ucwords(strtolower($name));
    $name = str_ireplace("A/L", "A/L", $name);
    $name = str_ireplace("A/P", "A/P", $name);
    $name = str_ireplace("A/K", "A/K", $name);
    $name = str_ireplace("S/O", "S/O", $name);
    $name = str_ireplace("D/O", "D/O", $name);
    $name = str_ireplace("YM", "YM", $name);
    $name = str_ireplace("Y.M", "Y.M", $name);
    return $name;
}

function calculateAge($birthday)
{

    return floor((time() - strtotime($birthday)) / 31556926);

}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function generateRandomStrings($length = 5)
{
    $characters = '2345678923456789ABCDEFGHJKLMNPQRSTUVWXYZABCDEFGHJKLMNPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function staff_photo($staffno, $height, $text)
{
    global $mysqli;
    $uq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno='" . $staffno . "'");
    $ur = mysqli_fetch_array($uq);
    $filename = "../staff_photo/" . $ur["staffno"] . ".bmp";

    if (file_exists($filename)) {
        $dp = $ur["staffno"] . ".bmp";
    } else {
        $dp = "default.jpg";
    }
    $ppq = mysqli_query($mysqli, "SELECT * FROM intra_picture_profile WHERE item_staff='" . $ur["staffno"] . "'");
    if (mysqli_num_rows($ppq) > 0) {
        $ppr = mysqli_fetch_array($ppq);
        print "<img src='upload/personal/" . $ur["staffno"] . "/" . $ppr["item_title"] . "' height='" . $height . "' align='left' border='0' class='short_cut' hspace='5' vspace='0' title='" . $text . "" . recap($ur["name"]) . " (" . $ur["div_code"] . ")' />";
    } else {
        print "<img src='../staff_photo/" . $dp . "' height='" . $height . "' align='left' border='0' class='short_cut' hspace='5' vspace='0' title='" . $text . "" . recap($ur["name"]) . " (" . $ur["div_code"] . ")' />";
    }
}

function staff_photos($staffno, $height)
{
    global $top_dept, $mysqli;
    $uq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno='" . $staffno . "'");
    $ur = mysqli_fetch_array($uq);
    $filename = "../staff_photo/" . $ur["staffno"] . ".bmp";

    if (file_exists($filename)) {
        $dp = $ur["staffno"] . ".bmp";
    } else {
        $dp = "default.jpg";
    }
    if ($top_dept == $ur["div_code"]) {
        $ppq = mysqli_query($mysqli, "SELECT * FROM intra_picture_profile WHERE item_staff='" . $ur["staffno"] . "'");
        if (mysqli_num_rows($ppq) > 0) {
            $ppr = mysqli_fetch_array($ppq);
            print "<img src='upload/personal/" . $ur["staffno"] . "/" . $ppr["item_title"] . "' height='" . $height . "' border='0' class='short_cut' />";
        } else {
            print "<img src='../staff_photo/" . $dp . "' height='" . $height . "' border='0' class='short_cut' />";
        }
    } else {
        print "<img src='../staff_photo/" . $dp . "' height='" . $height . "' border='0' class='short_cut' />";
    }

}

function early($firstTime, $lastTime)
{
    $array_td = array("0" => "00",
        "1" => "01",
        "2" => "02",
        "3" => "03",
        "4" => "04",
        "5" => "05",
        "6" => "06",
        "7" => "07",
        "8" => "08",
        "9" => "09",
        "10" => "10",
        "11" => "11",
        "12" => "12",
        "13" => "13",
        "14" => "14",
        "15" => "15",
        "16" => "16",
        "17" => "17",
        "18" => "18",
        "19" => "19",
        "20" => "20",
        "21" => "21",
        "22" => "22",
        "23" => "23",
        "24" => "24",
        "25" => "25",
        "26" => "26",
        "27" => "27",
        "28" => "28",
        "29" => "29",
        "30" => "30",
        "31" => "31",
        "32" => "32",
        "33" => "33",
        "34" => "34",
        "35" => "35",
        "36" => "36",
        "37" => "37",
        "38" => "38",
        "39" => "39",
        "40" => "40",
        "41" => "41",
        "42" => "42",
        "43" => "43",
        "44" => "44",
        "45" => "45",
        "46" => "46",
        "47" => "47",
        "48" => "48",
        "49" => "49",
        "50" => "50",
        "51" => "51",
        "52" => "52",
        "53" => "53",
        "54" => "54",
        "55" => "55",
        "56" => "56",
        "57" => "57",
        "58" => "58",
        "59" => "59",
        "60" => "00",
    );
    //initial strings
    $ts = $firstTime;
    $ts1 = $lastTime;

    //converting to time
    $start = strtotime($ts);
    $end = strtotime($ts1);

    //calculating the difference
    $difference = $end - $start;

    //calculating hours, minutes and seconds (as floating point values)
    $hours = $difference / 3600; //one hour has 3600 seconds
    $minutes = ($hours - floor($hours)) * 60;
    $seconds = ($minutes - floor($minutes)) * 60;

    //formatting hours, minutes and seconds
    $final_hours = floor($hours);
    $final_minutes = floor($minutes);
    $final_seconds = floor($seconds);
    if ($final_hours < 1) {
        $final_hours = 0;
    }
    //output
    //print $array_td[$final_hours].":".$array_td[$final_minutes].":".$array_td[$final_seconds];
    //echo $final_hours.":".$final_minutes.":".$final_seconds;
    //return date("H:i",$timeDiff);
    print $array_td[$final_hours] . ":" . $array_td[$final_minutes];
}

function earlyb($firstTime, $lastTime)
{

    $array_td = array("0" => "00",
        "1" => "01",
        "2" => "02",
        "3" => "03",
        "4" => "04",
        "5" => "05",
        "6" => "06",
        "7" => "07",
        "8" => "08",
        "9" => "09",
        "10" => "10",
        "11" => "11",
        "12" => "12",
        "13" => "13",
        "14" => "14",
        "15" => "15",
        "16" => "16",
        "17" => "17",
        "18" => "18",
        "19" => "19",
        "20" => "20",
        "21" => "21",
        "22" => "22",
        "23" => "23",
        "24" => "24",
        "25" => "25",
        "26" => "26",
        "27" => "27",
        "28" => "28",
        "29" => "29",
        "30" => "30",
        "31" => "31",
        "32" => "32",
        "33" => "33",
        "34" => "34",
        "35" => "35",
        "36" => "36",
        "37" => "37",
        "38" => "38",
        "39" => "39",
        "40" => "40",
        "41" => "41",
        "42" => "42",
        "43" => "43",
        "44" => "44",
        "45" => "45",
        "46" => "46",
        "47" => "47",
        "48" => "48",
        "49" => "49",
        "50" => "50",
        "51" => "51",
        "52" => "52",
        "53" => "53",
        "54" => "54",
        "55" => "55",
        "56" => "56",
        "57" => "57",
        "58" => "58",
        "59" => "59",
        "60" => "00",
    );
    //initial strings
    $ts = $firstTime;
    $ts1 = $lastTime;

    //converting to time
    $start = strtotime($ts);
    $end = strtotime($ts1);

    //calculating the difference
    $difference = $end - $start;

    //calculating hours, minutes and seconds (as floating point values)
    $hours = $difference / 3600; //one hour has 3600 seconds
    $minutes = ($hours - floor($hours)) * 60;
    $seconds = ($minutes - floor($minutes)) * 60;

    //formatting hours, minutes and seconds
    $final_hours = floor($hours);
    $final_minutes = floor($minutes);
    $final_seconds = floor($seconds);
    if ($final_hours < 1) {
        $final_hours = 0;
    }
    //output
    //print $array_td[$final_hours].":".$array_td[$final_minutes].":".$array_td[$final_seconds];
    //echo $final_hours.":".$final_minutes.":".$final_seconds;
    //return date("H:i",$timeDiff);
    return $array_td[$final_hours] . ":" . $array_td[$final_minutes];

}

function post_duration($eventTime)
{

    $totaldelay = time() - strtotime($eventTime);
    if ($totaldelay <= 0) {
        return '';
    } else {
        if ($days = floor($totaldelay / 86400)) {
            $totaldelay = $totaldelay % 86400;
            return $days . ' days ago.';
        }
        if ($hours = floor($totaldelay / 3600)) {
            $totaldelay = $totaldelay % 3600;
            return $hours . ' hours ago.';
        }
        if ($minutes = floor($totaldelay / 60)) {
            $totaldelay = $totaldelay % 60;
            return $minutes . ' minutes ago.';
        }
        if ($seconds = floor($totaldelay / 1)) {
            $totaldelay = $totaldelay % 1;
            return $seconds . ' seconds ago.';
        }
    }}

function staff_details($staffno)
{
    global $mysqli;
    $uq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno='" . $staffno . "'");
    $ur = mysqli_fetch_array($uq);
    $nick_name = $ur["em_nickname"];
    if ($ur["sex"] == 1) {
        $add = "His";
    } else {
        $add = "Her";
    }
    
    if ($nick_name == null || $nick_name == "" || $nick_name == "disable") {
        $name = recap($ur["name"]);
    } else {
        $name = $nick_name;
    }

    $filename = "../staff_photo/" . $ur["staffno"] . ".bmp";
    if (file_exists($filename)) {
        $dp = $ur["staffno"] . ".bmp";
       
    } else {
        $dp = "default.jpg";
        
    }
    $ppq = mysqli_query($mysqli, "SELECT item_title FROM intra_picture_profile WHERE item_staff='" . $staffno . "'");
    if (mysqli_num_rows($ppq) > 0) {
        $ppr = mysqli_fetch_array($ppq);
        $photo = "upload/personal/" . $staffno . "/" . $ppr["item_title"];
       
        if (!file_exists($photo)) {
            $photo = "../staff_photo/" . $dp;
        }
        //print "<img src='' height='80' align='left' border='0' class='short_cut' hspace='5' vspace='0' style='max-width:80px;' />";
    } else {
        $photo = "../staff_photo/" . $dp;
        // print "<img src='../staff_photo/".$dp."' height='80' align='left' border='0' class='short_cut' hspace='5' vspace='0' />";
       
    }

    $data = array(
        "name" => $name,
        "dept" => $ur["div_code"],
        "photo" => $photo,
        "add" => $add,
        "mail" => $ur["imail"]);

    return $data;}

function staff_info($staff)
{
    global $mysqli;
    $uq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno='" . $staff . "'");
    $ur = mysqli_fetch_array($uq);
    return $ur;
}

function staff_desig($desig)
{
    global $mysqli;
    $uq = mysqli_query($mysqli, "SELECT * FROM hr_designation WHERE desg_code='" . $desig . "'");
    $ur = mysqli_fetch_array($uq);
    return $ur["desg_name"];
}

function display_comment($post_id)
{
    global $ses_staffno, $act, $mysqli;
    print "<div id='comment_" . $post_id . "'>";

    $q = mysqli_query($mysqli, "SELECT * FROM intra_timeline_comment WHERE com_post=" . $post_id . " ORDER BY com_date ASC, com_time ASC");
    $row = mysqli_num_rows($q);
    if ($row <= 3) {
        $display = 1;
    } else {
        if ($act == "view_post") {
            $display = 1;
        } else {
            $display = 2;
            $start_display = $row - 3;
            print "<a href='?page=staff&act=view_post&id=" . $post_id . "'>View More Comment</a>";
        }
    }
    $c = 1;
    while ($r = mysqli_fetch_array($q)) {
        if ($display == 1) {
            if ($cd == 1) {
                $class = "clight";
                $cd = 2;
            } else {
                $class = "cdark";
                $cd = 1;
            }
            $staff_data = staff_details($r["com_staff"]);
            $post_since = post_duration($r["com_date"] . " " . $r["com_time"]);
            print "<div id='item_comment_" . $r["com_id"] . "' class='" . $class . "' style='margin-top:5px;border:0px;padding:5px;'>";
            if ($r["com_staff"] == $ses_staffno) {
                print "<a href='#' onclick='return delete_comment(" . $r["com_id"] . ")'><img id='" . $post_id . "' src='images/cross.png' border='0' style='float:right;margin:3px;' /></a>";
            }
            print "<div style='width:30px;height:30px;float:left;background-image: url(" . $staff_data["photo"] . ");background-size:30px;margin:3px;overflow:hidden;'><img src='" . $staff_data["photo"] . "' width='30px' /></div><a href='?page=staff&act=profile&staff=" . $r["com_staff"] . "'>" . $staff_data["name"] . "</a> [" . $staff_data["dept"] . "]";
            print "<br />
				<em>" . $post_since . "</em><br />";
            print "<em>" . $r["com_des"] . "</em><br style='clear:both;'></div>";
        }

        if ($display == 2) {
            if ($c > $start_display) {
                if ($cd == 1) {
                    $class = "clight";
                    $cd = 2;
                } else {
                    $class = "cdark";
                    $cd = 1;
                }
                $staff_data = staff_details($r["com_staff"]);
                $post_since = post_duration($r["com_date"] . " " . $r["com_time"]);
                print "<div id='item_comment_" . $r["com_id"] . "' class='" . $class . "' style='margin-top:5px;border:0px;padding:5px;'>";
                if ($r["com_staff"] == $ses_staffno) {
                    print "<a href='#' onclick='return delete_comment(" . $r["com_id"] . ")'><img id='" . $post_id . "' src='images/cross.png' border='0' style='float:right;margin:3px;' /></a>";
                }
                print "<div style='width:30px;height:30px;float:left;background-image: url(" . $staff_data["photo"] . ");background-size:30px;margin:3px;overflow:hidden;'><img src='" . $staff_data["photo"] . "' width='30px' /></div><a href='?page=staff&act=profile&staff=" . $r["com_staff"] . "'>" . $staff_data["name"] . "</a> [" . $staff_data["dept"] . "]";
                print "<br />
					<em>" . $post_since . "</em><br />";
                print "<em>" . $r["com_des"] . "</em><br style='clear:both;'></div>";
            }
            $c++;
        }

    }

    print "<form name='borang_" . $post_id . "' method='post' action='' onsubmit='return post_comment(" . $post_id . ");'>
		<input type='text' name='post_com_des_" . $post_id . "' id='post_com_des_" . $post_id . "' style='width:99.5%' placeholder='Place Your Comment Here' />
		</form>";
    print "</div>";
}

function send_mail($from, $staff, $title, $content)
{
    $to = $staff;
    $subject = $title;
    $message = $content;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . $from . "\r\n" .
    'Reply-To: No-Reply' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    if (mail($to, $subject, $message, $headers)) {}
}

function search_array($srchvalue, $array)
{
    if (in_array($srchvalue, $array)) {
        return "KO";
    } else {
        return "OK";
    }
}

function cal_hour($from_date, $from_time, $to_date, $to_time)
{
    global $ph_data;
    $bh1 = "08:30^17:30";
    $bh2 = "08:30^17:30";
    $bh3 = "08:30^17:30";
    $bh4 = "08:30^17:30";
    $bh5 = "08:30^16:30";
    $bh6 = "00:00^00:00";
    $bh0 = "00:00^00:00";

    $seconds = (strtotime($to_date . " " . $to_time) - strtotime($from_date . " " . $from_time));

    $days_between = ceil((strtotime($to_date) - strtotime($from_date)) / 86400);

    $deseconds = 0;
    for ($i = 0; $i <= $days_between; $i++) {

        $cur_date = date("Y-m-d", strtotime($from_date . " +" . $i . "days"));

        //check
        $check_cdate = search_array($cur_date, $ph_data);
        if (($check_cdate == "KO") || (date("w", strtotime($cur_date)) == 0) || (date("w", strtotime($cur_date)) == 6)) {
            if (($days_between == 0) || ($i == $days_between)) {
                $today = 0;
            } else {
                $today = 86400;
            }

        } else {
            //mon-thu
            if ((date("w", strtotime($cur_date)) == 1) || (date("w", strtotime($cur_date)) == 2) || (date("w", strtotime($cur_date)) == 3) || (date("w", strtotime($cur_date)) == 4)) {

                if (($days_between == 0) || ($i == $days_between)) {
                    $today = 0;
                } else {
                    $today = 50400;
                }
            }
            //fri
            else {
                if (($days_between == 0) || ($i == $days_between)) {
                    $today = 0;
                } else {
                    $today = 54000;
                }

            }

        }
        $deseconds = ($deseconds + $today);
    }

    $seconds = ($seconds - $deseconds);

    return $seconds;
}

$rfm_serial = 0;

$array_odt_req = array(
    "0" => "Good To Watch",
    "1" => "Required To Watch",
);

$array_station = array(
    "0" => "NA",
    "1" => "WIO",
    "2" => "WFH",
);

$array_admin_type = array(
    "1" => "Admin",
    "2" => "Moderator",
    "3" => "View Only",
);

$array_train_short = array(
    "1" => "INT",
    "2" => "EXT",
);

$array_train_eva = array("1" => "Interview",
    "2" => "Observation",
    "3" => "Test");

$array_train_effect = array("1" => "Effective",
    "2" => "Not Effective");
$array_sex_short = array(
    "1" => "M",
    "2" => "F",
);
$array_sex = array(
    "1" => "MALE",
    "2" => "FEMALE",
);

$array_cl_cat = array(
    "1" => "General Log",
    "11" => "General Log Reply",
    "2" => "Request Review",
    "21" => "Accepted",
    "22" => "Declined",
);

$array_rfm_stat = array(
    "0" => "New",
    "1" => "Staff Assigned",
    "2" => "In Progress",
    "3" => "Resolved",
    "4" => "Completed &amp; Acknowledged",
    "5" => "Unsatisfied Solution",
    "9" => "Canceled",
    "10" => "Rejected",
);

$array_rfm_stat_local = array(
    "0" => "Null",
    "1" => "New",
    "2" => "Progress",
    "3" => "Completed",
    "4" => "Completed",
    "5" => "Unsatisfied Solution",
    "9" => "Canceled",
    "10" => "Rejected",
);

$array_rfm_app_stat = array(
    "0" => "IT Approval",
    "1" => "Pending Approval",
    "2" => "Approved",
    "3" => "KIV",
    "4" => "Rejected");

$array_rfm_type = array(
    "0" => "Uncategorized",
    "1" => "Request",
    "2" => "Incident");

$array_rfm_level = array(
    "0" => "Uncategorized",
    "1" => "Low",
    "2" => "Moderate",
    "3" => "High");

$array_rfm_progress = array(
    "0" => "0%",
    "1" => "25%",
    "2" => "50%",
    "3" => "75%",
    "4" => "100%");

$array_rfm_period = array(
    "1" => "Q1: 08:30~10:29",
    "2" => "Q2: 10:30~12:30",
    "3" => "Q3: 13:30~15:29",
    "4" => "Q4: 15:30~17:30");

$array_ctype = array(
    "1" => "Government",
    "2" => "Private",
);

$array_gender = array(
    "1" => "Male",
    "2" => "Female",
);

$array_alpha = array(
    "1" => "A",
    "2" => "B",
    "3" => "C",
    "4" => "D",
    "5" => "E",
    "6" => "F",
    "7" => "G",
    "8" => "H",
    "9" => "I",
    "10" => "J",
    "11" => "K",
    "12" => "L",
    "13" => "M",
    "14" => "N",
    "15" => "O",
    "16" => "P",
    "17" => "Q",
    "18" => "R",
    "19" => "S",
    "20" => "T",
    "21" => "U",
    "22" => "V",
    "23" => "W",
    "24" => "X",
    "25" => "Y",
    "26" => "Z",
);

$array_fmonth = array(
    "1" => "January",
    "2" => "February",
    "3" => "March",
    "4" => "April",
    "5" => "May",
    "6" => "June",
    "7" => "July",
    "8" => "August",
    "9" => "September",
    "01" => "January",
    "02" => "February",
    "03" => "March",
    "04" => "April",
    "05" => "May",
    "06" => "June",
    "07" => "July",
    "08" => "August",
    "09" => "September",
    "10" => "October",
    "11" => "November",
    "12" => "December",
);

$array_tmonth = array(
    "1" => "01",
    "2" => "02",
    "3" => "03",
    "4" => "04",
    "5" => "05",
    "6" => "06",
    "7" => "07",
    "8" => "08",
    "9" => "09",
    "10" => "10",
    "11" => "11",
    "12" => "12",
);

$array_race_short = array(
    "1" => "M",
    "2" => "C",
    "3" => "I",
    "4" => "O",
);

$array_race = array(
    "1" => "Malay",
    "2" => "Chinese",
    "3" => "Indian",
    "4" => "Others",
);

$array_rl_short = array(
    "1" => "B",
    "2" => "NB",
);

$array_rl = array(
    "1" => "BUMI",
    "2" => "NON-BUMI",
);

$array_sector = array("1" => "Not Working", "2" => "Government", "3" => "Private");

$array_emtype_short = array(
    "1" => "P",
    "2" => "C",
    "3" => "I",
);

$array_emtype = array(
    "1" => "PERMANENT",
    "2" => "CONTRACT",
    "3" => "INTERNSHIP",
);

$array_loc_short = array(
    "1" => "H",
    "2" => "S",
);

$array_maritial = array(
    "1" => "SINGLE",
    "2" => "MARRIED",
);

$array_loc = array(
    "1" => "HEADQUATERS",
    "2" => "SITES",
);

$array_month = array(
    "1" => "Jan",
    "2" => "Feb",
    "3" => "Mar",
    "4" => "Apr",
    "5" => "May",
    "6" => "Jun",
    "7" => "Jul",
    "8" => "Aug",
    "9" => "Sep",
    "10" => "Oct",
    "11" => "Nov",
    "12" => "Dec",
);

$array_tmonth = array(
    "1" => "01",
    "2" => "02",
    "3" => "03",
    "4" => "04",
    "5" => "05",
    "6" => "06",
    "7" => "07",
    "8" => "08",
    "9" => "09",
    "10" => "10",
    "11" => "11",
    "12" => "12",
);

$array_tday = array(
    "1" => "31",
    "2" => "28",
    "3" => "31",
    "4" => "30",
    "5" => "31",
    "6" => "30",
    "7" => "31",
    "8" => "31",
    "9" => "30",
    "10" => "31",
    "11" => "30",
    "12" => "31",
);

$array_trday = array(
    "1" => "1 Hour",
    "2" => "2 Hours",
    "3" => "3 Hours",
    "4" => "4 Hours",
    "5" => "5 Hours",
    "6" => "6 Hours",
    "7" => "7 Hours",
    "8" => "1 Day",
    "9" => "2 Days",
    "10" => "3 Days",
    "11" => "4 Days",
    "12" => "5 Days",
    "13" => "6 Days",
    "14" => "1 Week",
    "15" => "2 Weeks",
    "16" => "3 Weeks",
    "17" => "1 Month",
);

$array_ttday = array(
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5",
    "6" => "6",
    "7" => "7",
    "8" => "8",
    "9" => "16",
    "10" => "24",
    "11" => "32",
    "12" => "40",
    "13" => "48",
    "14" => "56",
    "15" => "112",
    "16" => "120",
    "17" => "160",
);

$array_countday = array(
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5",
    "6" => "6",
    "7" => "7",
    "8" => "1",
    "9" => "2",
    "10" => "3",
    "11" => "4",
    "12" => "5",
    "13" => "6",
    "14" => "7",
    "15" => "14",
    "16" => "21",
    "17" => "28",
);

$array_tday = array(
    "1" => "31",
    "2" => "28",
    "3" => "31",
    "4" => "30",
    "5" => "31",
    "6" => "30",
    "7" => "31",
    "8" => "31",
    "9" => "30",
    "10" => "31",
    "11" => "30",
    "12" => "31",
);

$array_td = array("00" => "00",
    "0" => "00",
    "1" => "01",
    "2" => "02",
    "3" => "03",
    "4" => "04",
    "5" => "05",
    "6" => "06",
    "7" => "07",
    "8" => "08",
    "9" => "09",
    "10" => "10",
    "11" => "11",
    "12" => "12",
    "13" => "13",
    "14" => "14",
    "15" => "15",
    "16" => "16",
    "17" => "17",
    "18" => "18",
    "19" => "19",
    "20" => "20",
    "21" => "21",
    "22" => "22",
    "23" => "23",
    "24" => "24",
    "25" => "25",
    "26" => "26",
    "27" => "27",
    "28" => "28",
    "29" => "29",
    "30" => "30",
    "31" => "31",
    "32" => "32",
    "33" => "33",
    "34" => "34",
    "35" => "35",
    "36" => "36",
    "37" => "37",
    "38" => "38",
    "39" => "39",
    "40" => "40",
    "41" => "41",
    "42" => "42",
    "43" => "43",
    "44" => "44",
    "45" => "45",
    "46" => "46",
    "47" => "47",
    "48" => "48",
    "49" => "49",
    "50" => "50",
    "51" => "51",
    "52" => "52",
    "53" => "53",
    "54" => "54",
    "55" => "55",
    "56" => "56",
    "57" => "57",
    "58" => "58",
    "59" => "59",
    "00" => "00",
    "01" => "01",
    "02" => "02",
    "03" => "03",
    "04" => "04",
    "05" => "05",
    "06" => "06",
    "07" => "07",
    "08" => "08",
    "09" => "09",
);

$array_edu_level = array("1" => "Primary School",
    "2" => "Secondary School/PMR/SPM/&quot;O&quot; Level",
    "3" => "Higher Secondary/STPM/&quot;A&quot; Level/Pre-U",
    "4" => "Professional Certificate",
    "5" => "Diploma",
    "6" => "Advanced/Higher/Graduate Diploma",
    "7" => "Bachelor's Degree",
    "8" => "Post Graduate Diploma",
    "9" => "Professional Degree",
    "10" => "Master's Degree",
    "11" => "Doctorate (PhD)");

$array_edu_field = array("1" => "Advertising/Media",
    "2" => "Agriculture/Aquaculture/Forestry",
    "3" => "Airline Operation/Airport Management",
    "4" => "Architecture",
    "5" => "Art/Design/Creative Multimedia",
    "6" => "Biology",
    "7" => "BioTechnology",
    "8" => "Business Studies/Administration/Management",
    "9" => "Chemistry",
    "10" => "Commerce",
    "11" => "Computer Science/Information Technology",
    "12" => "Dentistry",
    "70" => "Economics",
    "13" => "Education/Teaching/Training",
    "14" => "Engineering (Aviation/Aeronautics/Astronautics)",
    "15" => "Engineering (Bioengineering/Biomedical)",
    "16" => "Engineering (Chemical)",
    "17" => "Engineering (Civil)",
    "18" => "Engineering (Computer/Telecommunication)",
    "19" => "Engineering (Electrical/Electronic)",
    "20" => "Engineering (Environmental/Health/Safety)",
    "21" => "Engineering (Industrial)",
    "22" => "Engineering (Marine)",
    "23" => "Engineering (Material Science)",
    "24" => "Engineering (Mechanical)",
    "25" => "Engineering (Mechatronic/Electromechanical)",
    "26" => "Engineering (Metal Fabrication/Tool &amp; Die/Welding)",
    "27" => "Engineering (Mining/Mineral)",
    "28" => "Engineering (Others)",
    "29" => "Engineering (Petroleum/Oil/Gas)",
    "30" => "Finance/Accountancy/Banking",
    "31" => "Food &amp; Beverage Services Management",
    "32" => "Food Technology/Nutrition/Dietetics",
    "33" => "Geographical Science",
    "34" => "Geology/Geophysics",
    "35" => "History",
    "36" => "Hospitality/Tourism/Hotel Management",
    "37" => "Human Resource Management",
    "38" => "Humanities/Liberal Arts",
    "39" => "Journalism",
    "40" => "Law",
    "41" => "Library Management",
    "42" => "Linguistics/Languages",
    "43" => "Logistic/Transportation",
    "44" => "Maritime Studies",
    "45" => "Marketing",
    "46" => "Mass Communications",
    "47" => "Mathematics",
    "48" => "Medical Science",
    "49" => "Medicine",
    "50" => "Music/Performing Arts Studies",
    "51" => "Nursing",
    "52" => "Optometry",
    "53" => "Personal Services",
    "54" => "Pharmacy/Pharmacology",
    "55" => "Philosophy",
    "56" => "Physical Therapy/Physiotherapy",
    "57" => "Physics",
    "58" => "Political Science",
    "59" => "Property Development/Real Estate Management",
    "60" => "Protective Services &amp; Management",
    "61" => "Psychology",
    "62" => "Quantity Survey",
    "63" => "Science &amp; Technology",
    "64" => "Secretarial",
    "65" => "Social Science/Sociology",
    "66" => "Sports Science &amp; Management",
    "67" => "Textile/Fashion Design",
    "68" => "Urban Studies/Town Planning",
    "69" => "Veterinary",
    "71" => "Others");

$array_natio = array(
    "1" => "Malaysian",
    "2" => "Indian",
    "3" => "Japanese",
    "4" => "Philippine",
    "5" => "Saudi Arabia",
    "6" => "Yamen",
    "7" => "Others",
    "8" => "Singaporean",
    "9" => "Cambodian");

$array_natiom = array(
    "1" => "Malaysia",
    "2" => "India",
    "3" => "Jepun",
    "4" => "Filipina",
    "5" => "Arab Saudi",
    "6" => "Lain-lain");

$array_lang = array(
    "1" => "Malay",
    "2" => "English",
    "3" => "Cantonese",
    "4" => "Mandarin",
    "5" => "Tamil",
    "6" => "Afrikaans",
    "7" => "Albanian",
    "8" => "Arabic",
    "9" => "Belarusian",
    "10" => "Bengali",
    "11" => "Bulgarian",
    "12" => "Catalan",
    "13" => "Croatian",
    "14" => "Czech",
    "15" => "Danish",
    "16" => "Dutch",
    "17" => "Estonian",
    "18" => "Filipino",
    "19" => "Finnish",
    "20" => "French",
    "21" => "Galician",
    "22" => "German",
    "23" => "Greek",
    "24" => "Hebrew",
    "25" => "Hindi",
    "26" => "Hungarian",
    "27" => "Icelandic",
    "28" => "Indonesian",
    "29" => "Irish",
    "30" => "Italian",
    "31" => "Japanese",
    "32" => "Korean",
    "33" => "Latvian",
    "34" => "Lithuanian",
    "35" => "Macedonian",
    "36" => "Maltese",
    "37" => "Norwegian",
    "38" => "Persian",
    "39" => "Polish",
    "40" => "Portuguese",
    "41" => "Romanian",
    "42" => "Russian",
    "43" => "Serbian",
    "44" => "Slovak",
    "45" => "Slovenian",
    "46" => "Spanish",
    "47" => "Swahili",
    "48" => "Swedish",
    "49" => "Thai",
    "50" => "Turkish",
    "51" => "Ukrainian",
    "52" => "Vietnamese",
    "53" => "Welsh",
    "54" => "Yiddish",
);

$array_lang_lev = array(
    "1" => "Poor",
    "2" => "Fair",
    "3" => "Good",
    "4" => "Excellent",
);

$array_tleave = array(
    "0" => "AFW",
    "1" => "Annual Leave",
    "2" => "Emergency Leave",
    "3" => "Unpaid Leave",
    "4" => "Medical Leave",
    "5" => "Hospitalization Leave",
    "6" => "Maternity Leave",
    "7" => "Marriage Leave",
    "8" => "Examination/Study Leave",
    "9" => "Disaster Leave",
    "10" => "Paternity Leave",
    "11" => "Compassionate Leave",
    "12" => "Un-Recorded Leave",
    "13" => "Site Visit/Meeting",
    "14" => "Sabbatical Leave",
    "20" => "Unauthorized Leave",
    "99" => "Approved Off-Day");

$array_emcat_short = array(
    "1" => "ADM",
    "2" => "TEC",
);

$array_natio_short = array(
    "1" => "M",
    "2" => "I",
    "3" => "J",
    "4" => "P",
    "5" => "SA",
    "6" => "Y",
    "7" => "O",
    "8" => "SP",
    "9" => "CAM");

$array_natio_long = array(
    "1" => "MALAYSIAN",
    "2" => "INDIAN",
    "3" => "JAPANESE",
    "4" => "PHILIPHINOS",
    "5" => "SAUDI ARABIAN",
    "6" => "YEMEN",
    "7" => "OTHERS",
    "8" => "SINGAPOREAN");

$array_leave = array(
    "0" => "AFW",
    "1" => "AL",
    "2" => "EL",
    "3" => "UL",
    "4" => "MC",
    "5" => "HL",
    "6" => "BL",
    "7" => "ML",
    "8" => "SL",
    "9" => "DL",
    "10" => "PL",
    "11" => "CL",
    "12" => "URL",
    "13" => "SV/MTG",
    "14" => "SBL",
    "20" => "UAL",
    "99" => "AOD");

$array_duration = array(
    "1" => "1",
    "2" => "0.75",
    "3" => "0.50",
    "4" => "0.25",
    "5" => "0.375");

$array_duration_t = array(
    "1" => "1 Day",
    "2" => "6 Hours",
    "3" => "Half Day",
    "4" => "2 Hours",
    "5" => "3 Hours");

$array_duration_st = array(
    "0" => "U",
    "1" => "1D",
    "2" => "6Hrs",
    "3" => "1/2D",
    "4" => "2Hrs",
    "5" => "3Hrs");

$array_duration_b = array(
    "0" => "-",
    "1" => "Full Day",
    "2" => "3/4 Day",
    "3" => "1/2 Day",
    "4" => "2 Hours",
    "5" => "3 Hours");

$array_duration_minute = array(
    "1" => "1day",
    "2" => "6hours",
    "3" => "4hours",
    "4" => "2hours",
    "5" => "3hours");

$array_duration_att = array(
    "1" => "8",
    "2" => "6",
    "3" => "4",
    "4" => "2",
    "5" => "3");

// $array_when = array(
//     "0" => "U",
//     "1" => "Full Day",
//     "2" => "Q1 - 08:30-10:30",
//     "3" => "Q2 - 10:30-12:30",
//     "4" => "Q3 - 01:30-03:30",
//     "5" => "Q4 - 03:30-05:30",
//     "6" => "Q4F - 02:30-04:30",
//     "7" => "Half Day AM",
//     "8" => "Half Day PM",
//     "9" => "Half Day PMF",
//     "10" => "3Q1 - 08:30-03:30",
//     "11" => "3Q2 - 10:30-05:30",
//     "12" => "3Q2F - 10:30-04:30",
//     "13" => "3Hrs AM1 8:30-11:30",
//     "14" => "3Hrs AM2 9:30-12:30",
//     "15" => "3Hrs PM1 01:30-04:30",
//     "16" => "3Hrs PM2 02:30-05:30");

$array_when = array(
    "0" => "U",
    "1" => "Full Day",
    "2" => "Q1 - AM (1st Session - 2 Hours)",
    "3" => "Q2 - AM (2nd Session - 2 Hours)",
    "4" => "Q3 - PM (1st Session - 2 Hours)",
    "5" => "Q4 - PM (2nd Session - 2 Hours)",
    "6" => "Q4F - PM (Friday - 2 Hours)",
    "7" => "Half Day AM",
    "8" => "Half Day PM",
    "9" => "Half Day PMF",
    "10" => "3Q1 - AM (6 Hours)",
    "11" => "3Q2 - PM (6 Hours)",
    "12" => "3Q2F - AM (Friday - 5 Hours)",
    "13" => "3Hrs AM1",
    "14" => "3Hrs AM2",
    "15" => "3Hrs PM1",
    "16" => "3Hrs PM2");

$array_when_t = array(
    "0" => "U",
    "1" => "Full Day",
    "2" => "08:30-10:30",
    "3" => "10:30-12:30",
    "4" => "01:30-03:30",
    "5" => "03:30-05:30",
    "6" => "02:30-04:30",
    "7" => "08:30-12:30",
    "8" => "01:30-05:30",
    "9" => "02:30-4:30",
    "10" => "08:30-03:30",
    "11" => "10:30-05:30",
    "12" => "10:30-04:30",
    "13" => "8:30-11:30",
    "14" => "9:30-12:30",
    "15" => "01:30-04:30",
    "16" => "02:30-05:30");

$array_when_minutes = array(
    "0" => "1day",
    "1" => "1day",
    "2" => "2hours",
    "3" => "2hours",
    "4" => "2hours",
    "5" => "2hours",
    "6" => "Q4F - 02:30-04:30",
    "7" => "4hours",
    "8" => "4hours",
    "9" => "Half Day PMF",
    "10" => "6hours",
    "11" => "6hours",
    "12" => "3Q2F - 10:30-04:30",
    "13" => "3Hrs AM1",
    "14" => "3Hrs AM2",
    "15" => "3Hrs 3 PM1",
    "16" => "3Hrs 4 PM2");

$array_mia_cat = array(
    "0" => "1day",
    "1" => "1day",
    "2" => "2hours Q1",
    "3" => "2hours Q2",
    "4" => "2hours Q3",
    "5" => "2hours Q4",
    "6" => "Q4F - 02:30-04:30",
    "7" => "Half Day AM",
    "8" => "Half Day AM",
    "9" => "Half Day PMF",
    "10" => "6hours AM",
    "11" => "6hours PM",
    "12" => "3Q2F - 10:30-04:30");

$array_leave_cat_1 = array("0" => "18",
    "1" => "20",
    "2" => "22",
    "3" => "24");

$array_leave_cat_2 = array("0" => "18",
    "1" => "19.5",
    "2" => "21");

$array_leave_cat_3 = array("0" => "15",
    "1" => "16.5",
    "2" => "18",
    "3" => "19.5",
    "4" => "21");

$array_leave_cat_4 = array("0" => "12",
    "1" => "13.5",
    "2" => "15",
    "3" => "16.5",
    "4" => "18",
    "5" => "19.5",
    "6" => "21");

$array_leave_cat_5 = array("0" => "12",
    "1" => "13",
    "2" => "14",
    "3" => "15",
    "4" => "16",
    "5" => "17",
    "6" => "18",
    "7" => "19",
    "8" => "20",
    "9" => "21");

$array_offday_approval = array("0" => "Draft",
    "1" => "Pending",
    "2" => "Approved",
    "3" => "Declined");

$array_re_cat = array("1" => "PUBLIC HOLIDAY", "2" => "SUNDAY");

$array_leave_stat = array("0" => "Approved",
    "1" => "Pending",
    "3" => "Not Approved",
    "4" => "Canceled",
    "8" => "Noted",
    "9" => "Noted");

$array_color = array(
    "1" => "#FF0000",
    "2" => "#FF8000",
    "3" => "#FFFF00",
    "4" => "#40FF00",
    "5" => "#01DFD7",
    "6" => "#0080FF",
    "7" => "#BF00FF",
    "8" => "#FE2E9A",
    "9" => "#A4A4A4",
    "10" => "#F5A9A9",
    "11" => "#F5D0A9",
    "12" => "#F2F5A9",
    "13" => "#9FF781",
    "14" => "#81F7BE",
    "15" => "#81DAF5",
    "16" => "#A9BCF5",
    "17" => "#D0A9F5",
    "18" => "#E6E6E6",
    "19" => "#610B0B",
    "20" => "#61380B",
    "21" => "#393B0B",
    "22" => "#173B0B",
    "23" => "#0B615E",
    "24" => "#0B173B",
    "25" => "#210B61",
    "26" => "#4C0B5F",
    "27" => "#610B4B",
    "28" => "#610B21",
    "29" => "#2E2E2E",
    "30" => "#F6CED8",
    "31" => "#F781F3",
    "32" => "#5882FA",
    "33" => "#00BFFF",
    "34" => "#01DFA5",
    "35" => "#00FFFF",
    "36" => "#04B431",
    "37" => "#688A08",
    "38" => "#868A08",
    "39" => "#B18904",
    "40" => "#FE9A2E",
    "41" => "#F5A9A9",
    "42" => "#FF0000",
    "43" => "#0B3861",
    "44" => "#F5F6CE",
    "45" => "#3B0B17",
    "46" => "#4000FF",
    "47" => "#E6E6E6",
    "48" => "#CEF6CE",
    "49" => "#F4FA58",
    "50" => "#2EFE2E",
    "51" => "#FF0000",
    "52" => "#FF8000",
    "53" => "#FFFF00",
    "54" => "#40FF00",
    "55" => "#01DFD7",
    "56" => "#0080FF",
    "57" => "#BF00FF",
    "58" => "#FE2E9A",
    "59" => "#A4A4A4",
    "60" => "#F5A9A9",
    "61" => "#F5D0A9",
    "62" => "#F2F5A9",
    "63" => "#9FF781",
    "64" => "#81F7BE",
    "65" => "#81DAF5",
    "66" => "#A9BCF5",
    "67" => "#D0A9F5",
    "68" => "#E6E6E6",
    "69" => "#610B0B",
    "70" => "#61380B",
    "71" => "#393B0B",
    "72" => "#173B0B",
    "73" => "#0B615E",
    "74" => "#0B173B",
    "75" => "#210B61",
    "76" => "#4C0B5F",
    "77" => "#610B4B",
    "78" => "#610B21",
    "79" => "#2E2E2E",
    "80" => "#F6CED8",
    "81" => "#F781F3",
    "82" => "#5882FA",
    "83" => "#00BFFF",
    "84" => "#01DFA5",
    "85" => "#00FFFF",
    "86" => "#04B431",
    "87" => "#688A08",
    "88" => "#868A08",
    "89" => "#B18904",
    "90" => "#FE9A2E",
    "91" => "#F5A9A9",
    "92" => "#FF0000",
    "93" => "#0B3861",
    "94" => "#F5F6CE",
    "95" => "#3B0B17",
    "96" => "#4000FF",
    "97" => "#E6E6E6",
    "98" => "#CEF6CE",
    "99" => "#F4FA58",
    "100" => "#2EFE2E");

$array_book_stat = array(
    "1" => "Available",
    "2" => "Reserved",
    "3" => "Borrowed");

$array_leave_earn = array(
    "1" => "Monthly Earn",
    "2" => "Replacement",
    "3" => "Forfeit");

$array_intra_level = array("0" => "Normal Access",
    "1" => "Secretarial Access",
    "2" => "Superior Access",
    "3" => "Sub-Superior Access",
    "4" => "Top Management Access",
    "10" => "Admin Access");

$array_project_stat = array("0" => "Archive",
    "1" => "Active",
    "2" => "Proposal");

$array_project_cat = array("0" => "Please Select",
    "1" => "Government",
    "2" => "Government Link",
    "3" => "Private");

$array_project_level = array("1" => "Main",
    "2" => "Sub");

$array_project_role = array("0" => "Please Select",
    "1" => "Sole Consultant",
    "2" => "Lead Consultant",
    "3" => "Associate");

$array_project_type = array("0" => "Please Select",
    "1" => "Continuous",
    "2" => "Intermittent");
$array_project_cur = array("0" => "Please Select",
    "1" => "MYR",
    "2" => "USD");

$array_smiley = array("0" => "Happy -1.gif",
    "1" => " Sad -2.gif",
    "2" => " Wink -3.gif",
    "3" => " Grin -4.gif",
    "4" => " Love -8.gif",
    "5" => " Blushing -9.gif",
    "6" => " Tongue -10.gif",
    "7" => " Broken -12.gif",
    "8" => " Angry -14.gif",
    "9" => " Crying -20.gif",
    "10" => " Meh -23.gif",
    "11" => " Yawning -37.gif",
    "12" => " Curious -39.gif",
    "13" => " Hypnotized -43.gif",
    "14" => " Rolling -24.gif",
    "15" => " Straight -22.gif",
    "16" => " Confused -7.gif",
    "17" => " Surprise -13.gif",
    "18" => " Argh -102.gif",
    "19" => " Times Up -110.gif",
    "20" => " Worried -42.gif");

$array_store_request_stat = array("0" => "Pending",
    "1" => "Approved",
    "2" => "Rejected",
    "3" => "Completed");
$array_v_request_stat = array("0" => "Pending",
    "1" => "Approved",
    "2" => "Not Approved",
    "3" => "Valid Information",
    "4" => "Invalid Information",
    "5" => "Confirmed",
    "6" => "Declined",
    "7" => "Key Taken By Staff",
    "8" => "Request Canceled");

$array_v_status = array("1" => "Available",
    "0" => "Under Maintenance");

$array_v_type = array("0" => "MOTORCYCLE", "1" => "CAR",
    "2" => "4WD",
    "3" => "VAN");

$array_v_gear = array("1" => "AUTOMATIC",
    "2" => "MANUAL");

$array_v_fuel = array("1" => "PETROL",
    "2" => "DIESEL");

$array_approver_level = array("1" => "SUPERIOR",
    "2" => "SUB-SUPERIOR");

$array_v_purpose = array("1" => "Meeting",
    "2" => "Proposal",
    "3" => "Site Visit",
    "4" => "General");

$array_v_destination = array("1" => "Local",
    "2" => "Outstation");

$array_v_owner = array("1" => "Company",
    "2" => "Personal");

$array_v_drive = array("1" => "Yes",
    "2" => "No");

$array_summon_status = array("1" => "Yes",
    "2" => "No");

$array_summon_type = array("1" => "JPJ",
    "2" => "PDRM");

$array_summon_payment = array("1" => "Not Completed",
    "2" => "Completed");

//OT
$array_ot_stat = array("0" => "Pending",
    "1" => "Approved",
    "2" => "Not Approved",
    "3" => "Canceled",
    "8" => "No Approval",
    "9" => "Noted");

$array_ot_cat = array("1" => "Hourly Pay",
    "2" => "1/2 Day Pay",
    "3" => "Full Day Pay");

$array_home = array("0" => "home_trial.php",
    "1" => "home_default.php",
    "2" => "home_three_sisters.php",
    "3" => "home_headline.php",
    "4" => "home_minimal.php");

$array_font = array("1" => "'Trebuchet MS', Arial, Helvetica, sans-serif",
    "2" => "Georgia, 'Times New Roman', Times, serif",
    "3" => "\"MS Serif\", \"New York\", serif");

$array_tableheader = array("1" => "#999",
    "2" => "#CC0000",
    "3" => "#66CC66",
    "4" => "#CCBB00");

$array_banner = array("1" => "intra_banner_blue.jpg",
    "2" => "intra_banner_red.jpg",
    "3" => "intra_banner_green.jpg",
    "4" => "intra_banner_yellow.jpg");

$array_banner_color = array("1" => "#001951",
    "2" => "#550007",
    "3" => "#086900",
    "4" => "#B3AD01");

$array_bg_color = array("1" => "#FFF",
    "2" => "#C4E3FB",
    "3" => "#D3D3D3",
    "4" => "#000",
    "21" => "bg_photo_1.png",
    "22" => "bg_photo_2.png",
    "23" => "bg_photo_3.png",
    "24" => "bg_photo_4.png",
    "25" => "bg_photo_5.png",
    "26" => "bg_photo_6.png",
    "27" => "bg_photo_7.png",
    "28" => "bg_photo_8.png",
    "29" => "bg_photo_9.png",
    "30" => "bg_photo_10.png",
    "31" => "bg_photo_11.png",
    "32" => "bg_photo_12.png",
    "33" => "bg_photo_13.png",
    "34" => "bg_photo_14.png",
    "35" => "bg_photo_15.png",
    "36" => "bg_photo_16.png",
    "37" => "bg_photo_17.png",
    "38" => "bg_photo_18.gif",
    "39" => "bg_photo_19.gif",
    "40" => "bg_photo_20.gif",
    "41" => "bg_photo_21.gif",
    "42" => "bg_photo_22.gif",
    "43" => "bg_photo_23.gif",
    "44" => "bg_photo_24.gif",
    "45" => "bg_photo_25.gif");

$array_badge = array("1" => "092.png",
    "2" => "087.png",
    "3" => "027.png",
    "4" => "071.png",
    "5" => "048.png",
    "6" => "047.png",
    "7" => "011.png",
    "8" => "009.png",
    "9" => "097.png",
    "10" => "032.png",
    "11" => "059.png",
    "12" => "014.png",
    "13" => "099.png",
    "14" => "089.png",
    "15" => "035.png");

$array_mia_type = array("1" => "Unknown",
    "2" => "Office Task",
    "3" => "EL/UL",
    "4" => "MC",
    "5" => "Late Coming",
    "10" => "SNC",
    "11" => "Forgot Tag",
    "12" => "Others");

$array_mia_setter = array("1" => "Secretary",
    "2" => "System");

$array_mentee_level = array("1" => "Level 1 (Month 01)",
    "2" => "Level 2 (Month 03)",
    "3" => "Level 3 (Month 06)",
    "4" => "Level 4 (Month 12)",
    "5" => "Level 5 (Month 24)",
    "6" => "Completed");

$array_mentee_level_word = array("1" => "First Month",
    "2" => "Third Month",
    "3" => "Sixth Month",
    "4" => "First Year",
    "5" => "Secon Year",
    "6" => "Completed");

$array_mentee_reminder = array("1" => "1",
    "2" => "3",
    "3" => "6",
    "4" => "12",
    "5" => "24");

$array_mentee_quest_level_1 = array("1" => "Are you settling in or are you still finding your way?",
    "2" => "What are you working on?",
    "3" => "Who you are working with?",
    "4" => "Who is assisting you in preparing of drawings, typing of reports, checking of work, etc?",
    "5" => "What are the usual problems you encounter in your work?",
    "6" => "Have you managed to review the company's Quality Manual and become aware of its requirements?",
    "7" => "Have you submitted your registration application with BEM?");

$array_mentee_quest_level_2 = array("1" => "Are you working on any project?",
    "2" => "Do you feel you are making/have made contributions to work output?",
    "3" => "Do you feel you are a member of a working/achieving team?",
    "4" => "Do you feel you are coping well with the work load?",
    "5" => "Have you generally understood the Company's quality procedures, and are you making an attempt to comply with their requirements?",
    "6" => "Have you completed your registration with BEM?");

$array_mentee_quest_level_3 = array("1" => "What have you achieved?",
    "2" => "Do you like your work?",
    "3" => "Have you attended any meetings with the Client?",
    "4" => "Have you had the opportunity to visit a project site?",
    "5" => "Do you feel you are learning new skills and knowledge?",
    "6" => "What areas of your work you feel should be improved?");

$array_mentee_quest_level_4 = array("1" => "Is there anyone you work with whom you regard as a friend rather than a workmate?",
    "2" => "Are you working on something you like doing?",
    "3" => "Are you getting the training and work exposure that will help in your career progression?",
    "4" => "Have you found any particular type of work/project/ division that you would like to be involved in?",
    "5" => "Have you applied to attend courses on any of the mandatory subjects for PE?");

$array_mentee_quest_level_5 = array("1" => "Are you happy with your current work environment?",
    "2" => "Are you working on something you like doing?",
    "3" => "Are you getting the training and work exposure that will help in your career progression?",
    "4" => "Have you found any particular type of work/project/ division that you would like to be involved in?",
    "5" => "Have you accumulated the minimum hours in respect of the mandatory subjects for the PE examination?");

$array_lib_item = array("1" => "Books",
    "2" => "Serials",
    "3" => "Standards",
    "4" => "Technical Publication",
    "5" => "Circulars",
    "6" => "Cassette",
    "7" => "Compact Disk",
    "8" => "Video Tape",
    "9" => "Photo",
    "10" => "Maps",
    "11" => "Diskette",
    "12" => "Special Collection");

$array_lib_item_stat = array("1" => "Available",
    "2" => "Reserved",
    "3" => "Borrowed",
    "4" => "Missing");

$array_punch_in = array("0"=>"Off-Day",
    "1"=>"07:00",
    "2"=>"07:30",
    "3"=>"08:00",
    "4"=>"08:30",
    "5"=>"09:00",
    "6"=>"09:30",
    "7"=>"10:00",
    "8"=>"10:30",
    "9"=>"11:00",
    "10"=>"11:30");

$array_punch_out = array("0" => "Off-Day",

    "1" => "16:00",
    "2" => "16:30",
    "3" => "17:00",
    "4" => "17:30",
    "5" => "18:00",
    "6" => "18:30",
    "7" => "19:00",
    "8" => "19:30",
    "9" => "13:00",
    "10" => "15:00");

asort($array_punch_out);

$array_punch_for = array("1" => "Default",
    "2" => "Temporary",
    "3" => "Ramadan");

$array_punch_type = array("0" => "Off-Day",
    "1" => "Work-Day",
    "2" => "Work-Day(R)");

    $array_lunch_hour = array("1"=>"1 Hour",
    "2"=>"30 Minutes",
    "3"=>"15 Minutes",
    "4"=>"0 Minute",
    "5"=>"2 Hour");

$pre_con = array("0" => "No Action Yet",
    "1" => "Confirmation Report Submited",
    "2" => "Highly Recommended",
    "3" => "Please Extended Probation",
    "4" => "Not Recommended",
    "5" => "Highly Recommended",
    "6" => "Please Extended Probation",
    "7" => "Not Recommended",
    "100" => "Confirmed",
    "101" => "Probation Extended",
    "102" => "Not Confirmed");

$pre_con_mark_g = array("0" => "Not Applicable",
    "1" => "Very Good",
    "2" => "Good",
    "3" => "Average",
    "4" => "Fair",
    "5" => "Poor");

$pre_con_mark_a = array("0" => "0",
    "1" => "70",
    "2" => "50",
    "3" => "35",
    "4" => "20",
    "5" => "10");

$pre_con_mark_b = array("0" => "0",
    "1" => "20",
    "2" => "15",
    "3" => "10",
    "4" => "5",
    "5" => "0");

$pre_con_mark_c = array("0" => "0",
    "1" => "10",
    "2" => "8",
    "3" => "5",
    "4" => "2",
    "5" => "0");

$dp_cat = array("1" => "Superior",
    "2" => "Draughts Person");

$array_staff_status = array("1" => "Active", "2" => "Resigned");

$array_resign = array(
    "0" => "Select",
    "1" => "Better Offer (Private)",
    "2" => "Better Offer (Gov/GLC)",
    "3" => "Retired",
    "4" => "Contract Completed",
    "5" => "Further Studies",
    "6" => "Health Problems",
    "7" => "Abscondment",
    "8" => "Termination",
    "9" => "Non-Confirm Probation",
    "10" => "Others");

$array_rnotice = array(
    "0" => "Select",
    "1" => "Notice (HQ)-3M",
    "2" => "Notice (Site)-1M",
    "3" => "Short Notice",
    "4" => "Notice (HQ)-2W",
    "5" => "Notice (Site)-2W",
    "6" => "Notice (HQ)-1M");

$arrayreligion = array("1" => "Muslim",
    "2" => "Kristian",
    "3" => "Katholik",
    "4" => "Budha",
    "5" => "Hindu",
    "6" => "Others");

$array_claim_for = array(
    "1" => "SELF",
    "2" => "SPOUSE",
    "3" => "CHILDREN",
    "4" => "FATHER",
    "5" => "MOTHER",
    "6" => "SON",
    "7" => "DAUGHTER",
);
$array_claim_cat = array("1" => "Normal",
    "2" => "Medical Check-Up",
    "3" => "Eyes",
    "4" => "Dental");

$array_claim_use = array(
    "1" => "CARD",
    "2" => "REIMBURSEMENT",
);

$array_claim_type = array(
    "1" => "HOSP",
    "2" => "PRE-HOSP",
    "3" => "POST-HOSP",
);

$array_claim_stat = array(
    "1" => "PEN",
    "2" => "PRO",
    "3" => "CLO",
);

$array_miscon_type = array(
    "0" => "All", "1" => "Absonded",
    "2" => "Councelling",
    "3" => "Letter Of Concern",
    "4" => "Letter Of Warning",
    "5" => "Showcause Letter",
    "6" => "Letter Of Serious Warning",
    "7" => "Termination",
    "8" => "Non-Confirm",
    "9" => "Domestic Inquiry",
    "10" => "Final Warning",
    "11" => "Letter Of Caution");

$array_miscon_short = array(
    "0" => "All", "1" => "ABSC",
    "2" => "COUN",
    "3" => "LOCO",
    "4" => "LOW",
    "5" => "SCAUSE",
    "6" => "LOSW",
    "7" => "TER",
    "8" => "NC",
    "9" => "DI",
    "10" => "FW",
    "11" => "LOCA");

$array_emcat = array(
    "1" => "ADMINISTRATION",
    "2" => "TECHNICAL",
);

$array_emlev_short = array(
    "1" => "PRO",
    "2" => "SPRO",
    "3" => "GW",
    "4" => "PRO.E",
);

$array_emlev = array(
    "1" => "ADMINISTRATION PROFESSIONAL",
    "2" => "SUB-PROFESSIONAL",
    "3" => "GENERAL WORKER",
    "4" => "ENGINEER PROFESSIONAL",
);

$array_bank = array("1" => "Maybank", "2" => "CIMB", "3" => "RHB", "4" => "Hong Leong", "5" => "Bank Islam", "6" => "Standard Chartered", "7" => "Public Bank", "8" => "HSBC Bank", "9" => "AmBank");

$array_staff_employment = array("0" => "Internal Staff", "1" => "External Staff");

$array_empstat = array("0" => "Resigned", "1" => "Active", "2" => "In-Active");

$array_it_item_stat = array("1" => "Available",
    "2" => "Unavailable",
    "3" => "Borrowed",
    "4" => "Missing");
$array_it_item_usage = array("1" => "Internal",
    "2" => "External");
$array_it_item_collect = array("1" => "Self-Collect",
    "2" => "IT Help Required");
$array_it_item_return = array("1" => "Self-Return",
    "2" => "IT Help Required");
$array_it_item_loan_stat = array("0" => "Pending",
    "1" => "Active",
    "2" => "Returned",
    "3" => "Canceled");

$array_it_kb_publish_stat = array("0" => "Draft",
    "1" => "Publish");

$array_business_role = array("1" => "Owner",
    "2" => "Operator", "3" => "Viewer");

$array_kpi_value = array("1" => "RM",
    "2" => "%",
    "3" => "Local/International");

$array_bp_code = array("A" => "1Error !!!",
    "BP" => "91Bearpalm",
    "X" => "91Free Time",
    "HS" => "91Housekeeping / Cleaning",
    "ISO" => "91ISO",
    "LT" => "91Lunch Talk/Training/Seminar/Workshop",
    "ME" => "91Medical Checkup",
    "PY" => "91Prayer",
    "MSRC" => "91Sport Club Activities",
    "SB" => "91StandBy",
    "AL" => "94Annual Leave",
    "CL" => "94Compassionate Leave",
    "DL" => "94Disaster Leave",
    "EL" => "94Emergency Leave",
    "HL" => "94Hospitalization",
    "MRL " => "94Marriage Leave",
    "ML" => "94Maternity Leave",
    "MC" => "94Medical  Leave",
    "PL" => "94Paternity  Leave",
    "PH" => "94Public Holiday",
    "SL" => "94Study Leave",
    "UPL" => "94UnPaid Leave",
    "URL" => "94UnRecorded Leave",
    "ACC" => "Accounts",
    "M" => "Administration ",
    "AVAIL" => "Available for other assignment",
    "Z" => "Billing",
    "BD" => "Business Development",
    "V" => "Contract  Administration",
    "CPB" => "Contribution to Professional Bodies",
    "CSR" => "Corporate Social Responsibility",
    "DP" => "Data Processing",
    "DR" => "Design Review",
    "H" => "Designs",
    "DF" => "Drafting",
    "HR" => "Human Resource",
    "I" => "Information Technology",
    "RAR" => "Library",
    "Lib" => "Library / Research",
    "K" => "Meetings/Presentation",
    "ADM" => "Office Administration",
    "Pro" => "Prospective Projects(Proposal)",
    "PUB" => "Publications",
    "W" => "Rain",
    "R" => "Reports",
    "RS" => "Research / Library",
    "SS" => "Site Supervision/Visit",
    "ST" => "Store",
    "S" => "Surveying",
    "T" => "Travelling");

$array_bp_task = array(
    "9999991" => "Pursuits",
    "9999994" => "Leave",
    "9999996" => "Office Administration",
    "9999998" => "General",
    "9999999" => "Proposal");

$array_relation = array(
    "1" => "Spouse",
    "2" => "Children",
    "3" => "Other");

$array_rec_type = array(
    "1" => "Replacement",
    "2" => "Additional Position");

$array_rec_stat = array(
    "1" => "Unprocessed",
    "2" => "Prescreened",
    "3" => "Shortlisted",
    "4" => "Interview",
    "5" => "KIV",
    "6" => "Recommended",
    "7" => "Hired",
    "8" => "Reject",
    "9" => "Blacklisted ");

$array_rec_approval = array(
    "1" => "Pending",
    "2" => "Approved",
    "3" => "Rejected");

$array_transfer_type = array(
    "1" => "Assignment",
    "2" => "Secondment",
    "3" => "Transfer");
    

    $array_place = array(
        "s/s" => "Sabah / Sarawak",
        "semenanjung" => "Semenanjung",
        "overseas" => "Overseas");
        


    function check_next_approval($id, $staffno){
        global $mysqli;

        $q = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id AND staffno = '$staffno' ORDER BY id DESC LIMIT 1");
        $r = mysqli_fetch_array($q);
        $next_approval = $r["approval_priority"];            
        return $next_approval;
    }


    function insert_into_next($next,$form, $id){
        global $mysqli;

        // $q = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = $form AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
        // $r = mysqli_fetch_array($q);

        // $id = $r["id"];
        // return $id;

            
        $qq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = $form AND approval_priority > $next");
        $rr = mysqli_fetch_array($qq);
        $approvalId = $rr["id"];
        $appPriority = $rr["approval_priority"];

        $qp = mysqli_query($mysqli, "SELECT * FROM approval WHERE approval_level_id = $approvalId");
        $rq = mysqli_fetch_array($qp);
        $nextStaff = $rq["staffno"];
        
        $cr = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE approval_priority = $appPriority AND t_claims_id = $id");
        if (mysqli_num_rows($cr) > 0) {            
        }else{     
            mysqli_query($mysqli, "INSERT INTO `approval_detail` (`approval_level_id`, `approval_priority`, `t_claims_id`, `staffno`, `approval_status`, `approval_remarks`, `approval_approved_date`, `form_category`) 
            VALUES ($approvalId, $appPriority, $id, '".$nextStaff."', 'pending', '', '".date("Y-m-d")."', '".$form."' );");

        }

    }

    function next_id($next,$form, $id){
        global $mysqli;

        $qq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = 1 AND approval_priority > $next");
        $rr = mysqli_fetch_array($qq);
        $approvalId = $rr["id"];
       
        $qp = mysqli_query($mysqli, "SELECT * FROM approval WHERE approval_level_id = $approvalId");
        $rq = mysqli_fetch_array($qp);
        $nextStaff = $rq["staffno"];

        return $nextStaff;

    }


    function check_workflow_array($form, $current_priority){
        global $mysqli;
     
        $q = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = $form ORDER BY approval_priority");
      
        while($r = mysqli_fetch_array($q)){
                $arrayApproval[] = $r["id"];
                
        }
        print_r($arrayApproval);
        // return $id;

    }


    function check_status($id, $next){

        // $next = check_next_approval($id, $ses_staffno);
         
        $sql8 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id AND approval_priority = $next");
        $dql8 = mysqli_fetch_array($sql8);
        $staffno = $dql8['staffno'];    

        print $dql8["approval_status"];
    }

//ZUL: MIT90016
    function logged_in(){
        global $ses_staffno;
        if ($ses_staffno == "MIT90016") {
            //CEO 
            $logged_in_status = 1;
        } elseif ($ses_staffno == "6810") {
            //CSO
            $logged_in_status = 2;
        }

        return $logged_in_status;
    }
    

    function check_form_with_multiple_flow($id){
        
        // TRAVEL FORM 
        // [1] Normal User (Approval ID)
        // HOD = 1 / PROJECT MANAGER = 2 / BILLING1 = 4 / BILLING2 = 5 / ACCOUNT = 8 / PAYROLL = 9
        // [5] CEO
        // BILLING1 = 32 / BILLING = 33 / CSO = 34 / ACCOUNT = 35
        // [6] CSO
        // BILLING1 = 36 / BILLING = 37 / CEO = 38 / ACCOUNT = 39

        //ENTERTAINMENT FORM 
        // [2] Normal User
        // HOD = 10 / BILLING1 = 11 / BILLING2 = 12 / ACCOUNT = 13 / PAYROLL = 14
        // [] CEO 
        //
        // [] CSO
        //

        // ADVANCE FORM
        // [3] Every user (Approval ID)
        // HOD = 21 / Account = 20 / CEO = 19 / FINANCE = 18 / BILLING1 = 16 / BILLING2 = 17 / PROJECT MANAGER = 15
        
        // OVERTIME ()
        // [] < 60 
        // [] > 60


        global $mysqli;

        $q = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = $id");
        while($r = mysqli_fetch_array($q)){
                print $r["id"]."</br>";
        }


        

    }