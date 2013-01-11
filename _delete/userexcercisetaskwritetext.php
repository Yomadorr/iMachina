<?

	// include instance
	include("./appinstance.php");

	// excercise task handling
	include("./includes/excercisetaskhandling.user.php");

	// check logged in!
	include("./includes/checkaccess.user.php");

	// start
	include("./includes/header.inc.php");


/*	// id?
	$excerciseId=-1;
	$excersicetaskObject=null;

	// excercise
	$excerciseId=1;
$excerciseId=2;	
	$excerciseObject=$app->getExcerciseById($excerciseId);	

	// this excercise
	if (isset($_REQUEST["id"]))
	{
		$excercisetaskId=$app->requestFromWeb("id","integer");
	}	
	
	// excerciseObject
	$excercisetaskObject=$app->getExcerciseTaskById($excercisetaskId);
	$excercisetaskObjId=-1;
*/	
	$excerciseId=$excerciseObject->excerciseId;
	$excercisetaskObject=$excerciseObject;

	//  =
	$excercisetaskObjId=$excerciseTaskObject->excercisetaskId;
	$excercisetaskObject=$excerciseTaskObject;
	$excercisetaskId=$excerciseTaskObject->excercisetaskId;

	$frameworkObj=$app->getFrameworkById( $excercisetaskId );


	// task
	$taskDone=false; 

	// ...
	// task: "" / "processing" / "done"
	// taskstart
	$taskstartDate=0; // date();

	// taskwritetextdone
	$action="";
	$action=$app->requestFromWeb("action","string.azAZ");
	// echo("action: $action");
	if ($action=="reset") // reset 
	{
// echo("<br>-1 reset");
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "" );
		// $app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "taskwritetext", "open" );
// echo("<br>-2 /".$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "nofound" )."/");
	}

	if ($action=="failed") // reset 
	{
// echo("<br>-1 reset");
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "failed" );
		// $app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "taskwritetext", "open" );
// echo("<br>-2 /".$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "nofound" )."/");
	}

	// start action here ...
	if ($action=="taskwritetextstart")
	{

		   	// $valTask==""
		   	
		    // task processing
		   	$userId=$app->session->userObject->userId;
			$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "processing" );

		   	// start action
		   	$userId=$app->session->userObject->userId;
		   	$app->setUserExcerciseTaskAttributeDateTimeNow( $userId, $excerciseTaskObject->excercisetaskId, "taskstart" );
	}

	if ($action=="taskwritetextdone")
	{
// echo("taskwritetextdone");
		// done? 
		// add ... 
		// show result here ... 
		// echo("done");
		$app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
		// $app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "taskwritetext", "done" );
		// getExcerciseTaskAttributesByAttributeNameAndValue( $name, $val )
	}

	// $app->setActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "done" );
	$ret=$app->getActualUserExcerciseTaskAttributeString(  $excercisetaskId, "task", "" );
	$valTask=$ret;
// echo("--***-".$ret);
	if ($ret=="done") { $taskDone=true;  } 

	// print_r($excerciseTaskObject);
	// print($excercisetaskId);

	// print_r($excercisetaskObject);

	// is there a text for this 
	// get latest text and insert here ....
	// $app->getLatestText();

	$textInput="";

	// noch keine!
	// version 1
	/*
	$arr=$app->getTaskWriteTextsByExcerciseTask($excercisetaskId,$app->session->userObject->userId);
	// print_r($arr);
	if (count($arr)>0)
	{
		// take first one
		$taskWriteTextObj=$arr[0];
		$excercisetaskObjId=$taskWriteTextObj->taskwritetextId;
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
	$arr=$app->getTaskWriteTextDocumentsByTaskAndUser($excercisetaskId,$app->session->userObject->userId);
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

		// time and
		$time=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetasktime", -1 );
		if ($time==-1) $time=0;
		$chars=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskchars", -1 );
		if ($chars==-1) $chars=0;
		$excercisetaskprocent=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskprocent", -1 );
		if ($excercisetaskprocent==-1) $excercisetaskprocent=0;

?>

<?=Display::displayUserSideMenu($app,"excercise",$excerciseObject,$excercisetaskObject)?>

<h2><?=Display::displayUserTaskIcon("writetext",true)?><?=$excerciseTaskObject->excercisetaskName?></h2>

<? 
   // show the whole task
   if (!$taskDone)
   { 

	// start task
	if ($valTask=="")
   	{
   		?>
   			<? echo(Display::displayRemarkTextTitle("Schreibauftrag",true)); ?>

   			<? 
   				$pretext="";
	   			echo(Display::displayTaskRemarkTextArea($app,$excerciseTaskObject->excercisetaskId,"pretext")); 

			?>

			<div class='containerTextWriteArea'>
				<form method="post" name='textWriteForm' action="userexcercisetaskwritetext.php" method='post'>
						<input type='hidden' name='action' value='taskwritetextstart'>
						<input type='submit' value=' Schreib&uuml;bung starten '>						
				</form>

			</div>
   		<?
   	}

	// writing
	if ($valTask=="processing")
   	{

 ?>
 	<? echo(Display::displayRemarkTextToggle("Schreibaufgabe",true)); ?>

<? echo("<div id='userRemarkText'>".Display::displayTaskRemarkText($app,$excerciseTaskObject->excercisetaskId))."</div>"; ?>


<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        theme_advanced_disable : "image,anchor,link,unlink,bullist,tablet,separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor,bullist,separator,outdent,indent,separator,separator,hr,removeformat,visualaid,separator,sub,sup,separator,charmap",
        plugins : "paste",
		valid_elements : "p[br|strong|b],strong/b,br[strong|b]",
		theme_advanced_buttons1 : "bold,redo,undo",
		theme_advanced_buttons2 : "",
	    theme_advanced_buttons3 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_resizing : true,

        paste_auto_cleanup_on_paste : true,

        width : "730",
		height: "400",

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",
      
		content_css : "stylestinymce.css",
		// convert_fonts_to_spans : false,
        //	theme_advanced_font_sizes: "x-large",
		//  font_size_classes : "16px,16px,16px,16px,16px,16px,16px",
	    // Example content CSS (should be your site CSS)
        // content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // on init
       oninit : tinymceInitDone,

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
        

});

// start up init done
// case: on time
function tinymceInitDone() {
	// alert
	// alert("abc");
	<? if ($time>0) echo("StartTaskWrite();"); ?>
	<? if ($chars>0) echo("tinymceCharCounter();serviceStoreTimerStart()"); ?>
}

// ....
// case: on change 
var actualamountcontent=0;
function tinymceCharCounter()
{
	var amount=<?=$chars?>;
		var percent=<?=$excercisetaskprocent?>;

	var amountcontent=getStats('content').chars;

	if (actualamountcontent!=amountcontent)
	{
		var diffAmount=amount-amountcontent;
			var diffAmountPercent=(amount*percent)/100;

		/*
			if (amount>10) alert("contents "+amount);
		*/
		$('#taskWriteTextObTimelimitChars').html(diffAmount);
		if (diffAmount < -diffAmountPercent ) 
		{
			$('#taskWriteTextObTimelimitChars').css("color","red");
			$('#containerTextWriteSubmit').hide();
		}
		else
		if (diffAmount < 0)
		{
			$('#taskWriteTextObTimelimitChars').css("color","orange");
			$('#containerTextWriteSubmit').show();	
		}
		else
		{
			$('#taskWriteTextObTimelimitChars').css("color","black");
			$('#containerTextWriteSubmit').show();	
		}

	}

	actualamountcontent=amountcontent;

	setTimeout("tinymceCharCounter()",1000);
}
	function getStats(id) {
    
    	var body = tinymce.get(id).getBody(), text = tinymce.trim(body.innerText || body.textContent);
	    return {
	        chars: text.length,
	        words: text.split(/[\w\u2019\'-]+/).length
    	};
	}


$(document).ready(function() {

	// validate form on keyup and submit
	/*
	$("#content").validate({
		rules: {
			deslen: {
			min: 2,
			max: 2000
			}
		},
		messages: {
				deslen: {
				min: " Please enter a description",
				max: " Description must not be longer than 2000 characters"
				},
			}
		});
	*/
	
	// start timer
	// serviceStoreTimerStart();
	
});

// startExcerciseTask
// webserviceSaveText
function startExcerciseStartDatabase()
{
	    $.ajax(
	    	    { 
	    	    	url: 'userexcercisetaskwritetext.service.php',  
				data: { 
							action: 'startexcercise',
							excercisetaskId: <?=$excercisetaskId?>
						},  
				context: document.body 
		   }
		)
		    .done(
		    function( result )
		    	{ 
			    	// alert("startExcerciseStartDatabase().ajax.done: "+result);
		   	}
		   ); 
}

// storing 
<? $storeTimerInSecs=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "excercisetaskautomaticstore", 30 ); ?>
var storeNextTimeInSeconds=<?=$storeTimerInSecs?>;
function serviceStoreTimerStart()
{
	// alert("serviceTimerStart()");	
	serviceStoreTimer();
}

	function serviceStoreTimer()
	{
		webserviceSaveText();
		setTimeout("serviceStoreTimer()",storeNextTimeInSeconds*1000);
	}

// convert
// problem with word to chrome 
/*
function convertWordInputToHtml( str )
{
	str=str.replace(/&sbquo;/g,"&quot;");
	str=str.replace(/&sbquo;/g,"&rsquo;");

	return str;
}
*/

// webserviceSaveText
function webserviceSaveText()
{

	  		// alert(""+ getFormParam('textWriteForm', 'content') );
	  		// var text = $('#textWriteFormTextarea').val();
	  		// alert(''+text);
	  		var textareatext =  tinyMCE.get('content').getContent();
	  		// textareatext=convertWordInputToHtml(textareatext);
	  		// alert("DEBUGHERE: "+textareatext);

  		    $.ajax(
  		    	    { 
  		    	    	url: 'userexcercisetaskwritetext.service.php',  
						data: { 
									action: 'store',
									taskwritetextdocumentTaskRef: '<?=$excercisetaskObjId?>',
									taskwritetextdocumentText: textareatext
								},  
						context: document.body 
				   }
				)
  			    .done(
  			    	function( result )
  			    	{ 
  			    	//alert("done: "+result); 		 
  					/*
  					if (action=='delete') { $('#tr'+id+'list').toggle('fast'); $('#tr'+id+'listdetail').toggle('fast');  } 
  					if (action=='update') { $('#tr'+id+'listdetail').toggle('fast'); $('#tr'+id+'list').html(result);  } 
  					if (action=='insert') { alert('insert'); document.location.reload(); } 
  					*/
					 // alert("abgespeichert:"+result);	
						 $('#containerTextWriteAreaLastStore').html(result);
  			   		})
  			   	.fail(
  			   		function() { alert("Leider konnte der Text nicht erneut gespeichert werden. Markieren Sie den Text (PC: Crtl+a; Mac: cmd+a) und kopieren Sie ihn zur Sicherheit (PC: Crtl+c; Mac: cmd+c). Stellen Sie sicher, dass Sie mit dem Internet verbunden sind (Ethernet-Kabel korrekt eingestoepselt oder WLAN aktiv). Sie können die Seite danach neu laden (PC: F5; Mac: cmd+r). Der zuletzt gespeicherte Text erscheint wieder."); 
  			   		})
  			   	;
}

function webserviceSaveTextAndSubmit()
{


	  		// alert(""+ getFormParam('textWriteForm', 'content') );
	  		// var text = $('#textWriteFormTextarea').val();
	  		// alert(''+text);

	  		var textareatext =  tinyMCE.get('content').getContent();

  		    $.ajax(
  		    	    { 
  		    	    	url: 'userexcercisetaskwritetext.service.php',  
						data: { 
									action: 'store',
									taskwritetextdocumentTaskRef: '<?=$excercisetaskObjId?>',
									taskwritetextdocumentText: textareatext
								},  
						context: document.body 
				   }
				)
  			    .done(
  			    function( result )
  			    	{ 
  			    	// alert(\"done: \"+result); 		 
  					/*
  					if (action=='delete') { $('#tr'+id+'list').toggle('fast'); $('#tr'+id+'listdetail').toggle('fast');  } 
  					if (action=='update') { $('#tr'+id+'listdetail').toggle('fast'); $('#tr'+id+'list').html(result);  } 
  					if (action=='insert') { alert('insert'); document.location.reload(); } 
  					*/
					 // alert("abgespeichert:"+result);	
					 $('#containerTextWriteAreaLastStore').html(result);
					 document.forms["textWriteForm"].submit();

  			   	}
  			   ); 


}

			// textWriteForm, content
	  		function getFormParam(formname,formfield) 
			  {
			     // alert('getFormParam:  '+formname+'  '+formfield);
			     var formObj=document.forms[formname]; var inputObj=formObj.elements[''+formfield]; if (inputObj==null) { alert('Could not find '+formfield); } else return inputObj.value; 
			  }
		

</script>

<?  

   		// starting here ..
   		$userId=$app->session->userObject->userId;
   		$taskstart=$app->getUserExcerciseTaskAttributeDateTime( $userId, $excerciseTaskObject->excercisetaskId, "taskstart", "" );
   		if ($taskstart!="")
   		{
			$taskstartDate=strtotime($taskstart);
			echo("<div>Startzeit der Aufgabe: ".Display::showDate($taskstartDate)."</div>");
		}

			?>
			<div class='containerTextWriteArea'>
				<form method="post" name='textWriteForm' action="userexcercisetaskwritetext.php?action=taskwritetextdone" method='post'>
					<input type='hidden' name='action' value='taskwritetextdone'>
					<div class='containerTextWriteAreaHead'>
						
			    	    <div id='containerTextWriteAreaHeadTime'><!-- 50 Minuten Limit<br>--></div>
			    	   <!-- <div class='containerTextWriteAreaHeadSpacer'></div> -->
			        </div>
					<?
						// setup time or time!
						if ($time>0) 
						{  
							// echo("Zeitlimite: ".$time." Minuten");
							?>
							<div id='taskwritetextTimelimitStart'>
								
								 <input type=button value='Starte Aufabe <?=$time." Minuten"?>' onClick="StartTaskWrite()"> 

							</div>
							<div id='taskwritetextTimelimitTimer' style='display:none; ' align=right >
								<img src='imgs/icontextwritetime.gif' valign=middle border=0> Verbleibende Zeit: <div id='taskWriteTextObTimelimitTimerNumbers'>50</div> Minuten 
							</div>
								<?
									// time to go
									$timeToGo=$time;
									// get new date here ...
									// hmm
									// echo("<br>--$taskstartDate--");
									// echo("<br>--".time()."--");
									$diffTime=(time()-$taskstartDate)/60;
									// echo("<br>--$diffTime--");
									$diffTimeToGo=$time-$diffTime;
									$diffTimeToGo=(int)$diffTimeToGo;
									// echo("<br>----".$diffTimeToGo);

									$timeToGo=$diffTimeToGo;

								?>
							<script>
							
								var maxTimeInSecs=<?=$timeToGo?>*60;
								var startDate;
								function StartTaskWrite()
								{
									$('#taskwritetextTimelimitStart').hide();
									$('#taskwritetextTimelimitTimer').show();

									// start now
									startExcerciseStartDatabase();

									// start here
									startDate=new Date();

									// store start data
									serviceStoreTimerStart();

									//  task write timer
									TaskWriteTimerUpdateTime();
									TaskWriteTimer();
								}
									function TaskWriteTimer()
									{
										// alert("TaskWriteTimer()");
										// print("TaskWriteTimer()");
										console.log("TaskWriteTimer()");
										
										var diffTime=(new Date()).getTime()-startDate.getTime();
											diffTime=parseInt(diffTime/1000);

										if (maxTimeInSecs-diffTime<=0)
										{
											webserviceSaveText();
											// speichern
											alert("Die Zeit ist um. Es wird gespeichert!");
											// todo: store etc
											webserviceSaveTextAndSubmit();
										}

										// store to cookie

										// update it ..
										TaskWriteTimerUpdateTime(diffTime);

										// store every minute!
										setTimeout("TaskWriteTimer()", 1000);
									}

										// TaskWriteTimerUpdateTime
										function TaskWriteTimerUpdateTime(diffTimeInSeconds)
										{

											var timeToGo=parseInt(maxTimeInSecs-diffTimeInSeconds);
												var timeToGoMinutes=parseInt(timeToGo/60);
												var timeToGoSeconds=parseInt(timeToGo%60);
													if (timeToGoSeconds<10) timeToGoSeconds="0"+timeToGoSeconds;
											$('#taskWriteTextObTimelimitTimerNumbers').html(""+timeToGoMinutes+":"+timeToGoSeconds);
										}

							</script>
							<?
						}
						if ($chars>0) echo("<div align=right><img src='imgs/icontextwritechars.gif' valign=middle border=0> Zeichenlimite: <div id='taskWriteTextObTimelimitChars'>".$chars."</div> Zeichen</div>");
			 		?>
			 		<!-- scripts for storing -->
			 		<script>
			 			// storing every ... x seconds ...
			 			// setInterval(function(){alert("Hello")},3000);
			 		</script>
			        <textarea name="content" id='content' class="mceSimple" ><?=$textInput?></textarea>
			        <div id='containerTextWriteAreaLastStore' style='padding-bottom: 5px; font-size: 12px; display: inline; '></div>
			        <br>
				        <input type="button" value='Zwischenspeichern' onClick='webserviceSaveText()'>
				        <!-- todo: all -->
			    	    <input type="button" value='Abschliessen'  id='containerTextWriteSubmit' onClick='webserviceSaveTextAndSubmit(); '>
				</form>
			</div>
			<?

			// debug it ..
			if (isset($_REQUEST["test"]))
			{
				echo("<br>-----------------TESTING-----------------");
				echo("<br><a onClick=\"threadTesting();\">START ></a>");
				?>
					<script>
						function threadTesting()
						{
							var textToInsert=" ";
							var rndInt=Math.floor(Math.random()*15);
							    if (rndInt==0) textToInsert="der";
							    if (rndInt==1) textToInsert="Mann";
							    if (rndInt==2) textToInsert="die";
							    if (rndInt==3) textToInsert="Hund";
							    if (rndInt==4) textToInsert="gehen";
							    if (rndInt==5) textToInsert="über";
							    if (rndInt==6) textToInsert="die";
							    if (rndInt==7) textToInsert="Strasse";
							    if (rndInt==8) textToInsert=". ";
							    if (rndInt==9) textToInsert="pflügt";
							    if (rndInt==10) textToInsert="\n";
							    if (rndInt==11) textToInsert="\t";
							tinyMCE.execInstanceCommand('content','mceInsertContent',false,' '+textToInsert);

							setTimeout("threadTesting()",1000);	
						}
					</script>
				<?
			}
 
		} // / task writing

		// start task
		if ($valTask=="failed")
	   	{

	   		?>
	   			<div class='userLoginError'>Failed.<br>Bitte kontaktieren Sie die Administration.</div>
	   		<?
	   	}

	} // / task done

	// task done!
	if ($taskDone)
	{
		 echo(Display::displayTaskRemarkTextArea($app,$excerciseTaskObject->excercisetaskId,"done")); 

		 echo(Display::displayLinkToNextTaskInOrder($app,$excerciseId,$excercisetaskId));

		 // show the text here
		 echo("<div id='excercisetaskwritetextDoneContainer'>");
			 echo($textInput);
		 echo("</div>");

	}



	echo("<div style='height: 300px'>&nbsp;</div>");

	// start
	include("./includes/footer.inc.php");
?>
