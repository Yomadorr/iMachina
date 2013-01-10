<?

	// include instance
	include("./appinstance.php");

	// check for admin
	include("./includes/checkaccess.admin.php");

	// start service
	include("./admin.service.start.php");

	$area="user";

	$inputObject=new FrameworkDimVal();

	// updateto
	$inputObject->updateToWebRequest($_REQUEST);

	/*
	    	var $frameworkdimvalDimRef=-1;
    	var $frameworkdimvalCatRef=-1;

    	var $frameworkdimvalUserRef=-1;
	*/

	// print_r($inputUserObject);
	
	// update to webrequest ...

	// todo: cases ... 
	// only admin can 

	// action here ...
	// insert
	/*
	if ($action=="insert")
	{
		$app->insertUser($inputUserObject);
		// search for latest and give it back?

		// reload ... here ..
	}

	// udpate
	if ($action=="update")
	{

		$app->updateUser($inputUserObject);
		// search for latest and give it back?

		// reload ... 
		// $output=$output."updated";
		$output="".Display::displayUser($inputUserObject,"listraw");
	}

	// delete
	if ($action=="delete")
	{
		$app->deleteUser($inputUserObject);
		// search for latest and give it back?
		// reload ... 
	}	
	*/

	/*
		dimensions
	*/
	// store
	if ($action=="store")
	{
		// $app->deleteUser($inputUserObject);
		// todo: done
		$output="";
		// print_r($inputObject);

		// todo: correct version
		/*		
		    [debug] => 
		    [frameworkdimvalId] => -1
		    [frameworkdimvalName] => -1
		    [frameworkdimvalDimRef] => 5
		    [frameworkdimvalCatRef] => 28
		    [frameworkdimvalUserRef] => 3
		    [frameworkdimvalType] => other
		*/		
		$app->setFrameworkDimVal($inputObject->frameworkdimvalUserRef,$inputObject->frameworkdimvalExcerciseTaskRef,$inputObject->frameworkdimvalDimRef,$inputObject->frameworkdimvalCatRef,$inputObject->frameworkdimvalType,$inputObject->frameworkdimvalComment);
	}

	// overview
	if ($action=="overview")
	{
		$output="";
		// $refId=$evaluationObj->taskevaluationFrameworkRef;
		
		// print_r($inputObject);
		$output=$output.Display::displayFramework($app,$inputObject->frameworkdimvalExcerciseTaskRef,"other",$inputObject->frameworkdimvalUserRef);
	
	}

	/*
		comments
	*/
	// comments
	// adminevaluationother.service.php?action=insertcomment&taskevaluatetextcommentId=10&taskevaluatetextcommentRange=1-7&taskevaluatetextcommentComment=esc+test
	if ($action=="insertcomment")
	{
		$output="";
		// $refId=$evaluationObj->taskevaluationFrameworkRef;
		// $output=$output."action=insertcomment:";
		$refId=1;
		$frameworkObj=$app->getFrameworkById( $refId );

		// insert a comment ...
		$commentObj=new TaskEvaluateTextComment();
		$commentObj->updateToWebRequest($_REQUEST);
		// print_r($_REQUEST);
		// $app->insert
		$app->insertTaskEvaluateTextComment($commentObj);

		// give back the the id (-1 oder new id ...)
		// get last id here
		$latestId=$app->getLatestTaskEvaluateTextCommentByRange($commentObj);
		$output=$output.$latestId;
		// print_r($commentObj);
		// $output=$output.Display::displayFramework($app,$frameworkObj,"other",-1);	
	}

	// updatecomment ...
	if ($action=="updatecomment")
	{
		$output="";
		// $refId=$evaluationObj->taskevaluationFrameworkRef;
		// $output=$output."action=insertcomment:";
		// $refId=1;
		// $frameworkObj=$app->getFrameworkById( $refId );

		// insert a comment ...
		$commentObj=new TaskEvaluateTextComment();
		$commentObj->updateToWebRequest($_REQUEST);
		// print_r($_REQUEST);
		// $app->insert
		$app->updateTaskEvaluateTextComment($commentObj);

		$output=$output.$commentObj->taskevaluatetextcommentId;
		// print_r($commentObj);
		// $output=$output.Display::displayFramework($app,$frameworkObj,"other",-1);	
	}

	// deletecomment ... 
	if ($action=="deletecomment")
	{
		$output="";
		// $refId=$evaluationObj->taskevaluationFrameworkRef;
		// $output=$output."action=insertcomment:";
		// $refId=1;
		// $frameworkObj=$app->getFrameworkById( $refId );

		// insert a comment ...
		$commentObj=new TaskEvaluateTextComment();
		$commentObj->updateToWebRequest($_REQUEST);
		// print_r($_REQUEST);
		// $app->insert
		$app->deleteTaskEvaluateTextComment($commentObj);

		$output=$output.$commentObj->taskevaluatetextcommentId;
		// print_r($commentObj);
		// $output=$output.Display::displayFramework($app,$frameworkObj,"other",-1);	
	}

	// suggestions ...
	if ($action=="storesuggestion")
	{
		$output="storesuggestion";
		// $refId=$evaluationObj->taskevaluationFrameworkRef;
		// $output=$output."action=insertcomment:";
		// $refId=1;
		// $frameworkObj=$app->getFrameworkById( $refId );

		// suggestions ... 

		$suggestionObj=new Suggestion();
		$suggestionObj->updateToWebRequest($_REQUEST);
		// print_r($suggestionObj);

		$userObj=new User();
		$userObj->updateToWebRequest($_REQUEST);
		// print_r($userObj);

		$exObj=new ExcerciseTask();
		$exObj->updateToWebRequest($_REQUEST);
		// print_r($exObj);

		// $userObj=new User();
		// $userObj->updateToWebRequest($_REQUEST);

		$app->setUserExcerciseTaskAttributeString( $userObj->userId, $exObj->excercisetaskId, "suggestionId", $suggestionObj->suggestionId );

		/*
		// insert a comment ...
		$commentObj=new TaskEvaluateTextComment();
		$commentObj->updateToWebRequest($_REQUEST);
		// print_r($_REQUEST);
		// $app->insert
		$app->deleteTaskEvaluateTextComment($commentObj);

		$output=$output.$commentObj->taskevaluatetextcommentId;
		*/
		// print_r($commentObj);
		// $output=$output.Display::displayFramework($app,$frameworkObj,"other",-1);	

		$output="updatesuggestion";
	}

	//  $output=$output."---".$action;


	// delete 


	// $output="...";



	// stop service
	include("./admin.service.stop.php");
	
	// stop
	// include("./includes/footer.inc.php");
?>