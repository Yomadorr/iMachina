<?php
	
	// debugging?
	$debugAll=false;
		$debugXMLTextToSentences=false;
		$debugSentencesToWord=false;
		$debugWordLines=false;
		$debugJavascriptMenu=false;
		
	if ($debugAll)
	{
		$debugXMLTextToSentences=true;
		$debugSentencesToWord=true;
		$debugWordLines=true;
		$debugJavascriptMenu=true;
	}
	if (!$debugAll)
	{
		$debugXMLTextToSentences=false;
		$debugSentencesToWord=false;
		$debugWordLines=false;
		$debugJavascriptMenu=false;
	}

	// debug something special
	$debugJavascriptMenu=false;



	// include instance
	include("./appinstance.php");

	// check for admin
	include("./includes/checkaccess.admin.php");

	// start
	include("./includes/header.inc.php");

?>
<h2>Admin: Fremdbeurteilung</h2>
<?php

/*
------------------------------------------------------------------------------------------------------------

 CONVERSION TEXTEDITOR-TEXT TO TAGGED-TEXT (PHP)
 Convert tinyMCE-text to tagged text
 
------------------------------------------------------------------------------------------------------------
*/

  // input  
  $text="<p><strong>Der Text ist der Titel</strong></p>\n<p>Ich stehe die <strong>Welt</strong> gut an</p>\n<p>&nbsp;</p>\n<p><strong>Der Weg ist gross!</strong></p>\n<p><strong><br /></strong>Nein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! <br />Nein<strong>Nein </strong>Nein!<br /> NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! Nein</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Hmmm</p>\n";
  
	// content
	if (isset($_REQUEST["content"]))
	{
		$text="".$_REQUEST["content"];

	}
	
	/*
		special conversion
	*/
	// <p></p> > <br>
	$text=str_replace("<p></p>","<br />",$text);

  $text="<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><html><body>".$text."</body></html>";

  // up
  $text=str_replace("\n","",$text);
  $text=str_replace("\r","",$text);


// echo($text);
/*

<p><strong>Der Text ist der Titel</strong></p>
<p>Ich stehe die <strong>Welt</strong> gut an</p>
<p>&nbsp;</p>
<p><strong>Der Weg ist gross!</strong></p>
<p><strong><br /></strong>Nein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! <br />NeinNein Nein! NeinNein <br />Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! Nein</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Hmmm</p>

</p> > return
<br /> > 

lines > 


<p><strong>Der Text ist der Titel</strong></p>
<p>Ich stehe die <strong>Welt</strong> gut an</p>
<p>&nbsp;</p>
<p><strong>Der Weg ist gross!</strong></p>
<p><strong><br /></strong>Nein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! N</p>
<p>ahaha!!</p>
<p>einNein Nein! NeinNein Nein! <strong>NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein N</strong>ein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! NeinNein Nein! Nein</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Hmmm</p>

*/

// html ..
$domDocument = new DOMDocument();
$domDocument->loadHTML($text);
// $domDocument->loadHTML("<html><body /></html>");

//use DOMXpath to navigate the html with the DOM
/*
$dom_xpath = new DOMXpath($dom_document);
print_r($dom_xpath);
// if you want to get the div with id=interestingbox
$elements = $dom_xpath->query("*\/div[@id='interestingbox']");
if (!is_null($elements)) {

  foreach ($elements as $element) {
    echo "\n[". $element->nodeName. "]";

    $nodes = $element->childNodes;
    foreach ($nodes as $node) {
      echo $node->nodeValue. "\n";
    }

  }
}
*/
/*
$domDocumentElements = $domDocument->documentElement;
for($i=0; $i<$domDocumentElements->childNodes->length; $i++)
{
    $tag = $domDocumentElements->childNodes->item($i);
    echo("<br>".$i." ".$tag->nodeName);
    
}
*/

/*
	------------------------------------------------------------------------
	CONVERT TEXT TO XML-TAGGED-TEXT
	------------------------------------------------------------------------
	
*/

// PREFERENCES
$lineLength=80;


/*
	------------------------------------
	CONVERT XML-DOM TO SENTENCE PART
	------------------------------------
	
	TINYMCE (BOLD ETC)
	
	Bsp:
	<P>ich gehe <strong>nach zb</strong> hause</P>
	>
	ich gehe
	nach zb{strong}
	hause
	{return}

*/


if ($debugXMLTextToSentences)
{
	echo("<hr>");
	echo("<strong>CONVERT XMLDOM TO SENTENCES</strong>");
	echo("<hr>");
}

// ...
class PartSentence
{
	var $partSentence="";	
	var $partNewSentenceFlag=false;
	var $partSentenceBold=false;
	
	var $partSentenceSpaceAfterwards=false; // 
	
	// var $partSpecialTag="strong";
}
$arrPartSentences=array();

// body ...
$domDocumentElements = $domDocument->documentElement;
$body = $domDocumentElements->childNodes->item(0);
recursiveInTag( $body, 0, "", 0 );

function recursiveInTag( $tag, $depth, $strCsv, $lastSentenceFlag )
{
	global $arrPartSentences, $debugXMLTextToSentences;
	
	$spacer="";
    for ($t=0;$t<$depth;$t++) $spacer=$spacer."*";
    if ($debugXMLTextToSentences) echo("<br>[".$strCsv." ]".$spacer." ".$tag->nodeName."=".$tag->nodeValue." {".$lastSentenceFlag."}");
    
    $strNewCsv="".$strCsv." ".$tag->nodeName;

	// br ?
	if ($tag->nodeName=="br")
    {
       if ($debugXMLTextToSentences) echo("<hr>BR<hr>");
   	
   	   $obj=new PartSentence();
       $obj->partNewSentenceFlag=true;
       $arrPartSentences[count($arrPartSentences)]=$obj;
    }

	// text    
    if ($tag->nodeName=="#text")
    {
       if ($debugXMLTextToSentences) echo("<hr>".$tag->nodeValue."<hr>");
       
       // it it is a p
       // $lastSentenceFlag
       // sentence
      
       
       // add a word
	   $obj=new PartSentence();
       $obj->partNewSentenceFlag=false;
       // bold?
       if (stristr($strCsv,"strong")) $obj->partSentenceBold=true;
       if (stristr($strCsv,"bold")) $obj->partSentenceBold=true;
       
       $obj->partSentence="".$tag->nodeValue;
       $arrPartSentences[count($arrPartSentences)]=$obj;    
    
     if ($lastSentenceFlag)
       {
       		$obj=new PartSentence();
       		$obj->partNewSentenceFlag=true;
       		$arrPartSentences[count($arrPartSentences)]=$obj;
       }
    
    }
    
    // todo: br!
    
	if ($tag->childNodes)
	for($i=0; $i<$tag->childNodes->length; $i++)
	{
	    $tagObj = $tag->childNodes->item($i);
    	// print_r($tagObj);
    	
    		$nextDepth=$depth+1;
    		$flag=false;
    		if ($tagObj->nodeName=="p") $flag=true;
    		if ($i==($tag->childNodes->length-1))
    		{
    			if ($lastSentenceFlag) $flag=true;
    		}
	    	recursiveInTag( $tagObj, $nextDepth, $strNewCsv, $flag);
	}
}

// show here ..
if ($debugXMLTextToSentences)
{
	echo("<hr>");
	echo("<pre>");
	print_r($arrPartSentences);
	echo("</pre>");
	echo("<hr>");
}

// generate it now
if ($debugXMLTextToSentences)
{
	for ($p=0;$p<count($arrPartSentences);$p++)
	{
		$sobj=$arrPartSentences[$p];
	
		if (!$sobj->partNewSentenceFlag)
		{
			if ($sobj->partSentenceBold) echo("<strong>");
			echo("".$sobj->partSentence);
			if ($sobj->partSentenceBold) echo("</strong>");
		}
		if ($sobj->partNewSentenceFlag)
		{
			echo("<br>");
		}
	}
}


/*
	------------------------------
	CONVERT TO WORDS
	------------------------------
	
	WORD1 WORD2 WORD 3

*/
if ($debugSentencesToWord)
{
	echo("<hr>");
	echo("<strong>CONVERTOWORDS</strong>");
	echo("<hr>");
}
$arrWordElement=array();

	class Word
	{
		var $wordValue="";
		var $wordReturn=false;
		var $wordStrong=false;
	}
	
	function addWord( $wordObj )
	{
		global $arrWordElement;
		
		$arrWordElement[count($arrWordElement)]=$wordObj;
	}

// break into words ...
// an too long lines ...
// generate it now

for ($p=0;$p<count($arrPartSentences);$p++)
{
	$sobj=$arrPartSentences[$p];
	if (!$sobj->partNewSentenceFlag)
	{
			// sentence ...
			$sentence="".$sobj->partSentence;
	
			// split here ..		
			$arrW=explode(" ",$sentence);
			// print_r($arrW);
			// satzzeichen?
			// > make a word out of it
			
			$strLine="";
			for ($m=0;$m<count($arrW);$m++)
			{
				$strWord=$arrW[$m];
				
				// the word
				$wordValue="".$strWord;
			
				// todo: , ; . : ?
				
				// add return / wrap here?
				$newStrLine=$strLine." ".$wordValue;
				if (strlen($newStrLine)>$lineLength)
				{
					// add a return
					$obj=new Word();
					$obj->wordReturn=true;
					addWord( $obj );
					
					$newStrLine="";
					$strLine="";
				}
			
				$strLine=$strLine." ".$wordValue;
				
				// add text
				$obj=new Word();
				$obj->wordValue="".$wordValue;
				if ($sobj->partSentenceBold) $obj->wordStrong=true;
				addWord( $obj );
			
					// add a space 
					$obj=new Word();
					$obj->wordValue=" ";
					$obj->wordReturn=false;
					addWord( $obj );
					
				// todo: too long? ...
				// return ...
				
				
			}
		
	}
	if ($sobj->partNewSentenceFlag)
	{
		// echo("<br>");
		$obj=new Word();
		$obj->wordReturn=true;
		addWord( $obj );
		$newStrLine=""; // ???
	}
	
}

// debug here
if ($debugSentencesToWord)
{
	$lineCounter=1;
	for ($u=0;$u<count($arrWordElement);$u++)
	{
		$wordObj=$arrWordElement[$u];
		
		// words 
		if (!$wordObj->wordReturn)
		{
			// strong?
			if ($wordObj->wordStrong) echo("<strong>");
				echo($wordObj->wordValue);
			if ($wordObj->wordStrong) echo("</strong>");
		}
		
		if ($wordObj->wordReturn)
		{
			// new line
			echo("<br>$lineCounter: ");
			$lineCounter++;
		}
		
	}
}


// ----------------------------------
// CONVERT WORDS TO LINES
// ----------------------------------
if ($debugWordLines)
{
	echo("<hr>");
	echo("<strong>CONVERT BACK TO WORDS</strong>");
	echo("<hr>");
}

$arrLines=array();

	// todo: extends ...
	class WordInLine extends Word
	{
		
		var $wordPunctuationMark=false;
		
		var $wordIndex=-1; // absolute
		
		var $wordIndexLine=-1; // which row
		var $wordIndexInLine=-1; // in line ...
	}
	
	function addWordInLine( $wordInLineObj )
	{
		global $arrLines;
		$arrLines[count($arrLines)]=$wordInLineObj;
	}
	
	$wordIndex=0;
	function getWordIndexNext()
	{
		global $wordIndex;
		
		return $wordIndex++;
		
	}


	// count lines ...
	$lineCounter=0;
		$lineCounterWord=0;
	$arrLine=array();	
	for ($u=0;$u<count($arrWordElement);$u++)
	{
		$wordObj=$arrWordElement[$u];
		
		// words 
		if (!$wordObj->wordReturn)
		{
			// strong?
			// echo($wordObj->wordValue);
			
						// add old line ...
			
			$foundPunctuationMark=false;
			// found .
			/*if (strstr(".","".$wordObj->wordValue)) 
			{
				
			}
			*/
			
			// has punctuation mark inside ...
			if ($foundPunctuationMark)
			{
				// add raw word
				
			}
			
			// simple word
			if (!$foundPunctuationMark)
			{ 
				// a mark there ..
				 $wordInLineObject=new WordInLine();

				 $wordInLineObject->wordValue=$wordObj->wordValue;
				 $wordInLineObject->wordReturn=$wordObj->wordReturn;
				 $wordInLineObject->wordStrong=$wordObj->wordStrong;
				 $wordInLineObject->wordValue=$wordObj->wordValue;
				 
				 $wordInLineObject->wordIndex=getWordIndexNext();
				 
				 $wordInLineObject->wordIndexLine=$lineCounter; 
			 	 $wordInLineObject->wordIndexInLine=$lineCounterWord;
				
				$arrLine[count($arrLine)]=$wordInLineObject;
			 	
			 	
			 	$lineCounterWord++;
			}
			
			
			
			
		}
		
		if ($wordObj->wordReturn)
		{
			// new line
			// echo("<br>--$lineCounter: ");
			$lineCounter++;

		 	// add array ... 
		 	addWordInLine($arrLine);
		 	
		 	// new line here ...
			$arrLine=array();
			$lineCounterWord=0;
		}
		
	}

// show them now
if ($debugWordLines)
{
	for ($t=0;$t<count($arrLines);$t++)
	{
		echo("<hr>");
		$arrLineObj=$arrLines[$t];
		for ($a=0;$a<count($arrLineObj);$a++)
		{
			$wordInLineObj=$arrLineObj[$a];
			echo("<div style='display:inline; border: 1px solid; '>".$wordInLineObj->wordValue."<div style='display:inline;font-size: 14px;'>(".$wordInLineObj->wordIndex.":".$wordInLineObj->wordIndexLine."/".$wordInLineObj->wordIndexInLine.")</div>");
//			echo($wordInLineObj->wordValue);
		}
	}
}

// text .....
if (false)
{
	echo("<hr>");
	echo("<pre>".$text."</pre>"); 
	echo("<hr>");
}


/*
------------------------------------------------------------------------------------------------------------

 SCRIPT AREA (Javascript)
 
------------------------------------------------------------------------------------------------------------

// div-composition
evaluationText
{
	line0-100
	{
		lineNumber0-x { }
		lineWords0-x 
		{ 
			lineWordIdx { }
			lineWordId_LineX_WordInLineY { }
		}
		lineComments0-x { }
	}
}

*/
?>
<style>

	.classEvaluationConfig { background: #eeeeee; border: 1px solid black; _width: 800px; padding-bottom: 10px; }
	.classEvaluationConfigSpacer { height: 30px; }
	.classEvaluationText { background: #ffffff; border: 1px solid; _width: 800px; }
	.classEvaluationTextClear { background: #ffffff; border: 1px solid; _width: 900px; background: #cc000000; }
		.classEvaluationTextLine { border-bottom: 1px solid black; }
			.classEvaluationTextLineIndex {  display:inline; alignment: left; width: 100px; alignment: right; border: 1px solid black; text-align:right; }
			.classEvaluationTextLineWordEntity { display:inline; _border: 1px black dotted; alignment: left; size: 14px; padding:0px; border:0px;}
			.classEvaluationTextLineWordEntityClear { display:inline; alignment: left; size: 10px; padding:0px; border:0px;}
				.classEvaluationTextLineWordEntityIndex { display:inline;  padding:0px; padding-right: 0px; font-size: 9px; vertical-align: top; padding:0px; border:0px;}
			.classEvaluationTextLineComment { display:inline; background: #ffffff; border: 1px solid dotted; padding:0px; border:0px;}
			.classEvaluationTextLineComment { display:inline; font-size: 12px; color: #777777; border-bottom: 1px solid; padding:0px; border:0px;}
</style>

<script>

/*

   library scripts

*/
  
  	/*
		HELPERS
	*/
	// Extended Things
	// Helpfull things
	Array.prototype.remove = function(from, to) {
	  var rest = this.slice((to || from) + 1 || this.length);
	  this.length = from < 0 ? this.length + from : from;
	  return this.push.apply(this, rest);
	};
  
  	/*
  		hrefVoid
  	*/
  	function hrefVoid()
  	{
  		return ;
  	}
  

/*

   library scripts

*/
// javascript-composition
/*
	// complex
	arr[]=
	{
		arrWords{}
		arrWords{}
		arrWords{}
	}
	arrIndex[]={}
	
*/
var arrLines=new Array();
var arrWordInLinesIndex=new Array();
	
	   var Word = function( )
	   {
	   		this.wordValue="";
	   		
	   		this.wordLine=-1;
	   		this.wordInLineIndex=-1;
		}
		
		// add objects only in the correct order ...
	    var actualArray=new Array();
		function addWord( wordObj, lineIndex )
		{
			if (lineIndex>arrLines.length)
			{
				arrLines[arrLines.length]=actualArray;
				actualArray=new Array();
			}
			actualArray[actualArray.length]=wordObj;
			arrWordInLinesIndex[arrWordInLinesIndex.length]=wordObj;	
		}
		function addLastWord()
		{
			arrLines[arrLines.length]=actualArray;
		}

/*
	WordIndex
*/
// toggleWordIndexDisplay
function toggleWordIndexDisplay()
{
	// alert("abc");
	// alert("length: "+arrWordInLinesIndex.length+"  lines:"+arrLines.length);
	// version 1.0
	/*
	var s="";
	var obj;
	for (var z=0;z<arrWordInLinesIndex.length;z++)
	{
		obj=arrWordInLinesIndex[z];
		s=s+" "+obj.wordValue;
	}
	alert(""+s);
	*/
	var s="";
	var arrObj;
	var obj;
	for (var z=0;z<arrLines.length;z++)
	{
		arrObj=arrLines[z];
		s=s+"\n"+arrObj.length+": ";
		// lock for the objects
		
		for (var zz=0;zz<arrObj.length;zz++)
		{
			obj=arrObj[zz];
			s=s+obj.wordValue+" ("+obj.wordLine+"/"+obj.wordInLineIndex+")";
		
			var strIndex="_"+obj.wordLine+"_"+obj.wordInLineIndex;
			var divId="evaluationTextLineWordEntity"+strIndex;
			$('#'+divId).toggleClass(".classEvaluationTextLineWordEntity", ".classEvaluationTextLineWordEntityClear");
			var divIdIndex="evaluationTextLineWordEntityIndex"+strIndex;
			$('#'+divIdIndex).toggle();
			s=s+divIdIndex;
		}
	}
	$('#evaluationText').toggleClass(".classEvaluationText",".classEvaluationTextClear");
	
	// alert(""+s);
}

</script>
<!-- insert query -->

<body >
<?

// show text ...

// config
echo("<div id='evaluationConfig' class='classEvaluationConfig'>");
echo("CONFIG");
echo(" <a href='javascript:hrefVoid()' onClick='toggleWordIndexDisplay()'>[ Wortz&auml;hlung ]</a> ");
echo("</div>");

echo("<div class='classEvaluationConfigSpacer'></div>");

echo("<div id='evaluationText' class='classEvaluationText'>");

$displayAsTable=true;

if ($displayAsTable) echo("<table border=0px >");
for ($t=0;$t<count($arrLines);$t++)
{
	$arrLineObj=$arrLines[$t];
	$wordIndexLine=-1;
	
	// line
	if ($displayAsTable) echo("<tr>");
		// words
		if ($displayAsTable) echo("<td valign=top align=right>");
		echo("\n<div id='textLineIndex".$t."' class='classEvaluationTextLineIndex'>$t.</div>");
		if ($displayAsTable) echo("</td>");

		// word in index
		$wordIndexLine=$t;
		$wordIndexInLine=0;
			
		// div line
		echo("\n<div id='textLine".$t."' class='classEvaluationTextLine'>");
		if ($displayAsTable) echo("<td valign=top>");
		for ($a=0;$a<count($arrLineObj);$a++)
		{
			$wordInLineObj=$arrLineObj[$a];
			
			// version 1.0
			/*
			$wordIndexLine=$t;
			$wordIndexInLine=$a;
			*/
			
			// version 2.0
			$wordIndexLine=$wordInLineObj->wordIndexLine;
			$wordIndexInLine=$wordInLineObj->wordIndexInLine;
			
			// add for scripting here
			echo("\n<script>");
			echo("\n  var obj=new Word();");
			echo("\n  obj.wordValue=\"".$wordInLineObj->wordValue."\";");
			echo("\n  obj.wordLine=\"".$wordIndexLine."\";");
			echo("\n  obj.wordInLineIndex=\"".$wordIndexInLine."\";");
			echo("\n  addWord( obj, $t );");
			echo("\n</script>");

			$wordIndex="_".$wordIndexLine."_".$wordIndexInLine;
			echo("\n<div id='evaluationTextLineWordEntity$wordIndex' class='classEvaluationTextLineWordEntity'  onClick=\"selectWord('neutral',".$wordIndexLine.",'".$wordIndexInLine."');\" >");
			if ($wordInLineObj->wordStrong) echo("<strong>");
				echo("".$wordInLineObj->wordValue);
			if ($wordInLineObj->wordStrong) echo("</strong>");
			
			echo("<div id='evaluationTextLineWordEntityIndex$wordIndex' class='classEvaluationTextLineWordEntityIndex'>".$wordInLineObj->wordIndexInLine."</div>");
			echo("\n</div>");

			// echo("<div style='display:inline; border: 1px solid; '>".$wordInLineObj->wordValue."<div style='display:inline;font-size: 14px;'>(".$wordInLineObj->wordIndex.":".$wordInLineObj->wordIndexLine."/".$wordInLineObj->wordIndexInLine.")</div>");
			// echo($wordInLineObj->wordValue);
		}
			// line
		echo("\n</div>");
		if ($displayAsTable) echo("</td>");

		// up/down
		if ($displayAsTable) echo("<td valign=top><a href='javascript:hrefVoid()' onClick=\"selectWord('start',".$wordIndexLine.",-1);\"><img src='imgs/cursorstart.png' border=0></a></td>");
		if ($displayAsTable) echo("<td valign=top><a href='javascript:hrefVoid()' onClick=\"selectWord('stop',".$wordIndexLine.",-1);\"><img src='imgs/cursorstop.png' border=0></a></td>");

		// comments
		if ($displayAsTable) echo("<td valign=top><div id='evaluationTextLineComment_$wordIndexLine' class='classEvaluationTextLineComment'></div></td>");
			

	if ($displayAsTable) echo("</tr>");
	
}
if ($displayAsTable) echo("</table>");
echo("</div>");

echo("<script>addLastWord();</script>");

/*
	Comments
*/
?>
<script>
 /*
  	
  		Comments
  
  */
  commentId=1;
  var arrComments=new Array();
  
  	   // comment 
	   var Comment = function( )
	   {
	   		// text-ref
	   		this.refToText=-1; // ref to the original text ... 
	   
	   		// this.newobject=true;
	   		this.id=-1;
	   
			this.comment="";
			
			// sentence
			this.sentenceReferenceStart=-1; // line
			this.sentenceReferenceStartWord=-1; // word in line
			this.sentenceReferenceStop=-1; // line
			this.sentenceReferenceStopWord=-1; // word in line
			
			this.category=-1; // no category!
			
			// updateTo
			this.updateTo = function( copyCommentObject )
			{
				this.id=copyCommentObject.id;
				
				this.sentenceReferenceStart=copyCommentObject.sentenceReferenceStart;
				this.sentenceReferenceStartWord=copyCommentObject.sentenceReferenceStartWord;
				this.sentenceReferenceStop=copyCommentObject.sentenceReferenceStop;
				this.sentenceReferenceStopWord=copyCommentObject.sentenceReferenceStopWord;

				this.comment=copyCommentObject.comment;

				this.category=copyCommentObject.category;
			}
			

		}
		
	
		// add comment
		function addComment( newCommentObj )
		{
			commentId++;
			newCommentObj.id=commentId;
			arrComments[arrComments.length]=newCommentObj;
			
			// update ..
			displayComments(); // ..
			
		}

		// add comment by value
		function addCommentByValue( start, startWord, stop, stopWord, comment )
		{
			var newComment=new Comment();
			newComment.sentenceReferenceStart=start;
			newComment.sentenceReferenceStartWord=startWord;
			newComment.sentenceReferenceStop=stop;
			newComment.sentenceReferenceStopWord=stopWord;
			newComment.comment=comment;
			addComment( newComment );
			
			return newComment;
		}

		// getCommentById
		function getCommentById( commentId )
		{
			var z=0;
			var commentObj;
			for (z=0;z<arrComments.length;z++)
			{
				commentObj=arrComments[z];	
				if (commentObj.id==commentId)
				{
					return commentObj;
				}
			}
			
			return false;
		}
		
		// getCommentIndexById
		function getCommentIndexById( commentId )
		{
			var z=0;
			var commentObj;
			for (z=0;z<arrComments.length;z++)
			{
				commentObj=arrComments[z];	
				if (commentObj.id==commentId)
				{
					return z;
				}
			}
			
			return -1;
		}
	
	// display comments
	function displayComments()
	{
		// display them now !!!
		// and here ..
		// alert(" displayComments() "+arrComments.length);
		
		// display comments
		clearComments();
		displayCommentsInLines();
		
		// display underline in text
		clearUnderlineInCommentsInText();
		displayUnderlineInCommentsInText();
		
		<?
		   if ($debugJavascriptMenu)
		   {
		     echo("\n    // debugging weapp ");
		     echo("\n    debugJavascriptApp();");
		   }
		?>
	}
		
			function displayCommentsInLines()
			{
				// alert("displayCommentsInLines()");
				
				// add the comments here ..
				var obj;
				var commentObj;
				for (var z=0;z<arrLines.length;z++)
				{
					// version 1.0
					for (var c=0;c<arrComments.length;c++)
					{
						commentObj=arrComments[c];
						if (commentObj.sentenceReferenceStart==z)
						{
							displayCommentObject(commentObj);
						}
					}
			
					/* 
					// version 2.0
					
					arrObj=arrLines[z];
					
					for (var zz=0;zz<arrObj.length;zz++)
					{
						// version 1.0
						obj=arrObj[zz];
						var divId=obj.wordLine;
						
						// case 1: there is something in this line 
						// case 2: there is nothing in this line
						
						// case 1: something in this line
						if (arrComments.length>1)
						{
							// comment here?
							for (var c=0;c<arrComments.length;c++)
							{
								commentObj=arrComments[c];
								if (obj.wordLine==commentObj.sentenceReferenceStart)
								{
									displayCommentObject(commentObj);
								}
							}
							
							break;
					 	}
					 	// case 2: nothing in this line
					 	if (arrComments.length==0)
						{
							// classic way ..
							for (var c=0;c<arrComments.length;c++)
							{
								commentObj=arrComments[c];
								if (obj.wordLine==z)
								{
									displayCommentObject(commentObj);
								 	
								}
							}
							break;
						}
					 	
					}
					*/
				}
			}
					
						function displayCommentObject( commentObj )
						{
								// alert("--"+commentObj.comment);
								var divIdLine="evaluationTextLineComment_"+commentObj.sentenceReferenceStart;
								  
								// add here and now!!
								var strComment=""+$('#'+divIdLine).html();	
								$('#'+divIdLine).html(strComment+"<div class='classEvaluationTextLineComment'><a  href='javascript:hrefVoid()' onClick=\"displayCommentInInspector("+commentObj.id+")\"><img src='imgs/comment.png' border=0>"+commentObj.comment+"</a></div>   ");
						}
			
			// comments in text
			// ________
			function displayUnderlineInCommentsInText()
			{
				// alert("displayCommentsInLines()");
				for (var c=0;c<arrComments.length;c++)
				{
					commentObj=arrComments[c];
					displayUnderlineCommentObjectInText(commentObj);
				}
				
			}	
					function displayUnderlineCommentObjectInText( commentObj )
					{
						var posStart=getStartPositionNormalized( commentObj, "start" );
						var posStop=getStartPositionNormalized( commentObj, "stop" );
					
						var arrObj;
						var obj;
						var pos;
						for (var z=0;z<arrLines.length;z++)
						{
							arrObj=arrLines[z];
							for (var zz=0;zz<arrObj.length;zz++)
							{
								obj=arrObj[zz];
								
								
								pos=generateIndex(obj.wordLine,obj.wordInLineIndex);
								
								if ((posStart<=pos)&&(pos<=posStop))
								{
									var strIndex="_"+obj.wordLine+"_"+obj.wordInLineIndex;
									var divId="evaluationTextLineWordEntity"+strIndex;
									$('#'+divId).css("text-decoration","underline");
								}
							}
						}
					}
						
							/*
								normalized
							*/
							function getStartPositionNormalized( commentObj, strType )
							{
								if (strType=="start") return generateIndex(commentObj.sentenceReferenceStart,commentObj.sentenceReferenceStartWord,strType);
								else return generateIndex(commentObj.sentenceReferenceStop,commentObj.sentenceReferenceStopWord,strType);
							}
							
								// generate index 
								// generate(10,5,"stop");
								function generateIndex( line, word, strType ) 
								{
									var posWord=parseInt(word);
										if (strType=="start") { if (posWord==-1) posWord=0; }
										// todo: not so simple
										if (strType=="stop") { if (posWord==-1) posWord=1000; }
									var pos=parseInt(line*1000)+posWord;
									return pos;
								}
					
			
				// clearUnderlineInCommentsInText
				function clearUnderlineInCommentsInText()
				{
					var arrObj;
					var obj;
					for (var z=0;z<arrLines.length;z++)
					{
						arrObj=arrLines[z];
						for (var zz=0;zz<arrObj.length;zz++)
						{
							obj=arrObj[zz];
							
							var strIndex="_"+obj.wordLine+"_"+obj.wordInLineIndex;
							var divId="evaluationTextLineWordEntity"+strIndex;
							$('#'+divId).css("text-decoration","");
						}
					}
				}
	
	function clearComments()
	{
			var arrObj;
			var obj;
			for (var z=0;z<arrLines.length;z++)
			{
				arrObj=arrLines[z];
				for (var zz=0;zz<arrObj.length;zz++)
				{
					// version 1.0
					obj=arrObj[zz];
					var divId="evaluationTextLineComment_"+obj.wordLine;
					$('#'+divId).css("background", "#ffffff");			
					$('#'+divId).html("");	
						// clean comments
						var divIdLineComment="evaluationTextLineComment_"+obj.wordLine;
						$('#'+divIdLineComment).html("");	
					
					// version 2.0
					/*
					var divId="evaluationTextLineComment_"+z;
					$('#'+divId).css("background", "#ff0000");			
					$('#'+divId).html("abc");
					*/
					
					
					break;
				}
			}
	}
		

/*

	ACTUAL COMMENT

*/
var actualComment=new Comment();
var actualCommentAsString=""; // as string ...		

/*
	SELECTION
	{ COMMENT  PART OF SELECTION }

*/
var nextSelection=""; // start / end ?

// start selection
function startSelection()
{
	nextSelection="start";
}

// used in ... 
function selectWord(type,lineIndex,wordInLineIndex)
{
	// debug
	// alert(" "+type+" "+lineIndex+"/"+wordInLineIndex);
	
	

	// direct
	// most used in line selection
	if (type=="start")
	{
			selectWordExtended("start",lineIndex,wordInLineIndex);
			
			// lines - first selection
			if (actualComment.sentenceReferenceStop==0)
			if (wordInLineIndex==-1)
			{
				selectWordExtended("stop",lineIndex,wordInLineIndex);
			}
			
			// selected line ..
			if (wordInLineIndex==-1) { actualComment.sentenceReferenceStart }
			

	}
	if (type=="stop")
	{
			selectWordExtended("stop",lineIndex,wordInLineIndex);
			// selected line ..
			if (wordInLineIndex==-1) { actualComment.sentenceReferenceStart }

			// if a<b toggle ...
			var posStart=getStartPositionNormalized(actualComment,"start");
			var posStop=getStartPositionNormalized(actualComment,"stop");
			if (posStart>posStop)
			{
				var oldActualComment=new Comment();
				oldActualComment.updateTo(actualComment);
				// version 1
				actualComment.sentenceReferenceStart=oldActualComment.sentenceReferenceStop;
				actualComment.sentenceReferenceStartWord=oldActualComment.sentenceReferenceStopWord;
				actualComment.sentenceReferenceStop=oldActualComment.sentenceReferenceStart;
				actualComment.sentenceReferenceStopWord=oldActualComment.sentenceReferenceStartWord;
			}


	}


	
	// go on on yourself
	if (type=="neutral") 
	{   
		if (nextSelection=="start")
		{
			selectWordExtended("start",lineIndex,wordInLineIndex);
			selectWordExtended("stop",lineIndex,wordInLineIndex);
			nextSelection="stop";
		}
		else
		{
			selectWordExtended("stop",lineIndex,wordInLineIndex);
			// do now the selection ...
			nextSelection="change";
		}

	}

	/*
	
		CHANGING (HARMONISE)
		LINESELECTION OR WORDSELECTION
		- type of selection
	
	*/
	
	// changing 
	//  case wordToLine: word -> line
	//  case LineToWord: line -> word
	//  case wordToLine: word -> line
	if (wordInLineIndex==-1)
	{
		if (actualComment.sentenceReferenceStartWord!=-1)
		{
			actualComment.sentenceReferenceStartWord=-1;
		}
		if (actualComment.sentenceReferenceStopWord!=-1)
		{
			actualComment.sentenceReferenceStopWord=-1;
		}		
	}
	//  case LineToWord: line -> word
	if (wordInLineIndex!=-1)
	{
		if (actualComment.sentenceReferenceStartWord==-1)
		{
			actualComment.sentenceReferenceStartWord=0;
		}
		if (actualComment.sentenceReferenceStopWord==-1)
		{
			actualComment.sentenceReferenceStopWord=0;
		}
	}
	
	// cases around
	if (nextSelection=="change")
	{
		var posStart=getStartPositionNormalized(actualComment,"start");
		var posStop=getStartPositionNormalized(actualComment,"stop");
		var posNew=generateIndex( lineIndex, wordInLineIndex, "start" );
		var posMiddle= posStart+(posStop - posStart)/2 
		// alert("posMiddle ("+posStart+"/"+posStop+") posMiddle="+posMiddle+", posNew="+posNew+")");
		// case: <posMiddle
		if (posNew<posMiddle)
		{
			actualComment.sentenceReferenceStart=lineIndex;	
			actualComment.sentenceReferenceStartWord=wordInLineIndex;	
		}
		else
		{
			actualComment.sentenceReferenceStop=lineIndex;	
			actualComment.sentenceReferenceStopWord=wordInLineIndex;	
		}
		// case: >posMiddle
	}		
	
	
	// actualComment.sentenceReferenceStart
	
	// display 
	displaySelection();
	
	// alert("selectWord() "+actualComment.sentenceReferenceStart+"."+actualComment.sentenceReferenceStartWord+"   "+actualComment.sentenceReferenceStop+"."+actualComment.sentenceReferenceStopWord);
	
	// display 
	displayCommandLine();
	
}		
	function selectWordExtended(typePosition,lineIndex,wordInLineIndex)
	{
		if (typePosition=="start")
		{
			actualComment.sentenceReferenceStart=lineIndex;
			actualComment.sentenceReferenceStartWord=wordInLineIndex;
		}
		if (typePosition=="stop")
		{
			actualComment.sentenceReferenceStop=lineIndex;
			actualComment.sentenceReferenceStopWord=wordInLineIndex;
		}
	}
	
	/*
	    UpdateDisplay *
	    1. Seleciton
	    2. Comments
	    
	*/
	
	/*
		Selection
	*/
	// showSelection
	function displaySelection()
	{
		// alert("displaySelection()");
		// alert("displaySelection() start("+actualComment.sentenceReferenceStart+"/"+actualComment.sentenceReferenceStartWord+") stop("+actualComment.sentenceReferenceStop+"/"+actualComment.sentenceReferenceStopWord+")");
		
		
		// clear selection
		clearSelection();
		
		// generate ...
		// start/stop
		var arrObj;
		var obj;
		
		// version 1.0
		// var posActualStart=parseInt(actualComment.sentenceReferenceStart)*1000+parseInt(actualComment.sentenceReferenceStartWord);
		// var posActualStop=parseInt(actualComment.sentenceReferenceStop)*1000+parseInt(actualComment.sentenceReferenceStopWord);
		
		// version 2.0
		var posActualStart=getStartPositionNormalized(actualComment,"start");
		var posActualStop=getStartPositionNormalized(actualComment,"stop");
		
		// alert("displaySelection() start("+posActualStart+") stop("+posActualStop+")");
		
		var isSelected=false;
		var strDebug=" "+actualComment.sentenceReferenceStart+"/"+actualComment.sentenceReferenceStartWord+" "+actualComment.sentenceReferenceStop+"/"+actualComment.sentenceReferenceStopWord+"\n--------------\n----------- ";
		for (var z=0;z<arrLines.length;z++)
		{
				// actualComment
				// -1 
				// 
				arrObj=arrLines[z];
				for (var zz=0;zz<arrObj.length;zz++)
				{
					obj=arrObj[zz];
					
					// debug
					strDebug=strDebug+"["+obj.wordLine+"/"+obj.wordInLineIndex+"] ";
					
					// selection open?
					isSelected=false;
					// case: single word 1.1  {1.1}
					// case: single line 5 {5.x}

					// case: lines 1-4
					if ((actualComment.sentenceReferenceStartWord==-1)&&(actualComment.sentenceReferenceStopWord==-1))
					{		
						isSelected=false;
						if ((actualComment.sentenceReferenceStart<=obj.wordLine)&&(actualComment.sentenceReferenceStop>=obj.wordLine))						
						{ 
							isSelected=true;						
							strDebug=strDebug+"* (normal)";
						}
					}
					
					// case: normal 1.3-5.4
					if ((actualComment.sentenceReferenceStartWord!=-1)||(actualComment.sentenceReferenceStopWord!=-1))
					{	
						
						// version 1.0
						// var pos=parseInt(obj.wordLine)*1000+parseInt(obj.wordInLineIndex);
						// version 2.0
						var pos=generateIndex( obj.wordLine, obj.wordInLineIndex, "stop" );
						
						strDebug=strDebug+" "+pos;
						if ((posActualStart<=pos)&&(pos<=posActualStop))	
						{ 
							
							isSelected=true;						
							strDebug=strDebug+"****";
						}
						else
						{
							isSelected=false;						
						}
					}
					
					
					// selected
					if (isSelected)
					{
						var strIndex="_"+obj.wordLine+"_"+obj.wordInLineIndex;
						var divId="evaluationTextLineWordEntity"+strIndex;
						$('#'+divId).css("background", "#CAD9AE");
					}
				}
		}
		
		// alert(strDebug);
		<?
		   if ($debugJavascriptMenu)
		   {
		     echo("\n    // debugging weapp ");
		     echo("\n    debugJavascriptApp();");
		   }
		?>
	}
	
	// clear selection
	function clearSelection()
	{
			var arrObj;
			var obj;
			for (var z=0;z<arrLines.length;z++)
			{
				arrObj=arrLines[z];
				for (var zz=0;zz<arrObj.length;zz++)
				{
					obj=arrObj[zz];
					var strIndex="_"+obj.wordLine+"_"+obj.wordInLineIndex;
					var divId="evaluationTextLineWordEntity"+strIndex;
					$('#'+divId).css("background", "#ffffff");
				}
			}
	}
</script>

<!-- category -->
<script>

	/*
			Category
		*/
		// category
		var arrCategories=new Array();
		var Category = function( )
	    { 
			this.catType="";
			
			this.catIndex=0;

			this.title="";
			this.color="#990000";
			
			this.count=0;
			
			
//			this.appearanceSentence=true;
//			this.appearanceWord=true;
//			this.appearanceWord=true;
			
			this.description="";
			this.arrChilds=new Array();
			
			this.addCategory = function( childCategoryObject )
			{
				this.arrChilds[this.arrChilds.length]=childCategoryObject;
			}
			
			
		}
		
		function generateCategory( catIndex, catType, title, description, color  )
		{
			var newCatObj=new Category();
				newCatObj.catType=catType;
				newCatObj.catIndex=catIndex;
				newCatObj.title=title;
				newCatObj.color=color;
				newCatObj.description=description;
			
			return newCatObj;
		}
	
		function addCategory( catIndex, catType, title, description, color )
		{
			var newCatObj = generateCategory( catIndex, catType, title, description, color  );
			arrCategories[arrCategories.length]=newCatObj;
			
			return newCatObj;
		}
		
		// categories
		var catAllgemeineDimension=addCategory( 0, "allgemeinesproblem", "Allgemeines Problem", " ***", "#666666", null )
		var catSprachDimension=addCategory( 1, "textdimension", "Textuelle Dimension", "Textuelle Dimension ***", "#ff9999", null )
		var catKommukativeDimension=addCategory( 2, "kommunikativedimension", "Kommunikative Dimension", "Textuelle Dimension ***", "#99ff99", null )
		var catSprachDimension=addCategory( 3, "sprachlichedimension", "Sprachliche Dimension", "Sprachliche Dimension ***", "#9999ff", null )
		var catSprachFormalie=addCategory( 4, "sprachformaledimension", "Sprach Formale", "Formalien der Sprache ***", "#ff99ff", null )
			catSprachFormalie.addCategory( generateCategory( 41, "grammatik", "Grammatik", "Grammatik ***", "#ff99ff" ) );
			catSprachFormalie.addCategory( generateCategory( 42, "rechtschreibung", "Rechtschreibung", "Rechtschreibung ***", "#ff99ff" ) );

		// get category for index			
		function getCategoryForIndex(categoryIndex)
		{
			var catObj=new Category();
			for (t=0;t<arrCategories.length;t++)
			{
				catObj=arrCategories[t];
			
				if (catObj.catIndex==categoryIndex)
				{
					return catObj;
				}
			
				// check beyond here
				// this.arrChilds
				var arrChilds=catObj.arrChilds;
				var catChildMore=new Category();
				for (o=0;o<arrChilds.length;o++)
				{	
					catSubChildObject=arrChilds[o];
					if (catSubChildObject.catIndex==categoryIndex)
					{
						return catSubChildObject;
					}
				
			
				}
				
			}
		
			return null;
		}
</script>

<!-- INSPECTOR -->
<style>

	  #inspector 
	  {
	  	 border: 1px solid black;
		  margin: 0;
		  font-size: 14px;
		  font-weight: normal;
		  line-height: 1.1;
		  text-align: left;
		  position: fixed;
		  top: 2em;
		  left: 900px;
		  font-family: helvectica, arial, sans serif;
		  background: #cccccc;
		  
		  width: 200px;
		}

		.inspectorTitle { weight: bold; background: black; color: white; padding-left: 5px; padding-right: 5px; }
		.inspectorContent { padding-left: 5px; padding-right: 5px; }
		.commentInspectorFormError { color: red; display: none; }
		.inspectorFormCommandLine { width: 150px; }
		.inspectorContentNewComment { border-top: 1px dotted black; padding-bottom: 10px; padding-top:5px; }
		.inspectorContentDelete { padding-top: 10px; padding-bottom: 5px; border-bottom: 1px dotted black; }
</style>
<div id='inspector'>
  <div class='inspectorTitle'>Kommentar-Inspektor</div>
  <div class='inspectorContent'>
   <div class='inspectorContentDelete' id='commentInspectorFormDelete'>
   	 <a href='javascript:hrefVoid()' onClick='deleteActualComment()'>L&ouml;schen  ></a>
   </div>
    <br>Selection
	<form name='commentInspectorForm'>
		<input type='text' id='commentInspectorFormCommandLine' name='commentInspectorFormCommandLine' class='inspectorFormCommandLine' value=''>
		<div id='commentInspectorFormError'></div>
		<br>Kommentar<br><textarea id='commentInspectorFormComment' name='commentInspectorFormComment' class='inspectorFormCommandLine' value=''></textarea>
		<br>Kategorie<br>...
		<br><input type='button' id='commentInspectorFormButton' value='' onClick="actionAddOrUpdateInspector()">
	</form>
 	<div class='inspectorContentNewComment'><a href='javascript:hrefVoid()' onClick='inspectorShowNewComment()'>Neuer Kommentar ></a> </div>
  </div>
</div>
<script>	
	/*
		Inspector
		
	*/
	function inspectorShowNewComment()
	{
		var newCom=new Comment();
		displayCommentObjectInInspector(newCom);
		
		startSelection();
	}
	
	// delete actual comment
	function  deleteActualComment()
	{
		var commentObject=getCommentById(actualComment.id);
		if (commentObject!=null)
		{
			if (confirm("Wollen Sie den Kommentar ("+commentObject.comment+") wirklich löschen?"))
			{
				var index=getCommentIndexById(actualComment.id);
				if (index!=-1)
				{
					// delete it ..
					arrComments.remove(index);
					// display
	
					// inspectorShowNewComment
					inspectorShowNewComment();
	
					// display 
					displayComments();
				}
			}
		
		}
		
	}
	
	// displayComment
	function displayCommentInInspector( commentId )
	{
		// alert("displayCommentInInspector( "+commentId+" ) ");
		
		var commentObject=getCommentById(commentId);
		if (commentObject!=null)
		{
		   // ok found here ..
		   displayCommentObjectInInspector( commentObject );
		  
		}
	}
			
			// displayCommentObjectInInspector this comment
			function displayCommentObjectInInspector( commentObject )
			{
	  			  // 1. set up inspector
				   // todo
				   
				   // 2. show this selection
				   actualComment.updateTo(commentObject);
				   
				   // display selection
				   displaySelection();
				   
				   // 3. update inspector view add/update
				   updateInspectorView();
				   
				   // 4. show in command line
				   displayCommandLine();
				   
				   // 5. show category
				   // todo
				   
				   // 6. show comment
				   displayFormComment();
			
			}
			

	  
	  	/*
		
			Inspector
		
		
		*/
		// on load / resize
		jQuery.event.add(window,"load",resizeWindowUpdatePosition);
		jQuery.event.add(window,"resize",resizeWindowUpdatePosition);
		function resizeWindowUpdatePosition()
		{
			// inspector
			var screenWidth=$(window).width();
			$('#inspector').css("left",(screenWidth-300));
		}

// click on body everywhere ..
/*
$("body").click(function() {
  alert("Handler for .click() called.");
});
*/
// todo: right place in script

		
		
		function updateInspectorView()
		{
			// add or update?
			
			// delete possiblities
			if (actualComment.id==-1) $('#commentInspectorFormDelete').hide();
			if (actualComment.id!=-1) $('#commentInspectorFormDelete').show();
			
			// add or do
			var htmlFormObj=document.getElementById("commentInspectorFormButton");
			    if (actualComment.id==-1) htmlFormObj.value='Hinzufügen';
			    if (actualComment.id!=-1) htmlFormObj.value='Aktualisieren';
			
			
			
		}
		
		function actionAddOrUpdateInspector()
		{
			// add new comment
			if (actualComment.id==-1) 
			{
				// 0. updateInspectorPropertiesToActualComment
				updateInspectorPropertiesToActualComment();
				// add a new actual comment
				// new comment
				var addThisComment=new Comment();
				addThisComment.updateTo(actualComment);
				addComment( addThisComment );
			}
			else
			// update object
			{
				// 0. updateInspectorPropertiesToActualComment
				updateInspectorPropertiesToActualComment();
				// 1. find original
				// 2. date it up to
				var commentObj=getCommentById( actualComment.id );
				commentObj.updateTo(actualComment);
			}
		
			// generate a clear new update ...
			inspectorShowNewComment();
			
			// display 
			displayComments();
		}
	
	
	  /*
		
	 	InspectorProperties
		
	  */
	  // CommandLine
	  // Comment
	  // Category
		
		// updateInspectorPropertiesToActualComment
		function updateInspectorPropertiesToActualComment()
		{
			
			// form comment
			formCommentToActualComment();
		}
  
		/*
		
			InspectorCommandLine
		
		*/
		function displayCommandLine()
		{
			// find object and set it ...
			var htmlFormObj=document.getElementById("commentInspectorFormCommandLine");
			// alert(htmlFormObj+"");
			var strCmdLine=""+generateCommentToCommandLineString(actualComment);
			htmlFormObj.value=""+strCmdLine;
		}
		

			/*
				CommandLine 
			*/
			// commandLines
			function generateCommentToCommandLineString( commentObj )
			{
				var strCmdLine="";
				
				// case: same selection 1.1-1.1
				var sameSelected=false;
				if (
						(commentObj.sentenceReferenceStart==commentObj.sentenceReferenceStop)
						&&
						(commentObj.sentenceReferenceStartWord==commentObj.sentenceReferenceStopWord)
					)
				{
					sameSelected=true;
				}
				
				// start
				strCmdLine=strCmdLine+generateCommandLineStringPartForLineWordInLine(commentObj.sentenceReferenceStart,commentObj.sentenceReferenceStartWord);
				
				// add 
				if (!sameSelected)
				{
					strCmdLine=strCmdLine+"-"+generateCommandLineStringPartForLineWordInLine(commentObj.sentenceReferenceStop,commentObj.sentenceReferenceStopWord);
				}
				
				// add category
				var categoryString=generateCommandLineStringPartForCategory(commentObj.category);
				if (categoryString!=null)
				{
					strCmdLine=strCmdLine+" "+categoryString; // *
				}			
				
				return strCmdLine;
			}
			
				// generateCommandLineFormForLineWordInLine
				// case 1: (1.-1) -> 1 
				// case 2: (1,1) -> 1.1 
				function generateCommandLineStringPartForLineWordInLine(index,wordInLineIndex)
				{
					var str="";
						if (index!=-1) str=""+index;
						if (wordInLineIndex!=-1) { str=str+"."+wordInLineIndex; }
					return str;
				}
			
				// generateCommandLineStringPartForCategory
				function generateCommandLineStringPartForCategory(categoryId)
				{
					var strCategory="";

					if (categoryId!=-1) return ""+categoryId;

					return null;
				}
			
			/*
				CommandLine Interaction
			*/
		    // keydown & keyup .. render new ..
		    // keyup
		    $('#commentInspectorFormCommandLine').keyup(function(event) {
				var stringCli=getCommandLineString();
				// alert("CLI "+stringCli);
				
				// comment object
				var commentObj=generateCommandLineStringToComment(stringCli);
				if (commentObj!=null)
				{
					// update to object
					// version 1.0
					actualComment.updateTo(commentObj);
					
					// version 2.0 - only selection ...
					
					// display selection ...
					displaySelection();
				}
				else
				{
					// error ...
					// todo: more perfomant - direct -1 !!
					var commentObj=new Comment();
					actualComment.updateTo(commentObj);
					displaySelection();
					
					// not correct - show only in return ...
					
				}
				
				
  			});
  			
  			// keydown
		  	$('#commentInspectorFormCommandLine').keydown(function(event) {
  				// alert('Handler for .keydown() called.');
  				
  				// press a button ...
  		   		/*
  		   		if (event.which != 13) {
  		   			// event.preventDefault();
  		   		
  		   			var commentObj=generateCommandLineStringToComment(stringCli);
					if (commentObj!=null)
					{
						// update to object
						// version 1.0
						actualComment.updateTo(commentObj);
					
						// version 2.0 - only selection ...
					
						// display selection ...
						displaySelection();
					}
					else
					{
						// not correct - show only in return ...
					}
  		   		}
  		   		*/
  		   		
  				// return ...
  		   		if (event.which == 13) {
  		   			event.preventDefault();
  		   			
  		   			var stringCli=getCommandLineString();
  		   			var commentObj=generateCommandLineStringToComment(stringCli);
					if (commentObj!=null)
					{
						// is generated
						// insert here 
						actionAddOrUpdateInspector();
						
						// set focus here again ...
						
					}
					else
					{
						var str="Leider ist das kein korrekter Input.";
							str=str+"\nFormat der Inputs per Tastatur:";
							str=str+"\n[IndexLinie Kategorie]";
							str=str+"\nBsp. 1 44";
							str=str+"\n[IndexLinie1-IndexLinie2 Kategorie]";
							str=str+"\nBsp. 1-3 44";
							str=str+"\n[IndexLinie1.IndexWord1-IndexLinie2.IndexWord2 Kategorie]";
							str=str+"\nBsp. 1.3-5.9 44";
						alert(str);	
					}
			    }
			
	  		});
	  		// keypressed
	  		$("#target").keypress(function(event) {
				// cursor down/up > scrolling window
				// alert("cursor pressed "+event.which);
				// scroll the text here ...
				// alert("Handler for .keypress() called."+event.which);
			});
	  		

			// getCommandLineString
			function getCommandLineString()
			{
				var formInputFormVal=$('#commentInspectorFormCommandLine').val();
				return formInputFormVal;
			}

			// generate it here ..			
			function generateCommandLineStringToComment( strCommentCommandLine )
			{
				var commentObj=new Comment();
				
				// cases
				// case 1: line(.word) (category)
				// case 2: line1(.word1)-line2(.word2) (category)
				// case 3: not correct input ... 
				
				// case: is there a space in there?

				var correctInputFlag=true;
				
				/* 
				// version 1
				// regex
				
				// version 2
						|
					[space]
					|     |
				  [-]     [^-]
				  | |       |
				  A B      A=B
				  |
				 [.]
			   1,2 1,-1
				             
				*/
				var stringCli=strCommentCommandLine;
				// stringCli
				if (stringCli!="")
				{
					var arrSelectionCategory=stringCli.split(" ");
					// case selection 1
					//if (arrSelectionCategory.length)
					//{
						var selection=arrSelectionCategory[0];
						// alert("cli selection"+selection);
						
						// case selectionStartStop -
						var arrSelectionStartStop=stringCli.split("-");

							// start
							var strStart=arrSelectionStartStop[0];
							var commentStart=getCommentObjectForCliString(strStart,"start");
							if (commentStart!=null) 
							{  
								commentObj.sentenceReferenceStart=commentStart.sentenceReferenceStart;
								commentObj.sentenceReferenceStartWord=commentStart.sentenceReferenceStartWord;
							} 
							else {  correctInputFlag=false; }
							
							// start==stop
							if (arrSelectionStartStop.length==1)
							{
								commentObj.sentenceReferenceStop=commentStart.sentenceReferenceStart;
								commentObj.sentenceReferenceStopWord=commentStart.sentenceReferenceStartWord;
							}

							// stop
							if (arrSelectionStartStop.length>1)
							{
								var strStop=arrSelectionStartStop[1];
								var commentStop=getCommentObjectForCliString(strStop,"stop");
								if (commentStop!=null) 
								{ 
									commentObj.sentenceReferenceStop=commentStop.sentenceReferenceStop;
									commentObj.sentenceReferenceStopWord=commentStop.sentenceReferenceStopWord;
								}
								else {  correctInputFlag=false; }
							}

							
					//}
					
					// case category 
					if (arrSelectionCategory.length>1)
					{
						var category=""+arrSelectionCategory[1]
						// alert("cli category"+category);
						// todo: exception - correctInputFlag=false;
						var intCategory=parseInt(category);
						commentObj.category=intCategory;
					}
					
					// >2 is comment
					if (arrSelectionCategory.length>2)
					{
						var strComment="";
						for (var z=2;z<(arrSelectionCategory.length);z++)
						{
							strComment=strComment+""+arrSelectionCategory[z]+" ";
						}
						// update the field ...
						document.getElementById("commentInspectorFormComment").value=strComment;
						
						// todo: update to actual? ....
					}
					
					// todo: case comment direct there
				}
				else
				{
					correctInputFlag=false;
				}
				
				if (correctInputFlag) return commentObj;
				else null;
			}
			
					// generate commentObject from cli
					function getCommentObjectForCliString(str,type)
					{
						var newCommentObj=new Comment();
						
						var arrIndexIndexWord=str.split(".");
						
						// todo: exception 
						// lineIndex
						var posIndex=parseInt(arrIndexIndexWord[0]);
						    if (type=="start") newCommentObj.sentenceReferenceStart=posIndex;
						    if (type=="stop") newCommentObj.sentenceReferenceStop=posIndex;
						
							// lineIndexWord
							if (arrIndexIndexWord.length>1)
							{
								// todo: exception
								var posIndexWord=parseInt(arrIndexIndexWord[1]);
								
							    if (type=="start") newCommentObj.sentenceReferenceStartWord=posIndexWord;
							    if (type=="stop") newCommentObj.sentenceReferenceStopWord=posIndexWord;
							}
							else
							{
							    if (type=="start") newCommentObj.sentenceReferenceStartWord=-1;
							    if (type=="stop") newCommentObj.sentenceReferenceStopWord=-1;
							}
					
						return newCommentObj;
						// return null;
					}
			
  	 
	
		// commentInspectorFormComment
		function displayFormComment()
		{
			// find object and set it ...
			var htmlFormObj=document.getElementById("commentInspectorFormComment");
			// alert(htmlFormObj+"");
			var str=""+actualComment.comment;
			htmlFormObj.value=""+str;
		}
		
		// commentInspectorFormComment
		function formCommentToActualComment()
		{
			// find object and set it ...
			var htmlFormObj=document.getElementById("commentInspectorFormComment");
			actualComment.comment=""+htmlFormObj.value;
		}
	
		
</script>


<?

/*
	DEBUG JAVASCRIPT
*/

// debug javascript
if ($debugJavascriptMenu)
{
	echo("\n<style>");
	echo("\n	#divDebugJavascript {  padding-top: 10px; padding-bottom: 10px; border: 1px dotted black; }");
	echo("\n		#divDebugJavascriptContainer {    }");
	echo("\n			#divDebugJavascriptTitle {  border: 1px solid black;   }");
	echo("\n			#divDebugJavascriptContent {  border: 1px solid black; display:visible;   }");
	echo("\n</style>");
	
	echo("\n<script>");
	echo("\n  function debugJavascriptApp()");
	echo("\n  {");
	echo("\n      $('#divDebugJavascriptContent').html('');  ");
	echo("\n      var str=''; ");
	echo("\n      var str=\"Aktuelle Selektion: actualComment = {\"+actualComment.sentenceReferenceStart+\".\"+actualComment.sentenceReferenceStartWord+\",\"+actualComment.sentenceReferenceStop+\".\"+actualComment.sentenceReferenceStopWord+\"} \"; ");

	echo("\n      $('#divDebugJavascriptContent').html(''+str);  ");
	echo("\n  }");  
	echo("\n  function toggleDebugContent()");
	echo("\n  {");
	echo("\n      $('#divDebugJavascriptContent').toggle();  ");
	echo("\n  }");
	echo("\n</script>");
	
	echo("\n<div id='divDebugJavascript'><br>");
	echo("\n	<div id='divDebugJavascriptContainer'>");
	echo("\n        <div id='divDebugJavascriptTitle'>DEBUG JAVASCRIPT</div>");
	echo("\n        <div id='divDebugJavascriptTitle'>[ <a href='javascript:hrefVoid()' onClick='toggleDebugContent()'>show/hide</a> ]</div>");
	echo("\n	    <a  href='javascript:hrefVoid()'  onClick='clearComments();'>Clear Comments</a> | <a  href='javascript:hrefVoid()'  onClick='displayCommentsInLines();'>Display Comments in Lines</a>  ");
	echo("\n        <div id='divDebugJavascriptContent'>");
	echo("\n        </div>");
	echo("\n	</div>");
	echo("\n</div>");
}

?>

<!-- startup -->
<script>

/*
 // add some comments
 var firstComment=addCommentByValue( 3, 3, 5, 10, "hallo du da" )
 	 firstComment.category=2;
 addCommentByValue( 7, -1, 7, -1, "ich war da!" )
 
 var zobj=addCommentByValue( 7, -1, 10, -1, "wow ich bin da!" )
 	 zobj.category=5;
*/

 toggleWordIndexDisplay();
 
 // show a clear comment
 inspectorShowNewComment();
 
</script>


<?
	// start
	include("./includes/footer.inc.php");
?>
