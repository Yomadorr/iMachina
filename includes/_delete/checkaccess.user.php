<?
	/*
		user check
	*/

	// if you are a administrator
	if ($app->session->isAdmin()) 
	{
	   // echo("is not logged in!");
	   header("Location: admin.php");
	}
	
	// is logged in 
	if (!$app->session->isLoggedIn())
	{
	   // echo("is not logged in!");
	   header("Location: index.php");
	}

?>