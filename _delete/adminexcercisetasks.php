<?

	// include instance
	include("./appinstance.php");

	// check for admin
	include("./includes/checkaccess.admin.php");

	/*
		DataHandling
	*/
	// input
	$action="";
	$action=$app->requestFromWeb("action","string.azAZ");

	/*
		Excercises
	*/
	/*
		add an exercise
	*/

	// create a new one?
	$inputObject=new Excercise();
    // updateto
 	$inputObject->updateToWebRequest($_REQUEST);
 	// find


	// print_r($inputObject);  

	// add
	if ($action=="add")
	{
		$copyFromExcercise=$app->requestFromWeb("copyFromExcercise","integer");
		// ... ok insert here an object ....
		$inputObject->excerciseStatus="preparing";
		$app->insertExcercise($inputObject);
		if ($copyFromExcercise!=-1)
		{
			// copy recursively here
			// todo: recursively
		}
		// echo("----".$copyFromExcercise);
		// find last one with this id
		$newObject=$app->getLatestExcercise( $inputObject );
		header("location: adminexcercisetasks.php?excerciseId=".$newObject->excerciseId);
	}
   		

	// update
	if ($action=="update")
	{
		$inputObject=$app->getExcerciseById($inputObject->excerciseId);
	 	$inputObject->updateToWebRequest($_REQUEST);
 		$app->updateExcercise($inputObject);
	}

	/*
		ExcerciseTask
	*/
	/*
		add an exercise
	*/

	// create a new one?
	$inputExcerciseTaskObject=new ExcerciseTask();
    // updateto
	$inputExcerciseTaskObject->updateToWebRequest($_REQUEST);
	// print_r($inputObject);  

	// add
	if ($action=="insertexercisetask")
	{
		$inputExcerciseTaskObject->excerciseStatus="";	
		$inputExcerciseTaskObject->excercisetaskName=$app->getExcerciseTaskNameByType( $inputExcerciseTaskObject->excercisetaskType );
		$app->insertExcerciseTask($inputExcerciseTaskObject);
		// special things for every task ...
		// print_r($inputExcerciseTaskObject);
	}
	// update
	if ($action=="updateexcercisetask")
	{
		//print_r($inputExcerciseTaskObject);
		$inputExcerciseTaskObject=$app->getExcerciseTaskById($inputExcerciseTaskObject->excercisetaskId);
		//print_r($inputExcerciseTaskObject);
		$inputExcerciseTaskObject->updateToWebRequest($_REQUEST);
		//print_r($inputExcerciseTaskObject);
		$app->updateExcerciseTask($inputExcerciseTaskObject);

		// really delete the whole thing?
		// todo: ? $inputExcerciseTaskObject->excercisetaskStatus=="deleted"
	}


	// start
	include("./includes/header.admin.inc.php");

	// id?
	$excerciseId=$inputObject->excerciseId;
	// echo("excerciseId: $excerciseId");
	// $excersiceObject=null;
	/*
	// this excercise
	if (isset($_REQUEST["id"]))
	{
		$excerciseId=$app->requestFromWeb("id","integer");
	}	
	// todo
	else
	{
		$excerciseId=$inputObject->excerciseId;
	}
	*/

	// tod
	// id==-1 > admin site
	
	// excerciseObject
	$excerciseObject=$app->getExcerciseById($excerciseId);
	
	// sidemenu
	$sideMenuText="".Display::adminDisplayExcerciseTasksPointTop( $app, $excerciseObject );
	include("./includes/header.adminsidemenu.inc.php");	

?>

<h4>Ablauf bearbeiten (Unterauftr&auml;ge)</h4>
<div id='excerciseFlow'>
<?
// 	$arr=$app->getAllExcerciseTasksFromExcercise( $excerciseId );
	$arr=$app->getAllActiveExcerciseTasksFromExcercise( $excerciseId );
	for ($i=0;$i<count($arr);$i++)
	{
		$obj=$arr[$i];

		$flagDisplay=true;
		if ($obj->excercisetaskStatus!="") $flagDisplay=false;
		
		// if ($flagDisplay)
		if (true)
		{
			$styleAddNoDisplay="";
			if (!$flagDisplay)
			{
				$styleAddNoDisplay=" display:none; border: 1px dotted red; ";
				echo("<div ><a onClick=\"$('#task$i').toggle(100);\">toggle '".$app->getExcerciseTaskNameByType($obj->excercisetaskType)."' deleted ></a></div>");	
			} 
			echo("<div id='task".$i."' class='adminTaskEditDetail' style=''  $styleAddNoDisplay'>");
				echo("<form action='adminexcercisetasks.php'>");
					echo("<input type=hidden name='action' value='updateexcercisetask' >");
					echo("<input type=hidden name='excerciseId' value='".$excerciseObject->excerciseId."' >");
					echo("<input type='hidden' name='excercisetaskId' value='".$obj->excercisetaskId."'>");
					echo("<input type='textfield' name='excercisetaskOrder' value='".$obj->excercisetaskOrder."'  size=1>");
					echo(Display::displayStatusActiveDeletedAsSelect( $app, "excercisetaskStatus", $obj->excercisetaskStatus ));
					// echo($obj->excercisetaskStatus."---");
					echo("<input type='textfield' name='excercisetaskName' value='".$obj->excercisetaskName."' size=40>");
					echo("<input type='submit' value='ver&auml;ndern'>");
					echo(" | ");
					echo("<a href='adminexcercisetask.php?excercisetaskId=".$obj->excercisetaskId."'>'".$app->getExcerciseTaskNameByType($obj->excercisetaskType)." editieren > </a>");
				echo("</form>");
			echo("</div>");
		}
	}

	
?>
<!-- add one -->
<div class='adminExcerciseNewTask'>
	<form action='adminexcercisetasks.php'>
	<input type='hidden' name='action' value='insertexercisetask'>
	<input type='hidden' name='excerciseId' value='<?=$excerciseObject->excerciseId?>' >
	<input type='hidden' name='excercisetaskExcerciseRef' value='<?=$excerciseObject->excerciseId?>' >
		Neue Auftr&auml;ge: 
		Pos: <input type='textfield' name='excercisetaskOrder' size=2 value='4'>
		Auftrag: 
		<select name='excercisetaskType'>
			<? 
				// get them from classes
				for ($t=0;$t<$app->getExerciseTaskTypesAmount();$t++)
				{
					$code=$app->getExcerciseTaskTypesIndexAt( $t );
					$name=$app->getExcerciseTaskNameTypesIndexAt( $t );
					$selected="";
					// if ($excerciseObject->excerciseStatus==$val) $selected=" selected ";
					echo("<option value='$code' $selected>$name</option>");
				}
			?>
		</select>
		<input type='submit' value='Hinzuf&uuml;gen'>
	</form>
</div>

</div>

<?

	// stop
	include("./includes/footer.inc.php");
?>