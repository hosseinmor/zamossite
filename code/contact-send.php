<?php

$mailto = 'Ahnenberg@hotmail.com' ;

$subject = "Contact through site' (Contact page)" ;

$formurl = "http://www.jqc.com/contact.htm" ;
$errorurl = "http://www.jqc.com/error.htm" ;
$thankyouurl = "http://www.jqc.com/confirm.htm" ;

$uself = 0;

$headersep = (!isset( $uself ) || ($uself == 0)) ? "\r\n" : "\n" ;
$name = $_POST['name'] ;
$company = $_POST['company'] ;
$responsibility = $_POST['responsibility'] ;
$tel = $_POST['tel'] ;
$fax = $_POST['fax'] ;
$email = $_POST['email'] ;
$site = $_POST['site'] ;
$message = $_POST['message'] ;
$http_referrer = getenv( "HTTP_REFERER" );

if (!isset($_POST['email'])) {
	header( "Location: $formurl" );
	exit ;
}
if (empty($name) || empty($email) || empty($message)) {
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
	"Company: $company\n" .
	"Tel: $tel\n" .
	"e-Mail: $email\n" .
	"Website: $site\n" .
	
	
	"------------------------- Message -------------------------\n\n" .
		
	$message .
	
	"\n\n------------------------------------------------------------\n" ;

mail($mailto, $subject, $messageproper,
	"From: \"$name\" <$email>" . $headersep . "Reply-To: \"$name\" <$email>" . $headersep . "X-Mailer: chfeedback.php 2.08" );
header( "Location: $thankyouurl" );
exit ;

?>
