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

			
						function viewContent( $app, $userId )
						{
							// $str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$this->textobjectObject->textobjectArgument."</div>";
							$strContent=TextObjectView::textToHtml($this->textobjectObject->getArgument());
							$strContent=str_replace("\n","<br>",$strContent);

							$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content' >";

								// side actions
								// $str=$str."".$this->viewSideActions($app,$userId);
								// the content
								// version 1.0
								// $str=$str.$strContent;
								// add members here ... 
								// $str=$str.$this->viewMembers( $app, $userId );

								// version 2.0
								$str=$str."\n <h1>".$this->textobjectObject->getArgument()."</h1>";

								// picture
								// todo: check if there is a picture ... 
								$str=$str."\n <div style='float:left;'><img src='".$this->textobjectObject->getDocumentURL()."' style='align: top;'></div>";

								// text ... 
								$htmltext=$this->textobjectObject->getMemberValue( "text", $app, $userId );
								$str=$str.$htmltext;


							$str=$str."\n</div>";


							// comments
							// $str=$str.$this->viewSideActionsComments( $app, $userId );

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