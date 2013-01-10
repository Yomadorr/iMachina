<?

	class TextObjectTextLine extends TextObject
	{
		   	var $textobjectType="text"; 
    		var $textobjectTypeSub="line"; 		

    		function setArgument( $input )
    		{
    			$this->textobjectArgumentText=$input;
    		}

    		function getArgument( )
    		{
    			return $this->textobjectArgumentText;
    		}	
	}
	
    
?>