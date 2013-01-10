<?

	// include instance
	include("./appinstance.php");

	// excercise task handling
	include("./includes/excercisetaskhandling.user.php");

	// check logged in!
	include("./includes/checkaccess.user.php");
	
	$debugThis=false;

	// readirect to the correct handling
	// echo("<hr>");
	// print_r($_SESSION);

	if ($debugThis) print_r($excerciseTaskObject);

	if ($excerciseTaskObject!=null)
	{
		
		// is there access for this?
		$taskId=$app->getTaskIdInOrder( $excerciseTaskObject->excercisetaskExcerciseRef, $excerciseTaskObject->excercisetaskId );
		if ($taskId!=$excerciseTaskObject->excercisetaskId)
		{
			// echo($taskId);
			$app->storeWorkSessionExcerciseTask($_SESSION,$taskId);
			$excerciseTaskObject=$app->getWorkSessionExcerciseTask($_SESSION);
// print_r($excerciseTaskObject);			
		}
		// header("location: userexcercisetask.php?taskId=".$taskId);
		// exit();


		$redirectLink="excercise.php";

		// correct let's redirect here ..
		if ($excerciseTaskObject->excercisetaskType=="start") $redirectLink="userexcercisetaskstart.php"; // ?id=".$obj->excercisetaskId;
		if ($excerciseTaskObject->excercisetaskType=="questionnaire") $redirectLink="userexcercisetaskquestionnaire.php"; // ?id=".$obj->excercisetaskId;
		if ($excerciseTaskObject->excercisetaskType=="readtext") $redirectLink="userexcercisetaskreadtext.php"; // ?id=".$obj->excercisetaskId;
		if ($excerciseTaskObject->excercisetaskType=="writetext") $redirectLink="userexcercisetaskwritetext.php"; // ?id=".$obj->excercisetaskId;
		if ($excerciseTaskObject->excercisetaskType=="selfevaluation") $redirectLink="userexcercisetaskevaluationself.php"; // ?id=".$obj->excercisetaskId;
		if ($excerciseTaskObject->excercisetaskType=="otherevaluation") $redirectLink="userexcercisetaskevaluationother.php"; // ?id=".$obj->excercisetaskId;
		if ($excerciseTaskObject->excercisetaskType=="result") $redirectLink="userexcercisetaskresult.php"; // ?id=".$obj->excercisetaskId;
		if ($excerciseTaskObject->excercisetaskType=="close") $redirectLink="userexcercisetaskfinish.php"; // ?id=".$obj->excercisetaskId;

		if ($debugThis) print("debug.location: $redirectLink");
		if (!$debugThis) header("location: $redirectLink");

	}
	else
	{
		// wrong ...
		if (!$debugThis) header("location: userexcercise.php?error=could+not+find+this+task&id=".$excerciseObject->excerciseId);
	}
	

?>