<?

	class TextObjectTextHtmlView extends TextObjectView 
	{
		   	var $textobjectviewType="text"; 
    		var $textobjectviewTypeSub="html"; 
		
			var $textobjectviewLabel="Html"; // @textobject.label*
			var $textobjectviewDescription="Simple Htmlobject."; // @textobject.description

			var $textobjectArgumentEditor="tinymce"; // tinymce

			function viewContent( )
			{
				// $str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$this->textobjectObject->textobjectArgumentText."</div>";
				$strContent=$this->textobjectObject->textobjectArgumentText;
				$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'  >".$strContent."</div>";
				return $str;
			}


						// the content ... 
			function viewFormExtendedCoreContentForm( $addDivAction="" ) // action with visual
			{
				$str="";
				// todo: escape html-entities
				// $str="\n 	<input type=hidden id='".$this->getDivId()."FormDatatextobjectId".$addDivAction."' value='".$this->textobjectObject->textobjectId."'> ";
				$strTextarea=$this->textobjectObject->getArgument();
				$str=$str."\n  <textarea cols=50 id='Form".$addDivAction."DatatextobjectArgument'  rows=10  style='width: 100%'  _class='tinymceRtf'  >".$strTextarea."</textarea>";

				// replace textareaId by the id of your textarea
  
				$str=$str."\n  <script>tinyMCE.execCommand('mceRemoveControl', false, 'Form".$addDivAction."DatatextobjectArgument'); tinyMCE.execCommand('mceAddControl', false, 'Form".$addDivAction."DatatextobjectArgument'); </script>";
				// $str=$str."\n ".$this->getDivId()."FormDatatextobjectArgument".$addDivAction." <a onClick=\"/* tinymce.get('".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."').hide(); */ tinyMCE.execCommand('mceAddControl', false, '".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."');\">ADD</a>"; 
				// $str=$str."\n ".$this->getDivId()."FormDatatextobjectArgument".$addDivAction." <a onClick=\"/* tinymce.get('".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."').show(); */ tinyMCE.execCommand('mceRemoveControl', false, '".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."');\">REMOVE</a>"; 
				$str=$str."\n  	<script>tinyMCE.execCommand('mceFocus', false, 'Form".$addDivAction."DatatextobjectArgument'); </script>";
		
				return $str;
			}
		
	}
	
    
?>