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

	$inputTaskWriteTextObject=new TaskWriteTextDocument();

	// updateto
	$inputTaskWriteTextObject->updateToWebRequest($_REQUEST);
	// print_r($_REQUEST);
	// print_r($inputTaskWriteTextObject);

	// print_r($inputTaskWriteTextObject);
	
	// update to webrequest ...

	// todo: cases ... 
	// only admin can 

	if ($action=="store")
	{
		// inputTaskWriteTextObject
		// take the user here ...
		$inputTaskWriteTextObject->taskwritetextdocumentUserRef=$app->getSessionUserId();
		// print_r($inputTaskWriteTextObject);

		// todo - dirty version!
		// > do it in the correct versionn !
		$inputTaskWriteTextObject->taskwritetextdocumentText=str_replace("\\'","'",$inputTaskWriteTextObject->taskwritetextdocumentText);
		$inputTaskWriteTextObject->taskwritetextdocumentText=str_replace("'","''",$inputTaskWriteTextObject->taskwritetextdocumentText);
		// echo("---".$content);

		$app->insertTaskWriteTextDocument($inputTaskWriteTextObject);
		echo("Letzte Sicherung: ".date("H:i:s"));
	}

	// start the excercise here
	if ($action=="startexcercise")
	{
		// echo("stored!");
		$excercisetaskId=$app->requestFromWeb("excercisetaskId","string.0-9");
		$timestamp=time();
		$app->setActualUserExcerciseTaskAttributeInt(  $excercisetaskId, "excercisetaskwritestart", "".$timestamp );

		// do it now!! store it here!
		/*
		// inputTaskWriteTextObject
		// take the user here ...
		$inputTaskWriteTextObject->taskwritetextdocumentUserRef=$app->getSessionUserId();
		// print_r($inputTaskWriteTextObject);
		$app->insertTaskWriteTextDocument($inputTaskWriteTextObject);
		echo("Letzte Sicherung: ".date("H:i:s"));
		*/
	}



	// stop service
	include("./user.service.stop.php");
	
	// stop
	// include("./includes/footer.inc.php");
?>