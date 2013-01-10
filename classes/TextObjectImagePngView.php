<?

	class TextObjectImagePngView extends TextObjectView 
	{
		   	var $textobjectviewType="image"; 
    		var $textobjectviewTypeSub="png"; 
		
			var $textobjectviewLabel="PNG-Image"; // @textobject.label*
			var $textobjectviewDescription="A PNG Image"; // @textobject.description


			function viewContent( )
			{
				// $str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$this->textobjectObject->textobjectArgumentText."</div>";
				// $strContent=TextObjectView::textToHtml($this->textobjectObject->textobjectArgumentText);

				// todo: check image - if existing

				// width 
				// height

				$width="".$this->textobjectObject->textobjectWidth;
				$height="".$this->textobjectObject->textobjectHeight;
				$strWidth="";
				$strHeight="";
					if ($width!="") $strWidth=" width='$width' ";
					if ($height!="") $strHeight=" width='$height' ";
				$strSize=" $strWidth  $strHeight ";

				// document path
				$documentURL=$this->textobjectObject->getDocumentURL();
				$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'><img src='$documentURL'  $strSize border=0></div>";
				// $str=$str."version: ".$this->textobjectObject->getVersionId(); // textobjectVersionId;

				return $str;
			}

			function viewFormExtendedCoreContentForm( $addDivAction="" )
			{
				$str="";

				// todo: escape html-entities
				$str=$str."\n  	<input type=hidden size=50 id='Form".$addDivAction."DatatextobjectArgument'    style='width: 100%'  value='".$this->textobjectObject->textobjectArgumentText."''>";				
				
				return $str;
			}

				// form insert
				function viewFormExtendedCoreContentFormInsert()
				{
					$str="";

					// is document?
					$str=$str."\n ".$this->viewFormExtendedCoreContentFormDocumentAddSingle( );

					return $str;
				}

				// form update
				function viewFormExtendedCoreContentFormUpdate()
				{
					$str="";

					$documentURL=$this->textobjectObject->getDocumentURL();
					$str=$str."\n <div><img src='$documentURL' width='50%' border=0></div>";

					// is document?
					$str=$str."\n ".$this->viewFormExtendedCoreContentFormDocumentUpdateSingle( );
					

					return $str;								
				}


		
	}
	
    
?>