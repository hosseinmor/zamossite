<?php

$mailto = 'moslemyan@gmail.com' ;

$subject = "Online order through zamosdesign.com' (Order page)" ;

$formurl = "http://www.zamosdesign.com/order.htm" ;
$errorurl = "http://www.zamosdesign.com/error.htm" ;
$thankyouurl = "http://www.zamosdesign.com/confirm.htm" ;

$uself = 0;

$headersep = (!isset( $uself ) || ($uself == 0)) ? "\r\n" : "\n" ;
$name = $_POST['name'] ;
$tel = $_POST['tel'] ;
$code = $_POST['code'] ;
$email = $_POST['email'] ;
$message = $_POST['message'] ;
$http_referrer = getenv( "HTTP_REFERER" );

if (!isset($_POST['email'])) {
	header( "Location: $formurl" );
	exit ;
}
if (empty($name) || empty($email) || empty($code)) {
   header( "Location: $errorurl" );
   exit ;
}
if ( ereg( "[\r\n]", $name ) || ereg( "[\r\n]", $email ) ) {
	header( "Location: $errorurl" );
	exit ;
}

if (get_magic_quotes_gpc()) {
	$message = stripslashes( $message );
}

$messageproper =

	"This message was sent from:\n" .
	"$http_referrer\n" .
	"------------------------------------------------------------\n" .
	"Name: $name\n" .
	"code: $code\n" .
	"Tel: $tel\n" .
	"e-Mail: $email\n" .
	
	
	"------------------------- Message -------------------------\n\n" .
		
	$message .
	
	"\n\n------------------------------------------------------------\n" ;

mail($mailto, $subject, $messageproper,
	"From: \"$name\" <$email>" . $headersep . "Reply-To: \"$name\" <$email>" . $headersep . "X-Mailer: chfeedback.php 2.08" );
header( "Location: $thankyouurl" );
exit ;

?>
