<?

	class TextObjectLinkPlainView extends TextObjectView
	{
		var $textobjectviewType="link";
		var $textobjectviewTypeSub="plain";
	
		var $textobjectviewIcon="@generic"; // * not used 
		var $textobjectviewIconBig="@generic"; // * not used
		var $textobjectviewLabel="Link"; // @textobject.label*
		var $textobjectviewDescription="Simple Link (URL)"; // @textobject.description < comple

		var $textobjectviewInteractionType="none"; // text|visual	// nonew	


			/*

			function viewDetailCore( $app, $userId )
            {
                $str="";

                $str=parent::viewDetailCore( $app, $userId );


                return $str;
            }
            */

            // detail is all together ... 
					function viewContent( $app, $userId )
					{
						// $str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$this->textobjectObject->textobjectArgumentText."</div>";
						$strContent=TextObjectView::textToHtml($this->textobjectObject->textobjectArgumentText);
						// $strContent=str_replace("\n","<br>",$strContent);

						$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content' >";
						
							$title="".$strContent;
							// is there something in the member?
							// echo("<pre>");print_r($this);echo("<pre>");
							$titleMember=$this->textobjectObject->getMemberValue("title",$app,$userId);
							if ($titleMember!=null) $title=$titleMember;
							$str=$str."<a href='$strContent' target='_blank'>";
								$str=$str.$title;
							$str=$str."</a>";

							// add members here ... 
							// $str=$str.$this->viewMembers( $app, $userId );
						$str=$str."</div>";


						// comments
						// $str=$str.$this->viewSideActionsComments( $app, $userId );

						return $str;
					}

 


			function viewFormExtendedCoreContentForm( $addDivAction="" ) 
			{
				$str="";
				
				// todo: escape html-entities
				// $str=     "\n 	<input type=hidden id='".$this->getDivId()."FormDatatextobjectId".$addDivAction."' value='".$this->textobjectObject->textobjectId."' style='width: 100%'> ";
				$str=$str."\n  	<input type=textfield size=50 id='Form".$addDivAction."DatatextobjectArgument'  style='width: 98%' value='".$this->textobjectObject->textobjectArgumentText."''>";

				return $str;
			}



            
	}
	
    
?>