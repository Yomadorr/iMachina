<?

	class TextObjectTextLineView extends TextObjectView
	{
		var $textobjectviewType="text";
		var $textobjectviewTypeSub="line";

		var $textobjectviewIcon="TitleIcon.png"; // * not used
		var $textobjectviewIconBig="TitlePlainIconBig.png"; // * not used
		var $textobjectviewLabel="Title"; // @textobject.label*
		var $textobjectviewDescription="Simple Title."; // @textobject.description


			function viewFormExtendedCoreContentForm( $addDivAction="" )
			{
				$str="";

				// todo: escape html-entities
				$str=$str."\n  	<input type=textfield size=50 id='Form".$addDivAction."DatatextobjectArgument'  style='width: 98%' value='".$this->textobjectObject->textobjectArgumentText."''>";

				return $str;
			}

			/*
			function viewContent( )
			{
				// $str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$this->textobjectObject->textobjectArgumentText."</div>";
				$strContent=$this->textobjectObject->textobjectArgumentText;
				$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'><strong>".$strContent."</strong></div>";
				return $str;
			}
			*/

	}
	
    
?>