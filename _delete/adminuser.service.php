<?

	// include instance
	include("./appinstance.php");

	// check for admin
	include("./includes/checkaccess.admin.php");

	// start service
	include("./admin.service.start.php");

	$area="user";

	$inputUserObject=new User();
	$inputUserObject->updateToWebRequest($_REQUEST);

	$inputExcerciseUserObject=new ExcerciseUser();
	$inputExcerciseUserObject->updateToWebRequest($_REQUEST);

	/*
	echo("--adminuser.service--");
	print_r($inputUserObject);
	print_r($inputExcerciseUserObject);
	echo($action);
	*/

	// update to webrequest ...

	// todo: cases ... 
	// only admin can 

	// action here ...
	// insert
	if ($action=="insert")
	{

		/*
		$app->insertUser($inputUserObject);
		// search for latest and give it back?

		*/
		// reload ... here ..
		$userExcerciseUserRef=-1;
		// if ($app->requestFromWebIsset( $userExcerciseUserRef ))
		{
			$userExcerciseUserRef=$app->requestFromWeb("userExcerciseUserRef","string");
		}
		// echo($userExcerciseUserRef);		
		$app->insertUserAndExcerciseUser($inputUserObject,$userExcerciseUserRef);
		// echo("-----".$userExcerciseUserRef);

	}

	// udpate
	if ($action=="update")
	{

		$app->updateUser($inputUserObject);
		// search for latest and give it back?

		// reload ... 
		// $output=$output."updated";
		$output="".Display::displayUser($app,$inputUserObject,"listraw");
	}

	// delete
	if ($action=="delete")
	{
		$app->deleteUser($inputUserObject);
		// search for latest and give it back?
		// reload ... 
	}	


	// $output="...";
	if ($action=="reload")
	{
		// $app->deleteUser($inputUserObject);
		// search for latest and give it back?
		// reload ... 
		$actionSub=$_REQUEST["actionsub"];
		// echo("action ...... ".$actionSub);
		if ($actionSub=="delete") {  $app->deleteExcerciseUser($inputExcerciseUserObject); }
		if ($actionSub=="update") {  $app->updateExcerciseUser($inputExcerciseUserObject); }
		if ($actionSub=="insert") {  $app->insertExcerciseUser($inputExcerciseUserObject); }


		$output="".Display::displayUser($app,$inputUserObject,"listraw");
	}


	// stop service
	include("./admin.service.stop.php");
	
	// stop
	// include("./includes/footer.inc.php");
?>