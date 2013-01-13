<?



	class TextObjectBlogPlain extends TextObject
	{
		   	var $textobjectType="blog"; 
    		var $textobjectTypeSub="plain";  // type ... set type ... 

            // status - default draft ... 
            var $textobjectStatus="draft"; // published/draft/deleted

                    var $textobjectviewTypeCategory="text";
                    // var $textobjectviewTypeCategoryLabel="Courses, Threads";

            // turn into editmode after insertion ... 
            var $textobjectFrontEndInsertToEditDialog=true;

    		function TextObjectBlogPlain()
            {
                // overwrite here ...
                $this->addMemberByValue("image","Blogbild",false,"image","png","default/TextObjectcomplexBlog.png",false);
                
                // text ...
                // $todefObj=$this->addMemberByValue("text","Text",false,"text","plain","Das ist der BlogText.",false);

                // text ...
                $todefObj=$this->addMemberByValue("text","Text",false,"text","html","Das ist der BIG-TEXT-INHTML.",false);

                // $todefObj=$this->addMemberByValue("text","Text",false,"text","plain","Wow plain!",false);
                
                // more defaults
                // $todefObj->memberDefaultObject=new TextObject();
                // $todefObj->memberDefaultObject->textobjectStatus="draft";
                // $todefObj->memberDefaultObject->setArgument("Overwrite this blogText even here!");
            }

	}
	
    
?>