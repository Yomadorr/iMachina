<?

	// include instance
	include("./appinstance.php");

	// excercise task handling
	include("./includes/excercisetaskhandling.user.php");

	// check logged in!
	include("./includes/checkaccess.user.php");
	
	// start
	include("./includes/header.inc.php");


	// first time on this side
	// > start done!
	$arr=$app->getAllActiveExcerciseTasksFromExcercise( $excerciseObject->excerciseId );
	for ($i=0;$i<count($arr);$i++)
	{
		$obj=$arr[$i];
		$strDone=$app->setActualUserExcerciseTaskAttributeString(  $obj->excercisetaskId, "task", "done" );
		// add a second thing to suppress the 
		$suppressdone=$app->getActualUserExcerciseTaskAttributeString(  $obj->excercisetaskId, "tasksuppressdone", "notdefined" );
		if ($suppressdone=="notdefined")
		{
			if ($i==0) $strSuppress=$app->setActualUserExcerciseTaskAttributeString(  $obj->excercisetaskId, "tasksuppressdone", "yes" );
		}
		break;
	}

?>

<?=Display::displayUserSideMenu($app,"excercise",$excerciseObject,null)?>

<!-- <h1><?=$excerciseObject->excerciseName?></h1> -->
<h1>Aktuelle Aufgaben</h1>

<div id='excerciseFlow'>
<?
	$arr=$app->getAllActiveExcerciseTasksFromExcercise( $excerciseObject->excerciseId );
	$firstOpen=true;
	for ($i=0;$i<count($arr);$i++)
	{
		$obj=$arr[$i];
		echo("<div style='margin: 0px; padding-bottom: 5px; '>");
			$link="userexcercisetask.php?taskId=".$obj->excercisetaskId; 
			echo("<a href='$link'>".Display::displayUserTaskIcon( $obj->excercisetaskType, false)." ".$obj->excercisetaskName);
			/*
			$val=$app->getExcerciseTaskStatusValueByExcerciseTaskAndUser( $obj, $app->session->userObject );
			if ($val!=null) { 
				if ($val=="done") { echo("&nbsp;<img src='imgs/overviewdone.jpg'>"); }

			}
			*/
					// type
					$type=$obj->excercisetaskType;
					// echo($type);
					// get date & time 
					// $timestamp = strtotime($string);
					// date("Y-m-d H:i:s", $timestamp)
					// get date for this .. 
					// print_r($userObj);

					// version 1
					/*
					// dates
					$flagShowDate=false;

					// if ($type=="start")  $flagShowDate=true;
					// if ($type=="readtext")  $flagShowDate=true;
					if ($type=="writetext")  $flagShowDate=true;

					if ($flagShowDate)
					{
						$name="group".$userObj->userGroup;
						// echo($name);
						$valDateTime=$app->getUserExcerciseTaskAttributeDateTime( -1, $obj->excercisetaskId, "$name", "notfound" );
						if ($valDateTime!="notfound")
						{
							// echo(" $valDateTime");
							$dateObj=strtotime($valDateTime);
							// print_r($dateObj);
							echo(" ( ");
								if ($type=="start") echo("Ab ");
								if ($type=="readtext") echo("Richtzeit ");
								if ($type=="writetext") echo("Abgabe bis ");
								echo(" ".Display::showDate($dateObj)." ");
							echo(" ) ");
							// print_r($dat);

						}
					}
					echo("</a>");
					*/

					// version 2
					$flagShowDate=true;
					// if ($type=="start")  $flagShowDate=true;
					// if ($type=="readtext")  $flagShowDate=true;
					// if ($type=="writetext")  $flagShowDate=true;
					if ($flagShowDate)
					{
						$name="group".$userObj->userGroup;
						// echo($name);
						$valDateTime=$app->getUserExcerciseTaskAttributeString( -1, $obj->excercisetaskId, "overviewtaskaddon$name", "notfound" );
						// echo("---".$valDateTime."---");
						if ($valDateTime!="notfound")
						if ($valDateTime!="")	
						{
							// echo(" $valDateTime");
							$dateObj=strtotime($valDateTime);
							// print_r($dateObj);
							echo(" ( ");
								/*
								if ($type=="start") echo("Ab ");
								if ($type=="readtext") echo("Richtzeit ");
								if ($type=="writetext") echo("Abgabe bis ");
								echo(" ".Display::showDate($dateObj)." ");
								*/
								echo(" ".$valDateTime." ");
							echo(" ) ");
							// print_r($dat);

						}
					}


			$strDone=$app->getActualUserExcerciseTaskAttributeString(  $obj->excercisetaskId, "task", "notfound" );
			if (($strDone=="notfound")||($strDone=="")||($strDone=="no")||($strDone=="waiting")||($strDone=="failed")||($strDone=="processing")) 
			{

				if ($firstOpen)
				{
					echo(" &nbsp;<img src='imgs/iconcheckbox.gif'> ");					
					$firstOpen=false;
				}
				else
				{
					// echo(" &nbsp;<div style='border: 1px solid black; font-size: 12px; padding: 1px; display:inline; '>noch geschlossen</div>");
					echo(" &nbsp;<img src='imgs/iconlocksmall.png' border=0>");
				}
			}
						

			if ($strDone=="done")
			{
				$suppress=false;

				// suppress?
				if ($i==0)
				{
					$suppress=$app->getActualUserExcerciseTaskAttributeString(  $obj->excercisetaskId, "tasksuppressdone", "notfound" );
					// echo($suppress);
					if ($suppress!="notfound")
					{
						if ($suppress=="yes")
						{
							$suppress=true;	
						}
					}
				}	

				if (!$suppress)
				{
					echo(" &nbsp;<img src='imgs/iconcheckboxchecked.gif'> ");
				}
				else
				{
					echo(" &nbsp;<img src='imgs/iconcheckbox.gif'> ");	
				}
			}
			// if ($strDone!="notfound") { }

		echo("</div>");
	}
	

	// echo($app->debugWorkSessionExcercise($_SESSION));

?>
</div>
<?
	// stop
	include("./includes/footer.inc.php");
?>