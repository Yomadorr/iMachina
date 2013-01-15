<html>

<!-- jquery -->
<script src="jquery.min.js"></script> 

<body>
<?
	


	// test selection ...
    
	?>
	  <style>
	  	.imachinaText { display: inline; /*float: left; */ }
	  	.imachinaTextSelected { display: inline; background; red; }
	  </style>

<?	 
	/*
		
		Selections
	
	*/
	// ok add 
	?>
	<script>
		/*
			Text and Words
		*/	
		var arrWords=new Array();
			
			var TextWord = function()
			{
				var textobjectId=-1;
				var textwordId=-1;
			}

		function addTextWord( textobjectId, wordId )
		{
			var wordObject=new TextWord();
				wordObject.textobjectId=textobjectId;
				wordObject.textwordId=wordId;

			arrWords[arrWords.length]=wordObject;

			return wordObject
		}


		/*
			actual
		*/
		var selectionObjectId=-1;
		var selectionRangeA=-1;
		var selectionRangeB=-1;
		function onTextClick( textobjectId, textId)
		{
			selectionObjectId=textId;
			if (selectionRangeA==-1) selectionRangeA=textId;
			else
			{
				if (selectionRangeA!=-1) 
				{
					/*
					if (selectionRangeA<selectionRangeB) selectionRangeB=textId;
					else
					if (selectionRangeA>selectionRangeA) selectionRangeA=textId;
					*/
					selectionRangeB=textId;
				}
			}
			// alert("onTextClick( "+textobjectId+","+ textId+")");

			showTextSelection();
		}

			function showTextSelection( textobjectId ) // todo: implement textobjectId
			{
				// remove all selections


				// add css on this!!
				// alert("   "+selectionRangeA+"   "+selectionRangeB);
				var wordObject;
				var inSelection=false;
				for (var z=0;z<arrWords.length;z++)
				{
					wordObject=arrWords[z];
					var divId="imt"+wordObject.textobjectId+"_"+wordObject.textwordId;
					// if (z==0) alert("   "+divId);
					// start now 
					// $('#'+divId).addClass("imachinaTextSelected");
					if (selectionRangeA==wordObject.textwordId)
					{
						$('#'+divId).css("background","red");
						inSelection=true;
					}

					// go to there
					if (selectionRangeB!=-1)
					{
						// go to there!
						if (inSelection)
						{
							$('#'+divId).css("background","red");
						}
						if (selectionRangeB==wordObject.textwordId)
						{
							inSelection=false;
						}

					}
				}

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
    $selectableText="<imachinaTextDiv>"."Das ist der Weg hinab ins Ungewisse. <br> Was <div class='imachinaText' id='imt".$textobjectId."_16' imachinaTag>meinstdu</div> Du <a href=''>alte Fettel</a>. Der Weg tötet. <div class='imachinaText' id='imt".$textobjectId."_20' imachinaTag>Die Welt ist da!</div>. Er macht sie ferti bis aufs <span>Blut</span> zerwuerrgte Zeit. "."</imachinaTextDiv>";
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
							if (($isInSystem)&&($wordIndex==0)) { $strReplace=$strReplace.$singleWord.""; } // end div in original!

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
			return "<div class='imachinaText'  id='imt".$textobjectId."_".$imachinaTextId."' imachinaTag>".$word."</div>";
		}


	/*
		add div layer and selection staff here ...
	*/
	// add layers here?
	
	// add on click script here manualy ...
//	preg_replace("/id='imt([^']+)'/", $selectableText, $arrImachinaIds, PREG_OFFSET_CAPTURE, 3);
	// $selectableText=preg_replace("/(Weg)/","$1---", $selectableText);


	/*
		
		Add Objects ....
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
			$strScript=$strScript."\n addTextWord( $textobjectId, $wordIndex ); ";
		}
	}
	$strScript=$strScript."\n</script>";

	


			// replace ...
			// onClick=\"onTextClick( $textobjectId, $imachinaTextId)\"


	echo($selectableText);

	// 



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