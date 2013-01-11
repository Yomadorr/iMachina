<?

	class TextObjectBlogPlainView extends TextObjectView
	{
		var $textobjectviewType="blog";
		var $textobjectviewTypeSub="plain";
	
		var $textobjectviewIcon="@generic"; // * not used 
		var $textobjectviewIconBig="@generic"; // * not used
		var $textobjectviewLabel="Blog"; // @textobject.label*
		var $textobjectviewDescription="Simple Blog"; // @textobject.description < comple

		var $textobjectviewInteractionType="none"; // text|visual	// nonew	


/*
			function viewDetailAccess( $app, $userId )
			{
				echo("<pre>");
				print_r($this->textobjectObject);
				echo("</pre>");

				return "BLOG:viewDetailAccess";
			}
*/

			function viewDetailCore( $app, $userId )
            {
                $str=parent::viewDetailCore( $app, $userId );

                /*
                $str=$str."---";
                echo("<pre>");
                print_r($this);
                echo("</pre>");
                */

                return $str;
            }


 


			function viewFormExtendedCoreContentForm( $addDivAction="" )
			{

				$str="";
				
				// todo: escape html-entities
				// $str=     "\n 	<input type=hidden id='".$this->getDivId()."FormDatatextobjectId".$addDivAction."' value='".$this->textobjectObject->textobjectId."' style='width: 100%'> ";
				$str=$str."\n  	<input type=textfield size=50 id='Form".$addDivAction."DatatextobjectArgument'    style='width: 98%'  value='".$this->textobjectObject->textobjectArgumentText."''>";

				return $str;
			}



            
	}
	
    
?>