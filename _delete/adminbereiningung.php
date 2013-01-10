<?

	// include instance
	include("./appinstance.php");

        // check for admin
        include("./includes/checkaccess.admin.php");

	// start
	include("./includes/header.inc.php");
?>
<h2>Admin: Text bereinigen</h2>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "", // "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",


		theme_advanced_buttons1 : "bold,redo,undo,code",
		theme_advanced_buttons2 : "",
	    theme_advanced_buttons3 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        // theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        
		valid_elements : "p[br|strong|b],strong/b,br[strong|b]",

        width : "730px",
        height : "500px",

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

/*
$(document).ready(function() {
// validate form on keyup and submit
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
});
*/

</script>
<?
	$content="";
	if (isset($_REQUEST["content"])) $content="".$_REQUEST["content"];

?>
<form method="post" action="adminfremdbeurteilung.php" method='post'>
        <input type="submit" value='Fremdbeurteilung beginnen'>
        <textarea name="content" ><?=$content?></textarea>
</form>
<?
	// start
	include("./includes/footer.inc.php");
?>