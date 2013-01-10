<?

	// include instance
	include("./appinstance.php");

	// excercise task handling
	include("./includes/excercisetaskhandling.user.php");

	// check logged in!
	include("./includes/checkaccess.user.php");


	$excerciseId=$excerciseObject->excerciseId;
	$excercisetaskObject=$excerciseObject;

	//  =
	$excercisetaskObjId=$excerciseTaskObject->excercisetaskId;
	$excercisetaskObject=$excerciseTaskObject;
	$excercisetaskId=$excerciseTaskObject->excercisetaskId;


	// taskdone?
	$taskDone=false;


	// frameworkId
	$frameworkId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "frameworkId", -1 );
	$frameworkObj=$app->getFrameworkById( $frameworkId );

	// 	textinput
	// todo: getTaskWriteText...
	$textInput="Konnte keinen Text finden...";
	$tasktextwriteId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "inputexcercisetaskId", -1 );
	$arr=$app->getTaskWriteTextDocumentsByTaskAndUser($tasktextwriteId,$app->session->userObject->userId);
	// print_r($arr);
	if (count($arr)>0)
	{
		$objDocument=$arr[0];
		$textInput="".$objDocument->taskwritetextdocumentText;
		
	}
	else
	{
		// generate one ...		
		// not existing - make one!
		// $app->insertTaskWriteText();
	}


	// taskwritetextdone
	$action="";
	$action=$app->requestFromWeb("action","string.azAZ");
	if ($action=="reset") // reset 
	{
		// echo("<br>reset");
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "" );
	}
	// finished task?
	$strError="";
	if ($action=="taskdone")
	{
		$answersDone=true;
		// echo("******");
		// check here
		$arr=$app->getFrameworkDimsByFramework( $frameworkObj->frameworkId );
		for ($r=0;$r<count($arr);$r++)
		{
			$obj=$arr[$r];

				$arrSub=$app->getFrameworkDimsByFrameworkSub( $obj->frameworkdimId );
				for ($t=0;$t<count($arrSub);$t++)
				{
					$objSub=$arrSub[$t];
					$dimVal=$app->getFrameworkDimValValueByDim( $app->session->userObject->userId, $excercisetaskId, $objSub->frameworkdimId, "self" );
					if ($dimVal==-2001) $answersDone=false;
					// echo("   $dimVal");					
				}
		}
		//echo("---".$answersDone."--");
		if (!$answersDone)
		{
			$strError="Bitte f&uuml;llen Sie die Selbstbeurteilung vollst&auml;ndig aus. Wenn Sie keine Antwort geben k&ouml;nnen, verwenden Sie bitte die Option 'Ich weiss es nicht.'.";
		}
		
		if ($answersDone)
		{
			$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
			$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "taskwritetext", "done" );
		
			header("location: userexcercise.php");
		}

		
		// done? 
		// add ... 
		// show result here ... 
		// echo("done");
		// getExcerciseTaskAttributesByAttributeNameAndValue( $name, $val )


	}
	$ret=$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "nofound" );
	// echo("--***-".$ret);
	if ($ret=="done") { $taskDone=true;  } 

	

	// id?
/*	$excerciseId=-1;
    $excerciseId=2;	

	$excerciseObject=$app->getExcerciseById($excerciseId);

	$excersicetaskObject=null;


	// this excercise
	if (isset($_REQUEST["id"]))
	{
		$excercisetaskId=$app->requestFromWeb("id","integer");
	
	}	

	// excerciseObject
	$excercisetaskObject=$app->getExcerciseTaskById($excercisetaskId);


	$evaluationObj=$app->getTaskEvaluationByExcerciseTask( $excercisetaskObject );

//	echo(".....");
//	print_R($evaluationObj);

	$frameworkObj=$app->getFrameworkById( $evaluationObj->taskevaluationFrameworkRef );
//	print_r($frameworkObj);

*/

/*
print_r($excercisetaskObject);


	$excercisetaskObjId=-1;
	// print_r($excercisetaskObject);

	// is there a text for this 
	// get latest text and insert here ....
	// $app->getLatestText();
	$textInput="";
	$arr=$app->getTaskWriteTextsByExcerciseTaskAndUser($excercisetaskId,$app->session->userObject->userId);
	// print_r($arr);
	if (count($arr)>0)
	{
		//print_r($arr);

		// arr
		// take first one
		$taskWriteTextObj=$arr[0];
		$excercisetaskObjId=$taskWriteTextObj->taskwritetextId;

		// search for texts
		$arrDocument=$app->getTaskWriteTextDocumentsByTaskWriteText( $taskWriteTextObj->taskwritetextId );
		// print_r($arrDocument);
		if (count($arrDocument)>0) 
		{
			$objDocument=$arrDocument[0];
			$textInput="".$objDocument->taskwritetextdocumentText;
		}

	}
	else
	{
		// generate one ...		
		// not existing - make one!
		// $app->insertTaskWriteText();
	}
*/

/*
	// id?
	$excerciseId=-1;
	$excersiceObject=null;
	
	// this excercise
	if (isset($_REQUEST["id"]))
	{
		$excerciseId=$app->requestFromWeb("id","integer");
	
	}
*/
		// start
	include("./includes/header.inc.php");
	// admin?
	// todo
	
	
	// tod
	// id==-1 > admin site
	
	// excerciseObject
	// $excerciseObject=$app->getExcerciseById($excerciseId);

?>

<?=Display::displayUserSideMenu($app,"selfevaluation",$excerciseObject,$excercisetaskObject)?>

<h2><?=Display::displayUserTaskIcon("selfevaluation",true)?><?=$excerciseTaskObject->excercisetaskName?></h2>

<? 
   // show the whole task
   if (!$taskDone)
   { 

?>

<? echo(Display::displayRemarkTextToggle("Beurteilung",true)); ?>
<? echo("<div id='userRemarkText'>".Display::displayTaskRemarkText($app,$excerciseTaskObject->excercisetaskId))."</div>"; ?>

<!-- scripting -->
<script>
function storeDimensionVal( taskref, dimId, dimCatRef )
{
			var relationtype="other";

			var userId=<?=$app->session->userObject->userId?>;
			// takt the correct

			// alert("  storeDimensionVal("+taskref+", "+dimId+", "+dimCatRef+" )  ");

			// get value here ...

			 $.ajax(
  		    	    { 
  		    	    	url: 'userexcercisetaskevaluationself.service.php',  
						data: { 
									action: 'store',
									frameworkdimvalExcerciseTaskRef: taskref,
									frameworkdimvalDimRef: dimId,
									frameworkdimvalCatRef: dimCatRef,
									frameworkdimvalUserRef: userId, 
									frameworkdimvalType: relationtype // , 
								}
						//		,  
						// context: document 
				   }
				)
  			    .done(
  			    function( result )
  			    { 

  			    	  // test ok -> else not ok
					 // alert("abgespeichert:"+result);	
					 // $('#containerTextWriteAreaLastStore').html(result);

  			   	}
  			   ); 

}
</script>

<? 
	echo(Display::displayFramework($app,$excercisetaskId,"self",-1));

?>
<div>
	<a name='taskdone'>&nbsp;</a>
	<form action='userexcercisetaskevaluationself.php#taskdone'  method='post'><input type='hidden' name='action' value='taskdone'>
	<input name='rnd' type='hidden' name='rnd' value='<?=rand(0,1000)?>'>
	<?
		if ($strError!="")
		{
			echo("<div class='userLoginError'>".$strError."</div>");
		}
	?>
	<input type='submit' value='Selbstbeurteilung abschliessen'></form>
</div>

<!-- todo -->
<p><div style=' border-bottom: 1px solid black; padding-top: 50px;'>Der Text: </div></p>
<?
	// display original text here
		// get content from input
	echo("<div style='border: 1px dotted #999999; padding-left: 10px; padding-right: 10px; '>".$textInput."</div>");
?>	

<br><br>

<?	} // task

	// task done!
	if ($taskDone)
	{
		 echo(Display::displayTaskRemarkTextArea($app,$excerciseTaskObject->excercisetaskId,"done")); 

		 echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));
		 echo("<br><br>");

		 // show the text here
		 // self evaluation ...
		 echo(Display::displayFramework($app,$excercisetaskId,"selfresult",-1));

/*
		 echo("<div id='excercisetaskwritetextDone'>");
			 echo($textInput);
		 echo("</div>");
*/

	}
	// start
	include("./includes/footer.inc.php");
?>
