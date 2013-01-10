<?

	// include instance
	include("./appinstance.php");

	// check for admin
	include("./includes/checkaccess.admin.php");

	// start
	include("./includes/header.admin.inc.php");

	$excerciseId=$app->requestFromWeb("excerciseId","string.azAZ");
	$excerciseObject=$app->getExcerciseById($excerciseId);
?>

<? echo(Display::displayAdminBreadCrump($app,$excerciseObject,null)) ?>

<h2>Administration: <?=$excerciseObject->excerciseName?> [ <a href='adminexcercise.php?excerciseId=<?=$excerciseObject->excerciseId?>'>Ablauf</a> | <a href='adminexcerciseusers.php?excerciseId=<?=$excerciseObject->excerciseId?>'>Users</a> | <a href='adminexcerciseresult.php?excerciseId=<?=$excerciseObject->excerciseId?>'>Resultate</a> ]</h2>
<h4>Resultate im Ablauf</h4>
<div id='excerciseFlow'>
<?
	// get all users
	$arrUsers=$app->getUsersByExcercise( $excerciseId  );
	// print_r($arrUsers);


	// 	$arr=$app->getAllExcerciseTasksFromExcercise( $excerciseId );
	$arr=$app->getAllActiveExcerciseTasksFromExcercise( $excerciseId );
	for ($i=0;$i<count($arr);$i++)
	{
		$obj=$arr[$i];

		// echo("<div  style='border: 1px dotted #888888; margin: 0px; padding: 0px; width: 700px; >");
		/*		echo("<form action='adminexcercise.php'>");
					echo("<input type=hidden name='action' value='updateexcercisetask' >");
					echo("<input type=hidden name='excerciseId' value='".$excerciseObject->excerciseId."' >");
					echo("<input type='hidden' name='excercisetaskId' value='".$obj->excercisetaskId."'>");
					echo("<input type='textfield' name='excercisetaskOrder' value='".$obj->excercisetaskOrder."'  size=1>");
					echo(Display::displayStatusActiveDeletedAsSelect( $app, "excercisetaskStatus", $obj->excercisetaskStatus ));
					// echo($obj->excercisetaskStatus."---");
		*/			
					echo("<div style='border-bottom:1px solid black;'><strong>");
						echo($obj->excercisetaskName);
					echo("</strong></div>");

					// go through all user and tasks
					for ($ii=0;$ii<count($arrUsers);$ii++)
					{
						$userObj=$arrUsers[$ii];
						// echo("<br>".$userObj->userId);
						$retTaskId=$app->getNextUserTaskNotDone($app, $userObj->userId, $excerciseId, -1, -2001);
						// echo("--".$retTaskId);

						$showLink=false;
						if ($obj->excercisetaskType=="otherevaluation") $showLink=true;

						if ($retTaskId==$obj->excercisetaskId) 
						{
							if ($showLink)
							{
								echo("<a href='adminevaluationother.php?excercisetaskId=".$obj->excercisetaskId."&userId=".$userObj->userId."'>".$userObj->userName.", ".$userObj->userPreName." [".$userObj->userClass."] ></a><br>");
							}
							else
							{
								echo("".$userObj->userName.", ".$userObj->userPreName."<br>");
							}
						}

					}
			


					// search for
					$type=$obj->excercisetaskType;
					if ($type=="writetext")
					{
						// search them all

					}

					if ($type=="otherevaluation")
					{

						/*
						// search them all
						// get id
						$inputexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $obj->excercisetaskId, "inputexcercisetaskId", -1 );
						$frameworkId=$app->getAdminExcerciseTaskAttributeInt( $obj->excercisetaskId, "frameworkId", -1 );
						// echo("".$inputexcercisetaskId." ".$frameworkId."<br>");
						
						// search for tasked closed .. here ..
						$arrClosedTasks=$app->getExcerciseTaskAttributesByAttributeNameAndValue( "taskwritetext", "done" );
						for ($it=0;$it<count($arrClosedTasks);$it++)
						{
							$attrObj=$arrClosedTasks[$it];
							// print_r($attrObj);
							// go there and submit
							$userId=$attrObj->excercisetaskattributeUserRef;
							$userObj=$app->getUserById($userId);
							$strUser="notknown"; if ($userObj!=null) { $strUser="".$userObj->userName.", ".$userObj->userPreName; }
							$taskId=$attrObj->excercisetaskattributeExcerciseTaskRef;
							// get task by id ...

							$displayNow=false;
							if ($attrObj->excercisetaskattributeExcerciseTaskRef==$inputexcercisetaskId) $displayNow=true;

							$displayNow=false;

							// task done
							$taskdone=$app->getUserExcerciseTaskAttributeString( $userId, $obj->excercisetaskId, "task", "tasknotdone" );
							if ($taskdone=="done") $displayNow=false;
 $displayNow=true;							
							if ($displayNow)
							{
								echo("<br><a href='adminevaluationother.php?excercisetaskId=".$obj->excercisetaskId."&userId=".$userObj->userId."'>".$strUser." ></a>");
							}
						}
						*/

					}

					echo("<br>");
		
		/*			echo("<input type='submit' value='ver&auml;ndern'>");
					echo(" | ");
					echo("<a href='adminexcercisetask.php?excercisetaskId=".$obj->excercisetaskId."'>'".$app->getExcerciseTaskNameByType($obj->excercisetaskType)."'' editieren > </a>");
				echo("</form>");
		*/
		// echo("</div>");
	}

	// done everything
	echo("<div style='border-bottom:1px solid black;'>");
		echo("<strong>Fertig</strong>");
	echo("</div>");
	for ($ii=0;$ii<count($arrUsers);$ii++)
	{
		$userObj=$arrUsers[$ii];
		// echo("<br>".$userObj->userId);
		$retTaskId=$app->getNextUserTaskNotDone($app, $userObj->userId, $excerciseId, -1, -2001);
		// echo("--".$retTaskId);
		if ($retTaskId==-2001) echo("".$userObj->userName.", ".$userObj->userPreName."<br>");
		// echo("<a href='adminevaluationother.php?excercisetaskId=".$obj->excercisetaskId."&userId=".$userObj->userId."'>".$userObj->userName.", ".$userObj->userPreName." [".$userObj->userClass."] ></a><br>");
	}
	
?>

</div>

<?

	// stop
	include("./includes/footer.inc.php");
?>