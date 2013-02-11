<?

	class TextObjectTextPlainView extends TextObjectView
	{
		var $textobjectviewType="text";
		var $textobjectviewTypeSub="plain";

		function viewContent( $app, $userId )
		{
			// return $this->viewContentAsWordText( true, $app, $userId );
			$strValue="".$this->textobjectObject->getArgument();
			return TextObjectView::returnsToHtml( $strValue );
		}

	}
	
    
?>