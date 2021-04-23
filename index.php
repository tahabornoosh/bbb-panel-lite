<?php 
require "incl/dbconn.php";
require "incl/functions.php";?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>بیگ بلو باتن</title>

<style>
	body, div, h1, h2, h3, h4, h5, h6, p, ul, ol, li, dl, dt, dd, img, form, fieldset, input, textarea, blockquote {
	margin: 0; padding: 0; border: 0;
}

body {
	background: #a9afb5;
	font-family: 'Segoe UI', sans-serif;
	font-size: 18px;
	line-height: 24px;
}

.logo {
	height: 115px;
    width: 263px;
    margin: 20px auto 0px auto;
    background: url(logo.png);
}

nav {
	margin: 45px auto;
	text-align: center;
}

nav ul ul {
	display: none;
}

nav ul li:hover > ul {
	display: block;
}

nav ul {
	background: #f1f4f7;
	box-shadow: 0px 0px 9px rgba(0,0,0,0.15);
	padding: 0 20px;
	border-radius: 10px;
	list-style: none;
	position: relative;
	display: inline-table;
}
nav ul:after {
	content: "";
	clear: both;
	display: block;
}

nav ul li {
	float: right;
	position: relative;
	font-weight: bold;
}

nav ul li:hover {
	background: #a70101;
}

nav ul li:hover a {
	color: #fff;
}

nav ul li a {
	display: block;
	padding: 15px 32px;
	color: #4e4e4e;
	text-decoration: none;
}

nav ul ul {
	background: #9c0000;
	border-radius: 0px;
	padding: 0;
	position: absolute;
	top: 100%;
	right: 0;
	width: 200px;
}
nav ul ul li {
	float: none;
	border-top: 1px solid #940000;
	border-bottom: 1px solid #940000;
	position: relative;
}
nav ul ul li a {
	padding: 15px 40px;
	color: #fff;
}	
nav ul ul li a:hover {
	background: #112f44;
}
		
nav ul ul ul {
	position: absolute;
	right: 100%;
	top:0;
}
		

</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<nav>
	<ul>
		<li><a href="index.php">صفحه اصلی</a></li>
		<li><a href="admin/login.php">ورود</a>
	</ul>
</nav>
<h1 style="text-align : center;">
اتاق های عمومی
</h1>
<?php
$sql = "SELECT * FROM rooms WHERE type='1' AND visible='1'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<div style="background-color : red;font-size : 30px; padding : 20px; margin : 50px; border-radius : 110px">
	<b>'.$row['name'].'</b>
	<a href="room/login.php?id='.$row['id'].'" style="color : black"><i class="fa fa-sign-in" style="text-align : left"></i></a>
	</div>';
  }
} else {
  echo "<b style='text-align : center'>no record found</b>";
}
require "incl/footer.php"
?>
</body>
</html>