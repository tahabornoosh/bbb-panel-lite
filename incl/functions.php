<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
session_start();
$url = 'http://test-install.blindsidenetworks.com/bigbluebutton/api';
$secret = '8cd8ef52e8e101574e400365b55e11a6';
$endpoint = '/';
$surl = "http://localhost/phpproject/bbb-conn/";
function redirect($url)
{
    if (!headers_sent()){
        header("Location: $url");
    }else{
        echo "<script type='text/javascript'>window.location.href='$url'</script>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=$url'/></noscript>";
    }
    exit;
}
function mnnv($value) {
    if(!isset($value)) {
        return false;
    }
    else if($value == NULL) {
        return false;
    }
    else if($value == "") {
        return false;
    }
    else {
        return true;
    }
}
function chqu($sql) {
    if ($conn->query($sql) === TRUE) {
      } else {
        echo "Query error: " . $conn->error;
      }
}
function mres($str) {
    return(mysqli_real_escape_string($conn, $str));
}

function gib($min = 100,$max = 999,$count = 4) {

    if($max - $min < $count) { 
        return false; 
    } 

   $nonrepeatarray = array(); 
   for($i = 0; $i < $count; $i++) { 
      $rand = rand($min,$max); 

        while(in_array($rand,$nonrepeatarray)) { 
         $rand = rand($min,$max); 
         } 

      $nonrepeatarray[$i] = $rand; 
   } 
     return $nonrepeatarray['0']."-".$nonrepeatarray['1']."-".$nonrepeatarray['2']."-".$nonrepeatarray['3']; 
}
function giveroll($rid) {
    if($rid == 0) {
        return("<li style='color : #f7e612;' class='fas fa-user'></li> guset (میهمان)");
    }
    else if($rid == 1) {
        return("<li class='fas fa-user'></li> viewer (کاربر عادی)");
    }
    else if($rid == 2) {
        return("<li style='color : blue;' class='fas fa-user'></li> moderator (مجری)");
    }
    else if($rid = 3) {
        return("<li style='color : red;' class='fas fa-user'></li> Admin (مدیر)");
    }
}
function gcpu() {
    return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
function givemainroll($rid) {
    if($rid == 0) {
        return("<span style='color : green'>کاربر عادی</span>");
    }
    else if($rid == 1) {
        return("<span style='color : blue'>برگزار کننده</span>");
    }
    else if($rid == 2) {
        return("<span style='color : red'>مدیر سیستم</span>");
    }
}
function tf10($tf) {
    if($tf == 0) {
        return(false);
    }
    else if($tf == 1) {
        return(true);
    }
}