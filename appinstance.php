<?
	/*
		errors
	*/
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	
	// set time limit
	// attention: in safe_mode > change in php.ini!

	set_time_limit(-1);

	// version 2
	session_start();

    // index.php > appinstance.php > header.inc.php!
    // something not here

	// & .htaccess
	/*
		# PHP error handling for development servers
php_flag display_startup_errors on
php_flag display_errors on
php_flag html_errors on
php_flag log_errors on
php_flag ignore_repeated_errors off
php_flag ignore_repeated_source off
php_flag report_memleaks on
php_flag track_errors on
php_value docref_root 0
php_value docref_ext 0
php_value error_log /home/path/public_html/domain/PHP_errors.log
# [see footnote 3] # php_value error_reporting 999999999
php_value error_reporting -1
php_value log_errors_max_len 0

<Files PHP_errors.log>
 Order allow,deny
 Deny from all
 Satisfy All
</Files>
	
	*/
	/*
	
		includes
	
	*/
	// app	
	include_once("./classes/App.php"); // main app

	include_once("./classes/Converter.php");
	include_once("./classes/Session.php");
	include_once("./classes/Config.php");
	include_once("./classes/ConfigItem.php");

	include_once("./classes/Rule.php");
	include_once("./classes/RuleAccessMatrix.php");

	include_once("./classes/Log.php");

	include_once("./classes/User.php"); // users
	
	include_once("./classes/UserContainerView.php"); // only view for the user (not in database) ...

		// members fors complex ...	
		include_once("./classes/TextObjectComplexMember.php"); 

	// base
	include_once("./classes/TextObject.php"); 
		include_once("./classes/TextObjectView.php"); 

	// objects
	include_once("./classes/TextObjectThread.php"); // subclasses
		include_once("./classes/TextObjectThreadView.php"); // subclassesview

		include_once("./classes/TextObjectHyperthreadPlain.php"); // subclasses
			include_once("./classes/TextObjectHyperthreadPlainView.php"); // subclassesview

	include_once("./classes/TextObjectDomainPlain.php"); // subclasses
		include_once("./classes/TextObjectDomainPlainView.php"); // subclassesview
	include_once("./classes/TextObjectDomainUser.php"); // subclasses
		include_once("./classes/TextObjectDomainUserView.php"); // subclassesview

	include_once("./classes/TextObjectPlatformPlain.php"); // subclasses
		include_once("./classes/TextObjectPlatformPlainView.php"); // subclassesview

			// images
			include_once("./classes/TextObjectImagePng.php"); 
				include_once("./classes/TextObjectImagePngView.php");

				// primitives
				include_once("./classes/TextObjectNumberBoolean.php"); // subclasses
					include_once("./classes/TextObjectNumberBooleanView.php"); // subclasses
				include_once("./classes/TextObjectNumberIntegerView.php"); // subclasses
					include_once("./classes/TextObjectNumberInteger.php"); // subclasses
				include_once("./classes/TextObjectNumberFloat.php"); // subclasses
					include_once("./classes/TextObjectNumberFloatView.php"); // subclasses
				include_once("./classes/TextObjectTextLine.php"); // subclasses
					include_once("./classes/TextObjectTextLineView.php"); // subclasses

			// text 
			include_once("./classes/TextObjectTitle.php"); // subclasses
				include_once("./classes/TextObjectTitleView.php"); // subclassesview

			// text html
			include_once("./classes/TextObjectTextHtml.php"); // subclasses
				include_once("./classes/TextObjectTextHtmlView.php"); // subclassesview

			// text rtf
			include_once("./classes/TextObjectTextRtf.php"); // subclasses
				include_once("./classes/TextObjectTextRtfView.php"); // subclassesview

			// audio
			include_once("./classes/TextObjectAudioWav.php"); // subclasses
				include_once("./classes/TextObjectAudioWavView.php"); // subclassesview
				include_once("./classes/wavefrom.php"); // draw waveform

			// video
			include_once("./classes/TextObjectVideoOgg.php"); // subclasses
				include_once("./classes/TextObjectVideoOggView.php"); // subclassesview
			
			// youtube embed
			include_once("./classes/TextObjectEmbedYoutube.php"); // subclasses
				include_once("./classes/TextObjectEmbedYoutubeView.php"); // subclassesview

			// complex ...	
			include_once("./classes/TextObjectBlogPlain.php"); 
				include_once("./classes/TextObjectBlogPlainView.php"); 

			// link
			include_once("./classes/TextObjectLinkPlain.php"); // subclasses
				include_once("./classes/TextObjectLinkPlainView.php"); // subclasses


	include_once("./classes/Language.php"); // cross references
	include_once("./classes/LanguageObject.php"); // cross references


	include_once("./classes/Tag.php"); // tags
	include_once("./classes/TextObjectTag.php"); // cross references

	// include_once("./classes/Display.php");

	// phpmailer for mails
	include_once("./classes/class.phpmailer.php");
	
	/*
		// phpinfo
		phpinfo();
	*/

	// userid
	$userId=-1;
	
	// app
	$app=new App();

	// overwrite default config
	include("./config.php");
		
		// version 1
		// session_start();
		

	// start
	$app->start();

	// get user Id things
	// check for session set and update here ..
	if (isset($_SESSION["userId"]))
	{
		// get user
		// $app->setSessionUser( $_SESSION["userId"] );
		$userId=$_SESSION["userId"];

	}
	else
	{
		// $app->setSessionUser( -1 );
		$_SESSION["userId"]=-1;
	}

	// login?
		
		// disable 
		if (isset($_SESSION["userLoginError"])) { $_SESSION["userLoginError"]="";	 }

	if (isset($_REQUEST["action"])) 
	{
		// actions
		$action=$_REQUEST["action"];

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
			// new password? > set it now ..
			if ($password!="")
			{
				// todo: disable canLogin here!

				$newUserPassword=$app->checkInPasswordNew($login,$password);
				if ($newUserPassword!=null)
				{
					if ($newUserPassword!="")
					{
						$newUserPassword->userPassword=$newUserPassword->userPasswordNew;
						$app->updateUserPassword($newUserPassword);
					}
				}
			}

			// check for login here ...
			$userObj=$app->checkIn($login,$password);
			if ($userObj!=null)
			{
				if ($userObj->userCanLogin==1)
				{
					// can login?
					$_SESSION["userId"]=$userObj->userId;
					$_SESSION["userLoginError"]="";
					// $app->setSessionUser( $_SESSION["userId"] );

					$strId="";
					$id=$app->requestFromWebExt("id","int",-1);
					if ($id!=-1) $strId="?id=$id";
					header("location: index.php".$strId);				
						
				}
				else
				{
					// todo: error?
					$_SESSION["userLoginError"]="Your login is disabled. Contact the administrator. @loginDisabledError";
				}
			}

			if ($userObj==null)
			{
					$_SESSION["userLoginError"]="Sorry could not login in with your data. @loginCheckinError";				
			}


		}

		// logout
		if ($action=="logout")
		{ 
			// add logging
			$_SESSION["userId"]=-1; 
			$userId=-1;

			$strId="";
			$id=$app->requestFromWebExt("id","int",-1);
			if ($id!=-1) $strId="?id=$id";
			header("location: index.php".$strId);
		}

	}

	// init platform
	// todo: ? actualises the platform if there is no one > add it ... 
	$app->initPlatform($userId);


	// not a special user?
	if (("".$_SESSION["userId"])=="-1")
	{
		$userAnonymousObj=$app->getUserAnonymous();
		// print_r($userAnonymousObj);
		$_SESSION["userId"]=$userAnonymousObj->userId;
	} 


	// redirect to front site if not yet set ...
	
?>