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

	// taskwritetextdone
	$action="";
	$action=$app->requestFromWeb("action","string.azAZ");
	// echo("action: $action");
	$taskDone=false; 
	if ($action=="reset") // reset 
	{
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "" );
	}
	/*
	if ($action=="done")
	{
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
	}
	$ret=$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "nofound" );
	if ($ret=="done") { $taskDone=true;  } 
	*/



	// default
	$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
	$suppress=$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "tasksuppressdone", "" );

?>

<?=Display::displayUserSideMenu($app,"excercise",$excerciseObject,$excercisetaskObject)?>

<h2><?=Display::displayUserTaskIcon("start",true)?><?=$excerciseTaskObject->excercisetaskName?> <? echo(Display::displayRemarkTextToggle("",false)); ?></h2>

<? echo("<div id='userRemarkText'>".Display::displayTaskRemarkText($app,$excerciseTaskObject->excercisetaskId))."</div>"; ?>

<?
  // show the whole task
   // show the whole task
/*
   if (!$taskDone)
   { 
		echo(Display::displayTaskFinish());
	}
	else
	{
		echo(Display::displayTaskRemarkTextArea($app,$excerciseTaskObject->excercisetaskId,"done")); 

		// a new link
		echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));

	}
	*/

		echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));


	// start
	include("./includes/footer.inc.php");
?>
