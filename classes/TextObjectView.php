<?

	class TextObjectView
	{
		var $textobjectviewVersion=1.0;

		var $textobjectviewType="text";
		var $textobjectviewTypeSub="plain";

		var $textobjectviewIcon="TextPlainIcon.png"; // * not used
		var $textobjectviewIconBig="TextPlainIconBig.png"; // * not used
		var $textobjectviewLabel="Text"; // @textobject.label*
		var $textobjectviewDescription="Simple Textobject."; // @textobject.description


		var $textobjectviewInteractionType="text"; // text|visual // todo: take from object ... 

		var $textobjectObject;

		// textobjectArgumentEditor 
		// todo: textobjectviewArgumentEditor
		var $textobjectviewArgumentEditor="form"; // form (html) / tinymce /  

		// display things - temporary
		// default show .. 
		var $textobjectAddShow=true;
		var $textobjectAddContainerViewFormDiv=true;
		var $textobjectAddShowObjects=true; // show all Objects

		// selectedobject there?
		var $textobjectViewWithId=-1;

		// ruleaccessmatrix
		var $textobjectRuleAccessMatrix=null;
			function getRuleAccessMatrix( $app, $userId )
			{
				if ($this->textobjectRuleAccessMatrix==null)
				{
					$this->textobjectRuleAccessMatrix=$app->getRuleAccessMatrixByTextObjectId( $this->textobjectObject->textobjectId, $userId );
				}

				return $this->textobjectRuleAccessMatrix;				
			}

		// will be overwritten 
/*
		function viewDetailWithIdStart( $showId, $app, $userId )
		{
			$this->textobjectViewWithId=$showId;

				$str="";
				$str=$str."viewDetailWithId( $showId, app, $userId )";

			return $str;
		}
*/
/*			// will be overwritten 
			function viewDetailWithId( $showId, $app, $userId )
			{
				$this->textobjectViewWithId=$showId;

				$str="";
				$str=$str."viewDetailWithId( $showId, app, $userId )";

				// not the receiver > show special .. 


				// the receiver > show detail

				return $str;
			}
*/
				// get Div ID
				function getDivId()
				{
					// update
					if ($this->textobjectObject->textobjectId==-1) return $this->getDivIdBase().$this->textobjectObject->textobjectRef;
					// 
					else return $this->getDivIdBase().$this->textobjectObject->textobjectId;
				}

					function getId()
					{
						return "".$this->textobjectObject->textobjectId;
					}


					function getDivIdBase()
					{
						return "iTextObjectDetail";
					}

				// not often use > only for timeline
				function getDivIdById( $id )
				{
					// update
					return $this->getDivIdBase().$id;
				}

			function getDivIdOrRef()
			{
				return $this->getDivIdBase().$this->getIdOrRef();
			}

				function getIdOrRef()
				{
					if ($this->textobjectObject->textobjectId==-1) return $this->textobjectObject->textobjectRef;
					else return $this->textobjectObject->textobjectId;
				}

		/*
			Views (Usage)
			- viewInTree (if it is thread or hyperthread ... )
			- speical in threads > 
			- viewDetail
			-- viewList
			--- viewDetail'
		*/



		/*
			SHOW DETAIL WITH SELECTED CONTENT
		*/
		// used for Platform > Domain > Hyperthreads > Thread
		// var $selectedTextObjectId=-1;
		/*
		function viewDetailSelectContent( $showId, $app, $userId )
		{
			$this->textobjectViewSelectedTextObjectId=$showId;	

				// if ($showId==$this->getId()) return viewInTree( $app, $userId );

			return $this->viewDetail( $app, $userId );
		}
		*/			

		/*
			Views:

			- viewTree  & viewTreeSelected (In The Tree) > used in Thread/HyperThread/Domain/Thread
			  - [threadA][threadB]
     		- viewTreeDetail (Selected Thread) > used in Thread/HyperThread/Domain/Thread 
			
			- viewDetail (Detail+List) 
			  - viewList (In a comment-list)			

		*/
		/*
			in trees ... 
		*/
		// used in Thread/HyperThread/Domain/Thread

		//
		//  trees

// todo: add access

		//   __________
		// _| threadA* |__
		function viewTree( $depth, $app, $userId)
		{
			return $this->textobjectObject->getArgument();
		}

			//   ___________________
			// _| threadA selected* |__
			function viewTreeSelected( $depth, $app, $userId)
			{
				return $this->textobjectObject->getArgument()."*";
			}

		//
		// selected treeobject detail 
		//  ______________________________________
		// |_threadADetailStart____________________|__
		//  ______________________________________
		// |_threadADetailStop____________________|__

// todo: add access

		function viewTreeDetailStart( $depth, $app, $userId)
		{
			$str="";
/*			$str=$str."<div style='border: 1px solid black; background: #eeeeee; padding-left: 10px; padding-right: 10px; padding-bottom: 20px; '>";
				$str=$str."<div style='_border-bottom: 1px solid; font-size: 24px; _padding-left: 8px; _padding-right: 8px;'>".$this->textobjectObject->getArgument()."</div>";
*/			return $str;
		}

			// content here ... 

		function viewTreeDetailStop( $depth, $app, $userId)
		{
			$str="";
//				$str=$str."</div>";
			return $str;
		}
		


		// function viewList( $app, $userId )
		// listview ... 
		// view a list as comments ... 

// todo: add access

		function viewList(  $app, $userId ) // $app, $userId
		{
			return $this->viewDetail( $app, $userId );
		}

		/*
		
		  DETAIL in HTML
		  
		  ID: iObjectDetail+ID

		  - iObjectDetail+ID
		    |_ iObjectDetail+ID+Core 	
 		      |_ iObjectDetail+ID+Content 	
 		      |_ iObjectDetail+ID+Actions 	
 		      |_ iObjectDetail+ID+Comments

		*/

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
				$str=$str."\n<div class='detailContainer $addHDivClass' id='".$this->getDivId()."' $strStyle> ";

				// the modify top
				// $str=$str."\n<div class='detailContainerModifyIcon' onClick=\"$('#".$this->getDivId()."Actions').toggle();$('#".$this->getDivId()."Timeline').toggle();\"></div>";

				// if ther are some!
				// $str=$str."\n   <div style='border: 1px dotted black'>THREADA|THREADB|THREADC</div>";

				return $str;
			}
		// function viewDetail( $app, $userId )
		/*
			viewDetail()
			-> noaccess: viewDetailNoAccess($app,$userId)
			-> access: viewDetailAccess( $app, $userId )
		*/
		function viewDetail( $app, $userId )
		{
			$str="";

			// access?
			// todo: put to view  or direct in methodes ... ?
			
			/*	$showThis="";
				if (!$ruleaccessmatrixObj->isReadable()) $showThis="NOT VISIBLE! HIDDEN! FOR THIS USER!";
			 	$str=$str."<br>DEBUG: VISIBLITY: ".$ruleaccessmatrixObj->debug()."  <strong>$showThis</strong>";
			*/

			// show or not?
			if (!$this->getRuleAccessMatrix($app,$userId)->isReadable()) $str=$str.$this->viewDetailNoAccess($app,$userId);
			if ($this->getRuleAccessMatrix($app,$userId)->isReadable()) $str=$str.$this->viewDetailAccess($app,$userId);

			return $str;
		} 

			// view no access ...
			function viewDetailNoAccess($app,$userId)
			{
				$str="";

				$str="<div class='detailContainerNoAccess'><div class='detailContainerNoAccessIcon'></div>Sorry, you don't have access here.</div>";

				return $str;
			}

			// function viewDetail( $app, $userId )
			function viewDetailAccess( $app, $userId )
			{
				$str="";

				$str=$str."\n\n<!-- ---------------- imachina object ".$this->textobjectObject->textobjectId."  ----------------  -->\n\n";


				$str=$str."".$this->viewHeader();
				
					// visual
					$str=$str."\n   ".$this->viewCommentsCommentTypeVisual( $app, $userId )."";	

					// mouse over toolbar js
					$str=$str."\n<script>";
					$str=$str."\n    function showActionToolbar".$this->getDivId()."(){";
					$str=$str."\n        $('#".$this->getDivId()."Core .detailContainerContentActionsTop').show();";
					$str=$str."\n    }";
					$str=$str."\n    function hideActionToolbar".$this->getDivId()."(){";
					$str=$str."\n        $('#".$this->getDivId()."Core .detailContainerContentActionsTop').hide();";
					$str=$str."\n    }";
					$str=$str."\n</script>";

					// get core info 
					$str=$str."\n <div id='".$this->getDivId()."Core' onmouseover=\"showActionToolbar".$this->getDivId()."();\" onmouseout=\"hideActionToolbar".$this->getDivId()."();\" onResize=\"debug('Resize');\">";

						// add core ... 
						$str=$str.$this->viewDetailCore( $app, $userId );

					// info
					$str=$str."\n </div>";

					// mouse over toolbar js
					$str=$str."\n<script>";
					$str=$str."\n    hideActionToolbar".$this->getDivId()."()";
					$str=$str."\n    $('#".$this->getDivId()."Core .detailContainerContentActionsTop').css('position','absolute');";
					$str=$str."\n</script>";
					
					// comments
					$str=$str."\n   ".$this->viewCommentsCommentTypeClear( $app, $userId )."";

				$str=$str."".$this->viewFooter();

				// double click
				// $str=$str."<script>$('#".$this->getDivId()."').dblclick(function () { $('#".$this->getDivId()."Actions').toggle();$('#".$this->getDivId()."Timeline').toggle(); });</script>";


				$str=$str."\n\n<!--  /imachina object ".$this->textobjectObject->textobjectId." ----------------   -->\n\n"; 

				return $str;

			}	

				function viewFooter()
				{ 
					$str="\n</div>";
					return $str; // "</div>";
				}


				function viewDetailCore( $app, $userId )
				{
					$str="";

						// version 1.0
						$str=$str."\n <div style='border: 1px solid black; vertical-alignment: top; '>";	

							// view side actions
							$str=$str."".$this->viewSideActionsTop($app,$userId);

                            // portrait pic
                            $userObj=$app->getUserById($this->textobjectObject->textobjectVersionUserRef);
                            $userIconPath="styles/default/imgs/UserViewDefaultIcon.png";
                            if ($userObj && $userObj->userIconStatus=="icon") $userIconPath="documents/user".$userObj->userId.".png";
                            $str=$str."\n<img class='userPortraitIconSmall' src='".$userIconPath."' height='20px' style='float:left; margin-left:-20px;'/>";
							//$str=$str."\n <img src='styles/default/imgs/UserViewDefaultIcon.png' style='float:left; margin-left:-20px;' height='20px'/>";	
							

							// add
	//						$str=$str."\n  	".$this->viewAddForm(  $app, $userId  )."";	
							// edit
	//						$str=$str."\n  	".$this->viewForm( $app, $userId )."";		


								// visualComments
								// $str=$str."\n   ".$this->viewCommentsCommentTypeVisual( $app, $userId )."";					
									// if visuall comment possible
									// if ($this->textobjectObject->innerCommentType=="visual") $str=$str."\n  ".$this->viewAddFormVisual()."";	

							// detail
							$str=$str."\n   ".$this->viewContent( $app, $userId )."";					

							// timeline
							$str=$str."\n   ".$this->viewTimeline( $app, $userId )."";				
						
						$str=$str."\n </div>";	

						$str=$str."".$this->viewSideActionsBottom($app,$userId);

					return $str;

				}	



				//
				// submethodes
				// 
				function viewTimeline( $app, $userId )
				{
					return $this->viewTimelineWithDivEnvelope( true, $app, $userId );
				}
			
						// show timeline and all visual or textmarkers here ... 
						function viewTimelineWithDivEnvelope( $flagDivEnvelope=true, $app, $userId )
						{
							$str="";

							$arrTimed=$app->getAllCommentsTimedByRef( $this->textobjectObject->textobjectId, $userId );

							$maxTime = $this->textobjectObject->textobjectTimeLength; // in secs ...
							if($maxTime == -1){
								$maxTime=0; // in secs ...
								for ($r=0;$r<count($arrTimed);$r++)
								{
									$textobjectTimed=$arrTimed[$r];
									if ($textobjectTimed->textobjectTimeA>$maxTime) $maxTime=$textobjectTimed->textobjectTimeA;
									if ($textobjectTimed->textobjectTimeB>$maxTime) $maxTime=$textobjectTimed->textobjectTimeB;
								}
							}

							// factor
							$maxTimePixelForEverySecond=1.0;
							// show the line
							// todo: javascript released?


							$flagDisplay=false;
							$strStyle="  style='display:none;' ";
							if (count($arrTimed)>0 || $maxTime>0) { $flagDisplay=true; $strStyle=""; }


							// the line
							if ($flagDivEnvelope) $str="\n   <div class='detailComponentGenericMore' id='".$this->getDivId()."Timeline' $strStyle >";
								//$str=$str."[>]";
								// $str=$str."[$maxTime secs]";

								// get all timestamped things here ...
								// print_r($arrTimed);

								// add timelines
								$str=$str."<div id='".$this->getDivId()."TimelinePlayer'></div>";
								$str=$str."\n<script>";
								$timelineId=$this->getId();
								// add javascript
								$str=$str."\n var timelineObj".$timelineId."=new iMachinaTimeLine();";
								// setup player
								$str=$str."\n 	timelineObj".$timelineId.".setId('".$this->getId()."');";
								$str=$str."\n	timelineObj".$timelineId.".setMaxTime(".$maxTime.");";
								$str=$str."\n	timelineObj".$timelineId.".setWidth(400.0);";
								$str=$str."\n	timelineObj".$timelineId.".playerDiv='".$this->getDivId()."TimelinePlayer';";
								for ($r=0;$r<count($arrTimed);$r++)
								{ 
									$textobjectTimed=$arrTimed[$r];
									// $str=$str."\n<br>-$r ".$textobjectTimed->textobjectTimeA."-".$textobjectTimed->textobjectTimeB;
									$divId=$this->getDivIdById(  $textobjectTimed->textobjectId );
									$str=$str."\n	timelineObj".$timelineId.".addTextObject(".$textobjectTimed->textobjectTimeA.",".$textobjectTimed->textobjectTimeB.", ".$textobjectTimed->textobjectId .",'".$divId."','".$textobjectTimed->textobjectTimeAction."');";
								}
								$str=$str."\n timelineObj".$timelineId.".display();";
								$str=$str."\n</script>";

								$str=$str."";

							if ($flagDivEnvelope) $str=$str."</div>";
							// $str=$str."<br>";

							return $str;
						}
					

						// detail is all together ... 
						function viewContent( $app, $userId )
						{

							// $str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$this->textobjectObject->textobjectArgument."</div>";
							$strContent="";

							$strContendDefault=TextObjectView::textToHtml($this->textobjectObject->getArgument());
							$strContendDefault=str_replace("\n","<br>",$strContendDefault);

// echo("Is wordtext: [".$this->textobjectObject->isWordText()."]");

								// default: not yet commented and converted
								if (!$this->textobjectObject->isWordText())
								{
									$strContent="".$strContendDefault."";
									// todo: also possible just do like comment and
									// only add if there is really a comment!
									// 
								}

								// converted with comments?
								if ($this->textobjectObject->isWordText())
								{

									// update this object
									$this->textobjectObject->updateArgumentAsWordText();

// echo("*****".$this->textobjectObject->getArgument());

									// conversion done - go on with this here ..
									$text=$this->textobjectObject->getArgument();
// echo("*****".$text);

// todo: put into a own methode
									// $text="OKDOIT<br>".$text;
									// add the rest things here ... 

									// add comments div container
									$text=$this->textInsertTextCommentContainer( $text );

									// javascripts ...

									// add onClicks
									$text=$this->textInserJavascriptOnClick( $text );

									// add the text
									$strScript="<script>";
									// todo: delete old words !!!! > do it javascript
//									$strScript=$strScript."\n imachinaTextManager.deleteTextWordsByTextObjectId( ".$this->textobjectObject->textobjectId." ); ";

									$arrWords=$this->textobjectObject->getTextWords( );
									for ($t=0;$t<count($arrWords);$t++)
									{
										$wordObj=$arrWords[$t];
										$strScript=$strScript."\n imachinaTextManager.addTextWord( ".$wordObj->textwordTextObjectId.", ".$wordObj->textwordId.", \"".$wordObj->getWordJavascriptFormat()."\" ); ";
									}
									$strScript=$strScript."</script>";
									$text=$text.$strScript;

									// ok that was it
									$strContent="CONVERTTED!<br><div class='detailComponentCommentsTextIcon'>test</div>".$text;
								}


							$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content' >";
							    
								// side actions
								// $str=$str."".$this->viewSideActions($app,$userId);
								// the content
								$str=$str.$strContent;
								// add members here ... 
								$str=$str.$this->viewMembers( $app, $userId );

							$str=$str."</div>";


							// comments
							// $str=$str.$this->viewSideActionsComments( $app, $userId );

							return $str;
						}

										// html output
										function textInsertTextCommentContainer( $text )
										{

												// add comments and divs here ...
												// todo: for eff. comments do this here ... 

												// add divs for ajax
												// version 1
												// $selectableText=preg_replace("/( id='imt(\d+)_(\d+)' imachinaTag>([^<]+))/", "$1<div style='display: inline; position: relative;'><div  style='position: absolute; display: inline; top: 20px; opacity: 1.0;' id='imcommentt$2_$3'></div></div>", $selectableText);
												// $selectableText=preg_replace("/( id='imt(\d+)_(\d+)' imachinaTag>([^<]+))/", "$1<div style='display: inline; position: relative;'><div  style='position: absolute; display: inline; top: 20px; opacity: 1.0;' id='imcommentt$2_$3'></div></div>", $selectableText);
												// version 2
												$text=preg_replace("/( id='endimt(\d+)_(\d+)'>)/", "$1<div class='detailComponentCommentsText'  id='commentimt$2_$3'></div>", $text);

												return $text;

										}

										// javascript inserts
										// comment
										function textInsertComment( $text )
										{

	/*
												// display 
												// add a concrete comment here ...
												$textobjectIdThis=1001;
												$wordtextId=62;
												$textobjectCommentId=15001;
												// version 1.0
											//	$selectableText=preg_replace("/( id='imt".$textobjectIdThis."_".$wordtextId."' imachinaTag>([^<]+))/", "$1C", $selectableText);
											//	$selectableText=preg_replace("/( id='imcommentt".$textobjectIdThis."_".$wordtextId."'>)/", "$1<div style='border: 1px solid black; padding: 5px;'>ABC</div>", $selectableText);
												// version 2
												// add an icon (for show and hide)
												$selectableText=preg_replace("/( id='endimt".$textobjectIdThis."_".$wordtextId."'>)/", "$1<div class='detailComponentCommentsTextIcon' onClick=\"onTextCommentToggle( $textobjectCommentId )\">[]</div>", $selectableText);
												// add a comment for this	
												$selectableText=preg_replace("/( id='commentimt".$textobjectIdThis."_".$wordtextId."'>)/", "$1<div class='detailComponentCommentsTextEntity' id='imcommentt$2_$3'>ABC</div>", $selectableText);
	*/
											return $text;
										}

										// insert the 

										// onClick
										function textInserJavascriptOnClick( $text )
										{
											// add on click script here manualy ...
											$text=preg_replace("/(id='imt(\d+)_(\d+)')/", " onClick=\"onTextClick( $2, $3 )\"  $1", $text);										
											return $text;
										}


									function viewSideActionsTop( $app, $userId )
									{
										$str="";

										
										$str=$str."\n<div class='detailContainerContentActionsTop'>";
										$str=$str."\n   <table >";
										$str=$str."\n   <tr>";
										$str=$str."\n    <td>";

	//									$str=$str."\n   <div class='detailContainerContentActionsComments' onClick=\"doCommand".$this->getDivIdOrRef()."('comments')\" ></div>";
										$str=$str.$this->viewActionCommanEditIcon( $app, $userId );
										
										$str=$str."\n   </td>";


										$str=$str."<td>";

										// todo: access here!
										// todo: problem
										$str=$str.$this->viewActionCommandRuleIcon( $app,$userId );

	//									$str=$str."\n   <div class='detailContainerContentActionsAdd'   onClick=\"doCommand".$this->getDivIdOrRef()."('add')\"  ></div>";
										//$str=$str."\n</div>";
										$str=$str."\n    </td>";

										// active users
										$str=$str."\n    <td>";
										$str=$str."\n ";

											// show only colaborators
											// version 1: show all
											/*
											$arrRules=$app->getRulesByTextObjectId( $this->textobjectObject->textobjectId, $userId );
											for ($a=0;$a<count($arrRules);$a++)
											{
												$ruleObj=$arrRules[$a];
												$userObject=$app->getUserById($ruleObj->ruleUserRef);
												// print_r($userObject);
												$ruleName=""; if ($ruleObj!=null) $ruleName=$ruleObj->ruleName;
												$userIdHere=$ruleObj->ruleUserRef;
												$userName=""; if ($userObject!=null) $userName=$userObject->userName;
												$userIsMe=false;
												if ($userId=$userIdHere) $userIsMe=true;

												// todo: not correct but perhaps here
												// domain
												$userDomain=$app->getUserDomainByUserId($userIdHere,$userId);
												$userDomainId=-1; if ($userDomain!=null) { $userDomainId=$userDomain->textobjectId; }
												
												$userDesc=" $userName (".$ruleName.")";	
												// if ($userIsMe) $userDesc=" Ego + ";

												$userDescInclude=$userDesc;
												// if (!$userIsMe) 
												$userDescInclude="<a onClick=\"loadContent(".$userDomainId.",'user')\">$userDesc</a> ";
												$str=$str.$userDescInclude; 	

											}
											*/

											// version 2
											// show only collaborators
											/*
											$arrRules=$app->getRulesByTextObjectId( $this->textobjectObject->textobjectId, $userId );
											for ($a=0;$a<count($arrRules);$a++)
											{
												$ruleObj=$arrRules[$a];
												$userObject=$app->getUserById($ruleObj->ruleUserRef);
												// print_r($userObject);
												$ruleName=""; if ($ruleObj!=null) $ruleName=$ruleObj->ruleName;
												$userIdHere=$ruleObj->ruleUserRef;
												$userName=""; if ($userObject!=null) $userName=$userObject->userName;
												$userIsMe=false;
												if ($userId=$userIdHere) $userIsMe=true;

												// todo: not correct but perhaps here
												// domain
												$userDomain=$app->getUserDomainByUserId($userIdHere,$userId);
												$userDomainId=-1; if ($userDomain!=null) { $userDomainId=$userDomain->textobjectId; }
												
												if ($ruleName=="collaborator")
												{
													$userDesc=" [$userName] ";	
													// if ($userIsMe) $userDesc=" Ego + ";

													$userDescInclude=$userDesc;
													// if (!$userIsMe) 
													$userDescInclude="<a onClick=\"loadContent(".$userDomainId.",'user')\">$userDesc</a> ";
													$str=$str.$userDescInclude; 	
												}

											}
											*/

											// version 3
											// show only who changed something here ...
											$str=$str.$this->showCollaboratorHistory($app, $userId); // 



										// request users
										// todo: show that and first? 

										// display history here ...
										// todo: show work history
										// $str=$str.$this->showChangeHistory( $app, $userId );

										// visibility											
										// $str=$str.$this->showVisibility( $app );

										$str=$str."\n    </td>";

										$str=$str."<td>";
										$str=$str."".$this->viewActionCommanAddVisualIcon( $app,$userId );

	//									$str=$str."\n   <div class='detailContainerContentActionsAdd'   onClick=\"doCommand".$this->getDivIdOrRef()."('add')\"  ></div>";
										//$str=$str."\n</div>";
										$str=$str."".$this->viewActionCommanAddTextIcon( $app,$userId );

										$str=$str."\n    </td>";
										
										
										//$str=$str."\n    <td>";
										//$str=$str."\n    <a href='#' onclick='hideActionToolbar".$this->getDivId()."(); return false;'>x</a>";
                                        //$str=$str."\n    </td>";

										$str=$str."\n   <tr>";	

										$str=$str."\n   </table>";
										$str=$str."\n</div>";

										return $str;
									}

										function showCollaboratorHistory( $app, $userId )
										{
											$str="";

											$arrVersions=$app->getTextObjectVersions( $this->textobjectObject->textobjectId, $userId );
											if (count($arrVersions)>0)
											{
												$str=$str."";
												$lastUserId=-1;

												// if (count($arrVersions)>1) $str=$str.count($arrVersions)." Versions: ";

												for ($t=0;$t<count($arrVersions);$t++)
												{
													$textobjectObjTmp=$arrVersions[$t];
													$userObjVersion=$app->getUserById($textobjectObjTmp->textobjectVersionUserRef);
													if ($userObjVersion!=null)
													{
															
														$userDomain=$app->getUserDomainByUserId($textobjectObjTmp->textobjectVersionUserRef,$userId);
														$userDomainId=-1; if ($userDomain!=null) { $userDomainId=$userDomain->textobjectId; }
														

														if ($lastUserId!=$textobjectObjTmp->textobjectVersionUserRef)
														{
															// if ($t!=0)
															// if ($userIdenticCounter>1) 
															//	$str=$str.($userIdenticCounter+1)."x ";

																$userDescInclude="<a onClick=\"loadContent(".$userDomainId.",'user')\">";
																if ($userDomainId!=-1) $str=$str.$userDescInclude;

															$strMultiply="";
															// get amount
															$countThis=0;
															for ($z=$t;$z<count($arrVersions);$z++)
															{
																if ($textobjectObjTmp->textobjectVersionUserRef==$arrVersions[$z]->textobjectVersionUserRef)
																{	
																	$countThis++;
																}
															}
															
															if ($countThis>1) 
															  $strMultiply=$countThis."x ";
                                                            
														    // portrait pic
                                                            $userIconPath="styles/default/imgs/UserViewDefaultIcon.png";
                                                            if ($userObjVersion->userIconStatus=="icon") $userIconPath="documents/user".$userObjVersion->userId.".png";
														    $str=$str."\n<img class='userPortraitIconSmall' src='".$userIconPath."' height='20px' />";

															$str=$str." + ".$strMultiply.$userObjVersion->userName." + ";

																if ($userDomainId!=-1) $str=$str."</a>";

															$lastUserId=$textobjectObjTmp->textobjectVersionUserRef;
														}

													}
												}
												$str=$str."";
											}

											return $str;
										}

										function showChangeHistory( $app, $userId )
										{
											$str="<div class='detailContainerContentChangeHistory'>";

											$arrVersions=$app->getTextObjectVersions( $this->textobjectObject->textobjectId, $userId );
											if (count($arrVersions)>1)
											{
												$str=$str."<div class='detailContainerContentChangeHistoryContainer'>";

												$str=$str."";
												for ($t=0;$t<count($arrVersions);$t++)
												{
													// dates .... 
												}

												$str=$str."</div>";
											}

											$str=$str."</div>";

											return $str;
										}

										function showVisibility( $app )
										{
											$str="";
												// version 1.0
											// good for 2 rules > more ! > new version!
												$textobjectRuleAccessMatrixAnonymous=$app->getRuleAccessMatrixByTextObjectId( $this->textobjectObject->textobjectId, $app->getUserAnonymousId() );
											$flagAnonymous=$textobjectRuleAccessMatrixAnonymous->isReadable();
												$textobjectRuleAccessMatrixRegistrated=$app->getRuleAccessMatrixByTextObjectId( $this->textobjectObject->textobjectId, $app->getUserRegistratedId() );
											$flagRegistrated=$textobjectRuleAccessMatrixRegistrated->isReadable();
											
											if ($flagAnonymous) { $str=$str.""; } // Everbody
											if (!$flagAnonymous) 
											{ 
												if ($flagRegistrated) $str=$str."AllUsers"; 
												if (!$flagRegistrated) $str=$str."TeamOnly"; 
											}

											if ($str!="") $str="<div class='detailContainerContentVisibility'>".$str."</div>";

											return $str;
										}

									function viewSideActionsBottom( $app, $userId )
									{
										$str="";
										//$str=$str."\n<div class='detailContainerContentActionsBottom'>";
										$str=$str."\n   <table>";
										$str=$str."\n   <tr><td>";
											$str=$str."\n   <div class='detailContainerContentActionsComments' id='detailContainerContentActionsComments".$this->getIdOrRef()."' onClick=\"doCommandTextObject(".$this->getIdOrRef().",'comments','detailContainerContentActionsComments".$this->getIdOrRef()."')\"  title='Hide / Show Comments'></div>";
										$str=$str."\n   </td><td>";
											$str=$str.$this->viewActionCommanAddIcon( $app, $userId );
										$str=$str."\n   </td><tr>";
										$str=$str."\n   </table>";
										//$str=$str."\n</div>";

										return $str;
									}

											// commands
											function viewActionCommanEditIcon( $app, $userId )
											{
												$str="";
												if ($this->getRuleAccessMatrix($app,$userId)->isWritable()) $str=$str."\n   <div class='detailContainerContentActionsEdit' id='detailContainerContentActionsEdit".$this->getIdOrRef()."'   onClick=\"doCommandTextObject(".$this->getIdOrRef().",'edit','detailContainerContentActionsEdit".$this->getIdOrRef()."')\" title='Edit Content' ></div>";
												return $str;
											}
											function viewActionCommandRuleIcon( $app, $userId )
											{
												$str="";
													$divIdRule="detailContainerContentActionsRule".$this->getIdOrRef()."";
													// if ($this->getRuleAccessMatrix($app,$userId)->isWritable()) 
													$str=$str."\n   <div class='detailContainerContentActionsRule' id='$divIdRule' onClick=\"doCommandRuleOnTextObject('rule',".$this->getIdOrRef().",'$divIdRule')\" title='Rights / Rules' ></div>";
												return $str;
											}

											function viewActionCommanAddIcon( $app, $userId )
											{
												$str="";
												
												if ($this->getRuleAccessMatrix($app,$userId)->isCommentable()) $str=$str."\n   <div class='detailContainerContentActionsAdd' id='detailContainerContentActionsAdd".$this->getIdOrRef()."' ".$this->viewOnAddClick("detailContainerContentActionsAdd".$this->getIdOrRef())."' ".$this->viewOnAddClick()." title='Add Comment' ></div>";
												
												return $str;
											}

												function viewActionCommandAddIconCommentable( $app, $userId )
												{
													return $this->getRuleAccessMatrix($app,$userId)->isCommentable();
												}

												function viewOnAddClick( $divId="" )
												{
													 return " onClick=\"doCommandTextObject(".$this->getIdOrRef().",'add','$divId')\" ";
												}

												function viewOnAddThreadClick( $textobjectParentId, $divId="" )
												{
													 return " onClick=\"doCommandTextObject(".$textobjectParentId.",'addthread','$divId')\" ";
												}

											function viewActionCommanAddVisualIcon( $app, $userId )
											{
												$str="";
												if ($this->textobjectObject->innerCommentType=="visual")
													if ($this->getRuleAccessMatrix($app,$userId)->isCommentable()) 
														$str=$str."\n   <div class='detailContainerContentActionsAddPostIt' id='detailContainerContentActionsAddPostIt".$this->getIdOrRef()."' onClick=\"doCommandTextObject(".$this->getIdOrRef().",'addpostit','detailContainerContentActionsAddPostIt".$this->getIdOrRef()."')\" title='Add Postit' ></div>";
												return $str;
											}

											function viewActionCommanAddTextIcon( $app, $userId )
											{
												$str="";
												if ($this->textobjectObject->innerCommentType=="text")
													if ($this->getRuleAccessMatrix($app,$userId)->isCommentable()) 
												{
														$str=$str."\n   <div class='detailContainerContentActionsMarkText' id='detailContainerContentActionsMarkText".$this->getIdOrRef()."' onClick=\"doCommandTextObject(".$this->getIdOrRef().",'addmarkmode','detailContainerContentActionsMarkText".$this->getIdOrRef()."')\"  title='TextMarking' >Add Textmarker</div>";
														$str=$str."\n   <div class='detailContainerContentActionsMarkText' style='display: none;' id='detailContainerContentActionsMarkText".$this->getIdOrRef()."Mode' onClick=\"doCommandTextObject(".$this->getIdOrRef().",'addmarkmodeclose','detailContainerContentActionsMarkText".$this->getIdOrRef()."Mode')\"  title='TextMarking-Mode' >Marking-Mode</div>";
														// $str=$str."\n   <div class='detailContainerContentActionsMarkText' id='detailContainerContentActionsMarkTextIt".$this->getIdOrRef()."' onClick=\"doCommandTextObject(".$this->getIdOrRef().",'addpostit','detailContainerContentActionsAddPostIt".$this->getIdOrRef()."')\" title='Add Postit' >Display Mode</div>";
														
												}

												return $str;
											}


									function viewSideActionsComments( $app, $userId )
									{
										$str="";
	  
										$str=$str."\n<div class='detailContainerContentActionsBottom'>";
	//									$str=$str."\n   <div class='detailContainerContentActionsComments' onClick=\"$('#".$this->getDivId()."Comments').slideToggle('fast')\"></div>";
										$str=$str."\n</div>";
										$str="";
	 
										return $str;
									}
								// show all
								function viewComments( $app, $userId )
								{
									// ... the visuals
									$arrTextObjects=$app->getAllCommentsByRef( $this->textobjectObject->textobjectId, $userId );

									$str="";
		
										$str=$str.     "\n <div class='detailComponentComments'  id='".$this->getDivId()."Comments' >";			
										
										$str=$str."\n   ";
										for ($i=0;$i<count($arrTextObjects);$i++)
										{
											$textobjectTmp=$arrTextObjects[$i];
											$textobjectViewTmp=$app->getTextObjectViewFor( $textobjectTmp, $userId );
											if ($textobjectViewTmp!=null)
											{
												$str=$str.     "\n <div class='detailComponentCommentsSpacer'  onClick=\"\"></div>";			
												$str=$str.$textobjectViewTmp->viewList($app,$userId);
												$str=$str.     "\n <div class='detailComponentCommentsSpacerBottom'   ></div>";			
											}

										}

									return $str;
								}

								// show the only 
								function viewCommentsCommentTypeVisual( $app, $userId )
								{
									// ... the visuals
									$arrTextObjects=$app->getAllCommentsCommentTypeVisualByRef( $this->textobjectObject->textobjectId, $userId );

									$str="";

										$str=$str."\n <div class='detailComponentCommentsContainerVisual'  id='".$this->getDivId()."CommentsVisual' >";			
										
										$str=$str."\n  ";
										for ($i=0;$i<count($arrTextObjects);$i++)
										{
											$textobjectTmp=$arrTextObjects[$i];
											$str=$str.$this->viewCommentsCommentTypeVisualObject($textobjectTmp, $app,$userId);
										}

										$str=$str."\n </div>";
									


									return $str;
								}

									// dont' use anymore!
									function viewCommentsCommentTypeVisualObject($textobjectTmp, $app,$userId)
									{
											$str="";

											$textobjectViewTmp=$app->getTextObjectViewFor($textobjectTmp, $userId );
											if ($textobjectViewTmp!=null)
											{
												// $str=$str.     "\n <div class='detailComponentCommentsSpacer'  onClick=\"\"></div>";			
												

												// position
												$posX=$textobjectTmp->textobjectPositionX;
												$posY=$textobjectTmp->textobjectPositionY;
												$posZ=$textobjectTmp->textobjectPositionZ;

												$strPosition=" style=\"/* relative in css! */ left: ".$posX."px; top: ".$posY."px; \"  ";
												// $strPosition=""; 

												$str=$str."\n <div class='detailComponentCommentsVisual' id='".$textobjectViewTmp->getDivId()."CommentsVisualDetail' $strPosition > ";

												// $str=$str."ABC ---- viewCommentsCommentTypeVisualObject ".$textobjectViewTmp->textobjectObject->getArgument();
												/*
												$str=$str."\n <div class='detailComponentCommentsVisualActions' \">";
													// $str=$str."\n     <div class='detailComponentCommentsVisualDrag' id='".$textobjectViewTmp->getDivId()."CommentsVisualDetailDrag'> + </div>";
													$str=$str."\n     <div class='detailComponentCommentsVisualSpace'  ></div>";
													$str=$str."\n     <div class='detailComponentCommentsVisualBringToFront'  onClick=\" var zIndex=$.topZIndex(); $('#".$textobjectViewTmp->getDivId()."CommentsVisualDetail').css( 'z-index',zIndex+10); $('#".$textobjectViewTmp->getDivId()."').show('fast');  \">----------</div>";
													$str=$str."\n     <div class='detailComponentCommentsVisualSpace'  ></div>";
													$str=$str."\n     <div class='detailComponentCommentsVisualToggle'  onClick=\" var zIndex=$.topZIndex(); $('#".$textobjectViewTmp->getDivId()."CommentsVisualDetail').css( 'z-index',zIndex+10);  $('#".$textobjectViewTmp->getDivId()."').toggle('fast'); \">==</div>";
												$str=$str."\n     </div>";
												*/
												$str=$str.$textobjectViewTmp->viewList($app,$userId);

												$str=$str."\n  </div>";				

												$divId=$textobjectViewTmp->getDivId();
												$divVisualDetailIdJQuery="\$('#".$divId."CommentsVisualDetail')";

												$str=$str."\n     <script>";
													$str=$str."\n         $(function() {";
													$str=$str."\n             $( \"#".$textobjectViewTmp->getDivId()."CommentsVisualDetail\" ).draggable({";
													$str=$str."\n                 cursor: 'move', ";
	//												$str=$str."\n                 cursorAt: { top: 0, left: 0 }, ";
													$str=$str."\n                 start: function(event, ui) { $divVisualDetailIdJQuery.css( 'z-index',$.topZIndex()+10); startDragOnTextObjectDetailPosition( ".$this->getId().", ".$textobjectTmp->textobjectId.", event.pageX, event.pageY ); }, ";
													$str=$str."\n                 drag: function(event, ui) { /* updateDragTextObjectDetailPosition( ".$textobjectTmp->textobjectId.", event.pageX, event.pageY   ); */  }, ";
													$str=$str."\n                 stop: function(event, ui) { updateDragTextObjectDetailPosition( ".$textobjectTmp->textobjectId.", event.pageX, event.pageY   );   }";
													$str=$str."\n             });";
													$str=$str."\n         });";
												$str=$str."\n     </script>";

												// $str=$str.     "\n <div class='detailComponentCommentsSpacerBottom'   ></div>";			
											
												return $str;
											}
									}


							// add members! if there are some
							function viewMembers( $app, $userId )
							{
								$str="";

								$textobjectObj=$this->textobjectObject;

	 							// $str=$str." ----- ".$textobjectObj->getArgument()."---".$textobjectObj->hasMembers();

	 							if ($textobjectObj->hasMembers())
		                        {

		 							// $str=$str." ----- ".$textobjectObj->getArgument()."---".$textobjectObj->hasMembers()."---".count($textobjectObj->arrMembers);
		
		                            // add the ...
		                            // insert them now
		                            for ($m=0;$m<count($textobjectObj->arrMembers);$m++)
		                            {
		                                // get them and insert them here!
		                                $memberDef=$textobjectObj->arrMembers[$m];
			                            // $str=$str."<br>  $m ".$memberDef->memberRefName;

		                                // go through members 
		                                // check for 
		                                // if there is no member create one!

		                                // 1. get member
		                                if ($memberDef->textobjectObject!=null)
		                                {
		                                	// show this here and now ..
											// $objMemberView= $memberDef->textobjectObject
		                                	$memberObj=$memberDef->textobjectObject;
											
											// if visible for everyone?

											$textobjectViewTmp=$app->getTextObjectViewFor($memberObj, $userId );
											if ($textobjectViewTmp!=null)
											{
												$str=$str.     "\n <div class='detailComponentCommentsSpacer'  onClick=\"alert('toggle');\"></div>";			
																$str=$str.$textobjectViewTmp->viewList($app,$userId);
												$str=$str.     "\n <div class='detailComponentCommentsSpacerBottom'   ></div>";			
											}

		                                }
		                                

		                            }
		                        }


								return $str;
							}

						function viewForm( $app, $userId )
						{
							
							$str="";

							$str=$str.$this->viewFormExtended( false, $app, $userId );

							return $str;
						} 

								// form edit / add
								// false>edit|true>add
								function viewFormExtended( $flagInsert, $app, $userId )
								{
									$textobjectObjectToShow=$this->textobjectObject;

									// $divId="";
	 
									// add 
									$add="Add";
									// div
									$addClass="detailComponentAdd";
									$addClassCommentType="";
									$id=$this->getIdOrRef();
	//								$divId=$this->getDivIdOrRef();

									// javascript
									// todo: used?
									$javascriptObj="jscriptAdd";

									// update										
									if (!$flagInsert) 
									{ 
										$add="Edit"; 
										$addClass="detailComponentForm";
										$divId=$this->getDivIdOrRef();								
									}	

									//$style=" ";
									//if ($this->textobjectAddShow==false ) $style="style='display:none'";
									//if (!$flagInsert) $style="style='display:none'";
									// if ($flagInsert) $style="";

									$str="";



										
									// $str=$str."<div style='width: 50px; height: 50px; border: 5px solid'></div>";
	//								if ($this->textobjectAddContainerViewFormDiv)
	//								$str=$str."\n  <div  class='detailComponentFormBasic $addClass $addClassCommentType' $style id='".$divId."$add' >";

									// $str=$str."--- viewFormExtended( $flagInsert ) ----::: ".$this->textobjectObject->textobjectId;

									// $str=$str.$divId;

									// add a menu
										$strMenuTitle="Add";
										$strIconDelete="<div class='detailComponentFormActionsClose' onClick=\"$('#detailComponentFormAdd').slideToggle('fast');\" > X </div>";
											if (!$flagInsert) 
											{
												$strMenuTitle="EDIT";
												$strIconDelete="";
												$strIconDelete=$strIconDelete."<div class='detailComponentFormActionsClose' onClick=\"$('#detailComponentFormEdit').slideToggle('fast');\" > x </div>";
												// $strIconDelete=$strIconDelete."<div class='dialogCommandOnObjectRuleContainerIconRule' onClick=\"$('#dialogCommandOnObjectRuleContainer').hide()\"> rules </div>";					
											}

									$str=$str."\n<div class='detailComponentFormActions'>$strMenuTitle $strIconDelete</div>";


									// dropbox for files here
									if ($flagInsert) 
									{

										$str=$str.$this->viewFormExtendedCoreContentFormAddDropBox();								
									}
									
									// manual container
									$containerManualStyle="detailComponentFormContainerManualAdd";
									if (!$flagInsert) $containerManualStyle="detailComponentFormContainerManualUpdate";
									$str=$str."<div id='detailComponentFormContainerManual'  class='$containerManualStyle'>";								

											// $str=$str."\n <br>[MOVE]"; 

											// include javascript ... 

											// add
											// delete
											if (!$flagInsert) 
											{

												$str=$str."\n<div class='detailComponentFormDelete'>";
													$str=$str."\n<form>";
													$str=$str."\n<input type=button value='Delete' onClick=\"deleteTextObject( ".$this->getId()." )\">";
													$str=$str."\n</form>";
												$str=$str."\n</div>";


												// space ...
												$str=$str."\n<div class='detailComponentFormDeleteSpace'></div>";

												// if visual thing
												if ($this->textobjectObject->textobjectCommentType=="visual")
												{
													$str=$str."\n<div>";
														$str=$str."\n<form>";
															// $str=$str."\n 	<input type=hidden id='Form".$add."DatatextobjectId' value='".$this->textobjectObject->textobjectId."'> ";
															$str=$str."\n Time:";
															$str=$str."\n	|&lt; <input type=text size=10 id='Form".$add."DatatextobjectTimeA'  value='".$this->textobjectObject->textobjectTimeA."'>secs";
															$str=$str."\n	   <input type=text size=10 id='Form".$add."DatatextobjectTimeB'  value='".$this->textobjectObject->textobjectTimeB."'>secs &gt;|";
															$str=$str."\n  <input type=button size=10  onClick=\"updateTextObjectDetailProperty(".$this->getId().",'time')\" value='Set'>";
														$str=$str."\n</form>";
													$str=$str."\n</div>";

													// ...
													if (false)
													{
														$str=$str."\n<div>";
															$str=$str."\n<form>";
																// $str=$str."\n 	<input type=hidden id='Form".$add."DatatextobjectId' value='".$this->textobjectObject->textobjectId."'> ";
																$str=$str."\n Position:";
																$str=$str."\n	<input type=text size=10 id='Form".$add."DatatextobjectPositionX'  value='".$this->textobjectObject->textobjectPositionX."'>px / ";
																$str=$str."\n	<input type=text size=10 id='Form".$add."DatatextobjectPositionY'  value='".$this->textobjectObject->textobjectPositionY."'>px ";
																$str=$str."\n  <input type=button size=10  onClick=\"updateTextObjectDetailProperty(".$this->getId().",'position')\" value='Set'>";
															$str=$str."\n</form>";
														$str=$str."\n</div>";
													}
												}
											}

											// add
											if ($flagInsert) 
											{

												// comment type 
												// $str=$str."\n 	CommentType: ".$this->textobjectObject->textobjectCommentType;
												$str=$str."<div style='vertical-alignment: top'>";
													if ($this->textobjectObject->textobjectCommentType=="")
													{
														// add here and now ...
														$str=$str."<div class='detailComponentAddCommentType'></div>";
													}
													if ($this->textobjectObject->textobjectCommentType=="visual")
													{
														// add here and now ...
														$str=$str."<div class='detailComponentAddCommentType detailComponentAddCommentTypeVisual'></div>";
													}
													if ($this->textobjectObject->textobjectCommentType=="text")
													{
														// add here and now ...
														$str=$str."<div class='detailComponentAddCommentType detailComponentAddCommentTypeText'></div>";
												}
												$str=$str."</div>";
												// $str=$str."\n 	CommentType: ".$this->textobjectObject->textobjectCommentType;

												// show selection ..
												if ($this->textobjectAddShowObjects)
												{
													$str=$str."\n<script>";
													$str=$str."\n var $javascriptObj=new TextObject();";
													$str=$str."\n     $javascriptObj.textobjectRef=".$this->getIdOrRef().";";
													$str=$str."\n     $javascriptObj.textobjectCommentType='".$this->textobjectObject->textobjectCommentType."';";
													// $str=$str."\n     alert('--'+$javascriptObj.textobjectRef);";
													

													$str=$str."\n</script>";
													$str=$str."\n<div class='detailComponentAddSelectionContainer'>";
													$str=$str."\n ";

														// function select ...
														// thread only
														$parentObject=$app->getTextObjectById($this->textobjectObject->textobjectRef,$app,$userId);

														// 1. show only type categories ... text/image etc ... 
														// types ...
														$arrTypeCategory=array();
														$lastTypeCategory="";
														for ($i=0;$i<count($app->arrPublicTypes);$i++)
														{
															$typeObj=$app->arrPublicTypes[$i];
															if ($lastTypeCategory!=$typeObj->textobjectviewTypeCategory)
															{
																// echo("<br>Type: ".$typeObj->textobjectType);
																// only thread on thread
																if ($parentObject!=null)
																if (
																	($parentObject->textobjectType!="thread")
																	&&
																	($parentObject->textobjectType!="hyperthread")
																	&&
																	($parentObject->textobjectType!="domain")
																   )
																{
																	if ($typeObj->textobjectType=="thread")
																	{
																		continue;
																	}

																	if ($typeObj->textobjectType=="hyperthread")
																	{
																		continue;
																	}
																}

																// is this category yet in the array?
																$foundInArray=false;

																if (count($arrTypeCategory)>0)
																for ($qi=0;$qi<count($arrTypeCategory);$qi++)
																{
																	$objCategory=$arrTypeCategory[$qi];
																	if ($objCategory->textobjectviewTypeCategory==$typeObj->textobjectviewTypeCategory)
																	{
																		$foundInArray=true;
																	}
																}

																if (!$foundInArray)
																{
																	$arrTypeCategory[count($arrTypeCategory)]=$typeObj;
																	$lastTypeCategory=$typeObj->textobjectviewTypeCategory;
																}
															}
														}

														// categories
														$str=$str."\n<div class='detailComponentAddSelectionTextObjectTypeCategoryContainer'>";
														for ($i=0;$i<count($arrTypeCategory);$i++)
														{
															$typeCategoryObj=$arrTypeCategory[$i];															
															// $str=$str."<br>".$typeCategoryObj->textobjectType;
															// echo("<pre>");print_r($typeCategoryObj);echo("</pre>");

															// textobjectviewTypesLabel
															$classSelected="";
															if ($textobjectObjectToShow->textobjectviewTypeCategory==$typeCategoryObj->textobjectviewTypeCategory) { $classSelected="detailComponentAddSelectionTextObjectTypeCategoryContainerEntrySelected"; $str=$str.""; }
															$typeCategoryObjView=$app->getTextObjectViewFor($typeCategoryObj, -1);
															$str=$str."\n <div class='detailComponentAddSelectionTextObjectTypeCategoryContainerEntry $classSelected' onClick=\"selectTextObjectAdd( ".$this->getIdOrRef().", '".$typeCategoryObj->textobjectType."', '".$typeCategoryObj->textobjectTypeSub."', '*' )\">".$typeCategoryObj->textobjectviewTypeCategoryLabel."</div>  ";
														}
														$str=$str."\n</div>";

														$str=$str."<br>";

														// 2. show category selection ... 
														$str=$str."\n<div class='detailComponentAddSelectionTextObjectTypeContainerFrame'>";
														for ($i=0;$i<count($app->arrPublicTypes);$i++)
														{
															$objClass=$app->arrPublicTypes[$i];
															// $str=$str."<br>".$textobjectObjectToShow->textobjectviewTypeCategory."  vs. ".$objClass->textobjectviewTypeCategory;
															if ($objClass->textobjectviewTypeCategory==$textobjectObjectToShow->textobjectviewTypeCategory)
															{
																// only thread on thread
																if ($parentObject!=null)
																if (
																	($parentObject->textobjectType!="thread")
																	&&
																	($parentObject->textobjectType!="hyperthread")
																	&&
																	($parentObject->textobjectType!="domain")
																   )
																{
																	if ($objClass->textobjectType=="thread")
																	{
																		continue;
																	}

																	if ($objClass->textobjectType=="hyperthread")
																	{
																		continue;
																	}
																}

																// todo: userId -1 !
																$objClassView=$app->getTextObjectViewFor($objClass, -1);
																// $str=$str."\n   <a onClick=\"select".$this->getDivId()."('".$textobjectTextView->textobjectviewType."','".$textobjectTextView->textobjectviewTypeSub."')\">[".$textobjectTextView->textobjectviewLabel."]</a> ";
																// ".$objClass->textobjectType."-
																// $classDivIcon=".detailContainerIcon".$objClass->textobjectType.$objClass->textobjectTypeSub;
																$classSelected="";
																// if (($this->textobjectObject->textobjectType==$objClass->textobjectType)&&($this->textobjectObject->textobjectTypeSub==$objClass->textobjectTypeSub)) 
																$flagSpecial=false;
																	if ($objClass->textobjectType=="hyperthread") $flagSpecial=true;
																	if ($objClass->textobjectType=="domain") $flagSpecial=true;
																if (($textobjectObjectToShow->textobjectType==$objClass->textobjectType)&&($textobjectObjectToShow->textobjectTypeSub==$objClass->textobjectTypeSub)) { $classSelected="detailComponentAddSelectionTextObjectTypeContainerSelected"; }
																// selectTextObjectAdd( textobjectId, 'text', 'plain', '' );
																$str=$str."\n <div class='detailComponentAddSelectionTextObjectTypeContainer $classSelected' onClick=\"selectTextObjectAdd( ".$this->getIdOrRef().", '".$objClass->textobjectType."', '".$objClass->textobjectTypeSub."', '*' )\">".$objClassView->textobjectviewLabel."</div>  ";
															}
														}
														$str=$str."\n</div>"; 

														$str=$str."\n <div class='detailComponentAddSelectionTextObjectTypeContainerDescription'>".$this->textobjectviewDescription."</div>";

													$str=$str."\n</div>";
												}
											}




											// insert
											$strJavascriptSubmit="";
											$strInsertAdd="Edit";
											$strFormAdd="Edit";
											if ($flagInsert)
											{
												$strFormAdd="Add";
												$strInsertAdd="Insert";

												// $strJavascriptSubmit="\n  <input type=hidden name='".."' value='' > ";
												if ($this->textobjectObject->textobjectDocument==0)
												{
													$strJavascriptSubmit="\n  <input type=button onClick=\"insertTextObject( ".$this->textobjectObject->textobjectRef.",'".$this->textobjectObject->textobjectCommentType."','".$this->textobjectviewArgumentEditor."'  );\" value='INSERT' > ";
												}
											}
											// update
											else
											{
												$strFormAdd="Edit";
												$strInsertAdd="Edit";
												// dont show in document-objects
												if ($this->textobjectObject->textobjectDocument==0)
												{
													$strJavascriptSubmit="\n <input type=button onClick=\"updateTextObject( ".$this->getId().",'".$this->textobjectviewArgumentEditor."'  );\" value='UPDATE' > ";
												}	
											}


											$str=$str."\n <form name='Form".$strInsertAdd."Data'>";

												if ($flagInsert)
												{
													$str=$str."\n   <input type=hidden id='Form".$strFormAdd."DatatextobjectCommentType' value='".$this->textobjectObject->textobjectCommentType."'> ";
													// $str=$str."\n 	CommentType: ".$this->textobjectObject->textobjectCommentType;

													$str=$str."\n 	<input type=hidden id='Form".$strFormAdd."DatatextobjectRef' value='".$this->textobjectObject->textobjectRef."'> ";
													$str=$str."\n 	<input type=hidden id='Form".$strFormAdd."DatatextobjectType' value='".$this->textobjectObject->textobjectType."'> ";
													$str=$str."\n 	<input type=hidden id='Form".$strFormAdd."DatatextobjectTypeSub' value='".$this->textobjectObject->textobjectTypeSub."'> ";
													$str=$str."\n 	<input type=hidden id='Form".$strFormAdd."DatatextobjectPositionX' value='".$this->textobjectObject->textobjectPositionX."'> ";
													$str=$str."\n 	<input type=hidden id='Form".$strFormAdd."DatatextobjectPositionY' value='".$this->textobjectObject->textobjectPositionY."'> ";
												}

												// the content ... 
												$str=$str.$this->viewFormExtendedCoreContentFormId( $strFormAdd );
												$str=$str.$this->viewFormExtendedCoreContentForm( $strFormAdd );

												// insert ...
												if ($flagInsert) 	$str=$str.$this->viewFormExtendedCoreContentFormInsert(  );	
												// update
												if (!$flagInsert)	$str=$str.$this->viewFormExtendedCoreContentFormUpdate(  );									

												$str=$str.$this->viewFormExtendedCoreContentFormMembersInline( $strFormAdd, $app, $userId );
												
											$str=$str."\n ";

											$str=$str.$strJavascriptSubmit;

											$str=$str."\n </form>";

											// sizes
											// formset
											if (!$flagInsert)  
											{
														
												// javascript for properties

												// attention: !!! update property > look for something other
												// update normal > function doUpdate

													// properties
													$str=$str."\n<div>";
														$str=$str."\n<form >";
															$str=$str."\n 	<input type=hidden id='Form".$strFormAdd."DatatextobjectId' value='".$this->textobjectObject->textobjectId."'> ";
															$str=$str."\n Size:";
															$str=$str."\n	width: <input type=text size=10 id='Form".$strFormAdd."DatatextobjectWidth'  value='".$this->textobjectObject->textobjectWidth."'>";
															$str=$str."\n	height: <input type=text size=10 id='Form".$strFormAdd."DatatextobjectHeight'  value='".$this->textobjectObject->textobjectHeight."'>";
															$str=$str."\n  <input type=button size=10  onClick=\"updateTextObjectDetailProperty(".$this->getId().",'size')\" value='Set'>";
														$str=$str."\n</form>";
													$str=$str."\n</div>";

													
													// max time
													$str=$str."\n<div>";
														$str=$str."\n<form>";
															$str=$str."\n 	<input type=hidden id='Form".$strFormAdd."DatatextobjectId' value='".$this->textobjectObject->textobjectId."'> ";
															$str=$str."\n Time:";
															$str=$str."\n	Max. Time Length: <input type=text size=10 id='Form".$strFormAdd."DatatextobjectTimeLength'  value='".$this->textobjectObject->textobjectTimeLength."'>";
															$str=$str."\n  <input type=button size=10  onClick=\"updateTextObjectDetailProperty(".$this->getId().",'timelength')\" value='Set'>";
														$str=$str."\n</form>";
													$str=$str."\n</div>";
													
													// add recursive members!
													$str=$str.$this->viewMembersFormRecursive( $app, $userId );
													// add here the members
											
											}

											

											// infos
											// $str=$str."\n <br><br>";
											$str=$str."\n<div style='font-size: 10px'>";
												if ($this->getId()!=-1) $str=$str."\n Id: ".$this->getId();
												$str=$str."\n <br>Ref: ".$this->textobjectObject->textobjectRef." (RefName: ".$this->textobjectObject->textobjectRefName.") ";
												$str=$str."\n <br>Status: ".$this->textobjectObject->textobjectStatus."";
												$str=$str."\n <br>Type: ".$this->textobjectObject->textobjectType."/".$this->textobjectObject->textobjectTypeSub."";

												$rootObj=$app->getRootObject( $this->textobjectObject, $userId  );
												$str=$str."\n <br>Root: ".$rootObj->textobjectId."  {";
												$arrTree=$app->getTreeUpForId( $this->textobjectObject, $userId );
												$str=$str."\n  RootUserType: ".$rootObj->textobjectUserRef."  ";
												$str=$str."\n  TreeLength: ".count($arrTree)."  ";
												if (($userId!=-1)&&($rootObj->textobjectUserRef==$userId)) $str=$str."\n<br> YOU ARE IN YOUR DOMAIN!  ";
												$str=$str."\n }";
											$str=$str."\n</div>";

									$str=$str."</div>";	 // manual container ... 							 


	//								if ($this->textobjectAddContainerViewFormDiv)
	//								 $str=$str."\n</div>";


									// the insert script 


									return $str;
								}

											function viewMembersFormRecursive( $app, $userId )
											{
												$str="";

												if ($this->textobjectObject->hasMembers())
						                        {
						                        	$str=$str."<div class='.detailComponentMemberForm'>";

							                        	$str=$str."<div class='detailComponentMemberFormTitle'>More properties</div>";

							                        	$str=$str."<div class='detailComponentMemberFormEntities'>";

															for ($m=0;$m<count($this->textobjectObject->arrMembers);$m++)
								                            {
								                                // get them and insert them here!
								                                $memberDef=$this->textobjectObject->arrMembers[$m]; 
								                                // viewFormExtendedCoreContentForm( $addDivAction="", $showMemberForms=false ) 
								                                // $str=$str."$m ";
								                                $str=$str."<div class='detailComponentMemberFormEntitiy'>";
								                                if ($memberDef->textobjectObject!=null)
								                                {
								                                	//$str=$str."$m ";
								                                	$memberObject=$memberDef->textobjectObject;
								                                	// echo("<pre>"); print_r($memberObject); echo("</pre>");

								                                	$memberObjectView=$app->getTextObjectViewFor($memberObject, $userId);   
								                                	// echo("<pre>");print_r($memberObjectView);echo("</pre>");
								                                	$str=$str."<div class='detailComponentMemberFormEntitiyTitle'>".$memberDef->memberRefLabelName."</div>";

								                                	// todo: recursive!
								                                	$strMember="";

								                                	$strMember=$strMember."<form >";
								                                		// $strMember=$strMember."<br>id: ".$memberObject->textobjectId."<br>";
								                                			// $strMember=$memberObjectView->viewFormExtendedCoreContentForm( "".$memberDef->memberRefName  );	
								                                			$strMember=$memberObjectView->viewFormExtendedCoreContentForm( "".$memberObject->textobjectId  );	
								                                		$strMember=$strMember."<input type=button value='Set' onClick=\"updateTextObjectDetailMember(".$this->textobjectObject->textobjectId.", '".$memberObject->textobjectRefName."','".$memberObject->textobjectId."')\">";
								                                	$strMember=$strMember."</form>";

								                                	
								                                	// echo("<br>...---".$strMember);
								                                	$str=$str."".$strMember;

								                                	// submembers
								                                	// todo: ! recursive ...
								                                	// 

								                                }
								                                else
								                                {
								                                	$str=$str."<div>Error not found this member</div>";
								                                }
								                                $str=$str."</div>";
								                            }

								                            $str=$str."</div>";

							                        $str=$str."</div>";
						                        }

						                        return $str;
											}


											function viewFormExtendedCoreContentFormAddDropBox()
											{
												
												$str="";

													$str=$str."\n<div id='formAddFileDropBoxContainer'>";

																$str=$str."\nOr: Import direct files: ";
																
																$str=$str."\n<div id='formAddFileDropBox'>";

																	$str=$str."\nThe Dropbox: ";
																	$str=$str."\nFiles just drop here for inserting.";

																	$str=$str."\n<div id='formAddFileDropBoxContainerList'></div>";

																$str=$str."\n</div>";

															$str=$str."\n</div>";

															$str=$str."\n<script>";

																$str=$str."\n  function handleAddDragAndDropFilesSingleDragOver(evt) { ";
																$str=$str."\n    evt.stopPropagation(); ";
																$str=$str."\n    evt.preventDefault(); ";
																$str=$str."\n    evt.dataTransfer.dropEffect = 'copy'; ";
																$str=$str."\n  }";

																$str=$str."\n function handleAddDragAndDropFilesSingleFileSelect(evt) {";
																$str=$str."\n    evt.stopPropagation();";
																$str=$str."\n    evt.preventDefault();";
																$str=$str."\n    var files = evt.dataTransfer.files;";
																$str=$str."\n    if (files.length>0) { documentCreateTextObjects( ".$this->textobjectObject->textobjectRef.", '".$this->textobjectObject->textobjectCommentType."', files ); /*alert('handleAddDragAndDropFilesSingleFileSelect'+files.length);*/ /* documentAddDragAndDropFilesSingleUpload( updateObject.textobjectId, files[0] ); */ } // alert('handleAddDragAndDropFilesSingleFileSelect'+files.length); ";
																$str=$str."\n }";

															$str=$str."\n  // Setup the dnd listeners.";
															$str=$str."\n  var dropZone = document.getElementById('formAddFileDropBoxContainer');";
															$str=$str."\n  dropZone.addEventListener('dragover', handleAddDragAndDropFilesSingleDragOver, false); ";
															$str=$str."\n  dropZone.addEventListener('drop', handleAddDragAndDropFilesSingleFileSelect, false);  ";

															$str=$str."\n</script>";

												return $str;	
											}

									function viewFormExtendedCoreContentFormId( $addDivAction="" ) // action with visual
									{
										$str="\n <input type=hidden id='".$this->getDivId()."FormDatatextobjectId".$addDivAction."' value='".$this->textobjectObject->textobjectId."'> ";
										return $str;
									}

									// the content ... 
									function viewFormExtendedCoreContentForm( $addDivAction="", $showMemberForms=false ) // action with visual
									{
										$str=""; // .$addDivAction;
										// todo: escape html-entities
										$str=$str."\n  	<textarea cols=50 id='Form".$addDivAction."DatatextobjectArgument'  rows=10  style='width: 98%' >".$this->textobjectObject->getArgument()."</textarea>";
	 
										// ...
										// add members here ..
										// todo: only special members
										//if ()
										//{

										// add members here direct inline?
										// $str=$str."".$this->viewFormExtendedCoreContentFormMembersInline( $addDivAction );
										
										//}

										return $str;
									}

									/*
										addons
									*/
									// form insert
									function viewFormExtendedCoreContentFormInsert()
									{
										$str="";

										// is document?

										return $str;
									}

									// form update
									function viewFormExtendedCoreContentFormUpdate()
									{
										$str="";

										return $str;								
									}

										/*
											 document versions
											 uploads
										*/
										
										// document add
										function viewFormExtendedCoreContentFormDocumentAddSingle( ) // action with visual
										{
											$str="";

											$str=$str." <!-- viewFormExtendedCoreContentFormDocumentAddSingle() --> ";

											$str=$str."\n <form action=\"\" method='post' enctype='multipart/form-data' multiple >";
											$str=$str."\n   <input type='file' name='file' id='documentAddSingle' onChange=\"onChangeDocumentAddSingleDocument()\" class='margin-10px;'  >";
											$str=$str."\n</form>";

												$str=$str."\n<div id='documentAddSingleFileName'></div>";
												$str=$str."\n<div id='documentAddSingleFileSize'></div>";
												$str=$str."\n<div id='documentAddSingleFileType'></div>";
												$str=$str."\n<div id='documentAddSingleFileError'></div>";
												$str=$str."\n<div id='documentAddSingleProgress' class='documentProgressBar'><img src='imgs/progressBarDone.png' id='documentAddSingleProgressA' ><img src='imgs/progressBarNotYet.png' id='documentAddSingleProgressB' ></div>";
												// " <progress id='progress' style='margin-top 10px;'></progress></div>";


											// dropbox
											$str=$str."\n<div id='documentAddSingleDropZone''>Drop file here ...</div>";
											$str=$str."\n<script>";

												$str=$str."\n  function handleAddSingleDragOver(evt) { ";
												$str=$str."\n    evt.stopPropagation(); ";
												$str=$str."\n    evt.preventDefault(); ";
												$str=$str."\n    evt.dataTransfer.dropEffect = 'copy'; ";
												$str=$str."\n  }";

												$str=$str."\n function handleAddSingleFileSelect(evt) {";
												$str=$str."\n    evt.stopPropagation();";
												$str=$str."\n    evt.preventDefault();";
												$str=$str."\n    var files = evt.dataTransfer.files; ";
												$str=$str."\n    if (files.length>0) { documentAddSingleDocumentFile( files[0] ); } // alert('handleAddSingleFileSelect'+files.length); ";
												$str=$str."\n }";

											$str=$str."\n  // Setup the dnd listeners.";
											$str=$str."\n  var dropZone = document.getElementById('documentAddSingleDropZone');";
											$str=$str."\n  dropZone.addEventListener('dragover', handleAddSingleDragOver, false); ";
											$str=$str."\n  dropZone.addEventListener('drop', handleAddSingleFileSelect, false);  ";

											$str=$str."\n</script>";


											return $str;
										}
								
										// document update
										function viewFormExtendedCoreContentFormDocumentUpdateSingle( ) // action with visual
										{
											$str="";

											$str=$str." <!-- viewFormExtendedCoreContentFormDocumentUpdateSingle() --> ";

											$str=$str."\n <form action=\"\" method='post' enctype='multipart/form-data' multiple >";
											$str=$str."\n   <input type='file' name='file' id='documentUpdateSingle' onChange=\"onChangeDocumentUpdateSingleDocument( ".$this->getId()." )\" class='margin-10px;'  >";
											$str=$str."\n</form>";

												$str=$str."\n<div id='documentUpdateSingleFileName'></div>";
												$str=$str."\n<div id='documentUpdateSingleFileSize'></div>";
												$str=$str."\n<div id='documentUpdateSingleFileType'></div>";
												$str=$str."\n<div id='documentUpdateSingleFileError'></div>";
												$str=$str."\n<div id='documentUpdateSingleProgress' class='documentProgressBar'><img src='imgs/progressBarDone.png' id='documentUpdateSingleProgressA' ><img src='imgs/progressBarNotYet.png' id='documentUpdateSingleProgressB' ></div>";
												// " <progress id='progress' style='margin-top 10px;'></progress></div>";

											// dropbox
											$str=$str."\n<div id='documentUpdateSingleDropZone''>Drop file here ...</div>";
											$str=$str."\n<script>";

												$str=$str."\n  function handleUpdateSingleDragOver(evt) { ";
												$str=$str."\n    evt.stopPropagation(); ";
												$str=$str."\n    evt.preventDefault(); ";
												$str=$str."\n    evt.dataTransfer.dropEffect = 'copy'; ";
												$str=$str."\n  }";

												$str=$str."\n function handleUpdateSingleFileSelect(evt) {";
												$str=$str."\n    evt.stopPropagation();";
												$str=$str."\n    evt.preventDefault();";
												$str=$str."\n    var files = evt.dataTransfer.files;";
												$str=$str."\n    if (files.length>0) { documentUpdateSingleUpload( updateObject.textobjectId, files[0] ); } // alert('handleUpdateSingleFileSelect'+files.length); ";
												$str=$str."\n }";

											$str=$str."\n  // Setup the dnd listeners.";
											$str=$str."\n  var dropZone = document.getElementById('documentUpdateSingleDropZone');";
											$str=$str."\n  dropZone.addEventListener('dragover', handleUpdateSingleDragOver, false); ";
											$str=$str."\n  dropZone.addEventListener('drop', handleUpdateSingleFileSelect, false);  ";

											$str=$str."\n</script>";

											return $str;
										}
										

									function viewFormExtendedCoreContentFormMembersInline( $addDivAction="", $app, $userId  )
									{
										$str="";

	// not yet implemented correctly
	/*
										if ($this->textobjectObject->hasMembers())
				                        {
											 for ($m=0;$m<count($this->textobjectObject->arrMembers);$m++)
				                            {
				                                // get them and insert them here!
				                                $memberDef=$this->textobjectObject->arrMembers[$m]; 
				                                // viewFormExtendedCoreContentForm( $addDivAction="", $showMemberForms=false ) 
				                                // $str=$str."$m ";
				                                if ($memberDef->textobjectObject!=null)
				                                {
				                                	//$str=$str."$m ";
				                                	$memberObject=$memberDef->textobjectObject;
				                                	$memberObjectView=$app->getTextObjectViewFor($memberObject, $userId);   
				                                	// echo("<pre>");print_r($memberObjectView);echo("</pre>");
				                                	$str=$str."<br>".$memberDef->memberRefLabelName.":";

				                                	// todo: recursive!
				                                	$strMember=$memberObjectView->viewFormExtendedCoreContentForm( $addDivAction."".$memberDef->memberRefName  );			                                	
				                                	// echo("<br>...---".$strMember);
				                                	$str=$str."".$strMember;
				                                }
				                            }
				                        }
	*/
				                        return $str;
			                       }



							/*
								Javascripts
								// for each object the scripts ...
							*/
								
						function viewAddForm( $app )
						{
							$str="";

							// $str=$str." viewAddForm() ".$this->textobjectObject->textobjectId;
							// todo: $userId
							$newTextObject=new TextObject();
							$newTextObject->textobjectRef=$this->textobjectObject->textobjectId;
							
							$userId=-1;
							$newTextObjectView=new TextObjectView();
							$newTextObjectView->textobjectAddShow=false;
							$newTextObjectView->textobjectObject=$newTextObject;
							$str=$str."\n ".$newTextObjectView->viewFormExtended( true, $app, $userId );

							return $str;
						}


						

						// show only the simple comments (no innermarker-comments)
						function viewCommentsCommentTypeClear( $app, $userId )
						{
							// version 1.0
							// $arrTextObjects=$app->getAllTextObjectsByRef( $this->textobjectObject->textobjectId, $userId );
							// version 2.0
							$arrTextObjects=$app->getAllCommentsCommentTypeEmptyByRef( $this->textobjectObject->textobjectId, $userId );

							$str="";

								// is this a thread?
								// special threads
								$nonThreadClass="detailComponentComments";
								if ($this->textobjectObject->textobjectType=="thread") { $nonThreadClass="detailThreadComponentComments"; }

								$str=$str.     "\n <div class='$nonThreadClass'  id='".$this->getDivId()."Comments' >";			
								
								$str=$str."\n   ";
								for ($i=0;$i<count($arrTextObjects);$i++)
								{
									$textobjectTmp=$arrTextObjects[$i];
									$textobjectViewTmp=$app->getTextObjectViewFor($textobjectTmp, $userId );
									if ($textobjectViewTmp!=null)
									{
										$str=$str.     "\n <div class='detailComponentCommentsSpacer'  onClick=\"\"></div>";			
										$str=$str.$textobjectViewTmp->viewList($app,$userId);
										$str=$str.     "\n <div class='detailComponentCommentsSpacerBottom'   ></div>";			
									}

								}

								$str=$str."\n </div>";
							

							return $str;
						}

						

						function viewDelete()
						{
							return $this->viewHeader()."".$this->viewFooter();			
						}



				


				/*
					for webservices ...
				*/
				// static! 
				static function  viewErrorMessage( $window, $msg )
				{
					$divId="#dialogCommandOnObjectRuleContainer";
					$title="Rules";
					if ($window=="add") { $title="Add/Comment"; $divId="#detailComponentFormAdd"; }
					if ($window=="edit") { $title="Edit/Update"; $divId="#detailComponentFormEdit";  }

					return "<div class='dialogCommandOnObjectRuleContainerIconClose' onClick=\"\$('$divId').hide()\"> X </div><div class='dialogCommandOnObjectRuleContainerTitle'>$title</div><div style='clear: both;'></div>$msg";
				}
				



        // -----------------------------
        // Helpers
        // -----------------------------
		static function textToHtml( $htmlText )
        {
        	$htmlText=str_replace("<","&lt;",$htmlText);
        	$htmlText=str_replace(">","&gt;",$htmlText);
            return $htmlText;
        }

		// don't use this ugly programming methode
		function viewEchoDebug()
		{
			echo("<hr><pre>");
				print_r($this->textobjectObject);
			echo("</pre><hr>");
		}
		
	}
	
    
?>