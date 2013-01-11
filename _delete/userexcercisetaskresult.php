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


	// default
	$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );

	// taskdone?
	$taskDone=false;



	// 	textinput
	// todo: getTaskWriteText...
	$textInput="Konnte keinen Text finden...";

	$selfexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "selfexcercisetaskId", -1 );
	$selfexcerciseTaskObject=$app->getExcerciseTaskById($selfexcercisetaskId);

	// other
	$otherexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "otherexcercisetaskId", -1 );
	// $selfexcerciseTaskObject=$app->getExcerciseTaskById($selfexcercisetaskId);


	
	$tasktextwriteId=$app->getAdminExcerciseTaskAttributeInt( $selfexcerciseTaskObject->excercisetaskId, "inputexcercisetaskId", -1 );
	$arr=$app->getTaskWriteTextDocumentsByTaskAndUser($tasktextwriteId,$app->session->userObject->userId);
	// print_r($arr);
	if (count($arr)>0)
	{
		$objDocument=$arr[0];
		$textInput="".$objDocument->taskwritetextdocumentText;
		
	}
	else
	{
		// generate one ...		
		// not existing - make one!
		// $app->insertTaskWriteText();
	}

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


	
	// tod
	// id==-1 > admin site
	
	// excerciseObject
	// $excerciseObject=$app->getExcerciseById($excerciseId);

		// start
	include("./includes/header.inc.php");

?>

<?=Display::displayUserSideMenu($app,"result",$excerciseObject,$excercisetaskObject)?>

<h2><?=Display::displayUserTaskIcon("result",true)?><?=$excerciseTaskObject->excercisetaskName?></h2>

<? 
   // show the whole task
   if (!$taskDone)
   { 

?>

<? echo(Display::displayRemarkTextToggle("Beurteilung",true)); ?>
<? echo("<div id='userRemarkText'>".Display::displayTaskRemarkText($app,$excerciseTaskObject->excercisetaskId))."</div>"; ?>

<? 
	echo(Display::displayFramework($app,$excercisetaskId,"both",-1));
?>


<?
	// display original text here
		// get content from input
	// echo("<div style='border: 1px dotted #999999; padding-left: 10px; padding-right: 10px; '>".$textInput."</div>");
?>		
<?
} // task


	// task done!
	if (!$taskDone)
	{
		 echo(Display::displayTaskRemarkTextArea($app,$excerciseTaskObject->excercisetaskId,"done")); 


		// suggestion
		$displaySuggestion=false;
		$suggestionIdSelected=$app->getUserExcerciseTaskAttributeString( $app->session->userObject->userId, $otherexcercisetaskId, "suggestionId", "-1" );
		if ($suggestionIdSelected!=-1) $displaySuggestion=true;
		if ($displaySuggestion)
		{
			$suggestionText=$app->getSuggestionById($suggestionIdSelected);
			if ($suggestionText!=null)
			{
				echo("<div>");
					echo("<h3>Empfehlung</h3>");
					echo($suggestionText->suggestionText);
				echo("</div>");
				echo("<br>");
			}
		}

		// a new link
		// echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));

	}

	echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));

	/*
	 // show the text here
	 echo("<br><div id_='excercisetaskwritetextDone'>");
		 echo($textInput);
	 echo("</div>");
	 */

	// start
	include("./includes/footer.inc.php");
?>
