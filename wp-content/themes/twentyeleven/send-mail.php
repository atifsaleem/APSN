<?php
include ('../../../wp-blog-header.php');
$url=home_url();
$to=$_POST['to'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$page=$_POST['page-id'];
$headers = 'From: APSN <apsn@gmail.com>' . "\r\n";
wp_mail( $to, $subject, $message, $headers ); 

header("Location: http://localhost/apsn/?page_id=".$page."&message=1&email=".$to);?>