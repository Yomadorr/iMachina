<?

	class TextObjectDomainUser extends TextObjectDomainPlain
	{
		var $textobjectType="domain"; // name for 
    	var $textobjectTypeSub="user"; // name for 


    	var $textobjectArgumentText="Domain";

    	function TextObjectDomainPlain()
        {
            // overwrite here ...
            // $this->addMemberByValue("logo","Logo",false,"image","png","imgs/logo.png",false);
                
            // text ...
            // $this->addMemberByValue("description","plain",false,"text","plain","Das ist eine iMachina-Installation.",false);

            // simple text ...
            // $this->addMemberByValue("","PlatformDescription",false,"text","plain","first domain on this imachina platform. you can change this or create a new one for your needs.",false);
 			// overview
            // of the domains ..

     	}      


	}
	
    
?>