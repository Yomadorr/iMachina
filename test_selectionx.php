<?
		include("./appinstance.php");
?>
<html>

<link href="styles/default/stylesplatform.css" rel="stylesheet" type="text/css" />

<!-- jquery -->
<script src="jquery.min.js"></script> 

<script src="jclasses.js"></script> 

<body>

<?


if (true)
{
	echo("<hr>MANUALLY TESTING<hr>");

    // generate this
    // $selectableText="Wir sind die <strong>Welt und</strong> Du bist tot und noch da! <a href='http://www.heise.de'>Lang lebe die</a> Menscheit!";

    $selectableText="Das ist <br>Text, der <a href='http://www.heise.de'>wartet</a> auf dich! ";

	$textobjectObj=new TextObject();
	$textobjectObj->textobjectId=3142;
	$textobjectObj->setArgument($selectableText);
	$text=$textobjectObj->getArgument();
	echo("\n\n<hr><div style='border: 1px solid black'>ORIGINAL:<br>".$text."</div><hr>");

	// add things ...
	$textobjectObjView=$app->getTextObjectViewFor($textobjectObj, $userId);		
	$textobjectObj->updateArgumentAsWordText();
	$text=$textobjectObj->getArgument();

	// some add ons
//	$text=$textobjectObjView->textInsertTextCommentContainer( $text );
//	$text=$textobjectObjView->textInserJavascriptOnClick( $text );	

	echo("\n\n\n<hr><div style='border: 1px solid black'>ADDON:<br>".$text."</div><hr>");

	echo("\n\n\n");
	// textobjectview .... 
	// and now direct and hard ... 
	echo($textobjectObjView->viewDetail($app, $userId));

?>	

<?
}

//  echo("ALL OK!<imachinaTextDiv><div class='imachinaText'   onClick=\"onTextClick( 3142, 15 )\"  id='imt3142_15' imachinaTag>Das</div id='endimt3142_15'><div class='detailComponentCommentsText'  id='commentimt3142_15'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 16 )\"  id='imt3142_16' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 64 )\"  id='imt3142_64' imachinaTag> </div id='endimt3142_64'><div class='detailComponentCommentsText'  id='commentimt3142_64'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 65 )\"  id='imt3142_65' imachinaTag></div id='endimt3142_65'><div class='detailComponentCommentsText'  id='commentimt3142_65'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 66 )\"  id='imt3142_66' imachinaTag> </div id='endimt3142_66'><div class='detailComponentCommentsText'  id='commentimt3142_66'></div></div id='endimt3142_16'><div class='detailComponentCommentsText'  id='commentimt3142_16'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 17 )\"  id='imt3142_17' imachinaTag>ist</div id='endimt3142_17'><div class='detailComponentCommentsText'  id='commentimt3142_17'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 18 )\"  id='imt3142_18' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 60 )\"  id='imt3142_60' imachinaTag> </div id='endimt3142_60'><div class='detailComponentCommentsText'  id='commentimt3142_60'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 61 )\"  id='imt3142_61' imachinaTag></div id='endimt3142_61'><div class='detailComponentCommentsText'  id='commentimt3142_61'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 62 )\"  id='imt3142_62' imachinaTag> </div id='endimt3142_62'><div class='detailComponentCommentsText'  id='commentimt3142_62'></div></div id='endimt3142_18'><div class='detailComponentCommentsText'  id='commentimt3142_18'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 19 )\"  id='imt3142_19' imachinaTag>der</div id='endimt3142_19'><div class='detailComponentCommentsText'  id='commentimt3142_19'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 20 )\"  id='imt3142_20' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 56 )\"  id='imt3142_56' imachinaTag> </div id='endimt3142_56'><div class='detailComponentCommentsText'  id='commentimt3142_56'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 57 )\"  id='imt3142_57' imachinaTag></div id='endimt3142_57'><div class='detailComponentCommentsText'  id='commentimt3142_57'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 58 )\"  id='imt3142_58' imachinaTag> </div id='endimt3142_58'><div class='detailComponentCommentsText'  id='commentimt3142_58'></div></div id='endimt3142_20'><div class='detailComponentCommentsText'  id='commentimt3142_20'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 21 )\"  id='imt3142_21' imachinaTag>Text</div id='endimt3142_21'><div class='detailComponentCommentsText'  id='commentimt3142_21'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 22 )\"  id='imt3142_22' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 52 )\"  id='imt3142_52' imachinaTag> </div id='endimt3142_52'><div class='detailComponentCommentsText'  id='commentimt3142_52'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 53 )\"  id='imt3142_53' imachinaTag></div id='endimt3142_53'><div class='detailComponentCommentsText'  id='commentimt3142_53'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 54 )\"  id='imt3142_54' imachinaTag> </div id='endimt3142_54'><div class='detailComponentCommentsText'  id='commentimt3142_54'></div></div id='endimt3142_22'><div class='detailComponentCommentsText'  id='commentimt3142_22'></div><br><div class='imachinaText'   onClick=\"onTextClick( 3142, 7 )\"  id='imt3142_7' imachinaTag>Der</div id='endimt3142_7'><div class='detailComponentCommentsText'  id='commentimt3142_7'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 8 )\"  id='imt3142_8' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 48 )\"  id='imt3142_48' imachinaTag> </div id='endimt3142_48'><div class='detailComponentCommentsText'  id='commentimt3142_48'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 49 )\"  id='imt3142_49' imachinaTag></div id='endimt3142_49'><div class='detailComponentCommentsText'  id='commentimt3142_49'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 50 )\"  id='imt3142_50' imachinaTag> </div id='endimt3142_50'><div class='detailComponentCommentsText'  id='commentimt3142_50'></div></div id='endimt3142_8'><div class='detailComponentCommentsText'  id='commentimt3142_8'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 9 )\"  id='imt3142_9' imachinaTag>Text</div id='endimt3142_9'><div class='detailComponentCommentsText'  id='commentimt3142_9'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 10 )\"  id='imt3142_10' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 44 )\"  id='imt3142_44' imachinaTag> </div id='endimt3142_44'><div class='detailComponentCommentsText'  id='commentimt3142_44'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 45 )\"  id='imt3142_45' imachinaTag></div id='endimt3142_45'><div class='detailComponentCommentsText'  id='commentimt3142_45'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 46 )\"  id='imt3142_46' imachinaTag> </div id='endimt3142_46'><div class='detailComponentCommentsText'  id='commentimt3142_46'></div></div id='endimt3142_10'><div class='detailComponentCommentsText'  id='commentimt3142_10'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 11 )\"  id='imt3142_11' imachinaTag>ist</div id='endimt3142_11'><div class='detailComponentCommentsText'  id='commentimt3142_11'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 12 )\"  id='imt3142_12' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 40 )\"  id='imt3142_40' imachinaTag> </div id='endimt3142_40'><div class='detailComponentCommentsText'  id='commentimt3142_40'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 41 )\"  id='imt3142_41' imachinaTag></div id='endimt3142_41'><div class='detailComponentCommentsText'  id='commentimt3142_41'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 42 )\"  id='imt3142_42' imachinaTag> </div id='endimt3142_42'><div class='detailComponentCommentsText'  id='commentimt3142_42'></div></div id='endimt3142_12'><div class='detailComponentCommentsText'  id='commentimt3142_12'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 13 )\"  id='imt3142_13' imachinaTag>gemein!</div id='endimt3142_13'><div class='detailComponentCommentsText'  id='commentimt3142_13'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 14 )\"  id='imt3142_14' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 36 )\"  id='imt3142_36' imachinaTag> </div id='endimt3142_36'><div class='detailComponentCommentsText'  id='commentimt3142_36'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 37 )\"  id='imt3142_37' imachinaTag></div id='endimt3142_37'><div class='detailComponentCommentsText'  id='commentimt3142_37'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 38 )\"  id='imt3142_38' imachinaTag> </div id='endimt3142_38'><div class='detailComponentCommentsText'  id='commentimt3142_38'></div></div id='endimt3142_14'><div class='detailComponentCommentsText'  id='commentimt3142_14'></div><br><div class='imachinaText'   onClick=\"onTextClick( 3142, 1 )\"  id='imt3142_1' imachinaTag>Was</div id='endimt3142_1'><div class='detailComponentCommentsText'  id='commentimt3142_1'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 2 )\"  id='imt3142_2' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 32 )\"  id='imt3142_32' imachinaTag> </div id='endimt3142_32'><div class='detailComponentCommentsText'  id='commentimt3142_32'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 33 )\"  id='imt3142_33' imachinaTag></div id='endimt3142_33'><div class='detailComponentCommentsText'  id='commentimt3142_33'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 34 )\"  id='imt3142_34' imachinaTag> </div id='endimt3142_34'><div class='detailComponentCommentsText'  id='commentimt3142_34'></div></div id='endimt3142_2'><div class='detailComponentCommentsText'  id='commentimt3142_2'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 3 )\"  id='imt3142_3' imachinaTag>meinst</div id='endimt3142_3'><div class='detailComponentCommentsText'  id='commentimt3142_3'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 4 )\"  id='imt3142_4' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 28 )\"  id='imt3142_28' imachinaTag> </div id='endimt3142_28'><div class='detailComponentCommentsText'  id='commentimt3142_28'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 29 )\"  id='imt3142_29' imachinaTag></div id='endimt3142_29'><div class='detailComponentCommentsText'  id='commentimt3142_29'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 30 )\"  id='imt3142_30' imachinaTag> </div id='endimt3142_30'><div class='detailComponentCommentsText'  id='commentimt3142_30'></div></div id='endimt3142_4'><div class='detailComponentCommentsText'  id='commentimt3142_4'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 5 )\"  id='imt3142_5' imachinaTag>du?</div id='endimt3142_5'><div class='detailComponentCommentsText'  id='commentimt3142_5'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 6 )\"  id='imt3142_6' imachinaTag></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 24 )\"  id='imt3142_24' imachinaTag> </div id='endimt3142_24'><div class='detailComponentCommentsText'  id='commentimt3142_24'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 25 )\"  id='imt3142_25' imachinaTag></div id='endimt3142_25'><div class='detailComponentCommentsText'  id='commentimt3142_25'></div><div class='imachinaText'   onClick=\"onTextClick( 3142, 26 )\"  id='imt3142_26' imachinaTag> </div id='endimt3142_26'><div class='detailComponentCommentsText'  id='commentimt3142_26'></div></div id='endimt3142_6'><div class='detailComponentCommentsText'  id='commentimt3142_6'></div></imachinaTextDiv>");
// direct over an existing object
if (false)
{

	echo("<hr>FROM DATABASE!<hr>");
	$textobjectObj=$app->getTextObjectById(3142,$userId);
	$textobjectObjView=$app->getTextObjectViewFor($textobjectObj, $userId);		
	$textobjectObj->updateArgumentAsWordText();	
	echo($textobjectObjView->viewDetail($app, $userId));
}
?>
 

</body>
</html>