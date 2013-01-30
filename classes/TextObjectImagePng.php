<?

	class TextObjectImagePng extends TextObject
	{
		var $innerCommentType="visual";

			// textobject ...
	   		var $textobjectDocument=1; 
    		var $textobjectSuffix="png"; 

    				var $textobjectviewTypeCategory="image";
					var $textobjectviewTypeCategoryLabel="Images";


		function TextObjectImagePng()
		{
			// add aleternative types ...
			$this->addAlternativeType("image","jpg");
			$this->addAlternativeType("image","jpeg");
		}
	}
	
    
?>