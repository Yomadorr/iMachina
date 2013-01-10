<?

	class TextObjectNumberInteger extends TextObject
	{
		   	var $textobjectType="number"; 
    		var $textobjectTypeSub="integer"; 		


    		function setArgument( $input )
    		{
    			$this->textobjectArgumentInt=$input;
    		}

    		function getArgument(  )
    		{
    			return $this->textobjectArgumentInt;
    		}

	}
	
    
?>