<?

	// include instance
	include("./appinstance.php");

	// excercise task handling
	include("./includes/excercisetaskhandling.user.php");

	// check logged in!
	include("./includes/checkaccess.user.php");

	// print_r($excerciseObject);
	// print_r($excerciseTaskObject);

	$debugThisSide=false;

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

	// waiting
	$waiting=false;



	$excercisetaskexcercisewaiting=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskexcercisewaiting",  0 );
	$excercisetaskexcercisewaitingerror=$app->getAdminExcerciseTaskAttributeString( $excercisetaskObject->excercisetaskId, "excercisetaskexcercisewaitingerror", "notfound" );

	if ($debugThisSide) echo("--- excercisetaskexcercisewaiting: $excercisetaskexcercisewaiting excercisetaskexcercisewaitingerror: $excercisetaskexcercisewaitingerror");

	// waiting
	if ($excercisetaskexcercisewaiting>0) $waiting=true;

	// echo("waiting: ".$waiting);

	// waiting ... 
	if (!$waiting)
	{
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
	}

	// firsttime
	$firsttime=false;

	// waiting
	$diffMinutes=0;
	if ($waiting)
	{
		$actualStatus=$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "" );
		if ($actualStatus=="")
		{
			// first time!
			$firsttime=true;

			// set ... time 
			$app->setUserExcerciseTaskAttributeDateTimeNow( $app->getSessionUserId(), $excerciseTaskObject->excercisetaskId, "taskstart" );
			$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "waiting" );
		}

		$actualStatus=$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "" );
		if (($action=="done")||($actualStatus=="waiting"))
		{

			// really done this?
			
			// $app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
			$actualStatus=$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "" );
			if ($actualStatus=="waiting")
			{
				$taskstart=$app->getUserExcerciseTaskAttributeDateTime( $app->getSessionUserId(), $excerciseTaskObject->excercisetaskId, "taskstart", "..." );

				// $app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "waiting" );
				// $app->setUserExcerciseTaskAttributeDateTimeNow( $userId, $excerciseTaskObject->excercisetaskId, "taskstart" );
				$taskstartDate=strtotime($taskstart);
				$diff=time()-$taskstartDate;
				$diffMinutes=((int)$diff)/60;
				// echo($diffMinutes);

				if ($diffMinutes>=$excercisetaskexcercisewaiting)
				{
					$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
					header("location: userexcercise.php");
				}

			}


		}
	}
	
	$ret=$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "" );
	if ($debugThisSide) echo("getActualUserExcerciseTaskAttributeString $ret");
	if ($ret=="done") { $taskDone=true;  } 

	// start
	include("./includes/header.inc.php");


	/*
	// default
	$doThis=true;

	// is there a waiting thing here?


	// do this .. 
	if ($doThis)
	{
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );

		// go to the overview
		// header("location: userexcercise.php");
	}
	*/

?>

<?=Display::displayUserSideMenu($app,"excercise",$excerciseObject,$excercisetaskObject)?>

<h2><?=Display::displayUserTaskIcon("readtext",true)?><?=$excerciseTaskObject->excercisetaskName?> <? echo(Display::displayRemarkTextToggle("",false)); ?></h2>

<? echo("<div id='userRemarkText'>".Display::displayTaskRemarkText($app,$excerciseTaskObject->excercisetaskId))."</div>"; ?>

<?
  // show the whole task
   // show the whole task
	// echo(Display::displayTaskRemarkTextArea($app,$excerciseTaskObject->excercisetaskId,"done")); 

if ($debugThisSide) echo("taskDone $taskDone");


   if (!$taskDone)
   { 
		if ($waiting)
		{
			if (!$firsttime)
			{
				echo("<div class='userLoginError'><a name='waitinganchor'>$excercisetaskexcercisewaitingerror</a>");
				// if ($diffMinutes<) {  }
				$diffToEnd=intval($excercisetaskexcercisewaiting-$diffMinutes);
				echo("<br><br>Freischaltung der n&auml;chsten Aufgabe in ".($diffToEnd+1). " Minuten.");
				echo("</div>");
			}
		}
		// error ... 
		echo(Display::displayTaskFinish("Teilaufgabe abschliessen","userexcercisetaskreadtext.php#waitinganchor"));
	}
	else
	{

		// a new link
		// echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));
		// echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));
		// echo(Display::displayTaskFinish());
		echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));

	}



	// start
	include("./includes/footer.inc.php");
?>
