<?

	class TextObjectHyperthreadPlain extends TextObjectThread
	{
		var $textobjectType="hyperthread"; // name for 
    	var $textobjectTypeSub="plain"; // name for 

    	var $innerCommentType="";


			function TextObjectHyperthreadPlain()
            {
            	// default news thread ...
                $todefObj=$this->addMemberByValue("news","News",false,"thread","plain","News",false);

            	// default news thread ...
                $todefObj=$this->addMemberByValue("","Topics",false,"thread","plain","Theme",false);

               	// text ...
                $todefObj=$this->addMemberByValue("maintext","Text",false,"text","html","",false);
            }

	}
	
    
?>