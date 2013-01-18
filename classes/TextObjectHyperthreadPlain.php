<?

	class TextObjectHyperthreadPlain extends TextObjectThread
	{
		var $textobjectType="hyperthread"; // name for 
    	var $textobjectTypeSub="plain"; // name for 

    	var $innerCommentType="";


			function TextObjectHyperthreadPlain()
            {
               	// text ...
                $todefObj=$this->addMemberByValue("maintext","Text",false,"text","html","Text zum Hyperthread. Edit this Text in Hyperthread properties.",false);
            }

	}
	
    
?>