<?

	class TextObjectComplexMember
    {

        var $memberCommentReal="----------------RealMemberObject-------------------------";
        var $textobjectObject; // * > in future not any more used!
        
        // array?
        var $arrTextObjects=Array(); // *
        // get actual object
        function getTextObject() // *
        {
            if (count($this->arrTextObjects)>0)
            {
                return $this->arrTextObjects[0];
            }

            return null;
        }

        // set actual object
        function setTextObject( $textobjectActual ) // *
        {
            if (count($this->arrTextObjects)>0)
            {
                $this->arrTextObjects[0]=$textobjectActual;
            }
        }

        // more than one!
        function addTextObject( $textobjectNext ) // *
        {
            $arrTextObjects[count($arrTextObjects)]=$textobjectNext;
        }

        var $memberCommentDefintion="----------------DefinitionMember-------------------------";
        var $memberRefName=""; // refName
        var $memberRefLabelName=""; // refName

        var $memberIsList=false; // one or more
        var $memberMimeType="text";
        var $memberMimeTypeSub="plain";

        var $memberDefaultArgument="";
        var $memberDefaultObject; // default object? * there?

        var $memberIsCommentable=true; // *

        var $memberVisibleOnlyForAdmin=false;

        // is an array? .... more than one refName!
        var $memberIsArray=false; // *


    }	
    
?>