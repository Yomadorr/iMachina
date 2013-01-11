<?

	// include instance
	include("./appinstance.php");

	// start
	// include("./includes/header.admin.inc.php");

	// check ... 
	// todo

	// start service
	include("./user.service.start.php");

	$area="taskwritetext";

	$inputObject=new FrameworkDimVal();

	// updateto
	$inputObject->updateToWebRequest($_REQUEST);


	// print_r($inputTaskWriteTextObject);
	
	// update to webrequest ...

	// todo: cases ... 
	// only admin can 

	// store
	if ($action=="store")
	{
		// $app->deleteUser($inputUserObject);
		// todo: done
		$output="";
		
		// todo: secure: excercisetask take from session! 
		
		$app->setFrameworkDimVal( $inputObject->frameworkdimvalUserRef, $inputObject->frameworkdimvalExcerciseTaskRef, $inputObject->frameworkdimvalDimRef,$inputObject->frameworkdimvalCatRef,"self");
	}

	// todo: used? think no ...

	// overview
	if ($action=="overview")
	{
		$output="";
		// $refId=$evaluationObj->taskevaluationFrameworkRef;
		$refId=1;
		$frameworkObj=$app->getFrameworkById( $refId );
		$output=$output.Display::displayFramework($app,$frameworkObj,"self",-1);
	

	}

	// $output="...";



	// stop service
	include("./user.service.stop.php");
	
	// stop
	// include("./includes/footer.inc.php");
?>