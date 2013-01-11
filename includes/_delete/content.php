<?
	function displayExcercise( $excerciseObj )
	{
		echo("<div><a href='userexcercise.php?id=".$excerciseObj->excerciseId."'>".$excerciseObj->excerciseName." >></a></div>");
	}



?>
	<?=Display::displayUserSideMenu($app)?>

	<h1>&Uuml;bersicht</h1>

	<?=Display::displayRemarkText($app, "userfront","Die &Uuml;bersicht")?>

	<h2>Schreibaufgaben</h2>
	<?
		// get all open excersises
		$arr=$app->getAllExcercisesByStatus( "open" );
		if (count($arr)>0)
		{
			for ($o=0;$o<count($arr);$o++)
			{
				$excerciseObj=$arr[$o];
				displayExcercise($excerciseObj);
			}
		}
		else
		{
			echo("Keine Schreibaufgabe offen.");
		}
	?>
	<h2>Archiv</h2>
	Archivierte Schreibaufgaben:
	<?
		// get all open excersises
		$arr=$app->getAllExcercisesByStatus( "close" );
		if (count($arr)>0)
		{
			$excerciseObj=$arr[0];
			displayExcercise($excerciseObj);
		}
		else
		{
			echo("Keine Schreibaufgabe im Archiv.");
		}
	?><br>
	
	<h2>Profil</h2>
	<a href='account.php'>Ansehen >></a>
	
	
