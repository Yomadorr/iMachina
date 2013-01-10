<?

	// include instance
	include("./appinstance.php");

		// excercise task handling
	include("./includes/excercisetaskhandling.user.php");

	// check logged in!
	include("./includes/checkaccess.user.php");

	// start
	include("./includes/header.inc.php");

	// excercise object
	$excerciseId=$excerciseObject->excerciseId;
	$excercisetaskObject=$excerciseObject;
	$excercisetaskObjId=$excerciseTaskObject->excercisetaskId;
	$excercisetaskObject=$excerciseTaskObject;
	$excercisetaskId=$excerciseTaskObject->excercisetaskId;

	// is there a text for this 
	// get latest text and insert here ....
	// $app->getLatestText();
	$taskDescription="";

	$textInput="";

	$arr=$app->getTaskWriteTextDocumentsByTask($excercisetaskId,$app->session->userObject->userId);
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

	// no more ... 

	// taskwritetextdone
	$action="";
	$action=$app->requestFromWeb("action","string.azAZ");
	// echo("action: $action");
	$taskDone=false; 
	if ($action=="reset") // reset 
	{
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "" );
	}
	if ($action=="done")
	{
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
	}
	$ret=$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "nofound" );
	if ($ret=="done") { $taskDone=true;  } 



?>

<?=Display::displayUserSideMenu($app,"otherevaluation",$excerciseObject,$excercisetaskObject)?>

<h2><?=Display::displayUserTaskIcon("otherevaluation",true)?><?=$excerciseTaskObject->excercisetaskName?></h2>

<? echo(Display::displayRemarkTextToggle("Beurteilung",false)); ?>


<?
  // show the whole task
   // show the whole task
   if (!$taskDone)
   { 
		// echo(Display::displayTaskFinish());
		echo("<div id='userRemarkText'>".Display::displayTaskRemarkText($app,$excerciseTaskObject->excercisetaskId))."</div>"; 

	}
	else
	{
		echo(Display::displayTaskRemarkTextArea($app,$excerciseTaskObject->excercisetaskId,"done")); 

		// a new link
		echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));

	}

?>


<!-- your text / please store again -->


<?
	// start
	include("./includes/footer.inc.php");
?>
