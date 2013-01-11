<?

	// include instance
	include("./appinstance.php");

	// check for admin
	include("./includes/checkaccess.admin.php");

	// start
	include("./includes/header.admin.inc.php");

	// mode ...
	$userModeExcerciseRef=-1; // all
	// a special excercisetask
	// $userMode
	// $userModeExcerciseRef=40;

	// add sidemenu
	$sideMenuText="".Display::adminDisplayTop(  );
	include("./includes/header.adminsidemenu.inc.php");	

?> 
	<h3>Verwaltung Users</h3>
<?

	$group="";
	if (isset($_REQUEST["group"]))
//	if ($app->requestFromWebIsset( $group ))
	{
		$group=$app->requestFromWeb("group","string");
	}
	$class="";
	if (isset($_REQUEST["class"]))
//	if ($app->requestFromWebIsset( $group ))
	{
		$class=$app->requestFromWeb("class","string");
	}

	// filter
	echo("<div class='adminContainerSmall'>");
		echo("<form action='adminusers.php'>");
		echo("Filter: ");
		echo("Group: ");
		echo("<input type=text name='group' value='$group'>*  ");
		echo("Klasse: ");
		echo("<input type=text name='class' value='$class'>*  ");
		echo("<input type=submit value='&Auml;ndern'>");
		echo("</form>");
	echo("</div>");

	// new User
	// import User
	echo("<div  class='adminContainerSmall'>");
		echo("<div>");
			echo(">+ User importieren*");
		echo("</div>");
		echo("<div>");
			echo("<a onClick=\"$('#newobject').toggle('fast');\">++ User anlegen</a>");
			echo("<div class='adminUserNewUpdateObject' id='newobject' style='display: none;'>");
				$newObj=new User();
				echo(Display::displayUser($app,$newObj,'listdetailraw'));
			echo("</div>");
		echo("</div>");
	echo("</div>");

	// not all groups are allowed!
	// group "admin" only for admins!
	echo("<div class='adminContainerSmall'>");
		$arr=$app->getUsersByGroupAndClassLike( $group, $class );
		echo(Display::displayUsers( $app, $arr ));
	echo("</div>");

	echo("<br>Count: ".count($arr));
		
/*
	// get all open excersises
		$arr=$app->getUsersByGroup( "admin" );
		if (count($arr)>0)
		{
			for ($o=0;$o<count($arr);$o++)
			{
				$obj=$arr[$o];
				// displayExcercise($excerciseObj);
				// load content here? ...
				echo("<div id=''>");
					echo("".$obj->userId);
					echo("".$obj->userType);
					echo("".$obj->userName);
					echo("");
				echo("</div>");
				
				
			}
		}
		else
		{
			echo("Keine User.");
		}
	
	*/

	// stop
	include("./includes/footer.inc.php");
?>