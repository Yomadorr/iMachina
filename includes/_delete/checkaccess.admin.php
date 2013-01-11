<?
	/*
		user check
	*/
	
	// is logged in 
	if (!$app->session->isLoggedIn())
	{
	   // echo("is not logged in!");
	   header("Location: index.php");
	}
	// usercheck
	if (!$app->session->isAdmin()) 
	{
		header("Location: index.php");
	}
	
	// admin-type?
	if ($app->session->userObject->userType!="admin") header("Redirect: index.php");
?>