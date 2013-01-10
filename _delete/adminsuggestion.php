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
		Suggestions
	*/
	/*
		add an exercise
	*/

	// create a new one?
	$suggestionObject=new Suggestion();
	// print_r($suggestionObject);	
    // updateto
 	$suggestionObject->updateToWebRequest($_REQUEST);
 	$inputSuggestionObject=$app->getSuggestionById($suggestionObject->suggestionId);
 	if ($inputSuggestionObject!=null) $suggestionObject=$inputSuggestionObject;

 	// find
	// print_r($suggestionObject);  

	// add
	if ($action=="add")
	{
		$copyFromSuggestion=$app->requestFromWeb("copyFromSuggestion","integer");
		// ... ok insert here an object ....
		$suggestionObject->suggestionStatus="";
		$app->insertSuggestion($suggestionObject);
		if ($copyFromSuggestion!=-1)
		{
			// copy recursively here
			// todo: recursively
		}
		$newObject=$app->getLatestSuggestion( $suggestionObject );
		header("location: adminsuggestion.php?suggestionId=".$newObject->suggestionId);
	}
	
	// update
	if ($action=="update")
	{
		$suggestionObject=$app->getSuggestionById($suggestionObject->suggestionId);
	 	$suggestionObject->updateToWebRequest($_REQUEST);
	 	// print_r($suggestionObject);
 		$app->updateSuggestion($suggestionObject);

 		if ($suggestionObject->suggestionStatus=="deleted") header("location: admin.php");
	}


	// start
	include("./includes/header.admin.inc.php");

	// add sidemenu
	$sideMenuText="".Display::adminDisplaySuggestionPointTop( $app, $suggestionObject );
	include("./includes/header.adminsidemenu.inc.php");	

	// id?
	$suggestionId=$suggestionObject->suggestionId;

	// tod
	// id==-1 > admin site
	
	// SuggestionObject
	$suggestionObject=$app->getSuggestionById($suggestionId);
	

?>



<h2>Administration: Empfehlung bearbeiten</h2>

<? /*echo(Display::displayAdminSuggestionBreadCrump($app,$SuggestionObject,null)) */ ?>

<form action="adminsuggestion.php">
<input type=hidden name='action' value='update'>
<input type=hidden name='suggestionId' value='<?=$suggestionObject->suggestionId?>' >
Name:
<input type=text name='suggestionName' value='<?=$suggestionObject->suggestionName?>' size=60 >
<br>Status: <?=Display::displayStatusActiveDeletedAsSelect( $app, "suggestionStatus", $suggestionObject->suggestionStatus )?>
<br>Text:
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
	<textarea name="suggestionText" class="mceSimple" style="width:100%"><?=$suggestionObject->suggestionText?></textarea>
<br><input type=submit value='Ver&auml;ndern'>
</form>
<?

	// stop
	include("./includes/footer.inc.php");
?>