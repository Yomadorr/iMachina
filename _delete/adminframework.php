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
		Frameworks
	*/
	/*
		add an exercise
	*/

	// create a new one?
	$frameworkObject=new Framework();
    // updateto
 	$frameworkObject->updateToWebRequest($_REQUEST);
 	$inputFrameworkObject=$app->getFrameworkById($frameworkObject->frameworkId);
 	if ($inputFrameworkObject!=null) $frameworkObject=$inputFrameworkObject;

 	// find
	// print_r($frameworkObject);  

	// add
	if ($action=="add")
	{
		$copyFromFramework=$app->requestFromWeb("copyFromFramework","integer");
		// ... ok insert here an object ....
		$frameworkObject->frameworkStatus="";
		$app->insertFramework($frameworkObject);
		if ($copyFromFramework!=-1)
		{
			// copy recursively here
			// todo: recursively
		}
		$newObject=$app->getLatestFramework( $frameworkObject );
		header("location: adminframework.php?frameworkId=".$newObject->frameworkId);
	}
   		

	// update
	if ($action=="update")
	{
		$frameworkObject=$app->getFrameworkById($frameworkObject->frameworkId);
	 	$frameworkObject->updateToWebRequest($_REQUEST);
	 	// print_r($frameworkObject);
 		$app->updateFramework($frameworkObject);

 		if ($frameworkObject->frameworkStatus=="deleted") header("location: admin.php");
	}

	/*
		FrameworkTask
	*/
	/*
		add an exercise
	*/

	// create a new one? / 
	$inputFrameworkDimObject=new FrameworkDim();
    // updateto
	$inputFrameworkDimObject->updateToWebRequest($_REQUEST);
	// print_r($frameworkObject);  

	// add
	if ($action=="addframeworkdim")
	{
		$inputFrameworkDimObject->frameworkdimStatus="";	
		// $inputFrameworkDimObject->frameworktaskName=$app->getFrameworkTaskNameByType( $inputFrameworkTaskObject->frameworktaskType );
		$app->insertFrameworkDim($inputFrameworkDimObject);
		// special things for every task ...
		// print_r($inputFrameworkTaskObject);
	}
	// update
	if ($action=="updateframeworkdim")
	{
		//print_r($inputFrameworkTaskObject);
		$inputFrameworkDimObject=$app->getFrameworkDimById($inputFrameworkDimObject->frameworkdimId);
		//print_r($inputFrameworkTaskObject);
		$inputFrameworkDimObject->updateToWebRequest($_REQUEST);
		//print_r($inputFrameworkTaskObject);
		$app->updateFrameworkDim($inputFrameworkDimObject);

		// really delete the whole thing?
		// todo: ? $inputFrameworkTaskObject->frameworktaskStatus=="deleted"
	}
	// delete
	if ($action=="deleteframdworkdim")
	{
		//print_r($inputFrameworkTaskObject);
		$inputFrameworkDimObject=$app->getFrameworkDimById($inputFrameworkDimObject->frameworkdimId);
		//print_r($inputFrameworkTaskObject);
		$inputFrameworkDimObject->updateToWebRequest($_REQUEST);
		//print_r($inputFrameworkTaskObject);
		$app->deleteFrameworkDim($inputFrameworkDimObject);


		// really delete the whole thing?
		// todo: ? $inputFrameworkTaskObject->frameworktaskStatus=="deleted"
	}
	
	/*
		category
	*/
	$inputFrameworkDimCatObject=new FrameworkDimCat();
    // updateto
	$inputFrameworkDimCatObject->updateToWebRequest($_REQUEST);
	
	// add
	if ($action=="addframeworkdimcat")
	{
		$inputFrameworkDimCatObject->frameworkdimcatStatus="";	
		// $inputFrameworkDimObject->frameworktaskName=$app->getFrameworkTaskNameByType( $inputFrameworkTaskObject->frameworktaskType );
		$app->insertFrameworkDimCat($inputFrameworkDimCatObject);
		// special things for every task ...
		// print_r($inputFrameworkTaskObject);
	}
	// update
	if ($action=="updateframeworkdimcat")
	{
		//print_r($inputFrameworkTaskObject);
		$inputFrameworkDimCatObject=$app->getFrameworkDimCatById($inputFrameworkDimCatObject->frameworkdimcatId);
		//print_r($inputFrameworkTaskObject);
		$inputFrameworkDimCatObject->updateToWebRequest($_REQUEST);
		//print_r($inputFrameworkTaskObject);
		$app->updateFrameworkDimCat($inputFrameworkDimCatObject);

		// really delete the whole thing?
		// todo: ? $inputFrameworkTaskObject->frameworktaskStatus=="deleted"
	}
	// delete
	if ($action=="deleteframdworkdimcat")
	{
		//print_r($inputFrameworkTaskObject);
		$inputFrameworkDimCatObject=$app->getFrameworkDimCatById($inputFrameworkDimCatObject->frameworkdimcatId);
		//print_r($inputFrameworkTaskObject);
		$inputFrameworkDimCatObject->updateToWebRequest($_REQUEST);
		//print_r($inputFrameworkTaskObject);
		$app->deleteFrameworkDimCat($inputFrameworkDimCatObject);


		// really delete the whole thing?
		// todo: ? $inputFrameworkTaskObject->frameworktaskStatus=="deleted"
	}
	

	// start
	include("./includes/header.admin.inc.php");

	// id?
	$frameworkId=$frameworkObject->frameworkId;

	// tod
	// id==-1 > admin site
	
	// FrameworkObject
	$frameworkObject=$app->getFrameworkById($frameworkId);

	// sidemenu
	$sideMenuText="".Display::adminDisplayFrameworkPointTop( $app, $frameworkObject );
	include("./includes/header.adminsidemenu.inc.php");	
	

?>
<h2>Administration: Raster bearbeiten</h2>

<? /*echo(Display::displayAdminFrameworkBreadCrump($app,$FrameworkObject,null)) */ ?>

<form action="adminframework.php">
<input type=hidden name='action' value='update'>
<input type=hidden name='frameworkId' value='<?=$frameworkObject->frameworkId?>' >
Name:
<input type=text name='frameworkName' value='<?=$frameworkObject->frameworkName?>' size=60 >
<br>Status: <?=Display::displayStatusActiveDeletedAsSelect( $app, "frameworkStatus", $frameworkObject->frameworkStatus )?>
<br><input type=submit value='Ver&auml;ndern'>
</form>

<!-- Empfehlungen -->
<h4>Empfehlungen</h4>
<?
	$arrSuggestions=$app->getAllActiveSuggestionsByFramework( $frameworkObject->frameworkId );
	// print_r($arrSuggestions);
	if (count($arrSuggestions)>0)
	for ($z=0;$z<count($arrSuggestions);$z++)
	{
		$suggestionObj=$arrSuggestions[$z];
		$displaySuggestion=true;			
		// print_r($frameworkObj);
		if ($suggestionObj->suggestionStatus=='deleted') $displaySuggestion=false;
		if ($displaySuggestion)
		echo("<div class='adminFrameworkList'><a href='adminsuggestion.php?suggestionId=".$suggestionObj->suggestionId."&suggestionFrameworkId=".$suggestionObj->suggestionFrameworkId."'>".$suggestionObj->suggestionName." ></a></div>");
	}
?>
<div class='adminNew'>
	<form action='adminsuggestion.php'><input type='hidden' name='action' value='add'>
		Neue Empfehlung erstellen:
		<input type=hidden name='suggestionFrameworkId' value='<?=$frameworkObject->frameworkId?>' size=5>
		<br><input type='text' name='suggestionName' value='Empfehlung XYZ' size=20>
		<input type='submit' value='erstellen'>
	</form>
</div>

<!-- dimensionen -->
<h3>Dimensionen</h3>
<br>
<i>Die Label für die Teildimenstionen müssen nur bei der ersten Teildimension eingegeben werden.</i>
<br><br>
<?	
	$arr=$app->getFrameworkDimsByFramework( $frameworkObject->frameworkId );
	echo("<div class='adminFrameworkDimContainer'>");
	echo("<table width=900>");
	for ($r=0;$r<count($arr);$r++)
	{
		echo("<tr>");
		$dim=$arr[$r];

			// dim
			echo("<td valign=top style='border-right: 1px solid black;' width=800>");

			echo("<div class='adminFramworkDim'>");
				// echo($dim->frameworkdimId." ".$dim->frameworkdimName);

					// add a button
					$dimSubId="dimsub".$dim->frameworkdimId;;
					$strButton="<input type=button value='Neue Teildimension' onClick=\"$('#$dimSubId').toggle();\">";

				$strField=displayFrameworkDimForm( $dim, true, $strButton );
				echo("<div>".$strField."</div>");
			echo("</div>");


			// dimsub
			echo("<div class='adminFramworkDimSub'>");
			
				$arrSub=$app->getFrameworkDimsByFrameworkSub( $dim->frameworkdimId );
				for ($rr=0;$rr<count($arrSub);$rr++)
				{
					$dimSub=$arrSub[$rr];
//					echo("".$dimSub->frameworkdimId."".$dimSub->frameworkdimName);
//					echo("<br>");
					echo("<div class='adminFramworkDimSubTitle'>");

						// add a button
						$dimSubId="dimsubcat".$dimSub->frameworkdimId;
						$strButton="<input type=button value='Neue Auspr&auml;gung' onClick=\"$('#$dimSubId').toggle();\">";

						echo(displayFrameworkDimForm( $dimSub, true, $strButton ));

						
					echo("</div>");

					// category
					// categories (eigentlicher raster)
					echo("<div class='adminFrameworkdimsubCategory'>");
					$arrCat=$app->getFrameworkDimCatsByFrameworkDim( $dimSub->frameworkdimId );
					for ($c=0;$c<count($arrCat);$c++)
					{
						$cat=$arrCat[$c];
						echo("<div class='adminFrameworkdimsubCategoryCat'>1");
							$firstLabel=false;
							if ($rr==0) $firstLabel=true;
							echo(displayFrameworkDimCatForm( $cat, true, $firstLabel ));
						echo("</div>");

					}

						// add cat
						$dimSubId="dimsubcat".$dimSub->frameworkdimId;
						// echo("<div ><a onClick=\"$('#$dimSubId').toggle();\">Neue Kategorie ></a></div>");
						echo("<div id='$dimSubId' style='font-size: 10px; display:none; '>");
							$newcat=new FrameworkDimCat();
							$newcat->frameworkdimcatDimRef=$dimSub->frameworkdimId;
							echo("<div class='adminFrameworkdimsubCategoryNew'>");
								echo(displayFrameworkDimCatForm( $newcat, false, true ));
							echo("</div>");
						echo("</div>");

					echo("</div>");	

				}

				// add sub dim ... 
				$newFramworkDim=new FrameworkDim();
				$newFramworkDim->frameworkdimFrameworkRef=$frameworkObject->frameworkId;
				$newFramworkDim->frameworkdimRef=$dim->frameworkdimId;
				$dimSubId="dimsub".$dim->frameworkdimId;;
				echo("<div id='$dimSubId' class='adminFramworkDimSubTitle' style='font-size: 10px; display:none; '>".displayFrameworkDimForm( $newFramworkDim, false )."</div>");

			echo("</div>");
			echo("</td>");	
		echo("</tr>");
	}
	$newFramworkDim=new FrameworkDim();
	$newFramworkDim->frameworkdimFrameworkRef=$frameworkObject->frameworkId;
	$newFramworkDim->frameworkRef=-1;
	echo("<tr><td valignt=top style='border-top: 1px dotted black;'><div class='adminFramworkDim'>Neue Dimension: ".displayFrameworkDimForm( $newFramworkDim, false )."</div></td></tr>" );
	echo("</table>");
	echo("</div>");

	function displayFrameworkDimForm( $frameworkdimObjectForm, $flagUpdate, $strButton="" )
	{
		global $frameworkObject;

		$str="";
			$str=$str."\n<form action='adminframework.php' _method='post'>";

				if (!$flagUpdate) $str=$str."\n<input type='hidden' name='action' value='addframeworkdim'>";
				if ($flagUpdate) { $str=$str."\n<input type='hidden' name='action' value='updateframeworkdim'>";}
				if ($flagUpdate) { $str=$str."\n<input type=button value='x' onClick=\"if (confirm('Sie sind sicher, dass sie diese Dimension und alle Subdimensionen loeschen wollen?')) document.location.href='adminframework.php?action=deleteframdworkdim&frameworkId=".$frameworkObject->frameworkId."&frameworkdimId=".$frameworkdimObjectForm->frameworkdimId."';\">"; }

				$str=$str."\n<input type='hidden' name='frameworkdimFrameworkRef'  value='".$frameworkObject->frameworkId."'>";
				$str=$str."\n<input type='hidden' name='frameworkdimRef'  value='".$frameworkdimObjectForm->frameworkdimRef."'>";

				$str=$str."\n<input type='hidden' name='frameworkId'  value='".$frameworkObject->frameworkId."'>";
				$str=$str."\n<input type='hidden' name='frameworkdimId'  value='".$frameworkdimObjectForm->frameworkdimId."'>";
				$str=$str."\n<input type='textfield' size=2 name='frameworkdimOrder'  value='".$frameworkdimObjectForm->frameworkdimOrder."'>";
				$str=$str."\n<input type='textfield' size=25 name='frameworkdimName'  value='".$frameworkdimObjectForm->frameworkdimName."'>";
				$str=$str."\n<input type='textfield' size=3 name='frameworkdimSigle'  value='".$frameworkdimObjectForm->frameworkdimSigle."'>";
				
				// textareaId
				$textareaId=$frameworkdimObjectForm->frameworkdimId;
//				if ($textareaId==-1) $textareaId="2001";
// echo($textareaId);

				// show description
				if ($textareaId!=-1) $str=$str."\n<input type=button style='border: 1px dotted gray; ' value=' Beschreibung + ' onClick=\"$('#$textareaId').toggle(100);\">"; 

				if (!$flagUpdate) $str=$str."\n<input type='submit'  value='neu'>";
				if ($flagUpdate) $str=$str."\n<input type='submit'  value='&auml;ndern'>";

				$str=$str.$strButton;

				$str=$str."\n<div style='display:none;' id='$textareaId'><textarea cols=70 rows=10 name='frameworkdimDescription'>".$frameworkdimObjectForm->frameworkdimDescription."</textarea></div>";
				

			$str=$str."\n</form>";


		return $str;
	}

	// kategorie!
	function displayFrameworkDimCatForm( $frameworkdimcatObjectForm, $flagUpdate, $isFirstCatForm=true )
	{
		global $frameworkObject;

		$str="";

		// $isFirstCatForm=true;

		// $str=$str."**( ".$frameworkdimcatObjectForm.",". $flagUpdate." )***";

			$str=$str."\n<form action='adminframework.php' _method='post'>";

				if (!$flagUpdate) $str=$str."\n<input type='hidden' name='action' value='addframeworkdimcat'>";
				if ($flagUpdate) { $str=$str."\n<input type='hidden' name='action' value='updateframeworkdimcat'>";}
				if ($flagUpdate) { $str=$str."\n<input type=button value='x' onClick=\"document.location.href='adminframework.php?action=deleteframdworkdimcat&frameworkId=".$frameworkObject->frameworkId."&frameworkdimcatId=".$frameworkdimcatObjectForm->frameworkdimcatId."';\">"; }

				$str=$str."\n<input type='hidden' name='frameworkdimcatFrameworkRef'  value='".$frameworkObject->frameworkId."'>";
				$str=$str."\n<input type='hidden' name='frameworkdimcatDimRef'  value='".$frameworkdimcatObjectForm->frameworkdimcatDimRef."'>";

				$str=$str."\n<input type='hidden' name='frameworkId'  value='".$frameworkObject->frameworkId."'>";
				$str=$str."\n<input type='hidden' name='frameworkdimcatId'  value='".$frameworkdimcatObjectForm->frameworkdimcatId."'>";
				$str=$str."\n<input type='textfield' width=20 size=2 name='frameworkdimcatOrder'  value='".$frameworkdimcatObjectForm->frameworkdimcatOrder."'>";
				$str=$str."\n<input type='textfield' size=80 name='frameworkdimcatName'  value='".$frameworkdimcatObjectForm->frameworkdimcatName."'>";


				if ($isFirstCatForm)
				{
					$str=$str."\nLabel:<input type='textfield' size=10 name='frameworkdimcatLabel'  value='".$frameworkdimcatObjectForm->frameworkdimcatLabel."'>";
					
					$arrValName=array("","gen&uuml;gend");
					$arrVal=array("","neutral");
					$str=$str."\nVal:<select name='frameworkdimcatValue' >";

					for ($i=0;$i<count($arrVal);$i++)
					{
						$sel="";
						if ($frameworkdimcatObjectForm->frameworkdimcatValue==$arrVal[$i])
						{
							$sel=" selected ";
						}
						$str=$str."<option value='".$arrVal[$i]."' $sel >".$arrValName[$i]."</option>";
					}
					$str=$str."\n</select>";
					// $str=$str."\nVal:<input type='textfield' size=5 name='frameworkdimcatValue'  value='".$frameworkdimcatObjectForm->frameworkdimcatValue."'>";
				}

				if (!$flagUpdate) $str=$str."\n<input type='submit'  value='neu'>";
				if ($flagUpdate) $str=$str."\n<input type='submit'  value='&auml;ndern'>";
			$str=$str."\n</form>";


		return $str;
	}

?>
<?

	// stop
	include("./includes/footer.inc.php");
?>