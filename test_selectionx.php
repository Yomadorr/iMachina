<?
		include("./appinstance.php");
?>
<html>

<link href="styles/default/stylesplatform.css" rel="stylesheet" type="text/css" />

<!-- jquery -->
<script src="jquery.min.js"></script> 

<script src="jclasses.js"></script> 

<body>

ted

<?

    // generate this
    $selectableText="Wir sind die <strong>Welt und</strong> Du bist tot und noch da! <a href='http://www.heise.de'>Lang lebe die</a> Menscheit!";

    $selectableText="Das ist der Text<br>Der Text ist gemein!<br>Was meinst du?";

	$textobjectObj=new TextObject();
	$textobjectObj->textobjectId=1001;
	$textobjectObj->setArgument($selectableText);
	$text=$textobjectObj->getArgument();
	echo("\n\n<hr><div style='border: 1px solid black'>ORIGINAL:<br>".$text."</div><hr>");

	// add things ...
	$textobjectObjView=$app->getTextObjectViewFor($textobjectObj, $userId);		
	$textobjectObj->updateArgumentAsWordText();
	$text=$textobjectObj->getArgument();

	// some add ons
	$text=$textobjectObjView->textInsertTextCommentContainer( $text );
	$text=$textobjectObjView->textInserJavascriptOnClick( $text );	

	echo("\n\n\n<hr><div style='border: 1px solid black'>ADDON:<br>".$text."</div><hr>");

	echo("\n\n\n");
	// textobjectview .... 
	// and now direct and hard ... 
	echo($textobjectObjView->viewDetail($app, $userId));

?>

</body>
</html>