<?

	class TextObjectNumberFloat extends TextObject
	{
		   	var $textobjectType="number"; 
    		var $textobjectTypeSub="float"; 		

    		function setArgument( $input )
    		{
    			$this->textobjectArgumentFloat=$input;
    		}

    		function getArgument(  )
    		{
    			return $this->textobjectArgumentFloat;
    		}		
	}
	
    
?>