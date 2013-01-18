<html>

<link href="styles/default/stylesplatform.css" rel="stylesheet" type="text/css" />

<!-- jquery -->
<script src="jquery.min.js"></script> 

<script src="jclasses.js"></script> 

<body>
<?
	


	// test selection ...
    
	?>

<?	 
	/*
		
		Selections
	
	*/
	// ok add 
	?>
	<script>

		/*

			Render Textcomments...

		*/
		/*

			Datastructure:

			[textobjectTextCommentX] [textobjectTextCommentY]
						   	|\\\	

    				      (TextAttribute1-LayerX) 
    				           (TextAttribute1-LayerY)
    				           (TextAttribute2-LayerX) 
					         \ |  /
				Text-Layer: [WordA-IDA][WordB-IDB]
			
			Workflow (Rendering):
			- TextObject { selectionA - selectionB }
			- Rendering to TextAttributes
			> Visualisation (Rendering)
			
		*/

		/*
			texts: wordtexts, holds texts (wordlist), 
				   [wordtext]-attributes
			comments
		*/
			

		// the manager
		var imachinaTextManager = function()
		{
			// this.debutToConsole=false; 

			this.version=0.6;

			/*
				Texts

			*/
			/*
				TextWords
			*/
			/*
			 	Words of the text ... 
			*/	
			// 
			// Layer: [selected] or [id]
			//  
			this.arrWords=new Array(); 

				this.debugWords = function()
				{
					var str="WORDS: ";
					var textwordObj;
					for (var i=0;i<this.arrWords.length;i++)
					{
						textwordObj=this.arrWords[i];
						str=str+"\n "+i+". "+textwordObj.debug();
					}

					return str;
				}


			this.addTextWord = function( textobjectId, wordId )
			{
				var wordObject=new TextWord();
					wordObject.textobjectId=textobjectId;
					wordObject.textwordId=wordId;

				// console.debug("addTextWord( "+textobjectId+", "+wordId+"  )");

				this.arrWords[this.arrWords.length]=wordObject;

				return wordObject
			}		

			this.debugText = function( )
			{
				var str="";

				for (var i=0;i<this.arrWords.length;i++)
				{
					str=str+"\n"+i+" "+this.arrWords[i].debug();;
				}

				return str;
			}


			/*
				TextComments
			*/
			/*
				TextComments
			*/
			this.arrTextComments = new Array();

			this.addTextCommentByValues = function(textobjectId, textobjectRef, textobjectCursorA, textobjectCursorB ) // red,green,blue
			{
				var textobjectObj=new TextObject();
					textobjectObj.textobjectId=textobjectId;
					textobjectObj.textobjectRef=textobjectRef;
					textobjectObj.textobjectCursorA=textobjectCursorA;
					textobjectObj.textobjectCursorB=textobjectCursorB;
						textobjectObj.textobjectTextWordAttribute=new TextWordAttribute();
						textobjectObj.textobjectTextWordAttribute.colorRed=0;					
						textobjectObj.textobjectTextWordAttribute.colorGreen=255;					
						textobjectObj.textobjectTextWordAttribute.colorBlue=0;					
				this.addTextComment( textobjectObj );
			}
			this.addTextComment = function ( textobjectObj )
			{
				textobjectObj.textobjectTextWordAttribute=new TextWordAttribute();

				var arr=this.arrTextComments;
				arr[arr.length]=textobjectObj;
			}
			
			this.getComments = function()
			{
				return this.arrTextComments.length;
			}

			this.getVersion = function()
			{
				return this.version;
			}

			this.debugTextComments = function () 
			{ 
				var arr=this.arrTextComments; 
				var str=""; 
				for (var z=0;z<arr.length;z++) {  str=str+"\n "+z+". "+this.arrTextComments[z].textobjectId+" A: "+this.arrTextComments[z].textobjectCursorA+" B: "+this.arrTextComments[z].textobjectCursorB; } 
				return str; 
			}

			/*
				Renderings

			*/
			this.renderTextObjectById = function( textobjectId )
			{
				// reset all now ...
				this.clearCommentAttributesForId( textobjectId );

				// render all textobjects
				// do now the renderdings
				console.debug("TextComments "+this.arrTextComments.length);
				for (var z=0;z<this.arrTextComments.length;z++)
				{
					if (this.arrTextComments[z].textobjectId==textobjectId) this.renderCommentToAttributes( this.arrTextComments[z] );;
				}

				// apply attributes to divs
				this.applyTextWordAttributeToText( textobjectId );

			}
				this.clearCommentAttributesForId = function( textobjectId )
				{
					for (var z=0;z<this.arrWords.length;z++)
					{
						if (this.arrWords[z].textobjectId==textobjectId) this.arrWords[z].clearTextWordAttributes();
					}
				}

				// render comment to attribute
				this.renderCommentToAttributes = function( textobjectObj )
				{
					var textwordObj;
					var flagInSelection=false;

					// console.debug("renderCommentToAttributes("+textobjectObj.textobjectId+")  ");

					for (var i=0;i<this.arrWords.length;i++)
					{
						if ((textobjectObj.textobjectId==this.arrWords[i].textobjectId)||(textobjectObj.textobjectId=="selection"))
						{
							if (textobjectObj.textobjectCursorA==this.arrWords[i].textwordId) {  flagInSelection=true;  }
							if (flagInSelection) { var textwordattributeObj=textobjectObj.textobjectTextWordAttribute;  this.arrWords[i].addTextWordAttribute(textwordattributeObj);   } 
							if ((textobjectObj.textobjectCursorB==this.arrWords[i].textwordId)||(textobjectObj.textobjectCursorB==-1)) {  flagInSelection=false;  }
						}
					}
				}

				// render data
				this.applyTextWordAttributeToText = function( textobjectId )
				{
					var toaObj;

					// red ...

					for (var z=0;z<this.arrWords.length;z++)
					{
						var textwordObj=this.arrWords[z];
						if (textwordObj.textobjectId==textobjectId) 
						{
							var arr=textwordObj.textwordAttributes;

							// more complex!!
							if (arr.length>0)
							{
								// go through attributes!!!
								// new TextWordAttribute();
								
								toaObj=new TextWordAttribute();
								toaObj.colorRed=0;
								toaObj.colorGreen=0;
								toaObj.colorBlue=0;
								for (var inx=0;inx<arr.length;inx++)
								{
									
									// add togehter here ...
									toaObj.colorRed=toaObj.colorRed+arr[inx].colorRed+1;
									toaObj.colorGreen=toaObj.colorGreen+arr[inx].colorGreen+1;
									toaObj.colorBlue=toaObj.colorBlue+arr[inx].colorBlue+1;
								}

								console.debug("new marker before: "+toaObj.colorRed+","+toaObj.colorGreen+","+toaObj.colorBlue);

								// max ... 
								if (toaObj.colorRed>255) toaObj.colorRed=255;
								if (toaObj.colorGreen>255) toaObj.colorGreen=255;
								if (toaObj.colorBlue>255) toaObj.colorBlue=255;

								// make it darker
								var factor=1;
								if (arr.length>1) factor=1.0-arr.length*0.1;

								toaObj.colorRed=parseInt(toaObj.colorRed*factor);
								toaObj.colorGreen=parseInt(toaObj.colorGreen*factor);
								toaObj.colorBlue=parseInt(toaObj.colorBlue*factor);

								console.debug("new marker: "+toaObj.colorRed+","+toaObj.colorGreen+","+toaObj.colorBlue);

								var divId="imt"+textwordObj.textobjectId+"_"+textwordObj.textwordId;
								$('#'+divId).css("background",'rgb('+toaObj.colorRed+','+toaObj.colorBlue+','+toaObj.colorGreen+')');

//								$('#'+divId).css("background","green");
							}
						}
					}
				}	

		
		}

		// instance of the manager ...
		var imachinaManager=new imachinaTextManager();
		
	</script>

	<script>

		// add TextComments
		// examples
		// 87-61
		imachinaManager.addTextCommentByValues(2001, 1001, 82, 61 );
		imachinaManager.addTextCommentByValues(2002, 1001, 96, 82 );

	</script>


	<script>

	
		/*
			textCommentToggle(

		*/
		function textCommentToggle( textobjectId )
		{
			alert("textobjectId: "+textobjectId);
		}


		/*
			actual
		*/
		// selected text
		var textobjectSelection=new TextObject();
			textobjectSelection.textobjectId=1001; // default
			textobjectSelection.textobjectTextWordAttribute.colorRed=255;
		    textobjectSelection.textobjectCursorA=-1;
		    textobjectSelection.textobjectCursorB=-1;
		// add this component here ...
		imachinaManager.addTextComment(textobjectSelection);	
		
		// debug
		var debugComments=imachinaManager.debugTextComments();
		console.debug(""+debugComments);			

		// todo: remove this here ... 
		function onTextClick( textobjectId, textId)
		{
			// alert("onTextClick( "+textobjectId+","+ textId+")");

			// clear
			if (textobjectId!=textobjectSelection.textobjectId)
			{
				this.clearCommentAttributesForId( textobjectSelection.textobjectId );
			}

			if (textobjectSelection.textobjectCursorA==-1)textobjectSelection.textobjectCursorA=textId;
			else
			{
				//if (textobjectSelection.textobjectCursorA!=-1) 
				//{
					/*
					if (selectionRangeA<selectionRangeB) selectionRangeB=textId;
					else
					if (selectionRangeA>selectionRangeA) selectionRangeA=textId;
					*/
					textobjectSelection.textobjectCursorB=textId;
				//}
			}
			// alert("onTextClick( "+textobjectId+","+ textId+")");

			// showTextSelection();

			// todo: deselect old version

			// console.debug("onTextClick() "+textobjectSelection.textobjectCursorA+"  "+textobjectSelection.textobjectCursorB);

			imachinaManager.renderTextObjectById(textobjectSelection.textobjectId);

			console.debug(imachinaManager.debugText());

		}

			


	</script>
<?

	  </script>
	<?

	$debugThis=false;

	/*

		generate new text

	*/

	$textobjectId=1001;
    $selectableText="<imachinaTextDiv>"."Das ist der Weg hinab ins Ungewisse. <br> Was <div class='imachinaText' id='imt".$textobjectId."_16' imachinaTag>meinstdu</div> Du !<a href='http://www.heise.de'>alte Fettel</a>. Der Weg tötet. <div class='imachinaText' id='imt".$textobjectId."_20' imachinaTag>Die Welt ist da!</div>. <strong>Er macht sie fertig</strong> bis aufs <span>Blut</span> zerwuerrgte Zeit. was soll das!??? . "."</imachinaTextDiv>";
    // if ($debugThis)
    // echo($selectableText);

    // 1. find not imachinaTextId tagged object
	$pattern = '/>([^<]+)/s';
	preg_match_all($pattern, $selectableText, $matches, PREG_OFFSET_CAPTURE, 3);

	// 2. take the foundings... 
		class imachinaText
		{
			var $text="";
			var $position="";

			function debug()
			{
				return $this->position." :".$this->text."";
			}
		}

	$arrMatches=$matches[1];
	$arrFound=array();
	if ($debugThis) {  echo("<pre>");print_r($arrMatches);echo("</pre>"); }
	for ($i=0;$i<count($arrMatches);$i++)
	{
		// echo("<pre>");print_r($arrMatches[$i]);echo("</pre>");
		$newTextObject=new imachinaText();
		$newTextObject->text=$arrMatches[$i][0];
		$newTextObject->position=$arrMatches[$i][1];
		$arrFound[count($arrFound)]=$newTextObject;
		if ($debugThis) echo("\n<br>---$i:-".$newTextObject->text);
	}
	// show matches here
	// debug
	for ($i=0;$i<count($arrFound);$i++)
	{
		$textObj=$arrFound[$i];
		// echo("<br>$i ".$textObj->debug());
	}

	// get max imachinaTextId	
	$imachinaTextId=0;
	preg_match_all("/id='imt([^']+)'/", $selectableText, $arrImachinaIds, PREG_OFFSET_CAPTURE, 3);
	if ($debugThis)  { echo("<hr>ID<hr>");echo("<pre>");print_r($arrImachinaIds);echo("</pre>"); echo("<hr>"); }
	for ($i=0;$i<count($arrImachinaIds[1]);$i++)
	{
		$val=$arrImachinaIds[1][$i][0];
		if ($debugThis) echo("\n<br>-----VAL:".$val);
		$arrVal=explode("_",$val);
		if (count($arrVal)>0) { $val=$arrVal[1]; } 
		$valInt=intval($val);
		if ($valInt>$imachinaTextId) $imachinaTextId=$valInt;
	}
	if ($debugThis) echo("\n<br><hr>----".$imachinaTextId."---");

	if ($debugThis) echo("\n<hr>");	
	if ($debugThis) echo("\n<hr>");	
	if ($debugThis) echo("\n<hr>");	

	// imachinaTextId
	$imachinaTextId++;

	// go from back to top 
	if (count($arrFound)>0)
	{
		for ($i=count($arrFound)-1;$i>=0;$i--)
		{
			$textObj=$arrFound[$i];
			// check 
			if ($debugThis) echo("\n<br><br>$i ".$textObj->debug());

			$inlineText=$textObj->text;

			// check now if there is something to do
		
			// check: "wordonly" > is it a imachinatext-div?
			//  imachinaTag>
			$isInSystem=false;
			$checkForThisTag="imachinaTag>";

			// case: "wordonly" > is it a imachinatext-div?
			$pos=$textObj->position;
			if ($pos>strlen($checkForThisTag))
			{

				$posStart=$pos-strlen($checkForThisTag);
				// ok get thext
				$tag=substr($selectableText,$posStart,strlen($checkForThisTag));
				if ($debugThis) echo("---{$tag}---");
				if ($tag==$checkForThisTag)
				{
					$isInSystem=true;
				}

				// echo("------TAG: ".$tag);
				if ($debugThis) if ($isInSystem) echo("\n---TAGFOUND---");

				$commentMode="word";
				// mode: word - do it 
				// $app->
				if ($commentMode=="word")
				{
					$strReplace="";

					// explode
					$arrWords=explode(" ",$inlineText);
					// = one
					if (count($arrWords)==1)
					{
						// in system?
						if (!$isInSystem)
						{
							// add div here ... 
							// addTextObject()
							// $strReplace="\n-REPLACEONEWORD-";
							// <div class='imachinaText' id='imt".$textobjectId."_16' imachinaTag>
							$strReplace=$strReplace.addTextWord( $textobjectId, $imachinaTextId, $inlineText );
							$imachinaTextId++;
						}
						
						if ($isInSystem)
						{
							if ($debugThis) echo(" IN SYSTEM ");
							$strReplace="";
						}
					}
					// on or more?
					if (count($arrWords)>1)
					{
						// add all now ... 
						$strReplace=""; // \n(-REPLACEMORETHANONEWORD-)";

						// version one - problem <div id='100'>A B</div>
						/*
						for ($wordIndex=0;$wordIndex<count($arrWords);$wordIndex++)
						{
							$singleWord=$arrWords[$wordIndex];
							// echo($singleWord);
							$strReplace=$strReplace.addTextWord( $textobjectId, $imachinaTextId, $singleWord );
							$imachinaTextId++;

							$strReplace=$strReplace.addTextWord( $textobjectId, $imachinaTextId, " " );
							$imachinaTextId++;

						}
						*/

						for ($wordIndex=0;$wordIndex<count($arrWords);$wordIndex++)
						{
							$singleWord=$arrWords[$wordIndex];
							// echo($singleWord);
							if (($isInSystem)&&($wordIndex==0)) { $strReplace=$strReplace.$singleWord."</div>"; } // end div in original!

							if ((!$isInSystem)&&($wordIndex==0)) { $strReplace=$strReplace.addTextWord( $textobjectId, $imachinaTextId, $singleWord ); } // end div in original!

							if (($wordIndex>0))
							{ 
								$strReplace=$strReplace.addTextWord( $textobjectId, $imachinaTextId, $singleWord );
							}
							$imachinaTextId++;

							$strReplace=$strReplace.addTextWord( $textobjectId, $imachinaTextId, " " );
							$imachinaTextId++;

						}

					}

					// replace this here and now ...
					if ($strReplace!="")
					{
						// cutoff ..
						$wordsLength=strlen($inlineText);
						$tmpText=$selectableText;
							$textA=substr($selectableText,0,$pos);
							if ($debugThis) echo("\n<br>POS: ".$pos);
							$textB=substr($selectableText,$pos+$wordsLength);
							if ($debugThis) echo("\n<br>TEXTA: ".$textA);
							if ($debugThis) echo("\n<br>TEXTB:".$textB);
						$selectableText=$textA.$strReplace.$textB;
						if ($debugThis) echo("\n<br>!!!!!!!!!!!!!!!!!!!!CHANGED");
					}

				}
				// mode: char - do every char!
				// ressource hungry
				if ($commentMode=="char")
				{

				}

			}

		}

		// done ..
		if ($debugThis) echo("\n\n\n<hr><br><hr>RESULT: <br>".$selectableText);

		// add all ids and comments?


	}
	if ($debugThis) echo("<br>parsing done - text updated - done...");


	// function
		function addTextWord( $textobjectId, $imachinaTextId, $word )
		{
			return "<div class='imachinaText'  id='imt".$textobjectId."_".$imachinaTextId."' imachinaTag>".$word."</div id='endimt".$textobjectId."_".$imachinaTextId."'>";
		}


	/*
		add div layer and selection staff here ...
	*/
	// add layers here?
	
	// add on click script here manualy ...
	$selectableText=preg_replace("/(id='imt(\d+)_(\d+)')/", " onClick=\"onTextClick( $2, $3 )\"  $1", $selectableText);

	// add comments and divs here ...
	// todo: for eff. comments do this here ... 

	// add divs for ajax
	// version 1
	// $selectableText=preg_replace("/( id='imt(\d+)_(\d+)' imachinaTag>([^<]+))/", "$1<div style='display: inline; position: relative;'><div  style='position: absolute; display: inline; top: 20px; opacity: 1.0;' id='imcommentt$2_$3'></div></div>", $selectableText);
	// $selectableText=preg_replace("/( id='imt(\d+)_(\d+)' imachinaTag>([^<]+))/", "$1<div style='display: inline; position: relative;'><div  style='position: absolute; display: inline; top: 20px; opacity: 1.0;' id='imcommentt$2_$3'></div></div>", $selectableText);
//	$selectableText=preg_replace("/( id='endimt(\d+)_(\d+)'>)/", "$1<div style='display:inline; background: blue;' class='detailComponentCommentsText'><div class='detailComponentCommentsTextEntity' id='imcommentt$2_$3'>*</div></div>", $selectableText);

	// display 
	// add a concrete comment here ...
	$textobjectIdThis=1001;
	$wordtextId=37;
	$textobjectCommentId=1001;
	// version 1.0
//	$selectableText=preg_replace("/( id='imt".$textobjectIdThis."_".$wordtextId."' imachinaTag>([^<]+))/", "$1C", $selectableText);
//	$selectableText=preg_replace("/( id='imcommentt".$textobjectIdThis."_".$wordtextId."'>)/", "$1<div style='border: 1px solid black; padding: 5px;'>ABC</div>", $selectableText);
	// version 2
	$selectableText=preg_replace("/( id='endimt".$textobjectIdThis."_".$wordtextId."'>)/", "$1<div class='detailComponentCommentsTextIcon' onClick=\"textCommentToggle( $textobjectCommentId )\">[]</a>", $selectableText);
//	$selectableText=preg_replace("/( id='endimt".$textobjectIdThis."_".$wordtextId."'>)/", "$1[C]", $selectableText);
	//	$selectableText=preg_replace("/( id='imcommentt".$textobjectIdThis."_".$wordtextId."'>)/", "$1<div style='border: 1px solid black; padding: 5px;'>ABC</div>", $selectableText);

//  id='endimt".$textobjectId."_".$imachinaTextId."'>

	/*
		
		Add Javascript Objects ....
		add objects

	*/

	// version 1.0
	// change text now ... ?
	$strScript="\n<script>";
	preg_match_all("/id='imt([^']+)'/", $selectableText, $arrImachinaIds, PREG_OFFSET_CAPTURE, 3);
	for ($i=0;$i<count($arrImachinaIds[1]);$i++)
	{
		$val=$arrImachinaIds[1][$i][0];
		if ($debugThis) echo("\n<br>-----VAL:".$val);
		$arrVal=explode("_",$val);
		if (count($arrVal)>0) 
		{ 
			$textobjectId=$arrVal[0]; 
			$wordIndex=$arrVal[1]; 
			// echo("\n $textobjectId $wordIndex ");
			$strScript=$strScript."\n imachinaManager.addTextWord( $textobjectId, $wordIndex ); ";
		}
	}

	// $strScript=$strScript."\n console.debug(imachinaManager.debugText()); ";

	$strScript=$strScript."\n imachinaManager.renderTextObjectById(1001);";

	// $strScript=$strScript."\n console.debug(imachinaManager.debugText()); ";

	$strScript=$strScript."\n</script>";

	// text
	echo($selectableText);

	// scripts
	echo($strScript);




	// activate now ... 

	// version 2.0 and remove ... 
	// add onClicks with jquery

	

/*	for ($i=0;$i<count();$i++)
	{

	}*/

	// echo("<pre>");print_r($matches);echo("</pre>");

/*
    echo("<pre>");echo($selectableText);echo("</pre>");

    $xml = new DOMDocument();
    $result=$xml->loadHTML('<?xml encoding="UTF-8">'.'<html><body>Test<br></body></html>');
    $result=$xml->loadHTML($selectableText);

    echo("<hr>*****result: ".$result);
    echo("<pre>"); print_r($xml); echo("</pre>");
	
$elements = $xml->getElementsByTagName('*');
if (!is_null($elements)) {
  foreach ($elements as $element) {
    echo "<br/>". $element->nodeName. ": ";

    $nodes = $element->childNodes;
    foreach ($nodes as $node) {
      echo $node->nodeValue. "\n";
      echo("<br>");
    }
  }
}
*/
    /*
    // $resultImport=$xml->loadHTML($selectableText);
    $resultImport $xml->loadHTMLFile("http://wwww.heise.de"); 
    // echo("<hr>".$$resultImport);
    echo("<pre>"); print_r($xml); echo("</pre>");
	*/
?>
</body>
</html>