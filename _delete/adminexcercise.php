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
		header("location: adminexcercise.php?excerciseId=".$newObject->excerciseId);
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
	$sideMenuText="".Display::adminDisplayExcercisePointTop( $app, $excerciseObject );
	include("./includes/header.adminsidemenu.inc.php");	

?>
<h2>Administration: <?=$excerciseObject->excerciseName?> </h2>


<form action="adminexcercise.php">
<input type=hidden name='action' value='update'>
<input type=hidden name='excerciseId' value='<?=$excerciseObject->excerciseId?>' >
Name:
<input type=text name='excerciseName' value='<?=$excerciseObject->excerciseName?>' size=60 >
<br>Status: 
<select name='excerciseStatus'>
	<? 
		// get them from classes
		for ($t=0;$t<$app->getExcerciseStatusAmount();$t++)
		{
			$name=$app->getExcerciseStatusNameIndexAt( $t );
			$val=$app->getExcerciseStatusIndexAt( $t );
			$selected="";
			if ($excerciseObject->excerciseStatus==$val) $selected=" selected ";
			echo("<option value='$val' $selected>$name</option>");
		}
	?>
</select>
<br><input type=submit value='Ver&auml;ndern'>
</form>

<br>
<div><a href='adminexcercisetasks.php?excerciseId=<?=$excerciseObject->excerciseId?>'>Ablauf ></a></div>
<div><a href='adminexcerciseusers.php?excerciseId=<?=$excerciseObject->excerciseId?>'>Users></a></div>
<div><a href='adminexcercisedates.php?excerciseId=<?=$excerciseObject->excerciseId?>'>Timetable></a></div>
<div><a href='adminexcerciseusers.php?excerciseId=<?=$excerciseObject->excerciseId?>'>Results></a></div>
<!-- <h4><a href='adminexcerciseresult.php?excerciseId=<?=$excerciseObject->excerciseId?>'>Resultate</a></h4> -->



<?

	// stop
	include("./includes/footer.inc.php");
?>