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
	}
	if ($action=="update")
	{
		$inputObject=new User();
		$inputObject->userId=$app->session->userObject->userId; // take the internal - user must be logged in!
	 	// $inputObject->getUserById($inputObject->userId);
	 	$inputObject->updateToWebRequest($_REQUEST);
		$app->updateExcercise($inputObject);
	 }


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
		// admin
		/*
		if ($app->session->userObject->userType=="admin") include("./includes/contentadmin.php"); 
		
		// user
		if ($app->session->userObject->userType=="user") include("./includes/content.php"); 
		*/


		// admin
		/*		
	?>	<br><br>
		<form action="account.php" method="post">
			<input type=hidden name='action' value='update'>
			Name
			<br>
			<input type=text name='userName' size=20 value='<?=$userObject->userName?>'>
			<br>
			Vorname
			<br>
			<input type=text name='userPreName' size=20 value='<?=$userObject->userPreName?>'>
			<br><br>
			Email-Adressen
			<br>
			<input type=text name='userEmails' size=60 value='<?=$userObject->userEmails?>'>
			<br><i>beat.muster@fhnw.ch;b.muster@gmx.de</i>
			<br><br>
			Login:
			<br>
			<input type=text name='userLogin' size=20 value='<?=$userObject->userLogin?>'>
			<br><br>
			<! --Rolle: <?=$userObject->userType?> -->
			<input type=submit value='&Auml;ndern'>
			<br>
			
		</form>
		
	<? */

		?>

			<strong>Name:</strong> <br><?=$userObject->userName?><br>
			<br>
			<strong>Vorname:</strong> <br><?=$userObject->userPreName?><br>
			<br>
			<strong>Email-Adressen:</strong> <br><?=$userObject->userEmails?><br>
			<br>
			<strong>Login:</strong>
			<br><?=$userObject->userLogin?><br>

		<?
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