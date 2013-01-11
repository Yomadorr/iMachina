<?

	class TextObjectTextRtfView extends TextObjectView 
	{
		   	var $textobjectviewType="text"; 
    		var $textobjectviewTypeSub="rtf"; 
		
			var $textobjectviewLabel="RichText"; // @textobject.label*
			var $textobjectviewDescription="Simple commentable richtext"; // @textobject.description

			var $textobjectArgumentEditor="tinymce"; // form 

			function viewContent( )
			{
				$str="";

				// $str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$this->textobjectObject->textobjectArgumentText."</div>";
				$strContent=$this->textobjectObject->textobjectArgumentText;
				$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$strContent."</div>";
				return $str;
			}


			// the content ... 
			function viewFormExtendedCoreContentForm( $addDivAction="" ) // action with visual
			{
				$str="";
				// todo: escape html-entities
				// $str="\n 	<input type=hidden id='".$this->getDivId()."FormDatatextobjectId".$addDivAction."' value='".$this->textobjectObject->textobjectId."'> ";
				$str=$str."\n  <textarea cols=50 id='Form".$addDivAction."DatatextobjectArgument'  rows=10  style='width: 100%'  _class='tinymceRtf'  >".$this->textobjectObject->getArgument()."</textarea>";

				// replace textareaId by the id of your textarea
  
				$str=$str."\n  <script>tinyMCE.execCommand('mceRemoveControl', false, 'Form".$addDivAction."DatatextobjectArgument'); tinyMCE.execCommand('mceAddControl', false, 'Form".$addDivAction."DatatextobjectArgument'); </script>";
				// $str=$str."\n ".$this->getDivId()."FormDatatextobjectArgument".$addDivAction." <a onClick=\"/* tinymce.get('".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."').hide(); */ tinyMCE.execCommand('mceAddControl', false, '".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."');\">ADD</a>"; 
				// $str=$str."\n ".$this->getDivId()."FormDatatextobjectArgument".$addDivAction." <a onClick=\"/* tinymce.get('".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."').show(); */ tinyMCE.execCommand('mceRemoveControl', false, '".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."');\">REMOVE</a>"; 
				$str=$str."\n  	<script>tinyMCE.execCommand('mceFocus', false, 'Form".$addDivAction."DatatextobjectArgument'); </script>";
		
				return $str;
			}
		
	}
	
    
?>