<?
	// app instance
	include("./appinstance.php");

	// check logged in!
	// todo: as admin

	// as a user
	// include("./includes/checkaccess.user.php");

	// login
	if (!$app->session->isLoggedIn()) 
	{
		header("location: index.php");
	}


	// update
	$action="";
	if (isset($_REQUEST["action"]))
	{
		$action=$app->requestFromWeb("action","string");

		// send ...
		if ($action=="password")
		{
			// passwort versenden
			// send password ... 
			// $app->
		}
	}

	/*
	if ($action=="update")
	{
		$inputObject=new User();
		$inputObject->userId=$app->session->userObject->userId; // take the internal - user must be logged in!
	 	// $inputObject->getUserById($inputObject->userId);
	 	$inputObject->updateToWebRequest($_REQUEST);
		$app->updateExcercise($inputObject);
	 }

*/
		$userObject=$app->session->userObject;
		$app->session->userObject=$app->getUserById($userObject->userId);
		$userObject=$app->session->userObject;

	


	// start
	include("./includes/header.inc.php");

?>

	<?=Display::displayUserSideMenu($app,"excercise",null,null)?>


	<h1>Profil</h1>

<?

	// logged in
	if ($app->session->isLoggedIn()) 
	{ 
		
		?>

			<strong>Name:</strong> <br><?=$userObject->userName?><br>
			<br>
			<strong>Vorname:</strong> <br><?=$userObject->userPreName?><br>
			<br>
			<strong>Email-Adressen:</strong> <br><?=$userObject->userEmails?><br>
			<br>
			<strong>Login:</strong>
			<br><?=$userObject->userLogin?><br>

			<? /*?>
			<!-- Passwort -->
			<br><strong>Passwort vergessen?</strong>					
			<?
			   // default
			   if ($action=="")
			   { ?>
					<br><form><input type='button' value=' Neues Passwort versenden ' onClick="document.location.href='account.php?action=password';"></form>
			<? }
			   else
			   { ?>
					<br>Passwort wurde als Email versandt. <br>Loggen Sie sich mit dem ihnen zugeschickten Passwort ein.
			<? }

			*/

	}
	else
	{
		echo("<h4>Kein Zugriff. Bitte einloggen.</h4>");
	}

	// stop
	include("./includes/footer.inc.php");
	
	// stop
	include("./appdeconstruct.php");

?>