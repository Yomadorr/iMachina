<?
	


	// test selection ...
    
	?>
	  <style>
	  	.imachinaText { display: inline; }
	  </style>

	<?

    $selectableText="<imachinaText>"."Computerspiel &gt; Film (Tomb Rider, <div class='imachinaText' imachinaTextId='12'>Nachahmen von</div> Figur</div>); Film &gt; <a href='test.php'>Computerspiel</a> (filmische Passagen); und wie verhält es sich mit <div class='imachinaText' imachinaTextId='13'>Computerspiel</div> &gt; Literatur? Hier Glavinic als hypothetisches Beispiel angeben: Das Leben der Wünsche (Wahlmöglichkeit; ähnlich Märchen (Computerspiel und Märchen: Jürgen Fritz); Das bin doch ich (Avatar) "."</imachinaText>";
    echo($selectableText);

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
	$arrMatches=$matches[0];
	$arrFound=array();
	// echo("<pre>");print_r($arrMatches);echo("</pre>");
	for ($i=0;$i<count($arrMatches);$i++)
	{
		// echo("<pre>");print_r($arrMatches[$i]);echo("</pre>");
		$newTextObject=new imachinaText();
		$newTextObject->text=$arrMatches[$i][0];
		$newTextObject->position=$arrMatches[$i][1];
		$arrFound[count($arrFound)]=$newTextObject;
	}
	// show matches here
	// debug
	for ($i=0;$i<count($arrFound);$i++)
	{
		$textObj=$arrFound[$i];
		// echo("<br>$i ".$textObj->debug());
	}

	// get max imachinaTextId	
	preg_match_all("/imachinaTextId\='([^']+)'/", $selectableText, $arrImachinaIds, PREG_OFFSET_CAPTURE, 3);
	echo("<hr>");echo("<pre>");print_r($arrImachinaIds);echo("</pre>"); echo("<hr>");

	/*for ($i=0;$i<count($arrMatches);$i++)
	{
	}*/


	// go from back to top 
	if (count($arrFound)>0)
	{
		for ($i=count($arrFound)-1;$i>=0;$i--)
		{
			$textObj=$arrFound[$i];
			// check 
			echo("<br>$i ".$textObj->debug());

			$inlineText=$textObj->text;
			// check now if there is something to do

			// case: "wordonly" > is it a imachinatext-div?

			// case: "worda wordb"


		}
	}
	echo("done...");

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