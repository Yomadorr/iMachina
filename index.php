<?

	/*

		PlatformView
        |__ Domain
        	(–– Threads)
            |__ Hyperthread
               |__ Thread

	*/

    // 0. includes classes
	// 1. app instance
    // 2. check login ..
	include("./appinstance.php");


	
	// start
	include("./includes/header.inc.php");

	/*
		special actions
	*/
	// install?
	if (isset($_REQUEST["action"])) 
	{
		// actions
		$action=$_REQUEST["action"];

		// spceicals 
		if ($action=="install")
		{
			$_SESSION["userId"]=-1;
			echo("<html>");
			echo("installing<br>");

			$platformObject=$app->getPlatform($userId);
	        if ($platformObject==null)
	        {
				// install!
				$str=$app->install();
				echo($str);
			}
			else
			{
				echo("could not install. because there is a platform there!");
			}

			exit();
		}

		/*
			logins
		*/
		// login
		if ($action=="login")
		{ 
			// add login ... 
			$login="";
			$password="";

			if (isset($_REQUEST["login"])) $login=$_REQUEST["login"]; 
			if (isset($_REQUEST["password"])) $password=$_REQUEST["password"]; 

			// check it now ...
		}

	}
	
	// platform ...
	$platformObj=$app->getActivePlatform( $userId );
	$platformViewObj=$app->getTextObjectViewFor($platformObj, $app, $userId);

	$contentId=-1;

	  if (isset($_REQUEST["id"]))
	  {
	  	  // check security ... 
	      $contentId=$_REQUEST["id"];
	  }

	// echo("<hr>$contentId<hr>");  
	$contentPlatform=$platformViewObj->viewDetailPlatform($contentId,$app, $userId);
		$str=$contentPlatform;
	echo($str);



	// stop
	include("./includes/footer.inc.php");
	
	// stop
	include("./appdeconstruct.php");

?>