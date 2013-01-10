<?

	class TextObjectNumberBooleanView extends TextObjectView
	{
		var $textobjectviewType="number";
		var $textobjectviewTypeSub="boolean";

		var $textobjectviewIcon="TitleIcon.png"; // * not used
		var $textobjectviewIconBig="TitlePlainIconBig.png"; // * not used
		var $textobjectviewLabel="Title"; // @textobject.label*
		var $textobjectviewDescription="Simple Title."; // @textobject.description


			function viewFormExtendedCoreContentForm( $addDivAction="" )
			{
				$str="";

				// todo: escape html-entities
				// $str=	  "\n 	<input type=hidden id='".$this->getDivId()."FormDatatextobjectId".$addDivAction."' value='".$this->textobjectObject->textobjectId."'> ";
				$str=$str."\n  	<input type=textfield  id='".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."'   style='width: 100%'  value='".$this->textobjectObject->textobjectArgumentText."''>";

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