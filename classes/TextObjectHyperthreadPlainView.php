<?

	class  TextObjectHyperthreadPlainView extends TextObjectThreadView
	{
		var $textobjectviewType="hyperthread";
		var $textobjectviewTypeSub="plain";

		var $textobjectviewIcon="TextPlainIcon.png"; // * not used
		var $textobjectviewIconBig="TextPlainIconBig.png"; // * not used
		var $textobjectviewLabel="HyperThread"; // @textobject.label*
		var $textobjectviewDescription="A topic ...."; // @textobject.description		

		function viewDetailHyperthread($contentId,$app,$userId)
		{
			$str="";

			$str=$str."<div class='textobjectHyperthreadPlainTreeDetail'>";

// todo: fix it!
// $str=$str.$this->showSiblingLineBySiblingId( $this->getId(), $app, $userId );

/*
			// version 2.0
			// get special textobject ... 
			// go on here ...
			// intreeview
			if ($contentId!=$this->getId())
			{
				
				// start
				$str=$str.$this->viewTreeDetailStart( 0, $app, $userId);

					// case: is the hyperthread
					if ($this->textobjectObject->textobjectId==$contentId)
					{
						$str=$str.$hyperthreadObjView->viewDetail($app,$userId);
					}

					// case: is not the hyperthread
					if ($this->textobjectObject->textobjectId!=$contentId)
					{
						// get tree ... 
						// search for ...
// todo: speed up here ... 
						// show the tree
						$arrTree=$app->getTreeUpForIdDirectExt( $contentId, $userId );
						$hyperThreadIndex=$app->getIndexInTreeFirstHyperThread( $arrTree );
						
						// version 1 - show all
//						$arr=$app->getArrayPart($arrTree,$hyperThreadIndex+1);
						// vesion 2 - don't show last thread!
						$arr=$app->getArrayPart($arrTree,$hyperThreadIndex+1);
						
						$str=$str.$this->showTreePart( -1,$arr, $app, $userId); // case count down: $hyperThreadIndex

						// get last object and show it here !
						// echo("***".(count($arrTree)-1)."***");
						$threadObj=$arrTree[count($arrTree)-1];
						// get thread here ...
						$threadObjView=$app->getTextObjectViewFor($threadObj, $userId );
	                    $str=$str.$threadObjView->viewDetail( $app, $userId );	
					}
	

				// stop 
				$str=$str.$this->viewTreeDetailStop( 0, $app, $userId);

			}

			//	Case: content
			// this is the content ... 
			if ($contentId==$this->getId())
			{

				$str=$str."".$this->viewDetail($app,$userId);
			}

			$str=$str."</div>";

*/
			// version 3
			// if you are there

					// case show this hyperthread > search for news here ...
					if ($contentId==$this->getId()) 
					{
						// overwrite contentId
						// todo: take selected hyperthread or just first added thread to this object ...
						// todo: search for news ...
						// todo: get first ..
						$arrSiblings=$app->getTextObjectChildrenById( $this->getId(), $userId );
						// print_r($arrSiblings);
						// echo("arrSiblings: ".count($arrSiblings));
						if (count($arrSiblings)>0)
						{
							$contentId=$arrSiblings[0]->textobjectId;
						}
						else
						{
							// todo: error problem with this hyperthread - no news
							// todo: create a new hyperthread?
                            $strError=$app->getLanguageBy( $app->getDomainLanguage($userId), "Sorry no correct Hyperthread-Structure. Missing News-Thread. @contentErrorThreadNotFound" ) ;  
                            $str=$str.$strError;                         							   
						}
					}

			if ($contentId!=$this->getId())
			{
				
				// start
				$str=$str.$this->viewTreeDetailStart( 0, $app, $userId);

/*
					// version 1
					// case: is the hyperthread
					if ($this->textobjectObject->textobjectId==$contentId)
					{
						$str=$str.$hyperthreadObjView->viewDetail($app,$userId);
					}

					// case: is not the hyperthread
					if ($this->textobjectObject->textobjectId!=$contentId)
					{
						// get tree ... 
						// search for ...
// todo: speed up here ... 
						// show the tree
						$arrTree=$app->getTreeUpForIdDirectExt( $contentId, $userId );
						$hyperThreadIndex=$app->getIndexInTreeFirstHyperThread( $arrTree );
						
						// version 1 - show all
//						$arr=$app->getArrayPart($arrTree,$hyperThreadIndex+1);
						// vesion 2 - don't show last thread!
						$arr=$app->getArrayPart($arrTree,$hyperThreadIndex+1);
						
						$str=$str.$this->showTreePart( -1,$arr, $app, $userId); // case count down: $hyperThreadIndex

						// get last object and show it here !
						// echo("***".(count($arrTree)-1)."***");
						$threadObj=$arrTree[count($arrTree)-1];
						// get thread here ...
						$threadObjView=$app->getTextObjectViewFor($threadObj, $userId );
	                    $str=$str.$threadObjView->viewDetail( $app, $userId );	
					}
	

				// stop 
				$str=$str.$this->viewTreeDetailStop( 0, $app, $userId);
*/


				// version 2.0

					//if ($this->textobjectObject->textobjectId!=$contentId)
					//{
						// get tree ... 
						// search for ...
// todo: speed up here ... 
						// show the tree
						$arrTree=$app->getTreeUpForIdDirectExt( $contentId, $userId );
						$hyperThreadIndex=$app->getIndexInTreeFirstHyperThread( $arrTree );
						
						// version 1 - show all
//						$arr=$app->getArrayPart($arrTree,$hyperThreadIndex+1);
						// vesion 2 - don't show last thread!
						$arr=$app->getArrayPart($arrTree,$hyperThreadIndex+1);
						
						$str=$str.$this->showTreePart( -2,$arr, $app, $userId); // case count down: $hyperThreadIndex

						// get last object and show it here !
						// echo("***".(count($arrTree)-1)."***");
						$threadObj=$arrTree[count($arrTree)-1];
						// get thread here ...
						$threadObjView=$app->getTextObjectViewFor($threadObj, $userId );
	                    $str=$str.$threadObjView->viewDetail( $app, $userId );	
					// }
	

				// stop 
				$str=$str.$this->viewTreeDetailStop( 0, $app, $userId);
			}

			// $str=$str."".$this->viewDetail($app,$userId);

			
			$str=$str."</div>";


			return $str;
		}

				/*
					in the view ...
				*/
				function viewTreeMenuPoint( $depth, $siblingAmount, $app, $userId)
				{
					$str="";

						$str=$str."<div class='textobjectThreadPlainTreeContainerMenuPoint' ".$this->getOnClickURLWebservice( $this->textobjectObject ).">";
						$str=$str.$this->textobjectObject->getArgumentCutted()." []";
						$str=$str."</div>";

					return $str;
				}

					//   ___________________
					// _| threadA selected* |__
					function viewTreeMenuPointSelected( $depth, $siblingAmount,  $app, $userId)
					{
						$str="";

							$str=$str."<div class='textobjectThreadPlainTreeContainerMenuPointActive' ".$this->getOnClickURLWebservice( $this->textobjectObject ).">";
							$str=$str.$this->textobjectObject->getArgumentCutted()." []";
							$str=$str."</div>";

						return $str;
					}

				/*
					selected thread
				*/
				function viewTreeDetailStart( $depth, $app, $userId)
				{
					$str="";

						// version 1.0
						/*
						$str=$str."<div class='textobjectHyperthreadPlainTreeDetail'>";
						// $str=$str.$this->getNoScriptHrefURLDirect( $this->textobjectObject ); // direct
						$strOnClick=$this->getOnClickURLWebservice( $this->textobjectObject ); // onClick
						$str=$str."<div class='textobjectHyperthreadPlainTreeDetailTitle' $strOnClick >";
						$str=$str.$this->showVisibility( $app );
						$str=$str.$this->textobjectObject->getArgument();
						$str=$str."</div>";
						*/

						// version 2.0
						// only this will be shown!!!
						// the moment when you start to change the good structure!
						// it is here! here! 
						$str=$str.$this->viewContent( $app, $userId );

						// add actions


						// show icons ... 


					return $str;
				}

					// content here ... 

				function viewTreeDetailStop( $depth, $app, $userId)
				{
					$str="";
						$str=$str."</div>";
					return $str;
				}

   		// detail is all together ... 
		function viewContent( $app, $userId )
		{
			// $str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$this->textobjectObject->textobjectArgumentText."</div>";
			$strContent=TextObjectView::textToHtml($this->textobjectObject->textobjectArgumentText);
			$strContent=str_replace("\n","<br>",$strContent);

			$strOnClick=$this->getOnClickURLWebservice( $this->textobjectObject ); // onClick

			$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content' $strOnClick>";


			// side actions
			// $str=$str."".$this->viewSideActions($app,$userId);

			$str=$str."<div class='textobjectHyperthreadPlainDetailTitle'>";
			$str=$str.$this->showVisibility( $app );
			$str=$str.$strContent;
			$str=$str."</div>";
			// add members here ... 
			// $str=$str.$this->viewMembers( $app, $userId );

			// text ... 
			$htmltext=$this->textobjectObject->getMemberValue( "maintext", $app, $userId );
			if ($htmltext!="") $str=$str.$htmltext;

			$str=$str."</div>";

			// add actions
			// $str=$str.$this->viewSideActionsComments( $app, $userId );

			$str=$str."\n<div class='textobjectHyperthreadPlainDetailIcon'>".$this->viewActionCommanEditIcon( $app, $userId )."</div>";
			$str=$str."\n<div class='textobjectHyperthreadPlainDetailIcon'>".$this->viewActionCommandRuleIcon( $app,$userId )."</div>.";
			$str.$str."\n<div class='textobjectHyperthreadPlainDetailIconsReset'></div><br>";
			// comments
			// version 1
			// $str=$str.$this->viewSideActionsComments( $app, $userId );


			return $str;
		}

		// overwriting existing methodes
		// list version ... 
		function viewList($app,$userId)
		{
			$str="";

				$str=$str."<div class='textobjectHyperthreadPlainDetailListViewStart'></div>";

					$str=$str."<div class='textobjectHyperthreadPlainDetailListViewContainer'>";

						// href
						$str=$str.$this->getNoScriptHrefURLDirect( $this->textobjectObject );
						$str=$str."<div class='textobjectHyperthreadPlainTreeDetailTitle' ".$this->getOnClickURLWebservice($this->textobjectObject).">";
							$str=$str.$this->textobjectObject->getArgument()."";
						$str=$str."</div>";

					$str=$str."</div>";

				$str=$str."<div class='textobjectHyperthreadPlainDetailListViewEnd'></div>";

			return $str;
		}




	}
	
    
?>