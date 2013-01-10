<?

	// include instance
	include("./appinstance.php");

	// check for admin
	include("./includes/checkaccess.admin.php");

	// start
	include("./includes/header.admin.inc.php");

	// sidemenu
	$sideMenuText="".Display::adminDisplayMenu( $app );
	include("./includes/header.adminsidemenu.inc.php");	


	// not yet
	function displayExcercise( $excerciseObj )
	{
		echo("<div><div>[".$excerciseObj->excerciseStatus."]</div> <a href='adminexcercise.php?excerciseId=".$excerciseObj->excerciseId."'>".$excerciseObj->excerciseName." ></a></div>");
	}
	// as tr
	function displayExcerciseAsTr( $excerciseObj )
	{
		echo("<tr><td valign=top style='font-size: 9px; border: 1px solid gray;'>".$excerciseObj->excerciseStatus."</td><td valign=top style='border: 1px dotted gray;'><a href='adminexcercise.php?excerciseId=".$excerciseObj->excerciseId."'>".$excerciseObj->excerciseName." [Edit] > </a></td><td valign=top style='border: 1px dotted gray;'><a href='adminexcerciseusers.php?excerciseId=".$excerciseObj->excerciseId."'>[Users] > </a></td><td valign=top style='border: 1px dotted gray;'><a href='adminexcerciseresult.php?excerciseId=".$excerciseObj->excerciseId."'> [Resultate] > </a></td></tr>");
	}

	// as text
	function displayExcerciseAsText( $excerciseObj )
	{
		echo("<div><a href='adminexcercise.php?excerciseId=".$excerciseObj->excerciseId."'>".$excerciseObj->excerciseName." (".$excerciseObj->excerciseStatus.") ></a></div>");	
	}

?>
	<h3>Administration</h3>
	

	<!-- <h4>Beendete Schreibaufgaben</h4> -->
	<?
	/*
		$arr=$app->getExcerciseTaskAttributesByAttributeNameAndValue( "taskwritetext", "done" );
		for ($i=0;$i<count($arr);$i++)
		{
			$attrObj=$arr[$i];
			// print_r($attrObj);
			// go there and submit
			$userId=$attrObj->excercisetaskattributeUserRef;
			$userObj=$app->getUserById($userId);
			$strUser="notknown"; if ($userObj!=null) { $strUser="".$userObj->userName.", ".$userObj->userPreName; }
			$taskId=$attrObj->excercisetaskattributeExcerciseTaskRef;
			// get task by id ...

			echo("<a href='adminevaluationother.php?'>  (".$strUser.")></a>");

		}
	*/
	?>

	<h4 >Schreibaufgaben</h4>
<?

 /*
	echo("<table>");

		// get all open excersises
		$arr=$app->getAllExcercisesByStatusAll(); // getAllExcercisesByStatus( "*" );
		if (count($arr)>0)
		{
			for ($o=0;$o<count($arr);$o++)
			{
				$excerciseObj=$arr[$o];
				// displayExcercise($excerciseObj);
				$display=true;
				if ($excerciseObj->excerciseStatus=="deleted")  $display=false;
				if ($display) displayExcerciseAsTr( $excerciseObj );
			}
		}
		else
		{
			echo("Keine Schreibaufgabe");
		}
	echo("</table>");
	*/

		$arr=$app->getAllExcercisesByStatusAll(); // getAllExcercisesByStatus( "*" );
		if (count($arr)>0)
		{
			for ($o=0;$o<count($arr);$o++)
			{
				$excerciseObj=$arr[$o];
				// displayExcercise($excerciseObj);
				$display=true;
				if ($excerciseObj->excerciseStatus=="deleted")  $display=false;
				if ($display) displayExcerciseAsText( $excerciseObj );
			}
		}
		else
		{
			echo("Keine Schreibaufgabe");
		}

	?>
	<div class='adminNew'>
		<form action='adminexcercise.php'><input type='hidden' name='action' value='add'>
			Neue Schreibaufgabe erstellen:
			<input type='text' name='excerciseName' value='Schreibaufgabe XYZ' size=20>
			<?
			 /*
			 	echo("Vorlage: ");
				$arr=$app->getAllActiveExcercisesByStatusAll(); // getAllExcercisesByStatus( "*" );
				if (count($arr)>0)
				{
					echo("*<select name='copyFromExcercise'>");
					echo("<option value='-1'>Keine</option>");
					for ($o=0;$o<count($arr);$o++)
					{
						$excerciseObj=$arr[$o];
						echo("<option value='".$excerciseObj->excerciseId."'>".$excerciseObj->excerciseName."</option>");
					}
					echo("</select>");
				}
				else
				{
					echo("Keine Vorlage vorhanden");
				}
			*/?>
			<input type='submit' value='erstellen'>
		</form>
	</div>

	<h4>Raster</h4>
	<?
		$arrFrameworks=$app->getAllFrameworks( );
		if (count($arrFrameworks)>0)
		for ($z=0;$z<count($arrFrameworks);$z++)
		{
			$frameworkObj=$arrFrameworks[$z];
			$displayFramework=false;			
			// print_r($frameworkObj);
			if ($frameworkObj->frameworkStatus!='deleted') $displayFramework=true;
			if ($displayFramework)
			echo("<div class='adminFrameworkList'><a href='adminframework.php?frameworkId=".$frameworkObj->frameworkId."'>".$frameworkObj->frameworkName." ></a></div>");
		}
	?>
	<div class='adminNew'>
		<form action='adminframework.php'><input type='hidden' name='action' value='add'>
			Neuen Raster erstellen:
			<br><input type='text' name='frameworkName' value='Raster XYZ' size=20>
			<!-- Vorlage: 
			<?
				$arr=$app->getAllActiveFrameworks( );
				if (count($arr)>0)
				{
					echo("*<select name='copyFromFramework'>");
					echo("<option value='-1'>Keine</option>");
					for ($o=0;$o<count($arr);$o++)
					{
						$frameworkObj=$arr[$o];
						echo("<option value='".$frameworkObj->frameworkId."'>".$frameworkObj->frameworkName."</option>");
					}
					echo("</select>");
				}
				else
				{
					echo("Keine Vorlage vorhanden");
				}
			?>-->
			<input type='submit' value='erstellen'>
		</form>
	</div>

	
	<h4 >Verwalten der User (allgemein)</h4>
	Admin Users <a href='adminusers.php?group='>Verwalten >></a>
	<br>(f&uuml;r Schreibaufgaben direkt in den Schreibaufgaben verwalten)
	<!-- <br>User importieren und einrichten. <a href='adminusers.php'>Verwalten >></a> -->


	<h4>Texte (Prefs)</h4>
	Texte (Einstieg) / Prefs <a href='adminprefs.php'>verwalten >></a>
<!--
	<h4>Account</h4>
	Verwalten der eigenen Account-Daten. <a href='account.php'>verwalten >></a>
-->
<?	
	// stop
	include("./includes/footer.inc.php");
?>