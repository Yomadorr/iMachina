<?

	// include instance
	include("./appinstance.php");


	echo("<html>");
	echo("<body>TEST EMAIL");

	$arrAddress=array("rene.bauer@zhdk.ch");
	$done=$app->sendEmailWithTitleText($arrAddress,"test ".time(),"send this email....");
	echo($done);

	// stop
	include("./includes/footer.inc.php");
?>