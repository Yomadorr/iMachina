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
		Excercise Task
	*/
	// create a new one?
	$excercisetaskObject=new ExcerciseTask();
 	$excercisetaskObject->updateToWebRequest($_REQUEST);
	// print_r($excercisetaskObject);	
	$excercisetaskObjectDatabase=$app->getExcerciseTaskById($excercisetaskObject->excercisetaskId); 	
	// print_r($excercisetaskObjectDatabase);
	//print_r($inputObjectDatabase);
 	// nothing found ... 
 	// back to overview?
 	if ($excercisetaskObjectDatabase==null) header("location: admin.php");
 	// look in database and get info, after this update it
	$excercisetaskObject=$excercisetaskObjectDatabase;
	$excercisetaskObject->updateToWebRequest($_REQUEST);
	$excerciseObject=$app->getExcerciseById($excercisetaskObject->excercisetaskExcerciseRef); 

		// update pretext		
		if ($action=="updatetaskpreremarktext")
		{

			$taskremarkTextObj=new TaskRemarkText();
			$taskremarkTextObj->updateToWebRequest($_REQUEST);
			$taskremarkTextObj=$app->getTaskRemarkTextById($taskremarkTextObj->taskremarktextId);
			// print_r($taskremarkTextObj);
			$taskremarkTextObj->updateToWebRequest($_REQUEST);
	 		$app->updateTaskRemarkText($taskremarkTextObj);

		}

	// update
	if ($action=="updatetaskremarktext")
	{

		$taskremarkTextObj=new TaskRemarkText();
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
		$taskremarkTextObj=$app->getTaskRemarkTextById($taskremarkTextObj->taskremarktextId);
		// print_r($taskremarkTextObj);
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
 		$app->updateTaskRemarkText($taskremarkTextObj);

	}

	// update result text
	if ($action=="updatetaskremarktextresult")
	{

		$taskremarkTextObj=new TaskRemarkText();
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
		$taskremarkTextObj=$app->getTaskRemarkTextById($taskremarkTextObj->taskremarktextId);
		// print_r($taskremarkTextObj);
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
 		$app->updateTaskRemarkText($taskremarkTextObj);

	}	



	/*
		remark text doc
	*/
	// documents
	$pathBase=dirname($_SERVER["SCRIPT_FILENAME"])."/documents/";
	

	// addtaskremarktextdoc
	if ($action=="addtaskremarktextdoc")
	{
		$taskremarktextdocObj=new TaskRemarkTextDoc();
		$taskremarktextdocObj->updateToWebRequest($_REQUEST);
		$filename=basename( $_FILES['uploadedfile']['name'] );
		$target_path = $pathBase . $filename; 
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
		{
		   	$taskremarktextdocObj->taskremarktextdocPath="documents/".$filename;
		} else {
			echo("problem with upload");
		}
 		$app->insertTaskRemarkTextDoc($taskremarktextdocObj);
	}

	// updatetaskremarktext
	if ($action=="updatetaskremarktextdoc")
	{

		$taskremarktextdocObj=new TaskRemarkTextDoc();
		$taskremarktextdocObj->updateToWebRequest($_REQUEST);
		$taskremarktextdocObj=$app->getTaskRemarkTextDocById($taskremarktextdocObj->taskremarktextdocId);
		$taskremarktextdocObj->updateToWebRequest($_REQUEST);
		$filename=basename( $_FILES['uploadedfile']['name'] );
		$target_path = $pathBase . $filename; 
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
		{
		   	$taskremarktextdocObj->taskremarktextdocPath="documents/".$filename;
		} else {
			echo("problem with upload");
		}
		// print_r($taskremarktextdocObj);
 		$app->updateTaskRemarkTextDoc($taskremarktextdocObj);
	}

	if ($action=="deletetaskremarktextdoc")
	{
		$taskremarktextdocObj=new TaskRemarkTextDoc();
		$taskremarktextdocObj->updateToWebRequest($_REQUEST);
		$taskremarktextdocObj=$app->getTaskRemarkTextDocById($taskremarktextdocObj->taskremarktextdocId);
		$app->deleteTaskRemarkTextDoc($taskremarktextdocObj);
	}

	// waiting
	if ($action=="updatewaitingpreferences")
	{
		$excercisetaskexcercisewaiting=$app->requestFromWeb("excercisetaskexcercisewaiting","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskexcercisewaiting", $excercisetaskexcercisewaiting );
		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");

		$excercisetaskexcercisewaitingerror=$app->requestFromWeb("excercisetaskexcercisewaitingerror","string.09");
		$app->setAdminExcerciseTaskAttributeString( $excercisetaskObject->excercisetaskId, "excercisetaskexcercisewaitingerror", $excercisetaskexcercisewaitingerror );
		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");
	}

	// pdf
	if ($action=="updatepdfpreferences")
	{
		$excercisetaskexcerciseinpdf=$app->requestFromWeb("excercisetaskexcerciseinpdf","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskexcerciseinpdf", $excercisetaskexcerciseinpdf );
		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");
	}

	// pdf
	if ($action=="updatepdfpreferences")
	{
		$excercisetaskexcerciseinpdf=$app->requestFromWeb("excercisetaskexcerciseinpdf","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskexcerciseinpdf", $excercisetaskexcerciseinpdf );
		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");
	}

	// specials
	if ($action=="updatewritetextpreferences")
	{
		$excercisetasktime=$app->requestFromWeb("excercisetasktime","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetasktime", $excercisetasktime );
		$excercisetaskchars=$app->requestFromWeb("excercisetaskchars","string.09");		
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskchars", $excercisetaskchars );
			$excercisetaskprocent=$app->requestFromWeb("excercisetaskprocent","string.09");		
			$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskprocent", $excercisetaskprocent );
		$excercisetaskautomaticstore=$app->requestFromWeb("excercisetaskautomaticstore","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskautomaticstore", $excercisetaskautomaticstore );

		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");
	}

	// updateotherevaluationpreferences
	if ($action=="updateotherevaluationpreferences")
	{
		$inputexcercisetaskId=$app->requestFromWeb("inputexcercisetaskId","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "inputexcercisetaskId", $inputexcercisetaskId );
		
		$frameworkId=$app->requestFromWeb("frameworkId","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "frameworkId", $frameworkId );
		
		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");
		// $nextactionId=$app->requestFromWeb("nextactionId","string.09");
		// $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", $nextactionId );		
		
		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");
	}

	// updateresultpreferences
	if ($action=="updateresultpreferences")
	{
		$selfexcercisetaskId=$app->requestFromWeb("selfexcercisetaskId","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "selfexcercisetaskId", $selfexcercisetaskId );
		$otherexcercisetaskId=$app->requestFromWeb("otherexcercisetaskId","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "otherexcercisetaskId", $otherexcercisetaskId );
		
		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");
		// $nextactionId=$app->requestFromWeb("nextactionId","string.09");
		// $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", $nextactionId );		
		
		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");
	}

	// updateresultresultexcercisetask
	if ($action=="updateresultresultexcercisetask")
	{
		$resultexcercisetask=$app->requestFromWeb("resultexcercisetask","string.09");
		// echo($resultexcercisetask);		
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "resultexcercisetask", $resultexcercisetask );
		$resultexcercisetask=$app->requestFromWeb("resultexcercisetask","string.09");
		$app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "resultexcercisetask", $resultexcercisetask );
		
		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");
		// $nextactionId=$app->requestFromWeb("nextactionId","string.09");
		// $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", $nextactionId );		
		
		// echo("action: updatewritetextpreferences ($excercisetasktime,$excercisetaskchars) ");
	}

	// email
	if ($action=="updatetaskremarktextemail")
	{

		$taskremarkTextObj=new TaskRemarkText();
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
		$taskremarkTextObj=$app->getTaskRemarkTextById($taskremarkTextObj->taskremarktextId);
		// print_r($taskremarkTextObj);
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
 		$app->updateTaskRemarkText($taskremarkTextObj);

		// $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "emailtitle", $resultexcercisetask );
		$emailTitle=$app->requestFromWeb("taskremarktextTitle","string.09");
// echo("emailTitle: $emailTitle");
		$app->setAdminExcerciseTaskAttributeString( $excercisetaskObject->excercisetaskId, "emailtitle", $emailTitle );
	}
     
	// start
	include("./includes/header.admin.inc.php");

	
	// sidemenu
	$sideMenuText="".Display::adminDisplayExcerciseTasksTaskPointTop( $app, $excerciseObject, $excercisetaskObject );
	include("./includes/header.adminsidemenu.inc.php");	

?>

<? echo("<h3>".$excercisetaskObject->excercisetaskName." (".$excercisetaskObject->excercisetaskType.")</h3>");?>

<?
		// pretext ...
		if ($excercisetaskObject->excercisetaskType=="writetext")
		{

				$writetextOb=$app->getTaskRemarkTextByTaskRefAndArea( $excercisetaskObject->excercisetaskId, "pretext" );
				// print_r($readtextObj);
				// is there a connected readtexttask document?
				if ($writetextOb==null) { echo("[NO READTASK FOUND>CREATE ONE!]"); $newReadTask=new TaskRemarkText(); $newReadTask->taskremarktextTaskRef=$excercisetaskObject->excercisetaskId; $newReadTask->taskremarktextArea="pretext"; $app->insertTaskRemarkText($newReadTask); }
				$writetextOb=$app->getTaskRemarkTextByTaskRefAndArea( $excercisetaskObject->excercisetaskId, "pretext" );

?>
		<? echo("<h4>Pretext</h4>");?>

		<form action="adminexcercisetask.php#preview">
				<input type=hidden name='action' value='updatetaskpreremarktext'>
				<input type=hidden name='excercisetaskId' value='<?=$excercisetaskObject->excercisetaskId?>' >
				<input type='hidden' name='taskremarktextId' value='<?=$writetextOb->taskremarktextId?>' >
				<textarea name="taskremarktextDescription" class="mceSimple" style="width:100%"><?=$writetextOb->taskremarktextDescription?></textarea>
				<br><input type=submit value='&Auml;ndern'> 
			</form>	
			<br><br>

<?
		}	


	// read textes
	//if ($excercisetaskObject->excercisetaskType=="readtext")
	//{
		// look for a task 
		// if there is no one create one!
		$readtextObj=$app->getTaskRemarkTextByTaskRef( $excercisetaskObject->excercisetaskId );
		// print_r($readtextObj);
		// is there a connected readtexttask document?
		if ($readtextObj==null) { echo("[NO READTASK FOUND>CREATE ONE!]"); $newReadTask=new TaskRemarkText(); $newReadTask->taskremarktextTaskRef=$excercisetaskObject->excercisetaskId; $app->insertTaskRemarkText($newReadTask); }
		$readtextObj=$app->getTaskRemarkTextByTaskRef( $excercisetaskObject->excercisetaskId );
		// print_r($readtextObj);
		?>
				<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
				<script type="text/javascript">
				tinyMCE.init({
				        // General options
				        mode : "textareas",
				        theme : "advanced",
				        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

				        // Theme options
				        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
				        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
				        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
				        theme_advanced_toolbar_location : "top",
				        theme_advanced_toolbar_align : "left",
				        theme_advanced_statusbar_location : "bottom",
				        theme_advanced_resizing : true,
				        height: 250,

				        // Skin options
				        skin : "o2k7",
				        skin_variant : "silver",

				        // Example content CSS (should be your site CSS)
				        content_css : "css/example.css",

				        // Drop lists for link/image/media/template dialogs
				        template_external_list_url : "js/template_list.js",
				        external_link_list_url : "js/link_list.js",
				        external_image_list_url : "js/image_list.js",
				        media_external_list_url : "js/media_list.js",

				        // Replace values for the template plugin
				        template_replace_values : {
				                username : "Some User",
				                staffid : "991234"
				        }
				});
				</script>

			<? echo("<h4>Haupttext</h4>");?>


			<form action="adminexcercisetask.php#preview">
				<input type=hidden name='action' value='updatetaskremarktext'>
				<input type=hidden name='excercisetaskId' value='<?=$excercisetaskObject->excercisetaskId?>' >
				<input type='hidden' name='taskremarktextId' value='<?=$readtextObj->taskremarktextId?>' >
				<textarea name="taskremarktextDescription" class="mceSimple" style="width:100%"><?=$readtextObj->taskremarktextDescription?></textarea>
				<br><input type=submit value='&Auml;ndern & Preview'> 
			</form>

			<div >
				<a name='documents'>&nbsp;</a>
				<h4>Dokumente zu diesem Text</h4>
				<?
					$arr=$app->getTaskRemarkTextDocsByRemarkTask( $readtextObj->taskremarktextId );
					for ($z=0;$z<count($arr);$z++)
					{
						$docObj=$arr[$z];
						// echo("<br><a href='".$docObj->taskremarktextdocPath."'>".$docObj->taskremarktextdocName." ></a>");
						echo(displayDocForm( $excercisetaskObject, $docObj, true ));
					}
				
				echo("<br>");
				$newDoc=new TaskRemarkTextDoc();
				$newDoc->taskremarktextdocRemarkTextRef=$readtextObj->taskremarktextId;

				echo("Neues PDF-Dokument anlegen: ".displayDocForm( $excercisetaskObject, $newDoc, false ));
			?>
			</div>

			<a name='preview'>&nbsp;</a>
			<br><a onClick="$('#adminReadTextPreviewId').toggle()">[Preview ein- und ausblenden ]</a>
			<div id='adminReadTextPreviewId' style='display:none' class='adminReadTextPreview'><h2>Preview: </h2><div id='adminReadTextPreviewContent'><?=Display::displayTaskRemarkText($app,$excercisetaskObject->excercisetaskId)?></div></div>

		<?
			// special things for every task

			// print_r($excercisetaskObject);
			// $app->setAdminExcerciseTaskAttributeString( $excercisetaskObject->excercisetaskId, "testx", "100" );
			// echo($app->getAdminExcerciseTaskAttributeString( $excercisetaskObject->excercisetaskId, "testx", "150" ));

			// echo("<br>debug: type: ".$excercisetaskObject->excercisetaskType."");

			echo("<a name='preferences'>&nbsp;</a>");

			// -----------------------
			// wait on this task ...
			// -----------------------
			// wait x minutes till you can get to the next task
			//
			if ($excercisetaskObject->excercisetaskType=="readtext")
			{

				echo("<br><h3>Waiting</h3>");

				echo("<form action='adminexcercisetask.php#preferences'");
				$excercisewaiting=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskexcercisewaiting", -1 );
				if ($excercisewaiting==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskexcercisewaiting", 0 ); }
				$excercisewaiting=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskexcercisewaiting", 0);

				$excercisewaitingerror=$app->getAdminExcerciseTaskAttributeString( $excercisetaskObject->excercisetaskId, "excercisetaskexcercisewaitingerror", "notfound" );
				if ($excercisewaitingerror=="notfound") {  $app->setAdminExcerciseTaskAttributeString( $excercisetaskObject->excercisetaskId, "excercisetaskexcercisewaitingerror", "" ); }
				$excercisewaitingerror=$app->getAdminExcerciseTaskAttributeString( $excercisetaskObject->excercisetaskId, "excercisetaskexcercisewaitingerror", 0);

				echo("\n<form action='adminexcercisetask.php#preferences' method='get'>");	
				echo("\n<input type='hidden' name='action' value='updatewaitingpreferences'>");
				echo("\n<input type='hidden' name='excercisetaskId' value='".$excercisetaskObject->excercisetaskId."'>");
				echo("\n<br>Minimum <input type='textfield' name='excercisetaskexcercisewaiting' value='".$excercisewaiting."' > Minuten warten (0: keine Wartezeit) ");
				echo("\n<br>&nbsp;&nbsp;> Fehlermessage: <input type='textfield' name='excercisetaskexcercisewaitingerror' size=90 value='".$excercisewaitingerror."' >");
				echo("\n<input type='submit'  value='&Auml;ndern'>");
				echo("\n</form>");
			}

			// /pdf
			// -----------------------
			// pdf
			// -----------------------
			echo("<br><h3>PDF-Settings</h3>");

				echo("<form action='adminexcercisetask.php#preferences'");
				$excerciseinpdf=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskexcerciseinpdf", -1 );
				if ($excerciseinpdf==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskexcerciseinpdf", 0 ); }
				$excerciseinpdf=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskexcerciseinpdf", 0);

				echo("\n<form action='adminexcercisetask.php#preferences' method='get'>");	
				echo("\n<input type='hidden' name='action' value='updatepdfpreferences'>");
				echo("\n<input type='hidden' name='excercisetaskId' value='".$excercisetaskObject->excercisetaskId."'>");
				echo("\n<br>In PDF: <input type='textfield' name='excercisetaskexcerciseinpdf' value='".$excerciseinpdf."' > (0: nein / 1: ja)");
				echo("\n<input type='submit'  value='&Auml;ndern'>");
				echo("\n</form>");
			// /pdf
			

			// questionnaire task 
			// echo($excercisetaskObject->excercisetaskType);
			if ($excercisetaskObject->excercisetaskType=="questionnaire")
			{
				echo("<div>");
				echo("<h1>Fragen</h1>");
				echo("</div>");

				include("./adminexcercisetaskquestionnaire.php");

			}

			// excercise task 
			if ($excercisetaskObject->excercisetaskType=="writetext")
			{
				echo("<br><h3>Settings</h3>");

				echo("<form action='adminexcercisetask.php#preferences'");

				$time=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetasktime", -1 );
				if ($time==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetasktime", 0 ); }
				$time=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetasktime", -1 );

				$chars=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskchars", -1 );
				if ($chars==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskchars", 0 ); }
				$chars=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskchars", -1 );

					$procent=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskprocent", -1 );
					if ($procent==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskprocent", 0 ); }
					$procent=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskprocent", 10);

				$automaticstore=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskautomaticstore", -1 );
				if ($automaticstore==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskautomaticstore", 30 ); }
				$automaticstore=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskautomaticstore", 30);

				echo("\n<form action='adminexcercisetask.php#preferences' method='get'>");	
				echo("\n<input type='hidden' name='action' value='updatewritetextpreferences'>");
				echo("\n<input type='hidden' name='excercisetaskId' value='".$excercisetaskObject->excercisetaskId."'>");
				echo("\n<br>Zeit (min): <input type='textfield' name='excercisetasktime' value='".$time."' > (0: endlos Zeit)");
				echo("\n<br>Zeichen: <input type='textfield' name='excercisetaskchars' value='".$chars."' > (0: keine Zeichenbegrenzung)");
					echo(" Buffer: 0-<input type='textfield' name='excercisetaskprocent' size=3 value='".$procent."' >%");
				echo("\n<br>Automatische Speicherung: <input type='textfield' name='excercisetaskautomaticstore' value='".$automaticstore."' > (sec)");
				echo("\n<br><input type='submit'  value='&Auml;ndern'>");
				echo("\n</form>");
			}


			/*
				connect otherevaluation with some input
				otherevaluation
			*/
			if (
				($excercisetaskObject->excercisetaskType=="otherevaluation")
				||
				($excercisetaskObject->excercisetaskType=="selfevaluation")
			  )
			{
					echo("<br><h3>Settings</h3>");

					// todo use task before as input for this!! on default !!
					$inputexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "inputexcercisetaskId", -1 );
					if ($inputexcercisetaskId==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "inputexcercisetaskId", -1 ); }
					$inputexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "inputexcercisetaskId", -1);


					$frameworkId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "frameworkId", -1 );
					if ($frameworkId==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "frameworkId", -1 ); }
					$frameworkId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "frameworkId", -1);

					
					echo("\n<form action='adminexcercisetask.php#preferences' method='get'>");	
					
					echo("\n<input type='hidden' name='action' value='updateotherevaluationpreferences'>");
					echo("\n<input type='hidden' name='excercisetaskId' value='".$excercisetaskObject->excercisetaskId."'>");

					echo("\n<br>Input (Text kommen von): ");
						
					$ival=$inputexcercisetaskId;
					// echo($ival);
					echo(displayTaskSelectFormByTaskType( $app, $excercisetaskObject->excercisetaskExcerciseRef ,  "inputexcercisetaskId", $ival, "writetext" )); // "*"
					echo("(Aufgabe)");

					echo("\n<br>Raster: ");
					$ival=$frameworkId;
					echo(displayFrameworkSelectForm( $app, "frameworkId", $ival ));

/*
					// nexttaskId
					$nextactionId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", -2001 );
					if ($nextactionId==-2001) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", -1 ); }
					$nextactionId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", -1);

					echo("\n<br>N&auml;chste Aufgabe: ");
					$ival=$nextactionId;
					// echo($ival);
					echo(displayTaskSelectFormByTaskType( $app, $excercisetaskObject->excercisetaskExcerciseRef ,  "nextactionId", $ival, "*", "Keine Aufgabe" )); // "*"
					echo("(nach Beendigung)");
*/

					echo("\n<br><input type='submit'  value='&Auml;ndern'>");
					echo("\n</form>");
			}

		/*
				connect result with self- und otherevaluation
			*/
			if ($excercisetaskObject->excercisetaskType=="result")
			{
					echo("<br><h3>Settings</h3>");

					// todo use task before as input for this!! on default !!
					$selfexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "selfexcercisetaskId", -1 );
					if ($selfexcercisetaskId==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "selfexcercisetaskId", -1 ); }
					$selfexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "selfexcercisetaskId", -1);


					$otherexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "otherexcercisetaskId", -1 );
					if ($otherexcercisetaskId==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "otherexcercisetaskId", -1 ); }
					$otherexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "otherexcercisetaskId", -1);

					
					echo("\n<form action='adminexcercisetask.php#preferences' method='get'>");	
					
					echo("\n<input type='hidden' name='action' value='updateresultpreferences'>");
					echo("\n<input type='hidden' name='excercisetaskId' value='".$excercisetaskObject->excercisetaskId."'>");


					echo("\n<br>Eigenbeurteilung: ");
					$ival=$selfexcercisetaskId;
					// echo($ival);
					echo(displayTaskSelectFormByTaskType( $app, $excercisetaskObject->excercisetaskExcerciseRef ,  "selfexcercisetaskId", $ival, "selfevaluation" )); // "*"

					echo("\n<br>Fremdbeurteilung: ");
					$ival=$otherexcercisetaskId;
					// echo($ival);
					echo(displayTaskSelectFormByTaskType( $app, $excercisetaskObject->excercisetaskExcerciseRef ,  "otherexcercisetaskId", $ival, "otherevaluation" )); // "*"

/*					// nexttaskId
					$nextactionId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", -2001 );
					if ($nextactionId==-2001) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", -1 ); }
					$nextactionId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", -1);

					echo("\n<br>N&auml;chste Aufgabe: ");
					$ival=$nextactionId;
					// echo($ival);
					echo(displayTaskSelectFormByTaskType( $app, $excercisetaskObject->excercisetaskExcerciseRef ,  "nextactionId", $ival, "*", "Keine Aufgabe" )); // "*"
					echo("(nach Beendigung)");
*/

					echo("\n<br><input type='submit'  value='&Auml;ndern'>");
					echo("\n</form>");
			}		

		/*
				connect result with self- und otherevaluation
			*/
			if ($excercisetaskObject->excercisetaskType=="close")
			{
					echo("<br><h3>Settings</h3>");

					// todo use task before as input for this!! on default !!
					$resultexcercisetask=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "resultexcercisetask", -1 );
					if ($resultexcercisetask==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "resultexcercisetask", -1 ); }
					$resultexcercisetask=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "resultexcercisetask", -1);

					/*
					$otherexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "otherexcercisetaskId", -1 );
					if ($otherexcercisetaskId==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "otherexcercisetaskId", -1 ); }
					$otherexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "otherexcercisetaskId", -1);
					*/
					
					echo("\n<form action='adminexcercisetask.php#preferences' method='get'>");	
					
					echo("\n<input type='hidden' name='action' value='updateresultresultexcercisetask'>");
					echo("\n<input type='hidden' name='excercisetaskId' value='".$excercisetaskObject->excercisetaskId."'>");


					echo("\n<br>EvaluationSelfOtherAndText: ");
					$ival=$resultexcercisetask;
					// echo($ival);
					echo(displayTaskSelectFormByTaskType( $app, $excercisetaskObject->excercisetaskExcerciseRef ,  "resultexcercisetask", $ival, "result" )); // "*"

					/*
					echo("\n<br>Fremdbeurteilung: ");
					$ival=$otherexcercisetaskId;
					// echo($ival);
					echo(displayTaskSelectFormByTaskType( $app, $excercisetaskObject->excercisetaskExcerciseRef ,  "otherexcercisetaskId", $ival, "otherevaluation" )); // "*"

					// nexttaskId

					$nextactionId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", -2001 );
					if ($nextactionId==-2001) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", -1 ); }
					$nextactionId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nextactionId", -1);

					echo("\n<br>N&auml;chste Aufgabe: ");
					$ival=$nextactionId;
					// echo($ival);
					echo(displayTaskSelectFormByTaskType( $app, $excercisetaskObject->excercisetaskExcerciseRef ,  "nextactionId", $ival, "*", "Keine Aufgabe" )); // "*"
					echo("(nach Beendigung)");
					*/

					echo("\n<br><input type='submit'  value='&Auml;ndern'>");
					echo("\n</form>");
			}	

			/*
				connect otherevaluation with some input
				otherevaluation
			*/
			/*
			if ($excercisetaskObject->excercisetaskType=="selfevaluation")
			{
					echo("<br><h3>Settings</h3>");

					// todo use task before as input for this!! on default !!
					$inputexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "inputexcercisetaskId", -1 );
					if ($inputexcercisetaskId==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "inputexcercisetaskId", -1 ); }
					$inputexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "inputexcercisetaskId", -1);


					$frameworkId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "frameworkId", -1 );
					if ($frameworkId==-1) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "frameworkId", -1 ); }
					$frameworkId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "frameworkId", -1);

					
					echo("\n<form action='adminexcercisetask.php#preferences' method='get'>");	
					
					echo("\n<input type='hidden' name='action' value='updateotherevaluationpreferences'>");
					echo("\n<input type='hidden' name='excercisetaskId' value='".$excercisetaskObject->excercisetaskId."'>");

					echo("\n<br># Input Selbstbeurteilung: ");
						
					$ival=$inputexcercisetaskId;
					// echo($ival);
					echo(displayTaskSelectFormByTaskType( $app, $excercisetaskObject->excercisetaskExcerciseRef ,  "inputexcercisetaskId", $ival, "writetext" )); // "*"

					echo("\n<br>Raster: ");
					$ival=$frameworkId;
					echo(displayFrameworkSelectForm( $app, "frameworkId", $ival ));


					// nexttaskId
					$nexttaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nexttaskId", -2001 );
					if ($nexttaskId==-2001) {  $app->setAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nexttaskId", -1 ); }
					$nexttaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "nexttaskId", -1);

					echo("\n<br>N&auml;chste Aufgabe: ");
					$ival=$nexttaskId;
					echo($ival);
					echo(displayTaskSelectFormByTaskType( $app, $excercisetaskObject->excercisetaskExcerciseRef ,  "nexttaskId", $ival, "*", "Keine Aufgabe" )); // "*"
					echo("(nach Beendigung)");


					echo("\n<br><input type='submit'  value='&Auml;ndern'>");
					echo("\n</form>");
			}
			*/

					// display 
					function displayTaskSelectFormByTaskType( $app, $excerciseId, $inputform, $ival, $filtertasktype, $jobdesc="Kein Textinput" )
					{
						$str="";
						$str=$str."\n<select name='$inputform'>";
						// get them from classes
						$str=$str."\n   <option value='-1' >".$jobdesc."</option>";
						$arrTasks=$app->getAllActiveExcerciseTasksFromExcercise( $excerciseId );
						for ($t=0;$t<count($arrTasks);$t++)
						{
							$taskObj=$arrTasks[$t];
							$selected="";
							$ttype=$taskObj->excercisetaskType;
							$name=$taskObj->excercisetaskName;
							$code=$taskObj->excercisetaskId;
							if ($code==$ival) $selected=" selected ";

							$displayThis=false;
							if ($filtertasktype=="*") $displayThis=true;
							if ($filtertasktype==$ttype) $displayThis=true;
							if ($displayThis)
							$str=$str."\n   <option value='$code' $selected>$name </option>";
						}
						$str=$str."\n</select>";

						return $str;
					}

					// display Rasters
					function displayFrameworkSelectForm( $app, $inputform, $ival )
					{
						$str="";
						$str=$str."\n<select name='$inputform'>";
						// get them from classes
						$str=$str."\n   <option value='-1' >Kein Raster</option>";
						$arrFramework=$app->getAllActiveFrameworks( );
						for ($t=0;$t<count($arrFramework);$t++)
						{
							$taskFramework=$arrFramework[$t];
							$selected="";
							$name=$taskFramework->frameworkName;
							$code=$taskFramework->frameworkId;
							if ($code==$ival) $selected=" selected ";

							$str=$str."\n   <option value='$code' $selected>$name </option>";
						}
						$str=$str."\n</select>";

						return $str;
					}

		/*
			result only in some cases
		
		*/
		if (
			($excercisetaskObject->excercisetaskType=="questionnaire")
			||
			($excercisetaskObject->excercisetaskType=="readtext")
			||
			($excercisetaskObject->excercisetaskType=="writetext")
			||
			($excercisetaskObject->excercisetaskType=="otherevaluation")
			||
			($excercisetaskObject->excercisetaskType=="selfevaluation")
			)
		{

				// look for a task 
				// if there is no one create one!
				$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( $excercisetaskObject->excercisetaskId, "done" );
				// print_r($readtextObj);
				// is there a connected readtexttask document?
				if ($readtextObj==null) { echo("[NO READTASK FOUND>CREATE ONE!]"); $newReadTask=new TaskRemarkText(); $newReadTask->taskremarktextTaskRef=$excercisetaskObject->excercisetaskId; $newReadTask->taskremarktextArea="done"; $app->insertTaskRemarkText($newReadTask); }
				$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( $excercisetaskObject->excercisetaskId, "done" );
				// print_r($readtextObj);
				?>
						<h3>Result/Done</h3>
						<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
						<script type="text/javascript">
						tinyMCE.init({
						        // General options
						        mode : "textareas",
						        theme : "advanced",
						        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

						        // Theme options
						        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
						        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
						        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
						        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
						        theme_advanced_toolbar_location : "top",
						        theme_advanced_toolbar_align : "left",
						        theme_advanced_statusbar_location : "bottom",
						        theme_advanced_resizing : true,
						        height: 250,

						        // Skin options
						        skin : "o2k7",
						        skin_variant : "silver",

						        // Example content CSS (should be your site CSS)
						        content_css : "css/example.css",

						        // Drop lists for link/image/media/template dialogs
						        template_external_list_url : "js/template_list.js",
						        external_link_list_url : "js/link_list.js",
						        external_image_list_url : "js/image_list.js",
						        media_external_list_url : "js/media_list.js",

						        // Replace values for the template plugin
						        template_replace_values : {
						                username : "Some User",
						                staffid : "991234"
						        }
						});
						</script>

					<form action="adminexcercisetask.php#preview">
						<input type=hidden name='action' value='updatetaskremarktextresult'>
						<input type=hidden name='excercisetaskId' value='<?=$excercisetaskObject->excercisetaskId?>' >
						<input type='hidden' name='taskremarktextId' value='<?=$readtextObj->taskremarktextId?>' >
						<textarea name="taskremarktextDescription" class="mceSimple" style="width:100%"><?=$readtextObj->taskremarktextDescription?></textarea>
						<br><input type=submit value='&Auml;ndern'> 
					</form>
					<?
			}


		/*
		
			sending an email
			automatic email

		*/
		/*if (
			($excercisetaskObject->excercisetaskType=="questionnaire")
			||
			($excercisetaskObject->excercisetaskType=="readtext")
			||
			($excercisetaskObject->excercisetaskType=="writetext")
			||
			($excercisetaskObject->excercisetaskType=="selfevaluation")
			)*/
		if (
			($excercisetaskObject->excercisetaskType=="start")
			||
			($excercisetaskObject->excercisetaskType=="readtext")
			||
			($excercisetaskObject->excercisetaskType=="writetext")
			||
			($excercisetaskObject->excercisetaskType=="otherevaluation")
		   )
		{
				// title
				$emailTitle=$app->getAdminExcerciseTaskAttributeString( $excercisetaskObject->excercisetaskId, "emailtitle", "" );

				// look for a task 
				// if there is no one create one!
				$emailText=$app->getTaskRemarkTextByTaskRefAndArea( $excercisetaskObject->excercisetaskId, "email" );
				// print_r($readtextObj);
				// is there a connected readtexttask document?
				if ($emailText==null) 
				{ 
						echo("[NO READTASK FOUND>CREATE ONE!]"); 
						$newReadTask=new TaskRemarkText();  
						$newReadTask->taskremarktextDescription="Ihre Fremdbeurteilung ist nun gemacht. Loggen Sie sich ein für das weitere Vorgehen. http://toss.update.ch/  "; 
						if ($excercisetaskObject->excercisetaskType=="writetext")  $newReadTask->taskremarktextDescription="Sie haben die Uebung versauemt."; 
						$newReadTask->taskremarktextTaskRef=$excercisetaskObject->excercisetaskId; 
						$newReadTask->taskremarktextArea="email"; 
						$app->insertTaskRemarkText($newReadTask); 
				}
				$emailText=$app->getTaskRemarkTextByTaskRefAndArea( $excercisetaskObject->excercisetaskId, "email" );
				// print_r($readtextObj);

				if ($excercisetaskObject->excercisetaskType=="start") { echo("<h3>Start Email</h3>"); }
				if ($excercisetaskObject->excercisetaskType=="readtext") { echo("<h3>Reminder Email</h3>"); }
				if ($excercisetaskObject->excercisetaskType=="writetext") { echo("<h3>Failed Email</h3>"); }
				if ($excercisetaskObject->excercisetaskType=="otherevaluation") { echo("<h3>Automatic Email</h3>"); }

				?>

						<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
						<script type="text/javascript">
						tinyMCE.init({
						        // General options
						        mode : "textareas",
						        theme : "advanced",
						        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

						        // Theme options
						        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
						        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
						        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
						        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
						        theme_advanced_toolbar_location : "top",
						        theme_advanced_toolbar_align : "left",
						        theme_advanced_statusbar_location : "bottom",
						        theme_advanced_resizing : true,
						        height: 250,

						        // Skin options
						        skin : "o2k7",
						        skin_variant : "silver",

						        // Example content CSS (should be your site CSS)
						        content_css : "css/example.css",

						        // Drop lists for link/image/media/template dialogs
						        template_external_list_url : "js/template_list.js",
						        external_link_list_url : "js/link_list.js",
						        external_image_list_url : "js/image_list.js",
						        media_external_list_url : "js/media_list.js",

						        // Replace values for the template plugin
						        template_replace_values : {
						                username : "Some User",
						                staffid : "991234"
						        }
						});
						</script>

					<form action="adminexcercisetask.php#preview">
						<input type=hidden name='action' value='updatetaskremarktextemail'>
						<input type=hidden name='excercisetaskId' value='<?=$excercisetaskObject->excercisetaskId?>' >
						<input type='hidden' name='taskremarktextId' value='<?=$emailText->taskremarktextId?>' >
						Titel: <input type='textfield' name='taskremarktextTitle' value='<?=$emailTitle?>'  size=60>
						<textarea name="taskremarktextDescription" class="mceSimple" style="width:100%"><?=$emailText->taskremarktextDescription?></textarea>
						<? if ($excercisetaskObject->excercisetaskType=="start") { echo("<i>Angeh&auml;ngt werden die URL, die Login- und Passwort-Daten.</i><br>"); } ?>
						<br><input type=submit value='&Auml;ndern'> 
					</form>
					<?


			}

			echo("<div style='height: 200px;'></div>");

	//}


	function displayDocForm( $excercisetaskObj, $taskremarktextdocObj, $flagUpdate )
	{
		global $frameworkObject;


		$str="";
			$enctype=" enctype=\"multipart/form-data\"  ";
			$str=$str."\n<form action='adminexcercisetask.php#documents' $enctype method='post'>";

				if (!$flagUpdate) $str=$str."\n<input type='hidden' name='action' value='addtaskremarktextdoc'>";
				if ($flagUpdate) { $str=$str."\n<input type='hidden' name='action' value='updatetaskremarktextdoc'>";}
				if ($flagUpdate) { $str=$str."\n<input type=button value='x' onClick=\"document.location.href='adminexcercisetask.php?action=deletetaskremarktextdoc&excercisetaskId=".$excercisetaskObj->excercisetaskId."&taskremarktextdocId=".$taskremarktextdocObj->taskremarktextdocId."#documents';\">"; }

				$str=$str."<input type='hidden' name='excercisetaskId' value='".$excercisetaskObj->excercisetaskId."' >";
				$str=$str."<input type='hidden' name='taskremarktextdocId' value='".$taskremarktextdocObj->taskremarktextdocId."' >";
				$str=$str."<input type='hidden' name='taskremarktextdocRemarkTextRef' value='".$taskremarktextdocObj->taskremarktextdocRemarkTextRef."' >";


				$str=$str."Pos: <input type='textfield' name='taskremarktextdocOrder' value='".$taskremarktextdocObj->taskremarktextdocOrder."' size=2>";				
				$str=$str."Name: <input type='textfield' name='taskremarktextdocName' value='".$taskremarktextdocObj->taskremarktextdocName."' >";				
				// $str=$str."Path: <input type='textfield' name='taskremarktextdocPath' value='".$taskremarktextdocObj->taskremarktextdocPath."' >";				
				$path=$taskremarktextdocObj->taskremarktextdocPath;
				if ($path!="") $str=$str."<span style='font-size:9'><i><a href='$path' target='_blank'>".$taskremarktextdocObj->taskremarktextdocPath."</a></i></span> ";				
				$str=$str."<input name=\"uploadedfile\" type=\"file\" /> ";
				if (!$flagUpdate) $str=$str."\n<input type='submit'  value='neu'>";
				if ($flagUpdate) $str=$str."\n<input type='submit'  value='&auml;ndern'>";
			$str=$str."\n</form>";


		return $str;
	}	

	// stop
	// include("./includes/footer.inc.php");
?>