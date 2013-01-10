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



	// include action ....
	/*

		-----------------------------------------
		CSV Import
		-----------------------------------------

	*/
	$doImport=false;

	if ( isset($_FILES["file"])) $doImport=true;

	$arrTableField=array();
		class TableField
		{
			var $name="";
			var $index=-1;
		}
	function addTableField($name,$index)
	{
		global $arrTableField;

		$fObj=new TableField();
		$fObj->tablefieldName=$name;
		$fObj->tablefieldIndex=$index;
		$arrTableField[count($arrTableField)]=$fObj;
	}
	// users
	function setUserAttribute($userObj,$attribute,$value)
	{
		global $arrTableField;
		if ($attribute=="name") $userObj->userName=$value;
		if ($attribute=="prename") $userObj->userPreName=$value;
		if ($attribute=="login") $userObj->userLogin=$value;
		if ($attribute=="group") $userObj->userGroup=$value;
		if ($attribute=="class") $userObj->userClass=$value;
		if ($attribute=="email") 
		{
			if ($value!="")
			{
				if ($userObj->userEmails!="") $userObj->userEmails=$userObj->userEmails.";";
				$userObj->userEmails=$userObj->userEmails.$value;
			}
		}
	}

	// do the import ...
	$strImport="";
	$importedUser=0;
	if ($doImport)
	{
		// add name ... 
		addTableField("prename",0);
		addTableField("name",1);
		addTableField("login",3);
		addTableField("email",3);
		addTableField("email",4);
		addTableField("class",5);
		addTableField("group",6);

		/*
		echo("<hr>");
		print_r($arrTableField);
		echo("<hr>");
		*/

		
			// upload
			$debugThis=false;
			if ($debugThis)
			{
	             echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	             echo "Type: " . $_FILES["file"]["type"] . "<br />";
	             echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	             echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
            }

            // IMPORT

            $path=$_FILES["file"]["tmp_name"];
            
            // test if it is ; ,
            $delimiter=",";
            $row = 0;
			if (($handle = fopen($path, "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 1000,  $delimiter)) !== FALSE) {
			        $num = count($data);
			        if ($num<5) { $delimiter=";"; break; }
			    }
			    fclose($handle);
			}

			// import
			// and again now correctly
			$strImport=$strImport."<table border=1>";
			$row = 0;
			if (($handle = fopen($path, "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 1000,  $delimiter)) !== FALSE) {
			        $num = count($data);
			        if ($num<5) $delimiter=";";
			        if ($debugThis) echo "<p> $num Felder in Zeile $row: <br /></p>\n";
			        if ($debugThis)
			        for ($c=0; $c < $num; $c++) {
			            if ($debugThis) echo "$c. ".$data[$c] . "<br />\n";
			        }

			        // now generate a new user here and now .....
			        $userObj=new User();
		        	for ($c=0;$c<count($arrTableField);$c++)
		        	{
		        		$obj=$arrTableField[$c];

		        		$index=$obj->tablefieldIndex;
		        		$val="";
		        		if ($debugThis)echo("<br>  $index = $val");
		        		if (count($data)>$index)
		        		{
			        		$val=$data[$index];
			        	}

//			        	$val=mb_convert_encoding($val, "UTF-8", "ISO-8859-1");
						$val=mb_convert_encoding($val, "UTF-8", "ISO-8859-1");
						// $val=mb_convert_encoding($val, "ISO-8859-1", "UTF-8");

				        setUserAttribute($userObj,$obj->tablefieldName,$val);
		        	}

		        	// insert user now ...
		        	if ($userObj->userName!="")
		        	{
		        		$importedUser++;
		        		$strImport=$strImport."<tr><td>".($row+1)."</td><td>".$userObj->userPreName."</td><td>".$userObj->userName."</td><td>".$userObj->userName."</td><td>".$userObj->userGroup."</td><td>".$userObj->userClass."</td>";
			        	
			        	$strImport=$strImport."<td> ";

			        		// add ... something
			        		$app->jobSetRandomPassword( $userObj );

				        	$newUserObj=$app->insertUserAndExcerciseUser($userObj,$excerciseId);
				        	if ($newUserObj!=null) 
				        	{
				        		// $strImport=$strImport." newUserFound";
				        		
				        		if ($newUserObj->userId==-1)  $strImport=$strImport." Error (not a correct User found -  added)";
				        	}
				        	else $strImport=$strImport."  ERROR (no user created)";
			        	
			        	$strImport=$strImport."</td> ";
			        	
		        		$strImport=$strImport."</tr> ";
			        	
		        	}
		        	// print_r($userObj);

			        $row++;
			    }
			    fclose($handle);
			    $strImport=$strImport."</table>";

			}


		$strImport=$strImport."<br>Erstellte User: ".$importedUser;
	}


	/*

		-----------------------------------------
		/ CSV Import
		-----------------------------------------

	*/

	// start
	include("./includes/header.admin.inc.php");

	// sidemenu
	$sideMenuText="".Display::adminDisplayExcerciseUsersPointTop( $app, $excerciseObject, $userObj );
	include("./includes/header.adminsidemenu.inc.php");	

/*
echo($excerciseId);
echo("<hr>");
	print_r($excerciseObject);
echo("<hr>");
*/

?> 
<h2>Nutzer & Resultate</h2>
<?

	// new User
	// import User
	echo("<div  class='adminContainerSmall'>");
		echo("<div>");
			echo("<a onClick=\"$('#newobject').toggle('fast');\">++ User in der &Uuml;bung anlegen</a>");
			echo("<div class='adminUserNewUpdateObject' id='newobject' style='display: none;'>");
				$newObj=new User();
				echo("<form action='adminexcerciseuserdetail.php'><input type=hidden name='action' value='add'><input type=hidden name='excerciseId' value='$excerciseId'><input type=hidden name='userId' value='-1'>Name: <input type=textfield name='userName' value=''><input type=submit value='neu'></form>");
				// echo(Display::displayUser($app,$newObj,'listdetailraw',$excerciseId));
				// echo(Display::displayExerciseUser($app,$newObj,'listdetailraw',$excerciseId));

			echo("</div>");
		echo("</div>");
		echo("<div>");
			echo("<a onClick=\"$('#importobjects').toggle('fast');\">++ User importieren</a>");
			echo("<div class='adminUserNewUpdateObject' id='importobjects' style='display: none;'>");

				echo("<form action='adminexcerciseusers.php'  method='post' enctype='multipart/form-data'>");
				echo("<input type=hidden name='excerciseId' value='".$excerciseObject->excerciseId."'>");
				echo("<br>Template: <a href='admindocuments/users.xls' target='_blank'>users.xls</a> > Exportieren als csv mit den Einstellungen (Delimiter ; / auf Mac Windows *.csv)  <a href='admindocuments/users.csv' target='_blank'>users.csv</a>");
				echo("<br>Datei: <input type='file' name='file' id='file' />");
				echo("<input type=submit value='Uploaden und importieren'>");
				echo("</form>");

			echo("</div>");

			// import
			if ($strImport!="")
			{
				echo("<div style='border: 1px dotted red;'><br>");
					echo("<h3>Importierte Nutzer</h3>");
					echo($strImport);
				echo("<br></div>");
			}

		echo("</div>");
	echo("</div>");



	// filter
	echo("<div class='adminContainerSmall'>");
		echo("<form action='adminexcerciseusers.php'>");
		echo("<input type=button value='X' onClick=\"document.location.href='adminexcerciseusers.php?excerciseId=$excerciseId&name=&class=&group=';\">");
		echo("<input type=hidden name='excerciseId' value='$excerciseId'> ");
		echo("Kurs: ");
		echo("<input type=text name='class' value='$class'> ");
		echo("Group: ");
		echo("<input type=text name='group' value='$group'>  ");
		echo("Name: ");
		echo("<input type=text name='name' value='$name'>  ");
		echo("<input type=submit value='&Auml;ndern'>");
		echo("</form>");
	echo("</div>");



	echo("<script>");
	echo("   function showUserDetail( id ) { document.location.href='adminexcerciseuserdetail.php?excerciseId=".$excerciseId."&userId='+id;  }");
	echo("</script>");

	// not all groups are allowed!
	// group "admin" only for admins!
	echo("<div class='adminContainerSmall'>");

		// action here ...
		$actionselection="";
		if (isset($_REQUEST["actionselection"])) $actionselection=$_REQUEST["actionselection"];
		if ($actionselection=="delete")
		{
			// echo("delete this here and now!!");
			$arr=$app->getAllUsersInExcercisesByExcerciseIdGroupAndClassAndNameLike( $excerciseId, $group, $class, $name );

			// filter by 
			$arrCorrect=array();
			for ($a=0;$a<count($arr);$a++)
			{
				$userObj=$arr[$a];
				// print_r($userObj);
				$app->deleteUser($userObj);
			}

			echo("<div class='adminMessageDone'>Users deleted</div>");
		}

		// rest them all .. 
		if ($actionselection=="reset")
		{
			// echo("delete this here and now!!");
			$arrUsers=$app->getAllUsersInExcercisesByExcerciseIdGroupAndClassAndNameLike( $excerciseId, $group, $class, $name );

			echo("<div class='adminMessageDone'>Users reset<br>");

			// filter by 
			// $arrCorrect=array();
			for ($a=0;$a<count($arrUsers);$a++)
			{
				$userObj=$arrUsers[$a];
				// print_r($userObj);
				// $app->deleteUser($userObj);

				echo("<br>".$userObj->userName.", ".$userObj->userPreName);

				// go through all 
				// "done" > ""
				// $app->excerciseResetUser($excerciseId);
				// tasks ...
				// $arrTasks=$app->
				//    ->resetTask()
				// "";
				$app->resetExcerciseUser($userObj->userId, $excerciseId );

			}

			echo("</div>");
		}

		// actionselection=newgroup&groupname
		if ($actionselection=="newgroup")
		{
			// echo("delete this here and now!!");
			$arrUsers=$app->getAllUsersInExcercisesByExcerciseIdGroupAndClassAndNameLike( $excerciseId, $group, $class, $name );

			// ...
			$groupname=$_REQUEST["groupname"];

			echo("<div class='adminMessageDone'>Users regrouped<br>");

			// filter by 
			// $arrCorrect=array();
			for ($a=0;$a<count($arrUsers);$a++)
			{
				$userObj=$arrUsers[$a];
				// print_r($userObj);
				// $app->deleteUser($userObj);

				echo("<br>".$userObj->userName.", ".$userObj->userPreName);
				$userObj->userGroup=$groupname;
				$app->updateUser($userObj);

			}

			echo("</div>");

			echo("<script>document.location.href='adminexcerciseusers.php?excerciseId=$excerciseId&group=$groupname';</script>");
		}

		// display
		// // $arr=$app->getAllUsersInExcercisesByExcerciseId( $excerciseId );
		$arr=$app->getAllUsersInExcercisesByExcerciseIdGroupAndClassAndNameLike( $excerciseId, $group, $class, $name );

		/*
		$arr=$app->getUsersByGroupAndClassAndNameLike( $group, $class, $name );

		// filter by 
		$arrCorrect=array();
		for ($a=0;$a<count($arr);$a++)
		{
			$userObj=$arr[$a];
			// is the user in this excercise?
			if ($app->checkExcerciseUserAgainst( $userObj->userId, $excerciseId ))
			{
				$arrCorrect[count($arrCorrect)]=$arr[$a];
			}
		}
		*/

		// show here
		$str="";
		if (count($arr)>0)
		{
			$str=$str."\n<table border=0 cellpading=3>";
			$str=$str."<tr><td valign=top class='adminTableTitle'>Kurs</td><td valign=top class='adminTableTitle'>Gruppe</td><!--<td valign=top class='adminTableTitle'>Typ</td>--><td valign=top class='adminTableTitle'>Name</td><td valign=top class='adminTableTitle'>Vorname</td><td valign=top class='adminTableTitle'>Login</td><!--<td valign=top class='adminTableTitle'>Emails</td>--><td valign=top class='adminTableTitle'>N&auml;chste Aufgabe</td><td valign=top class='adminTableTitle'></td></tr>";
			for ($i=0;$i<count($arr);$i++)
			{
				$obj=$arr[$i];


				/*
				// list entry
				$str=$str.Display::displayUser($app,$obj,"list");
				// detail
				$str=$str.Display::displayUser($app,$obj,"listdetail");
				*/
				$str=$str."<tr onClick=\"showUserDetail(".$obj->userId.");\">";

							$str=$str."\n<td valign=top class='adminUsersListTitle'>";
								$str=$str."<a >".$obj->userClass."</a>";
							$str=$str."\n</td>";
							$str=$str."\n<td valign=top class='adminUsersListTitle'>";
								$str=$str."<a >".$obj->userGroup."</a>";
							$str=$str."\n</td>";

							/*
							$str=$str."\n<td valign=top class='adminUsersListTitle'>";
								$str=$str."<a >".$obj->userType."</a>";
							$str=$str."\n</td>";
							*/

							$str=$str."\n<td valign=top class='adminUsersListTitle'>";
								$str=$str."<a >".$obj->userName."</a>";
							$str=$str."\n</td>";
							$str=$str."\n<td valign=top class='adminUsersListTitle'>";
								$str=$str."<a >".$obj->userPreName."</a>";
							$str=$str."\n</td>";

							$str=$str."\n<td valign=top class='adminUsersListTitle'>";
								$strLogin="".$obj->userLogin;
								if (strlen($strLogin)>25) $strLogin=substr($strLogin,0,24)."...";
								$str=$str."<a >".$strLogin."</a>";
							$str=$str."\n</td>";

							// getNextUserTaskNotDone($app, $userId, $excerciseId, $startingUpValue, $endUpValue)
							$failedInATask=$app->getFirstFailedUserTaskNotDone($app, $obj->userId, $excerciseId );
							$nextTaskId=$app->getNextUserTaskNotDone($app, $obj->userId, $excerciseId, "-1", "-2001");
							$str=$str."\n<td valign=top  class='adminUsersListTitle'>";
							// echo($nextTaskId);
								$taskName="";	
								if ($nextTaskId=="-1") $taskName="Nicht angefangen";					
								else
								if ($nextTaskId=="-2001") $taskName="Fertig";
								else
								{
									$taskObj=$app->getExcerciseTaskById($nextTaskId);	
									if ($taskObj!=null) $taskName=$taskObj->excercisetaskName;
								}					

								if ($failedInATask!="") $str=$str."<a >Failed</a>";
								else $str=$str."<a >".$taskName."</a>";


							$str=$str."\n</td>";
							/*
							$str=$str."\n<td valign=top class='adminUsersListTitle'>";
								$str=$str."<a >".$obj->userEmails."</a>";
							$str=$str."\n</td>";
							*/

				$str=$str."</tr>";

			}
			$str=$str."\n</table>";

			$str=$str."\n<br>Anzahl: ".count($arr)."<br>";

			$str=$str."\n<br><form>Auswahl: Gruppe um&auml;ndern in <input type='textfield' id='groupnew' name='groupnew' value=''><input type='button' onClick=\"document.location.href='adminexcerciseusers.php?excerciseId=$excerciseId&actionselection=newgroup&groupname='+$('#groupnew').val();\" value='&auml;ndern'>";
			$str=$str."\n<br>Auswahl: <a onClick=\"if (confirm('&Uuml;bungen reseten?')) { document.location.href='adminexcerciseusers.php?excerciseId=$excerciseId&actionselection=reset'; } \">&Uuml;bungen reseten></a>";
			$str=$str."\n<br><br><br>Auswahl: <a onClick=\"if (confirm('L&ouml;schen der Auswahl?')) { document.location.href='adminexcerciseusers.php?excerciseId=$excerciseId&actionselection=delete'; }\">L&ouml;schen ></a>";
		}
		echo($str);



	echo("</div>");


	// stop
	include("./includes/footer.inc.php");
?>