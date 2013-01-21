<?

	/*
		TextWord

		used for  TextComments / Javascript only Temp 
		// no database

	*/

	class TextWord
	{
		var $debug=false;

		var $textwordTextObjectId=-1;
		var $textwordId=-1; 
		var $textwordString="";		

		function getWordJavascriptFormat()
		{
			$str=$this->textwordString;

//			$str=str_replace("\"","\\\"",$str);

			return $str;
		}
	}

			// helping class
			class TextWordFound
			{
				var $text="";
				var $position="";

				function debug()
				{
					return $this->position." :".$this->text."";
				}
			}
	
    
?>