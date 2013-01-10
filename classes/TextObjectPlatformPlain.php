<?

	class TextObjectPlatformPlain extends TextObjectHyperthreadPlain
	{
		var $textobjectType="platform"; // name for 
    	var $textobjectTypeSub="plain"; // name for 


    	var $textobjectArgumentText="Platform iMachina";

    	function TextObjectPlatformPlain()
        {
            // $this->setArgument("Platform iMachina");

            // overwrite here ...
            $this->addMemberByValue("logo","Logo",false,"image","png","imgs/logo.png",false);
                
            // text ...
            $todefObj=$this->addMemberByValue("text","plain",false,"text","plain","Das ist eine iMachina-Installation.",false);
     	}      

	}
	
    
?>