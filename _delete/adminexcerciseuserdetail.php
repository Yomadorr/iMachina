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

	// userId
	$userId=$app->requestFromWeb("userId","string.azAZ");
	//echo($userId);
	if ($userId!=-1) $userObject=$app->getUserById($userId);

	// action
	$action="";
	if (isset($_REQUEST["action"]))
	{
		$action="".$_REQUEST["action"];
		if ($action=="add")
		{
			$userObject=new User();
			$userObject->updateToWebRequest($_REQUEST); 
			// $app->insertUser($userObject);
			$app->insertUserAndExcerciseUser($userObject, $excerciseId);
			// redirect to ... 
			
		}
		if ($action=="update")
		{
			$userObject->updateToWebRequest($_REQUEST); 
			$app->updateUser($userObject);

		}
		if ($action=="delete")
		{
			$userObject->updateToWebRequest($_REQUEST); 
			$app->deleteUser($userObject);
			// redirect to ... 

			header("location: adminexcerciseusers.php?excerciseId=".$excerciseId);
		}

		if ($action=="reset")
		{
			$app->resetExcerciseUser($userId, $excerciseId );
		}

		if ($action=="sendemail")
		{
			// $app->resetExcerciseUser($userId, $excerciseId );
			// find start task and than fill in
			// todo
			// $app->cronjobDoExcerciseTaskIdUserSendEmail($excercisetaskId, $userObjectX, $createNewPassword);

		}

		// set a special action to
		if (
			 ($action=="statusopen")
			 ||
			 ($action=="statusfailed")
			 ||
			 ($action=="statusdone")
		  )

		{
			if (isset($_REQUEST["excercisetaskId"]))
			{
				$excercisetaskId=$_REQUEST["excercisetaskId"];
				// get excercisetaskObj
				// echo($excercisetaskId);
				
				$excercisetaskObject=$app->getExcerciseTaskById($excercisetaskId);
				if ($excercisetaskObject!=null)
				{
					// print_r($excercisetaskObject);
					// echo("$excercisetaskId: ");
					if ($action=="statusopen") $app->setUserExcerciseTaskAttributeString( $userId, $excercisetaskObject->excercisetaskId, "task", "" );
					if ($action=="statusfailed") $app->setUserExcerciseTaskAttributeString( $userId, $excercisetaskObject->excercisetaskId, "task", "failed" );
					if ($action=="statusdone") $app->setUserExcerciseTaskAttributeString( $userId, $excercisetaskObject->excercisetaskId, "task", "done" );
					// $app->updateExcerciseTask($excercisetaskObject);
					// print_r($excercisetaskObject);
				}
				else
				{
					echo("could no find $excercisetaskId");
				}
			}
		}


	}

	//echo("****");
	//print_r($userObject);

	// start
	include("./includes/header.admin.inc.php");

	// sidemenu
	$sideMenuText="".Display::adminDisplayExcerciseUsersDetailPointTop( $app, $excerciseObject, $userObject );
	include("./includes/header.adminsidemenu.inc.php");	

/*
echo($excerciseId);
echo("<hr>");
	print_r($excerciseObject);
echo("<hr>");
*/

?> 

<h2>Administration Nutzer Detail</h2>

<?
	$size=50;
	echo("<form action='adminexcerciseuserdetail.php'>");
		echo("<input type=hidden name='action' value='update'>");
		echo("<input type=hidden name='userId' value='".$userObject->userId."'>");
		echo("<input type=hidden name='excerciseId' value='".$excerciseId."'>");
		echo("<div>Name: <input type=textfield name='userName' size=$size value='".$userObject->userName."'></div>");
		echo("<div>Vorname: <input type=textfield name='userPreName'  size=$size value='".$userObject->userPreName."'></div>");
		echo("<div>Emails: <input type=textfield name='userEmails'  size=$size value='".$userObject->userEmails."'></div>");
		echo("<div>Login: <input type=textfield name='userLogin'  size=$size value='".$userObject->userLogin."'></div>");
		echo("<div>Password: <input type=textfield name='userPassword'  size=$size value='".$userObject->userPassword."'></div>");
		echo("<div>Klasse: <input type=textfield name='userClass' size=$size  value='".$userObject->userClass."'></div>");
		echo("<div>Gruppe: <input type=textfield name='userGroup' size=$size  value='".$userObject->userGroup."'></div>");
		echo("<div><input type=submit value='&auml;ndern'><a style='border: 1px solid black; background: #cccccc; font-size: 14px; font-color: black; padding: 3px; ' onClick=\"if (confirm('L&ouml;schen?')) { document.location.href='adminexcerciseuserdetail.php?action=delete&excerciseId=$excerciseId&userId=$userId'; } \">delete</a></div>");

		// echo("<br><br>");
		// echo("<div><a style='border: 1px solid black; background: #cccccc; font-size: 14px; font-color: black; padding: 3px; ' onClick=\"document.location.href='adminexcerciseuserdetail.php?action=sendemail&excerciseId=$excerciseId&userId=$userId';\">Manuell Start-Email versenden</a></div>");

	echo("</form>");

	echo("<h2>Ablauf</h2>");

	echo("<div><form ><input type=button onClick=\"document.location.href='adminexcerciseuserdetail.php?action=reset&excerciseId=$excerciseId&userId=$userId';\" value=' Reset Progress '></form><br></div>");
?>
<?
	// get all tasks
	$arr=$app->getAllActiveExcerciseTasksFromExcercise( $excerciseId );
	
	$doneTillHere=true;
	$retTaskId=$app->getNextUserTaskNotDone($app, $userObject->userId, $excerciseId, "-1", "-2001");
// echo($retTaskId."--");	
	$actualHere="Aktuell hier";

	echo("<div style='border-bottom:1px solid black;'><strong>Anfang</strong></div>");
	if ($retTaskId=="-1") { echo($actualHere); $doneTillHere=false; }
	echo("<br>");

	for ($i=0;$i<count($arr);$i++)
	{
		$obj=$arr[$i];

// echo("<br> $userId - ".$obj->excercisetaskId);
		
					echo("<div style='border-bottom:1px solid black;'><strong>");
						echo($obj->excercisetaskName);
						$val=$app->getUserExcerciseTaskAttributeString( $userId, $obj->excercisetaskId, "task", "" );
						$strVal=""; $strVal="".$val;
						if ($val=="") { $strVal="offen"; }
						$strVal=" [ ".$strVal." ]";
						echo($strVal);

						/*
						if ($val=="failed") 
						{
							echo("   <div style='display: inline;color: red;'>FAILED</div>");
						} 
						*/
						
						echo("  <div style='display: inline;color: #cccccc; font-size: 14px; font-weight: none; '>Umwandeln in:");
						echo("   <div style='display: inline;color: black;'><a  style='display: inline;color: #cccccc;' href='adminexcerciseuserdetail.php?action=statusopen&excerciseId=$excerciseId&excercisetaskId=".$obj->excercisetaskId."&userId=$userId'>[ offen ]</a></div>");
						echo("   <div style='display: inline;color: black;'><a   style='display: inline;color: #cccccc;' href='adminexcerciseuserdetail.php?action=statusfailed&excerciseId=$excerciseId&excercisetaskId=".$obj->excercisetaskId."&userId=$userId'>[ failed ]</a></div>");
						echo("   <div style='display: inline;color: black;'><a  style='display: inline;color: #cccccc;' href='adminexcerciseuserdetail.php?action=statusdone&excerciseId=$excerciseId&excercisetaskId=".$obj->excercisetaskId."&userId=$userId'>[ done ]</a></div> ");
						echo("   </div>");


						// add done if it is done
					echo("</strong></div>");


					
					// user type
					$type=$obj->excercisetaskType;

					// search for
					if ($type=="questionnaire")
					{
						echo("".Display::displayQuestionnaire( $app, $obj->excercisetaskId, "html", $userId ));
					}

					
					if ($type=="writetext")
					{
						// search them all
						// get text for this ..
						// search for the text here ...
						if ($doneTillHere) 
						{
							// show the text 
							$latestTextObj=$app->getTaskWriteTextDocumentByUserAndExcercisetaskLatest( $userId, $obj->excercisetaskId);
							if ($latestTextObj!=null)
							{
								$text=$latestTextObj->taskwritetextdocumentText;
								echo($text);
							}
						} 

					}

					if ($type=="otherevaluation")
					{
						// userObj
						if ($doneTillHere) 
						{
							echo("<a href='adminevaluationother.php?excercisetaskId=".$obj->excercisetaskId."&userId=".$userObject->userId."'> Frembeurteilen ></a><br>");
						
							echo("<div style='border: 1px dotted black'>");
							//		echo(Display::displayFramework($app,$obj->excercisetaskId,"other",$userObject->userId));
							echo("</div>");
						}	
					}

					if ($type=="selfevaluation")
					{
						// userObj
						if ($doneTillHere) 	
						{
							echo("<div style='border: 1px dotted black'>");
									echo(Display::displayFramework($app,$obj->excercisetaskId,"selfresult",$userObject->userId));
							echo("</div>");
						}
					}


					if ($type=="result")
					{
						// userObj
						if ($doneTillHere) 
						{
							echo("<div style='border: 1px dotted black'>");
									echo(Display::displayFramework($app,$obj->excercisetaskId,"both",$userObject->userId));
							echo("</div>");
						}

					}

					// here and now
					if ($retTaskId==$obj->excercisetaskId) echo($actualHere."<br>");

					echo("<br>");

					if ($retTaskId==$obj->excercisetaskId) { $doneTillHere=false; }
		
	}

	// done everything
	echo("<div style='border-bottom:1px solid black;'>");
		echo("<strong>Fertig</strong>");
	echo("</div>");
	if ($retTaskId==-2001)  echo($actualHere);
	echo("<br>");
	
?>

<?
	// stop
	include("./includes/footer.inc.php");
?>