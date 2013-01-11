<?

	class TextObjectNumberBoolean extends TextObject
	{
		   	var $textobjectType="number"; 
    		var $textobjectTypeSub="boolean"; 		


    		function setArgument( $input )
    		{
    			$val=0;
    			if ($input==true) $val=1; 
    			$this->textobjectArgumentInt=$val;
    		}

    		function getArgument( )
    		{
    			
    			if ($this->textobjectArgumentInt==0) return false;
    			if ($this->textobjectArgumentInt!=0) return true;
    		}			
	}
	
    
?>