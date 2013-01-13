<?



	class TextObjectLinkPlain extends TextObject
	{
		   	var $textobjectType="link"; 
    		var $textobjectTypeSub="plain";  // type ... set type ... 
		
			var $textobjectArgumentText="http://";

			        var $textobjectviewTypeCategory="web";
                    var $textobjectviewTypeCategoryLabel="Web";


    		function TextObjectLinkPlain()
            {
                 $todefObj=$this->addMemberByValue("title","Title",false,"text","line","",false);
            }

	}
	
    
?>