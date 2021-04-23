<?php
require 'incl/functions.php';
unset($_SESSION['login']);
unset($_SESSION['mainrole']);
redirect('index.php');
?>