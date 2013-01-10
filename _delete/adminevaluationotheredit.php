<?php


	// include instance
	include("./appinstance.php");

		// check for admin
	include("./includes/checkaccess.admin.php");

	// id?
//	$excerciseId=-1;
	$excersicetaskObject=null;
	// this excercise
	if (isset($_REQUEST["excercisetaskId"]))
	{
		$excercisetaskId=$app->requestFromWeb("excercisetaskId","integer");
	}	
	$excercisetaskObject=$app->getExcerciseTaskById($excercisetaskId);
	
	// get user ref ...
	$inputexcercisetaskId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "inputexcercisetaskId", -1 );
	$frameworkId=$app->getAdminExcerciseTaskAttributeInt( $excercisetaskObject->excercisetaskId, "frameworkId", -1 );
	$excerciseId=$excercisetaskObject->excercisetaskExcerciseRef;
	$excerciseObject=$app->getExcerciseById($excerciseId);
	// $excercisetaskObject->excercisetaskExcerciseRef;

	$userId=-1;
	$userObject=null;
	if (isset($_REQUEST["userId"]))
	{
		$userId=$app->requestFromWeb("userId","integer");
		$userObject=$app->getUserById($userId);
	}	

	// content
	if (isset($_REQUEST["content"]))
	{
		// $action=$app->requestFromWeb("action","azAZ");
		$content=$_REQUEST["content"];
		// echo($content);
		// add here and now ...
		$inputTaskWriteTextObject=new TaskWriteTextDocument();
		// $inputTaskWriteTextObject->updateToWebRequest($_REQUEST);
		$inputTaskWriteTextObject->taskwritetextdocumentTaskRef=$inputexcercisetaskId;
		
		// todo - dirty version!
		// > do it in the correct versionn !
		$content=str_replace("\\'","'",$content);
		$content=str_replace("'","''",$content);
		// echo("---".$content);

		$inputTaskWriteTextObject->taskwritetextdocumentText=$content;
		$inputTaskWriteTextObject->taskwritetextdocumentUserRef=$userId;
		// print_r($inputTaskWriteTextObject);
		$app->insertTaskWriteTextDocument($inputTaskWriteTextObject);

		header("location: adminevaluationother.php?excercisetaskId=".$excercisetaskId."&userId=".$userId);

	}	

	// print_r($userObject);

	// debug
	// echo("<br>frameworkId: $frameworkId");
	// framework
//	$inputexcercisetaskId=-1;

	// excerciseObject

// print_r($excercisetaskObject);

	// $evaluationObj=$app->getTaskEvaluationByExcerciseTask( $excercisetaskObject );

//	echo(".....");
//	print_R($evaluationObj);

//	$frameworkObj=$app->getFrameworkById( $evaluationObj->taskevaluationFrameworkRef );
//	print_r($frameworkObj);


	// start
	include("./includes/header.admin.inc.php");

	// side ...
	$excersicetaskObject=$app->getExcerciseTaskById($excercisetaskId);
	$userObject=$app->getUserById($userId);
	$sideMenuText="".Display::adminDisplayExcerciseUsersDetailEvaluationOtherPointTop( $app, $excerciseObject, $userObject );
	include("./includes/header.adminsidemenu.inc.php");	

?>
<h2>Admin: Fremdbeurteilung manuell bearbeiten</h2>

<!-- text manual editing -->
<a href='adminevaluationother.php?excercisetaskId=<?=$excercisetaskId?>&userId=<?=$userId?>'>[< Zur&uuml;ck zur Fremdbeurteilung]</a>
<br><br>
<!-- display the tasks -->


<!-- todo: tocss -->
<style>
  .containertosscontent,#containertosscontent {	_background: #ddeedd;  width: 900px;}
</style>


<?
	// get text ... 
	$text="";
	$latestTextObj=$app->getTaskWriteTextDocumentByUserAndExcercisetaskLatest( $userId, $inputexcercisetaskId );
	if ($latestTextObj!=null)
	{
		$text=$latestTextObj->taskwritetextdocumentText;
		$taskwritetextdocumentId=$latestTextObj->taskwritetextdocumentId;
	}
	else
	{
		echo("<div style='background: red;'>Kein Input Text gefunden! Keine Input Quelle im Ablauf angegeben oder keiner gefunden!</div>");
		// $text="";
		$taskwritetextdocumentId=-1;
	}


?>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        theme_advanced_disable : "image,anchor,link,unlink,bullist,tablet,separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor,bullist,separator,outdent,indent,separator,separator,hr,removeformat,visualaid,separator,sub,sup,separator,charmap",
        plugins : "paste",
		valid_elements : "p[br|strong|b],strong/b,br[strong|b]",
		theme_advanced_buttons1 : "bold,redo,undo,html",
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
       // oninit : tinymceInitDone,

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
        

});

</script>

			<div style='height: 500px;'>
				<form method="post" name='textWriteForm' action="adminevaluationotheredit.php" method='post'>
				    <input type=hidden name='userId' value='<?=$userId?>'>
				    <input type=hidden name='excercisetaskId' value='<?=$excercisetaskId?>'>
				    <textarea name="content" id='content' class="mceSimple" ><?=$text?></textarea>
				    <br><input type=submit value='Speichern'>
				</form>
			</div>
<?
	// start
	include("./includes/footer.inc.php");
?>
