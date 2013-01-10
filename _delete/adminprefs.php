<?

	// include instance
	include("./appinstance.php");

	// check for admin
	include("./includes/checkaccess.admin.php");

	// start
	include("./includes/header.admin.inc.php");

	// action ..
	$action=$app->requestFromWeb("action","string.azAZ");
	if ($action=="updatetextfront")
	{
		$taskremarkTextObj=new TaskRemarkText();
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
		$taskremarkTextObj=$app->getTaskRemarkTextById($taskremarkTextObj->taskremarktextId);
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
 		$app->updateTaskRemarkText($taskremarkTextObj);
	}

	if ($action=="updatetextsendpassword")
	{
		$taskremarkTextObj=new TaskRemarkText();
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
		$taskremarkTextObj=$app->getTaskRemarkTextById($taskremarkTextObj->taskremarktextId);
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
 		$app->updateTaskRemarkText($taskremarkTextObj);
	}


	if ($action=="updateuserfront")
	{
		$taskremarkTextObj=new TaskRemarkText();
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
		$taskremarkTextObj=$app->getTaskRemarkTextById($taskremarkTextObj->taskremarktextId);
		$taskremarkTextObj->updateToWebRequest($_REQUEST);
 		$app->updateTaskRemarkText($taskremarkTextObj);
	}


	// add sidemenu
	$sideMenuText="".Display::adminDisplayTop(  );
	include("./includes/header.adminsidemenu.inc.php");	

?>
	
	<h3>Administration Texte & Einstellungen</h3>
	

	<h4 >Texte</h4>

	<h5>Fronttext</h5>
	<?
			// look for a task 
		// if there is no one create one!
		$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "textfront" );
		if ($readtextObj==null) { echo(""); $newReadTask=new TaskRemarkText(); $newReadTask->taskremarktextTaskRef=0; $newReadTask->taskremarktextArea="textfront"; $newReadTask->taskremarktextDescription=""; $app->insertTaskRemarkText($newReadTask); }
		$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "textfront" );
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
 			<form action="adminprefs.php">
				<input type=hidden name='action' value='updatetextfront'>
				<input type=hidden name='excercisetaskId' value='0' >
				<input type='hidden' name='taskremarktextId' value='<?=$readtextObj->taskremarktextId?>' >
				<textarea name="taskremarktextDescription" class="mceSimple" style="width:100%"><?=$readtextObj->taskremarktextDescription?></textarea>
				<br><input type=submit value='&Auml;ndern'> 
			</form>


<h5>Email "Passwort verschicken"</h5>
	<?
			// look for a task 
		// if there is no one create one!
		$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "textfrontpassword" );
		if ($readtextObj==null) { echo(""); $newReadTask=new TaskRemarkText(); $newReadTask->taskremarktextTaskRef=0; $newReadTask->taskremarktextArea="textfrontpassword"; $newReadTask->taskremarktextDescription=""; $app->insertTaskRemarkText($newReadTask); }
		$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "textfrontpassword" );
		// print_r($readtextObj);
		
		?>
 			<form action="adminprefs.php">
				<input type=hidden name='action' value='updatetextsendpassword'>
				<input type=hidden name='excercisetaskId' value='0' >
				<input type='hidden' name='taskremarktextId' value='<?=$readtextObj->taskremarktextId?>' >
				<textarea name="taskremarktextDescription" class="mceSimple" style="width:100%"><?=$readtextObj->taskremarktextDescription?></textarea>
				<br><input type=submit value='&Auml;ndern'> 
			</form>




	<h5>Benutzer &Uuml;bersichtstext</h5>
	<?
			// look for a task 
		// if there is no one create one!
		$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "userfront" );
		if ($readtextObj==null) { echo(""); $newReadTask=new TaskRemarkText(); $newReadTask->taskremarktextTaskRef=0; $newReadTask->taskremarktextArea="userfront"; $newReadTask->taskremarktextDescription=""; $app->insertTaskRemarkText($newReadTask); }
		$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "userfront" );
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
 			<form action="adminprefs.php">
				<input type=hidden name='action' value='updateuserfront'>
				<input type=hidden name='excercisetaskId' value='0' >
				<input type='hidden' name='taskremarktextId' value='<?=$readtextObj->taskremarktextId?>' >
				<textarea name="taskremarktextDescription" class="mceSimple" style="width:100%"><?=$readtextObj->taskremarktextDescription?></textarea>
				<br><input type=submit value='&Auml;ndern'> 
			</form>

	<h5>Benutzer Account Einstellungen</h5>
	<?
			// look for a task 
		// if there is no one create one!
		$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "useraccount" );
		if ($readtextObj==null) { echo(""); $newReadTask=new TaskRemarkText(); $newReadTask->taskremarktextTaskRef=0; $newReadTask->taskremarktextArea="useraccount"; $newReadTask->taskremarktextDescription=""; $app->insertTaskRemarkText($newReadTask); }
		$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "useraccount" );
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
 			<form action="adminprefs.php">
				<input type=hidden name='action' value='updateuserfront'>
				<input type=hidden name='excercisetaskId' value='0' >
				<input type='hidden' name='taskremarktextId' value='<?=$readtextObj->taskremarktextId?>' >
				<textarea name="taskremarktextDescription" class="mceSimple" style="width:100%"><?=$readtextObj->taskremarktextDescription?></textarea>
				<br><input type=submit value='&Auml;ndern'> 
			</form>
<?	

	// stop
	include("./includes/footer.inc.php");
?>