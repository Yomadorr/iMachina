<?

	class TextObjectThreadView extends TextObjectView
	{
		var $textobjectviewType="thread";
		var $textobjectviewTypeSub="plain";

		var $textobjectviewIcon="TextPlainIcon.png"; // * not used
		var $textobjectviewIconBig="TextPlainIconBig.png"; // * not used
		var $textobjectviewLabel="Thread"; // @textobject.label*
		var $textobjectviewDescription="a simple thread for this ..."; // @textobject.description		


			/*

				Tree things

			*/

					function showTreePart( $startDepthIndex, $arrPartOfTree, $app, $userId)
					{
						$str="";

						/*
						echo("showTreePart()<pre>");
						print_r($arrPartOfTree);
						echo("showTreePart()</pre>");
						*/

						for ($i=0;$i<count($arrPartOfTree);$i++)
						{
							$objSibling=$arrPartOfTree[$i];
							$nextDepth=$startDepthIndex-$i;
							if ($startDepthIndex==-1) $nextDepth=-1;
							if ($startDepthIndex==-2) $nextDepth=-2;
							$str=$str.$this->showSiblingLineBySiblingId( $nextDepth, $objSibling->textobjectId, $app, $userId );
						}

						return $str;
					}

					function showSiblingLineBySiblingId( $depth, $siblingId, $app, $userId )
					{
						$str="";

						$arrSiblings=$app->getDomainSiblingsByParentId($siblingId, $userId);
						//if (count($arrSiblings)>1)
						//{	
							$str=$str.$this->showSiblingLine($depth, $siblingId, $arrSiblings, $app, $userId );
						//}
						

						return $str;
					}

						function showSiblingLine( $depth, $siblingId, $arrSiblings, $app, $userId )
						{
							// depth
							$depthStart=$depth;

							// show singling lines ...
							// opacity?
							$opacity=1.0;
							$newdepth=8;
							if ($depth!=-1)
							{
								$newdepth=$depth*1.3;
								if ($newdepth>8) $newdepth=8;
								$opacity=$opacity-($newdepth/10);
							}


							$str="<div class='treeSiblingBottomLine' style='opacity: $opacity; _overflow: hidden; _vertical-alignment: top; _height: 14px;'>"; // margin-top: ".-$newdepth."px

//							$str=$str."&nbsp;($depth)";

							// $str=$str."-$siblingId-";
							$strMenuPoints="";
							$threadObj=null;
							$selectedThreadViewObj=null;
							for ($i=0;$i<count($arrSiblings);$i++)
							{
								$threadObj=$arrSiblings[$i];
								
								// version 2.0
								$threadObjView=$app->getTextObjectViewFor($threadObj, $app, $userId);
								
									// href: simple noscript link for crawler  
									$str=$str.$this->getNoScriptHrefURLDirect( $threadObj );
									// normal: link
									if ($threadObj->textobjectId==$siblingId) 
									{ 
										$selectedThreadViewObj=$threadObjView; 
										// $strMenuPoints=$strMenuPoints.$threadObjView->viewTreeMenuPointSelected( $depth, count($arrSiblings), $app, $userId); 
									}
									if ($threadObj->textobjectId!=$siblingId) $strMenuPoints=$strMenuPoints.$threadObjView->viewTreeMenuPoint( $depth, count($arrSiblings), $app, $userId);

							}

							// the first in line ...
							if ($selectedThreadViewObj!=null) $str=$str.$selectedThreadViewObj->viewTreeMenuPointSelected( $depth, count($arrSiblings), $app, $userId); 

							// the menu points
							$str=$str.$strMenuPoints;

							// add +
							// todo: check accessibility.. 
							// add new ... 
							if ($depthStart==-2) 
							{
								// check access
								$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $threadObj->textobjectId, $userId );
								if ($app->checkRuleMatrixFor($ruleaccessmatrixObj,"comment"))
									$str=$str."<div class='textobjectThreadPlainTreeContainerMenuPoint' id='iMachinaAddThread".$threadObj->textobjectRef."' ".$this->viewOnAddThreadClick( $threadObj->textobjectRef, "iMachinaAddThread".$threadObj->textobjectRef )."> +</div>";
							}

							$str=$str."</div>";  

							return $str;
						}

						// ...
						function showChildren( $parenttextobjectId, $arrChildren, $app, $userId )
						{
							
							$str="";
							$str=$str."<div style='_float: right; background: white; margin-top: 10px; z-index: 1000px;'";
								
								$str=$str."<div class='treeSiblingBottomLine' style='opacity: 1.0; _overflow: hidden; _vertical-alignment: top; _height: 14px;'>"; // margin-top: ".-$newdepth."px

								$str=$str."<div style='width: 300px;'></div>";
	//							$str=$str."&nbsp;($depth)";

								// $str=$str."-$siblingId-";
								if (count($arrChildren)>0)
								{
									$threadObj=null;
									for ($i=0;$i<count($arrChildren);$i++)
									{
										$threadObj=$arrChildren[$i];
										
										// version 2.0
										$threadObjView=$app->getTextObjectViewFor($threadObj, $app, $userId);
										
											// href: simple noscript link for crawler  
											$str=$str.$this->getNoScriptHrefURLDirect( $threadObj );
											$str=$str.$threadObjView->viewTreeMenuPoint( -2, count($arrChildren), $app, $userId);
									}

								}

									// add +
									// todo: check accessibility.. 
									// add new ... 
										// check access

										$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $parenttextobjectId, $userId );
										if ($app->checkRuleMatrixFor($ruleaccessmatrixObj,"comment"))
											$str=$str."<div class='textobjectThreadPlainTreeContainerMenuPoint' id='iMachinaAddThread".$parenttextobjectId."' ".$this->viewOnAddThreadClick( $parenttextobjectId, "iMachinaAddThread".$parenttextobjectId )."> +</div>";
								$str=$str."</div>";  
							$str=$str."</div>";

							return $str;
						}
								/*
									display menupoint
								*/
								// overwrite this here .. 
								function viewTreeMenuPoint( $depth, $siblingAmount, $app, $userId)
								{
									$str="";

										$str=$str."<div class='textobjectThreadPlainTreeContainerMenuPoint' ".$this->getOnClickURLWebservice( $this->textobjectObject ).">";
										$str=$str.$this->textobjectObject->getArgumentCutted()." ";
										$str=$str."</div>";

									return $str;
								}

									//   ___________________
									// _| threadA selected* |__
									function viewTreeMenuPointSelected( $depth, $siblingAmount,  $app, $userId)
									{
										$str="";

											$str=$str."<div class='textobjectThreadPlainTreeContainerMenuPointActive' ".$this->getOnClickURLWebservice( $this->textobjectObject ).">";
											$str=$str.$this->textobjectObject->getArgumentCutted()."";
											$str=$str."</div>";

										return $str;
									}


							// getHrefURLDirect
							function getNoScriptHrefURLDirect( $threadObj )
							{
								return "<noscript><a href='".$this->getHrefURLDirect( $threadObj )."' alt='".$threadObj->getArgument()."'>".$threadObj->getArgument()."</a></noscript>";
							}

								function getHrefURLDirect( $threadObj )
								{
									return "?id=".$threadObj->textobjectId;
								}

							// getOnClickURLWebservice
							function getOnClickURLWebservice( $threadObj )
							{
								return " onClick=\"".$this->getHrefURLWebservice( $threadObj )."\" ";
							}

								function getHrefURLWebservice( $threadObj )
								{
									$javascriptDiv="content";
									/*
									$rootObj=$app->getRootObject( $obj, $userId  );
										if ($userId!=-1)
											if ($rootObj->textobjectUserRef==$userId) $javascriptDiv="user";
									*/
									return "loadContent( ".$threadObj->textobjectId.",'$javascriptDiv');";
								}

			/*

				detail

			*/
			// view no access ...
			function viewDetailNoAccess($app,$userId)
			{
				$str="";

				// add possibitlity to ... 
				$str="<div class='detailContainerNoAccess'><div class='detailContainerNoAccessIcon'></div>";
					$str=$str."<div >Sorry, you don't have access here.";

						// request ... 
						// if user is not anonymous!
						if ($userId!=$app->getUserAnonymousId())
						{
							// default ...
							$textobjectBaseId=$this->textobjectObject->textobjectId;

							// tree
							$arrTree=$app->getTreeUpForIdDirectExt( $this->textobjectObject->textobjectId, $userId );
							$textobjectBaseIndex=$app->getIndexInTreeFirstHyperThread( $arrTree );
							$textobjectBaseObj=$arrTree[$textobjectBaseIndex];
							$textobjectBaseId=$textobjectBaseObj->textobjectId;
							// echo("textobjectBaseId: $textobjectBaseId");

							$str=$str."<br><div class='detailContainerNoAccessRequest' onClick=\"doCommandRuleRequest('freerider',".$textobjectBaseId.")\">Request Follow (Read)</div>";
							$str=$str."<div class='detailContainerNoAccessRequest' onClick=\"doCommandRuleRequest('friend',".$textobjectBaseId.")\">Request Friend (Read & Comment)</div>";

							// check if there is a request there?
							// todo: get the not active rules!!!!
						}
						else
						{
							$str=$str."<div>You can request access, if you are not an anonymous user. Create a user.</div>";
						}
					$str=$str."</div>";
				$str=$str."</div>";

				return $str;
			}


			/*
		
				in the comments-list

			*/

			// overwriting existing methodes
			// list version ... 
			function viewList($app,$userId)
			{
				$str="";

					$str=$str."<div class='textobjectThreadPlainDetailListViewStart'></div>";

						$str=$str."<div class='textobjectThreadPlainDetailListViewContainer'>";
	
							// href
							$str=$str.$this->getNoScriptHrefURLDirect( $this->textobjectObject );
							$str=$str."<div class='textobjectThreadPlainDetailListView' ".$this->getOnClickURLWebservice($this->textobjectObject).">";
								$str=$str.$this->textobjectObject->getArgument();
							$str=$str."</div>";
	
						$str=$str."</div>";

					$str=$str."<div class='textobjectThreadPlainDetailListViewEnd'></div>";

				return $str;
			}




			function viewHeader( $addHDivClass="" )
			{
				$debugThis=false;

				$str="";

//$str=$str."<div style='font-size:8px;'>id:".$this->textobjectObject->textobjectId."</div>";
				
				if ($debugThis) $str=$str."TextObject-Typ: [".$this->textobjectObject->textobjectType."/".$this->textobjectObject->textobjectTypeSub."]";
// echo("<pre>");print_r($this->textobjectObject);echo("</pre>");
				if ($debugThis) $str=$str."<br>TextObjectView-Typ: [".$this->textobjectviewType."/".$this->textobjectviewTypeSub."]";
// echo("<pre>");print_r($this);echo("</pre>");

				// $str=$str."$addHDivClass";


				if ($debugThis) $str=$str."<br>[".$this->textobjectObject->textobjectId."]";


				$strStyle="";
				if ($this->textobjectObject->textobjectWidth!="") $strStyle=" style='width: ".$this->textobjectObject->textobjectWidth."px; ' ";


				// the divs ...
				$str=$str."\n<div class='detailContainerThread $addHDivClass' id='".$this->getDivId()."' $strStyle> ";
				
				return $str;
			}							


			function viewDetailAccess( $app, $userId )
			{
				$str="";

				// $str=$str."\n (".$this->textobjectObject->textobjectRef.")--".$this->textobjectObject->textobjectId."";

				// echo("<br>viewDetail() ");

				$str="\n\n<!-- ---------------- imachina object thread ".$this->textobjectObject->textobjectId."  ----------------  -->\n\n";


				// CONTENT
				$str=$str."<div class='detailThreadPlainContainer' >";
				$str=$str.$this->viewHeader( "" );

					// get core info 
					$str=$str."\n <div id='".$this->getDivId()."Core'>";
						// add core ... 
						$str=$str.$this->viewDetailCore( $app, $userId );
					// info
					$str=$str."\n </div>";

				// comments
//				$str=$str."\n   ".$this->viewCommentsCommentTypeVisual( $app, $userId )."";
				$str=$str."\n   ".$this->viewComments( $app, $userId )."";

					// add icon at the end ...
					if ($this->viewActionCommandAddIconCommentable( $app, $userId ))
					{
						$str=$str."<div style='padding-top: 30px;' >";
							// solve this visual problem!
							$str=$str."<div id='commentDetailFooterAdd".$this->getIdOrRef()."'  ".$this->viewOnAddClick( 'commentDetailFooterAdd'.$this->getIdOrRef())." valign=top><span style='vertical-alignment: top; valign: top; vertical-align:text-top;' valign=top><div class='detailContainerContentActionsAdd' style='vertical-alignment: top; valign: top; vertical-align:text-top;' title='Add Comment'></div> Add comment</span></div>";
						$str=$str."</div>";
					}

				$str=$str."".$this->viewFooter();
				$str=$str."</div>";


				$str=$str."\n\n<!--  /imachina object thread ".$this->textobjectObject->textobjectId." ----------------   -->\n\n"; 


				return $str;

			}	

           		// detail is all together ... 
				function viewContent( $app, $userId )
				{
					// $str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$this->textobjectObject->textobjectArgumentText."</div>";
					$strContent=TextObjectView::textToHtml($this->textobjectObject->textobjectArgumentText);
					$strContent=str_replace("\n","<br>",$strContent);
					$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>";

						// side actions
						// $str=$str."".$this->viewSideActions($app,$userId);

						$str=$str."<div class='textobjectThreadPlainDetailCore'>";
							$str=$str.$strContent;

							// children ...
							// version 1.0
							$arrChildren=$app->getTextObjectChildrenById( $this->getId(), $userId );
							$str=$str.$this->showChildren( $this->getId(), $arrChildren, $app, $userId );

							

						$str=$str."</div>";
						// add members here ... 
						// $str=$str.$this->viewMembers( $app, $userId );
						// ....

					$str=$str."</div>";


					// comments
					$str=$str.$this->viewSideActionsComments( $app, $userId );


					return $str;
				}


			function viewDetailCore( $app, $userId )
			{
				$str="";

					// version 1.0
					// $str=$str."\n <div _style='border: 1px solid black; vertical-alignment: top; '>";	



						// timeline
						$str=$str."\n   ".$this->viewTimeline( $app, $userId )."";					

						// detail
						$str=$str."\n   ".$this->viewContent( $app, $userId )."";					
	
					
					// $str=$str."\n </div>";	

					// view side actions
					$str=$str."".$this->viewSideActionsTop($app,$userId);
					$str=$str."".$this->viewSideActionsBottom($app,$userId);

				return $str;

			}	


			function viewFormExtendedCoreContentForm( $addDivAction="" )
			{
				$str="";
				
				// todo: escape html-entities
				$str=$str."\n  	<input type=textfield size=50 id='Form".$addDivAction."DatatextobjectArgument'    style='width: 98%'  value='".$this->textobjectObject->textobjectArgumentText."''>";

				return $str;
			}


			// show all
			function viewComments( $app, $userId )
			{
				// ... the visuals
				$arrTextObjects=$app->getAllCommentsByRef( $this->textobjectObject->textobjectId, $userId );

				$str="";

					$str=$str.     "\n <div class='textobjectThreadPlainDetailComponentComments'  id='".$this->getDivId()."Comments' >";			
					
					$str=$str."\n   ";
					for ($i=0;$i<count($arrTextObjects);$i++)
					{
						$textobjectTmp=$arrTextObjects[$i];
						$textobjectViewTmp=$app->getTextObjectViewFor( $textobjectTmp, $userId );
						if ($textobjectViewTmp!=null)
						{
							$str=$str.     "\n <div class='detailComponentCommentsSpacer' ></div>";			
							$str=$str.$textobjectViewTmp->viewList($app,$userId);
							$str=$str.     "\n <div class='detailComponentCommentsSpacerBottom'   ></div>";			
						}

					}
					// todo: added this / changed this here!
					$str=$str."</div>";



				return $str;
			}

	}
	
    
?>