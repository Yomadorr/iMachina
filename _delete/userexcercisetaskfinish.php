<?

	// include instance
	include("./appinstance.php");

	// excercise task handling
	include("./includes/excercisetaskhandling.user.php");

	// check logged in!
	include("./includes/checkaccess.user.php");



	$excerciseId=$excerciseObject->excerciseId;
	$excercisetaskObject=$excerciseObject;

	//  =
	$excercisetaskObjId=$excerciseTaskObject->excercisetaskId;
	$excercisetaskObject=$excerciseTaskObject;
	$excercisetaskId=$excerciseTaskObject->excercisetaskId;


	// taskdone?
	$taskDone=false;


	// default
	$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );


//	$frameworkObj=$app->getFrameworkById( $evaluationObj->taskevaluationFrameworkRef );
//	print_r($frameworkObj);


/*
print_r($excercisetaskObject);


	$excercisetaskObjId=-1;
	// print_r($excercisetaskObject);

	// is there a text for this 
	// get latest text and insert here ....
	// $app->getLatestText();
	$textInput="";
	$arr=$app->getTaskWriteTextsByExcerciseTaskAndUser($excercisetaskId,$app->session->userObject->userId);
	// print_r($arr);
	if (count($arr)>0)
	{
		//print_r($arr);

		// arr
		// take first one
		$taskWriteTextObj=$arr[0];
		$excercisetaskObjId=$taskWriteTextObj->taskwritetextId;

		// search for texts
		$arrDocument=$app->getTaskWriteTextDocumentsByTaskWriteText( $taskWriteTextObj->taskwritetextId );
		// print_r($arrDocument);
		if (count($arrDocument)>0) 
		{
			$objDocument=$arrDocument[0];
			$textInput="".$objDocument->taskwritetextdocumentText;
		}

	}
	else
	{
		// generate one ...		
		// not existing - make one!
		// $app->insertTaskWriteText();
	}
*/


	$excerciseId=$excerciseObject->excerciseId;
	$excercisetaskObject=$excerciseObject;

	//  =
	$excercisetaskObjId=$excerciseTaskObject->excercisetaskId;
	$excercisetaskObject=$excerciseTaskObject;
	$excercisetaskId=$excerciseTaskObject->excercisetaskId;
	
	// tod
	// id==-1 > admin site
	
	// excerciseObject
	// $excerciseObject=$app->getExcerciseById($excerciseId);

		// start
	include("./includes/header.inc.php");

?>

<?=Display::displayUserSideMenu($app,"close",$excerciseObject,$excercisetaskObject)?>

<h2><?=Display::displayUserTaskIcon("close",true)?><?=$excerciseTaskObject->excercisetaskName?></h2>


<? 
   // show the whole task
   if (!$taskDone)
   { 

?>
	<? echo(Display::displayTaskRemarkText($app,$excerciseTaskObject->excercisetaskId)); ?>
	<!-- <a onClick="$('#taskdescription').toggle('fast');">[ Aufgabenstellung Ein- und Ausklappen ]</a> -->

<? 
	// download
	echo("<div><a class='linkColor' href='userexcercisetaskpdf.php' target='_blank'>".Display::displayUserIconPDF()."Download als PDF ></a></div>");

?>
 <?



} // task

	// task done!
	if ($taskDone)
	{
		 echo(Display::displayTaskRemarkTextArea($app,$excerciseTaskObject->excercisetaskId,"done")); 

		 // show the text here
		 echo($textInput);
		 
		 // show ... 


		// a new link
		echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));


	}



	// start
	include("./includes/footer.inc.php");
?>
