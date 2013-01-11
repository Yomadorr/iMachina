<?

	// include instance
	include("./appinstance.php");

	// excercise task handling
	include("./includes/excercisetaskhandling.user.php");

	// check logged in!
	include("./includes/checkaccess.user.php");

	// start
	include("./includes/header.inc.php");

	// print_r($excerciseObject);
	// print_r($excerciseTaskObject);
	$excerciseId=$excerciseObject->excerciseId;
	$excercisetaskObject=$excerciseObject;

	//  =
	$excercisetaskObjId=$excerciseTaskObject->excercisetaskId;
	$excercisetaskObject=$excerciseTaskObject;
	$excercisetaskId=$excerciseTaskObject->excercisetaskId;

// echo("****1---".$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "nofound" ));

	// search for the input of the questionnaire
	$arr=$app->getTaskQuestionnaireQuestionsByExcerciseTaskId($excercisetaskId);
	$someInput=false;
	$somethingNotThere=false;
	for ($r=0;$r<count($arr);$r++)
	{

		$questionObj=$arr[$r];
		// set?
		// selection!
		$isSelection=false;
		if ($questionObj->taskquestionnairequestionType=="selection") $isSelection=true;

		$isSomethingInRequest=false;
		$name="question".$questionObj->taskquestionnairequestionId;
		if (isset($_REQUEST[$name]))
		{
			$someInput=true;
			$val=$app->requestFromWeb("".$name,"string.azAZ");
			// echo("<br>$name :".$val);
			// if ($val!="")
			// {
				// store now here 
				$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "$name", "".$val );
			// }
		}

		// found something
		$valDb=$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "$name", "" );
		if ($valDb!="")
		{
			// echo("----".$valDb);
		 
		}
		else
		{
			$somethingNotThere=true;
		}

	}
	// some input?
	if (!$somethingNotThere)
	{
		// echo done!
		// echo("Something is there ... ");
		if ($app->requestFromWeb("action","string.azAZ")=="done")
		{
			$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
		}
	}

	// task
	$taskDone=false;

	// taskwritetextdone
	$action="";
	$action=$app->requestFromWeb("action","string.azAZ");
	// echo("action: $action");
	if ($action=="reset") // reset 
	{
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "" );
	}
	if ($action=="done")
	{
		// everything filled in?

// 		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
	}
	$ret=$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "nofound" );
	if ($ret=="done") { $taskDone=true;  } 

// echo("***2**---".$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "nofound" ));

	// echo("attribute:for($excercisetaskId)--/".$action."_".$ret."\--".$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "nofound" )."---".$taskDone);

?>

<?=Display::displayUserSideMenu($app,"questionnaire",$excerciseObject,$excercisetaskObject)?>

<h2><?=Display::displayUserTaskIcon("questionnaire",false)?><?=$excerciseTaskObject->excercisetaskName?></h2>

<? 
   // show the whole task
   if (!$taskDone)
   { 
		 echo(Display::displayRemarkTextToggle("questionnaire",false)); 


		 echo("<div id='userRemarkText'>".Display::displayTaskRemarkText($app,$excerciseTaskObject->excercisetaskId)."</div>");
	

		 // somethingNotThere
		 if ($somethingNotThere)
		 {
		 		echo("<div class='userLoginError'>Bitte alle Felder ausf&uuml;llen.</div>");
		 }

		 echo("".Display::displayQuestionnaire( $app, $excerciseTaskObject->excercisetaskId, "formhtml", $app->getSessionUserId() ));

		 // echo(Display::displayTaskFinish());
	}
	else
	{
		echo(Display::displayTaskRemarkTextArea($app,$excerciseTaskObject->excercisetaskId,"done")); 

		// a new link
		echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));

		// results
		// actual user ... 
		echo("".Display::displayQuestionnaire( $app, $excerciseTaskObject->excercisetaskId, "html", $app->getSessionUserId() ));

	}

	// start
	include("./includes/footer.inc.php");
?>
