<?

	// SystemTest 

    // 0. includes classes
	// 1. app instance
    // 2. check login ..
	include("./appinstance.php");

	echo("\n<html>");
	echo("\n  <body>");

	// config
	echo("config");
	
	echo("<br>email-from-system:".$app->emailSystem);
	

	// email test
	echo("\n  <br>email-test ");
	$arr=Array($app->emailSystem,"rene.bauer@zhdk.ch");
	print_r($arr);
	$done=$app->sendEmailWithTitleText($arr,"imachina.test","testing");
	echo($done);

	/*
		other test
	*/
			/*
	// test .. 
	$textobj=new TextObjectPlatformPlain();
	echo("<pre>");
	print_r($textobj);
	echo("</pre>");
	*/
	
	// create a textobject	
	// $textObj=new TextObject();
	// print_r($textObj);

	// TextObject() > Ableiten ....
	// DisplayTextObject()

	// insert one
	//$textObj=new TextObject();
	//$textObj->textobjectArgumentText="Der erste Text ... wow".time();
	// $app->insertTextObject($textObj);

	/*
	$textObj=$app->getTextObjectById(14);
	print_r($textObj);
	*/

	// print_r($app->getUserAnonymous());


	// $userObject=new User();
	/*
	$userId=-1;
	
	$id=-1;  
	if (isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
	}
	
	// display this here and now ...
	if ($id!=-1)
	{
		$threadObj=$app->getTextObjectById( $id, $userId );
		if ($threadObj!=null)
		{
			// print_r($threadObj);
			$textobjectViewTmp=$app->getTextObjectViewFor($threadObj, $userId );
			if ($textobjectViewTmp!=null)
			{
				// print_r($textobjectViewTmp);
				echo($textobjectViewTmp->viewDetail($app,$userId));
			}
		}
	}
	*/

	// get textobjects
	/*
	echo("<hr>");
	$refId=$id;
	$arrTextObjects=$app->getAllTextObjectsByRef( $refId, $userObject->userId );
	// print_r($arrTextObjects);
	for ($i=0;$i<count($arrTextObjects);$i++)
	{
		$textobjectTmp=$arrTextObjects[$i];
		// echo("<br>".$i." ".$textobjectTmp->textobjectId." (".$textobjectTmp->textobjectType.")  ".$textobjectTmp->textobjectArgumentText);
		// echo($textobjectTmp->display());
		
		$textobjectViewTmp=$app->getTextObjectViewFor($textobjectTmp);
		if ($textobjectViewTmp!=null)
		{
			// $textobjectViewTmp->viewEchoDebug();
//			echo($textobjectViewTmp->viewDetail());
			echo($textobjectViewTmp->viewList());

			// viewList

			// print_r($textobjectViewTmp);
		}
		
	}
	*/
	
	
	// ...
	// don't use this!
	/*
	echo("<pre>");
	$newObj=new TextObjectComplexBlog();
	print_r($newObj);
	echo("</pre>");
	*/

	/*
	$newObj=$app->getTextObjectCastForMime("complex","blog");
	echo("<pre>");
	print_r($newObj);
	echo("</pre>");
	*/

	/*
		$arr=Array("1","2","3","4","5");
		echo("<pre>");
			$arrRet=$app->getArrayPart($arr, -2,17 );
			print_r($arrRet);
		echo("</pre>");
	*/
?>
		<script>

    //
    // test this timeline class
    //
    /*
    document.writeln("<div id='aplayer'></div>");
    document.writeln("<div id='timeId1'>TIME1</div>");
    document.writeln("<div id='timeId2'>TIME2</div>");

    var timelineObj=new iMachinaTimeLine();
        timelineObj.setId("1");
        timelineObj.setMaxTime(20.0);
        timelineObj.setWidth(800.0);
        timelineObj.addTextObject(10,150,101,"timeId1","");
        timelineObj.addTextObject(90,120,102,"timeId2","");
        timelineObj.playerDiv="aplayer";
        timelineObj.display();
    // play ..
    // timelineObj.play();

    var timelineObjTmp=new iMachinaTimeLine();
        timelineObjTmp.setId("2");
        timelineObjTmp.setMaxTime(20.0);
        timelineObjTmp.setWidth(400.0);
        timelineObjTmp.addTextObject(10,15,101,"timeId1","stop");
        timelineObjTmp.addTextObject(5,7,102,"timeId2","");
        timelineObjTmp.playerDiv="aplayer";
        timelineObjTmp.display();
    */
</script>
<?
	echo("\n  </body>");
	echo("\n</html>");
?>