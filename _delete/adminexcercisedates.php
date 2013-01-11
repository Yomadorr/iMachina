<?

	// include instance
	include("./appinstance.php");

	// check for admin
	include("./includes/checkaccess.admin.php");

		// mode ...
	$userModeExcerciseRef=-1; // all
	// a special excercisetask
	// $userMode
	// $userModeExcerciseRef=40;

	// excerciseObject
	$excerciseId=$app->requestFromWeb("excerciseId","string.azAZ");
	$excerciseObject=$app->getExcerciseById($excerciseId);


	/*

		-----------------------------------------
		Filter
		-----------------------------------------

	*/
	// group
	$group=""; if (isset($_SESSION["group"])) $group=$_SESSION["group"];
	if (isset($_REQUEST["group"]))
//	if ($app->requestFromWebIsset( $group ))
	{
		$group=$app->requestFromWeb("group","string");
		$_SESSION["group"]=$group;
	}
	$class=""; if (isset($_SESSION["class"])) $class=$_SESSION["class"];
	if (isset($_REQUEST["class"]))
//	if ($app->requestFromWebIsset( $group ))
	{
		$class=$app->requestFromWeb("class","string");
		$_SESSION["class"]=$class;
	}
	$name=""; if (isset($_SESSION["name"])) $name=$_SESSION["name"];
	if (isset($_REQUEST["name"]))
//	if ($app->requestFromWebIsset( $group ))
	{
		$name=$app->requestFromWeb("name","string");
		$_SESSION["name"]=$name;
	}

	// start
	include("./includes/header.admin.inc.php");

	// sidemenu
	$sideMenuText="".Display::adminDisplayExcerciseDatesPointTop( $app, $excerciseObject, $userObj );
	include("./includes/header.adminsidemenu.inc.php");	

/*
echo($excerciseId);
echo("<hr>");
	print_r($excerciseObject);
echo("<hr>");
*/

// get all groups

	// $arr=$app->getAllUsersInExcercisesByExcerciseId( $excerciseId );
	// print_r($arr);

	// groups
	$arrGroups=$app->getAllUsersDistinctGroupInExcercisesByExcerciseId( $excerciseId );
	for ($a=0;$a<count($arrGroups);$a++)
	{
		$obj=$arrGroups[$a];
		// echo("<br>".$obj->userGroup);
	}
	// print_r($arr);
	$arrNewGroups=array();
	for ($a=0;$a<count($arrGroups);$a++)
	{
		$arrObj=$arrGroups[$a];
		
		// in array?
		$found=false;
		if (count($arrNewGroups)>0)
		for ($aa=0;$aa<count($arrNewGroups);$aa++)
		{
			$newObj=$arrNewGroups[$aa];
			if ($arrObj->userGroup==$newObj->userGroup)
			{
				$found=true;
				break;
			}
		}
		// not found > add ...
		if (!$found)
		{
			$arrNewGroups[count($arrNewGroups)]=$arrObj;
		}

	}
	$arrGroups=$arrNewGroups;
	/*
	echo("<hr><pre>");
		print_r($arrGroups);
	echo("</pre><hr>");
	*/

?> 
<h2>Timetable</h2>
<?
	// filter
	echo("<div class='adminContainerSmall'>");
		echo("<form action='adminexcercisedates.php'>");
		echo("<input type=button value='X' onClick=\"document.location.href='adminexcercisedates.php?excerciseId=$excerciseId&name=&class=&group=';\">");
		echo("<input type=hidden name='excerciseId' value='$excerciseId'> ");
		echo("Group: ");
		echo("<input type=text name='group' value='$group'>  ");
		echo("<input type=submit value='&Auml;ndern'>");
		echo("</form>");
	echo("</div>");



	// new User
	// import User
	echo("<div  class='adminContainerSmall'>");
	$arr=$app->getAllActiveExcerciseTasksFromExcercise( $excerciseId );
	$excercisetaskId=$app->requestFromWeb("excercisetaskId","string.09.-");
	for ($i=0;$i<count($arr);$i++)
	{
		$obj=$arr[$i];
		
					echo("<div style='border-bottom:1px solid black;'><strong>");
						echo($obj->excercisetaskName."");
					echo("</strong></div>");

					// description
					if ($obj->excercisetaskType=="start") echo("<div style='padding-top: 20px; padding-bottom: 20px; '>Start der ganzen Aufgabe. Mail mit Beschrieb (Editierbar im Ablauf).</div>");
					if ($obj->excercisetaskType=="readtext") echo("<div style='padding-top: 20px; padding-bottom: 20px; '>Halbzeit. Reminder-Email wegen der Schreibaufgabe. (Editierbar im Ablauf) </div>");
					if ($obj->excercisetaskType=="writetext") echo("<div style='padding-top: 20px; padding-bottom: 20px; '>Deadline für das Schreiben des Textes. Wer noch nicht fertig ist > geflaggt. </div>");

					// display
					$groupnameOld="";
					$countNames=0;

					for ($a=0;$a<count($arrGroups);$a++)
					{
						$objGroup=$arrGroups[$a];
						$name="group".$objGroup->userGroup;

						// show only one group
						// echo(" $groupnameOld - $name  ");
						// show only one group
						
						
						
						// filter
						if ($group!="")
						{
							// echo($group); echo($objGroup->userGroup);
							if ($objGroup->userGroup!=$group) continue;
						}

						if ($groupnameOld==$name) 
						{
							// break;
							// echo("*****");
							continue;
						}
						$groupnameOld=$name;



						// echo("<br>---".$name);
						// echo("  ".$obj->excercisetaskId);
						// new input?
						if ($obj->excercisetaskId==$excercisetaskId)
						if (isset($_REQUEST["userGroup"]))
						{
							$actiondate="";
							if (isset($_REQUEST["actiondate"]))
								$actiondate="".$_REQUEST["actiondate"];
							
							if ($actiondate=="update")
							{
								if ($app->requestFromWeb("userGroup","string.09")==$objGroup->userGroup)	
								{
									// echo(" :::: ...".$app->requestFromWeb("userGroup","string.09"));
									// echo("name!!!");
									$groupStartDate=$app->requestFromWeb("date","string.09.-");
									$app->setUserExcerciseTaskAttributeDateTime( -1, $obj->excercisetaskId, "$name", $groupStartDate );
								
									$groupDone=$app->requestFromWeb("done","string.09.-");
									$app->setUserExcerciseTaskAttributeString( -1, $obj->excercisetaskId, "done$name", $groupDone );
								
									$emailaddon=$app->requestFromWeb("emailaddon","string.09.-");
									$app->setUserExcerciseTaskAttributeString( -1, $obj->excercisetaskId, "emailaddon$name", $emailaddon );

									$overviewtaskaddon=$app->requestFromWeb("overviewtaskaddon","string.09.-");
									$app->setUserExcerciseTaskAttributeString( -1, $obj->excercisetaskId, "overviewtaskaddon$name", $overviewtaskaddon );

								}
							}
							if ($actiondate=="do")
							{
								if ($app->requestFromWeb("userGroup","string.09")==$objGroup->userGroup)	
								{
									// do this task
									// echo("do it");

									$html=$app->cronjobDoExcerciseTaskId( $excercisetaskId, $objGroup->userGroup );
									echo($html);
									/*
									// echo(" :::: ...".$app->requestFromWeb("userGroup","string.09"));
									// echo("name!!!");
									$groupStartDate=$app->requestFromWeb("date","string.09.-");
									$app->setUserExcerciseTaskAttributeDateTime( -1, $obj->excercisetaskId, "$name", $groupStartDate );
								
									$groupDone=$app->requestFromWeb("done","string.09.-");
									$app->setUserExcerciseTaskAttributeString( -1, $obj->excercisetaskId, "done$name", $groupDone );
									*/
								}
							}
						}

						// work on 
						$val=$app->getUserExcerciseTaskAttributeDateTime( -1, $obj->excercisetaskId, "$name", "" );
						$valdone=$app->getUserExcerciseTaskAttributeString( -1, $obj->excercisetaskId, "done$name", "no" );
						$valemailaddon=$app->getUserExcerciseTaskAttributeString( -1, $obj->excercisetaskId, "emailaddon$name", "Bitte lösen Sie die Aufträge von TOSS 2012 bis Freitag, TT. MMMM JJ, um hh:mm Uhr.» " );

						$overviewtaskaddon=$app->getUserExcerciseTaskAttributeString( -1, $obj->excercisetaskId, "overviewtaskaddon$name", "" );
/*
						

	    $app->setAdminExcerciseTaskAttributeDateTime( $excercisetaskObject->excercisetaskId, "$name", $resultexcercisetask );
		$resultexcercisetask=$app->requestFromWeb("resultexcercisetask","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "resultexcercisetask", $resultexcercisetask );

		$excercisetaskexcerciseinpdf=$app->requestFromWeb("excercisetaskexcerciseinpdf","string.09");
		$app->setAdminExcerciseTaskAttributeDateTime( $excercisetaskObject->excercisetaskId, "excercisetaskexcerciseinpdf", $excercisetaskexcerciseinpdf );
	
*/




						// display
						$displayInput=false;
						if ($obj->excercisetaskType=="start") $displayInput=true;
						if ($obj->excercisetaskType=="readtext") $displayInput=true;
						if ($obj->excercisetaskType=="writetext") $displayInput=true;
						if ($displayInput)
						{
							echo("<div>");

								echo("<form action='adminexcercisedates.php'>");
								echo("<input type=hidden name='actiondate' value='update'>");
								echo("<input type=hidden name='excerciseId' value='$excerciseId'>");
								echo("<input type=hidden name='excercisetaskId' value='".$obj->excercisetaskId."'>");
								echo("<input type=hidden name='userGroup' value='".$objGroup->userGroup."'>");
									echo("\nGruppe: ".$objGroup->userGroup."   ");
									echo("<input type='textfield' size=21 name='date' value='$val'> <i style='font-size:9px'>2012-02-29 09:13:20</i>  ");
									echo(" ");
								/*
									echo(" Auf: <input type='textfield' size=1 name='triggerdone' value=''>( /no/yes) ");
								*/
									echo(" Ausgef&uuml;hrt: <input type='textfield' size=1 name='done' value='$valdone'>( /no/yes) ");
								
									echo("<input type=submit value='Datum setzen'> ");
									echo("<input type=button onClick=\"document.location.href='adminexcercisedates.php?actiondate=do&excerciseId=$excerciseId&excercisetaskId=".$obj->excercisetaskId."&userGroup=".$objGroup->userGroup."';\" value='Jetzt ausf&uuml;hren'> ");
									if (
										($obj->excercisetaskType=="start")
										||
										($obj->excercisetaskType=="readtext")
										)
									{
										echo("<div style='padding-left: 70px;'>Abgabe der Gruppe bis: <input type='textfield' size=70 name='emailaddon' value='$valemailaddon'></div>");

									}
									
									// abgabe ... 
									echo("<div style='padding-left: 70px;'>Text in der &Uuml;bersicht (<input type='textfield' size=70 name='overviewtaskaddon' value='$overviewtaskaddon'>) </div>");
								
								echo("</form>");
							echo("</div>");
						}

						
					}							
					echo("<div style='padding-top: 10px;'>&nbsp;</div>");
					
	}


	echo("</div>");


	// stop
	include("./includes/footer.inc.php");
?>