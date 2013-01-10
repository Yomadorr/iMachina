<?
	/*
		check and store excercises and users here ..
	*/
	
	// this excercise
	if (isset($_REQUEST["id"]))
	{
		$excerciseId=$app->requestFromWeb("id","integer");
		// echo("excerciseId: ".$excerciseId);
		$app->storeWorkSessionExcercise($_SESSION,$excerciseId);
	}

	if (isset($_REQUEST["taskId"]))
	{
		// echo($_REQUEST["taskId"]);
		$excercisetaskId=$app->requestFromWeb("taskId","integer");
		// echo($excercisetaskId);
		$app->storeWorkSessionExcerciseTask($_SESSION,$excercisetaskId);

		/*
		echo("<hr>");
		echo("<h1>excercisetaskhandling.inc.php</h1>");
		echo("<br>excercisetaskId: $excercisetaskId<br>");
		echo($_SESSION["excercisetaskId"]);
		print_r($_SESSION);
		echo("<hr>");
		*/
	}

	// get the most important things if it is there
	// 1. excercise
	// 2. task 	

	// 1. excerciseObject
	$excerciseObject=$app->getWorkSessionExcercise($_SESSION);

	// 2. excercisetaskObject
	$excerciseTaskObject=$app->getWorkSessionExcerciseTask($_SESSION);
	// print_r($excerciseTaskObject);

?>