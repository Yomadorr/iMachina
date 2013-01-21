<?
	// rest services	
	$debugServices=false;

	// 

	// app instance
	include("./appinstance.php");

	// tests
	// get textobject
	// webservice.rest.php?area=textobjectdetail&action=get&textobjectId=21

	// area
	// $userId=-1; if (isset($_REQUEST["userId"])) $userId="".$_REQUEST["userId"];
	// session?

	// todo get from session!
	// $userId=-1; // comes from aviewTimelineWithDivEnvelopeppinstance ..

	// area
	$area=""; if (isset($_REQUEST["area"])) $area="".$_REQUEST["area"];
	$areasub=""; if (isset($_REQUEST["areasub"])) $areasub="".$_REQUEST["area"];
	
	// actions
	$action=""; if (isset($_REQUEST["action"])) $action="".$_REQUEST["action"];
	$actionsub=""; if (isset($_REQUEST["actionsub"])) $actionsub="".$_REQUEST["actionsub"];

	// argument
	$argument=""; if (isset($_REQUEST["argument"])) $argument="".$_REQUEST["argument"];
	$argumentsub=""; if (isset($_REQUEST["argumentsub"])) $argumentsub="".$_REQUEST["argumentsub"];

	// todo: special ... output: xml / json etc .. 
	$outputtype="html"; if (isset($_REQUEST["outputtype"])) $argument="".$_REQUEST["outputtype"]; // html/xml* not yet implemented
	
	// get textobject
	$textobjectFromWeb=new TextObject();
	$textobjectFromWeb->updateToWebRequest($_REQUEST);
	if ($debugServices) print_r($textobjectFromWeb);


	// output
	$output="";

	// log here and now
	$logargument="$area/$areasub/$action/$actionsub/$argument";
	$app->log("webservice.rest.php",$logargument,$userId);

	// domain
	$canCreateDomain=false;

	if ($app->userCanCreateDomains)
	{
		if (isset($_SESSION["userId"]))
		{
			if ($_SESSION["userId"]!=-1)
			{
				$canCreateDomain=true;
			}
			else
			{
				// todo: error no acess 
			}
		}
	}

	// todo: check if user is admin of platform ..

	if ($canCreateDomain)
	if ($area=="domain")
	{
		$domain="";

		// todo: security webrequest
		if (isset($_REQUEST["domain"])) $domain=$_REQUEST["domain"];

		if ($action=="create")
		{
			$output=$output."";

			// $output=$output."<hr>".$login."<hr>";

			// is used?
			// todo: check if domain with namex is existing
			/*
			if ($app->checkUserInSystem( $login ))
			{
				// there is such a user
				$output=$output."Sorry this Email-Address (User) is in the system. <br>Please try another or recover your password.<br><a href=''>Try another ?</a>";
				$output=$output."<br>";
			}
			else
			*/
			if (true)
			{
				// there is not such a user
				// create a new user

				// send email here ... with data ...

				// create a user
				// $userObj=$app->createNewUser($login,"");

				// todo: add base url
				$newUrl="".$domain."/";

				// send email domain ...
				// todo: ....

				// show in user-domains (collaborator or friends) 
				// 
				$domainObj=$app->createDomain( $domain, $userId );


				// give back
				$outputTmp="";
				$outputTmp=$outputTmp."Your new domain, was created.";
				$outputTmp=$outputTmp."<br>You can use it now.";
				$outputTmp=$outputTmp."<br>URL: <a href='".$newUrl."'>".$newUrl."</>";

				// add system dialog here
				$output=$output."\n<script>";
				$output=$output."\n  resetSystemDialog();";
				$output=$output."\n  appendSystemDialog(\"".$outputTmp."\");";
				$output=$output."\n  showSystemDialog();";
				$output=$output."\n</script>";


			}


		}

	}

	// textobjectdetail
	// only if you have a session!
	if (isset($_SESSION["userId"]))
	if ($area=="account")
	{
		$login="";
		$password="";

		// todo: security webrequest
		if (isset($_REQUEST["login"])) $login=$_REQUEST["login"];
		if (isset($_REQUEST["password"])) $password=$_REQUEST["password"];

		// recover here
		// usage: webservice.rest.php?area=account&action=recover&login=rene.bauer@zhdk.ch
		if ($action=="recover")
		{
			$output=$output."";
			// echo("...".$app->checkUserInSystem( $login ));
			if ($app->checkUserInSystem( $login ))
			{
				$outputTemp="";
				// data sent to your email address
				$outputTemp=$outputTemp."1. Validated Email-Address";
				$outputTemp=$outputTemp."<br>2. Send the Email-Address";
				// reset password
				$userObj=$app->getUserByLogin($login);
				// add new password
				$app->jobSetRandomPasswordNew( $userObj );

					// send this email
					$emailText="";
						$emailText=$emailText."\n<br>";
						$emailText=$emailText."\n<br>You can login with a new password: ";
						$emailText=$emailText."\n<br><br>".$userObj->userPasswordNew." ";
						$emailText=$emailText."\n";
						$arrEmails=array();
						$arrEmails[0]=$login;
					$sentEmail=$app->sendEmailWithTitleText($arrEmails,"[imachina] Password Recovery",$emailText);

				// email problems
				$outputTemp=$outputTemp."<br>3. Email-Sent: ";
				if ($sentEmail) $outputTemp=$outputTemp." The email should arrive soon. ";
				if (!$sentEmail) $outputTemp=$outputTemp." Error something is wrong with this email address. ";
				$outputTemp=$outputTemp."<br>4. Check your email.";
				$outputTemp=$outputTemp."<br>5. Login with your new password.";
				$outputTemp=$outputTemp."<br>";

				// add system dialog here
				$output=$output."\n<script>";
				$output=$output."\n  resetSystemDialog();";
				$output=$output."\n  appendSystemDialog(\"".$outputTemp."\");";
				$output=$output."\n  showSystemDialog();";
				$output=$output."\n</script>";


			}
			else
			{
				// $app->getLanguageForKey("","e") // 
				$output=$output."Sorry, could not find this email-address. <br>Wrong email-address?<br><a href=''>Again ?</a>";
				$output=$output."<br>";
			}
		}

		if ($action=="create")
		{
			$output=$output."";

			// $output=$output."<hr>".$login."<hr>";

			// is used?
			if ($app->checkUserInSystem( $login ))
			{
				// there is such a user
				$output=$output."Sorry this Email-Address (User) is in the system. <br>Please try another or recover your password.<br><a href=''>Try another ?</a>";
				$output=$output."<br>";
			}
			else
			{
				// there is not such a user
				// create a new user

				// send email here ... with data ...

				// create a user
				$userObj=$app->createNewUser($login,"");

/*
				$output=$output."<br>DEBUG: Name: ".$userObj->userName;
				$output=$output."<br>DEBUG: Avatar: ".$userObj->userAvatar;
				$output=$output."<br>DEBUG: Login: ".$userObj->userLogin;
				$output=$output."<br>DEBUG: Password: ".$userObj->userPassword;

*/
				/*
				$output=$output."<br>3. Email-Sent: ";
				if ($sentEmail) $output=$output." The email should arrive soon. ";
				if (!$sentEmail) $output=$output." Error something is wrong with this email address. ";
				*/

				// give back
				$outputTmp="";
				$outputTmp=$outputTmp."<br>1. New user was created.";
				$outputTmp=$output."<br>2. The password was sent to your email-address.";			
				$outputTmp=$outputTmp."<br>3. Go to your email-account and use the activation link.";
				$outputTmp=$outputTmp."<br>4. Login again.";
				$outputTmp=$outputTmp."<br>(5. Update your personal data if wished.)";
				$outputTmp=$outputTmp."<br>6. Collaborate";
				$outputTmp=$outputTmp."<br>";

				// add system dialog here
				$output=$output."\n<script>";
				$output=$output."\n  resetSystemDialog();";
				$output=$output."\n  appendSystemDialog(\"".$outputTmp."\");";
				$output=$output."\n  showSystemDialog();";
				$output=$output."\n</script>";


			}


		}

	}

	// textobjectdetail
	if ($area=="thread")
	{
		$login="";
		$password="";

		// todo: security webrequest
		$textobjectId=-1;
		if (isset($_REQUEST["textobjectId"])) $textobjectId=$_REQUEST["textobjectId"];

		if ($action=="get")
		{
			// webservice.rest.php?area=thread&action=get&actionsub=view&textobjectId=1127

			// version 4
			if ($actionsub=="view")
			{
				$domainObj=$app->getDomainById( $textobjectId, $userId );

                  if ($domainObj!=null) 
                  {
                      // domainView
                      $domainObjView=$app->getTextObjectViewFor($domainObj, $userId );
                      $output=$output.$domainObjView->viewDetailDomain( $textobjectId, $app, $userId );
                  }
                  if ($domainObj==null) 
                  {
                      $strError=$app->getLanguageBy( $app->getDomainLanguage($userId), "@contentErrorThreadNotFound" ) ;  
                      $output=$output.$strError."   ".$textobjectId;                      
                  }
            }

			// version 3
			/*
			if ($actionsub=="view")
			{
				$domainObj=$app->getDomainById( $textobjectId, $userId );                   
                  if ($domainObj!=null) 
                  {
                      // domainView
                      $domainObjView=$app->getTextObjectViewFor($domainObj, $userId );
                      $output=$output.$domainObjView->viewDetailSelectContent( $textobjectId, $app, $userId );
                  }
                  if ($domainObj==null) 
                  {
                      $strError=$app->getLanguageBy( $app->getDomainLanguage($userId), "@contentErrorThreadNotFound" ) ;  
                      $output=$output.$strError;                      
                  }
            }
            */

			// version 2
			/*
			if ($actionsub=="view")
			{
				// todo: get html
				// $output=$output."GET.".$textobjectId;
				$str=$app->viewDetailSelectContent( $textobjectId, $userId );
				$output=$output.$str;
			}
			*/

			// version 1 ...
			/*
			if ($actionsub=="view")
			{
				// todo: get html
				// $output=$output."GET.".$textobjectId;
				$threadObject=$app->getTextobjectById( $textobjectId, $app, $userId );
				$threadObjectView=$app->getTextObjectViewFor($threadObject, $app, $userId );
				// print_r($textobjectViewTmp);
				if ($threadObjectView!=null)
				{
					$output=$output."".$threadObjectView->viewDetail( $app, $userId );

					// push document title
					// todo: solve correctly! problem with noscript!
					$output=$output."<script>document.title = \"[imachina] ".$threadObject->getArgument()."\";</script>";
				}
			}
			*/
		}

	}

	// textobjectdetail
	if ($area=="textobjectdetail")
	{

		/*
			insert
		*/
		// formselect
		// insert
		if ($action=="insert")
		{

			$parentObject=$app->getTextObjectById($textobjectFromWeb->textobjectRef, $userId);
			$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $parentObject->textobjectId, $userId );
			// $output=$output."<br>TextObjectId: ".$textobjectObj->textobjectId." UserID: $userId Matrix:".$ruleaccessmatrixObj->debug();

			if (!$ruleaccessmatrixObj->isCommentable())
			{
				$msg="Sorry you can't comment this @rule.inser.error.nocomment";
				$output=$output.TextObjectView::viewErrorMessage( "add", $msg );
			}

			if ($ruleaccessmatrixObj->isCommentable())
			{

				// webservice.rest.php?area=textobjectdetail&action=get&actionsub=form&textobjectType=text&textobjectTypeSub=plain&textobjectRef=345&textobjectCommentType=visual
				// get new type/typesub 
				if ($actionsub=="form")
				{
					// $output=$output."type/subtype: ".$textobjectFromWeb->textobjectType."/".$textobjectFromWeb->textobjectTypeSub;
					$output="";

					$newObject=new TextObject();

					// todo: check for possible type ...
					// print_r($textobjectFromWeb);

					// version 1.0
					// todo ...
					$newObject->textobjectRef=$textobjectFromWeb->textobjectRef;

					$newObject->textobjectType=$textobjectFromWeb->textobjectType;
					$newObject->textobjectTypeSub=$textobjectFromWeb->textobjectTypeSub;

					$newObject->textobjectCommentType=$textobjectFromWeb->textobjectCommentType;

					$newObject->textobjectPositionX=$textobjectFromWeb->textobjectPositionX;
					$newObject->textobjectPositionY=$textobjectFromWeb->textobjectPositionY;
					// echo($newObject->textobjectRef);
					
					$newObjectCasted=$app->getTextObjectCastFor($newObject);

					if ($newObjectCasted!=null)
					{
						// print_r($newObjectCasted);
						$textobjectViewTmp=$app->getTextObjectViewFor($newObjectCasted, $app, $userId );
						// print_r($textobjectViewTmp);
						if ($textobjectViewTmp!=null)
						{
							// dont' show ... 
							$textobjectViewTmp->textobjectAddContainerViewFormDiv=false;
							$output=$output."".$textobjectViewTmp->viewFormExtended( true, $app, $userId );
							// print_r($textobjectViewTmp);
						}
					}

				}

				// 	webservice.rest.php?area=textobjectdetail&action=insert&actionsub=&textobjectType=text&textobjectTypeSub=html&textobjectRef=18&textobjectArgumentText=abcif
				if ($actionsub=="")
				{

					// echo("textobjectdetail.update");

					// todo: userid from session
					// $output=$output."type/subtype: ".$textobjectFromWeb->textobjectType."/".$textobjectFromWeb->textobjectTypeSub;

					// todo: check for rights / possible type ...
					// print_r($textobjectFromWeb);
					$parentObject=$app->getTextObjectById($textobjectFromWeb->textobjectRef, $userId);
					if ($parentObject!=null)
					{
						// todo:
						// positionX!=-1 > possible on this parent-object?

						// add new object
						// print_r($parentObject);
						$newObject=new TextObject();
						$newObject->textobjectRef=$textobjectFromWeb->textobjectRef;
						$newObject->textobjectType=$textobjectFromWeb->textobjectType;
						$newObject->textobjectTypeSub=$textobjectFromWeb->textobjectTypeSub;
						$newObject->textobjectPositionX=$textobjectFromWeb->textobjectPositionX;
						$newObject->textobjectPositionY=$textobjectFromWeb->textobjectPositionY;
						// $newObject->textobjectArgumentText=$textobjectFromWeb->textobjectArgumentText;
						$newObject->setArgument($textobjectFromWeb->getArgument());

						$newObject->textobjectCommentType=$textobjectFromWeb->textobjectCommentType;

						// echo("-----error----".$newObject->textobjectCommentType);

						$newObjectCasted=$app->getTextObjectCastFor($newObject);

						// print_r($newObjectCasted);
						$newObjInDatabase=$app->insertTextObject($newObjectCasted,$userId);

						// new id as output?
						// ...
						// print_r($newObjectCasted);
						if ($newObjInDatabase!=null)
						{
							echo($newObjInDatabase->textobjectId);
						}
						else
						{
							echo("error");
						}
					}
				
				}
			}

		}	

		/*
		 	get
		*/
		if ($action=="get")
		{
			// webservice.rest.php?area=textobjectdetail&action=get&actionsub=document&textobjectId=1416 [&textobjectVersionId=14]
			if ($actionsub=="document")
			{
				// $output=$output."\n-----document-------";
				// todo: only possible for comments on images (who can have visual comments)
				$updateThisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
				if ($updateThisObject!=null)
				{
					$error=false;

					if ($updateThisObject->textobjectDocument==1)
					{
						// $output=$output."\n-----document------- isDocument! ";

						// $output=$output."---".$_FILES['documentfile'];
						$filePathBaseFolder=$app->getApplicationBaseFilePath();

						// version?

						// $output=$output.$filePath;
						$filePath=$filePathBaseFolder."documents/document".$updateThisObject->textobjectId.".".$updateThisObject->textobjectSuffix;
						// $output=$output."\nfilePath: ".$newFilePath;
						$mimeType=$updateThisObject->textobjectType."/".$updateThisObject->textobjectTypeSub;

						// stream here and now ...
						$app->streamDocumentWithMimeType( $filePath, $mimeType );

					}
					else
					{
						$error=true;
					}

					
					// error
					if ($error) $output=$output."error.type.nodocument";

				}
			}			
		}

		/*
			update
		*/
		if ($action=="update")
		{
			// echo("textobjectdetail.update");
			$updateThisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
			$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $updateThisObject->textobjectId, $userId );
			// $output=$output."<br>TextObjectId: ".$textobjectObj->textobjectId." UserID: $userId Matrix:".$ruleaccessmatrixObj->debug();

			if (!$ruleaccessmatrixObj->isWritable())
			{
				$msg="Sorry you can't change anything here @rule.access.error.noaccess";
				$output=$output.TextObjectView::viewErrorMessage( "edit", $msg );
			}

			if ($ruleaccessmatrixObj->isWritable())
			{

					// form
					// webservice.rest.php?area=textobjectdetail&action=update&actionsub=form&textobjectId=1365
					if ($actionsub=="form")
					{

						$updateThisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);

						// echo("webservice.rest.php: <pre>");print_r($updateThisObject);echo("</pre>");

						if ($updateThisObject!=null)
						{
							// ... 
		//					$updateThisObject->textobjectArgumentText=$textobjectFromWeb->textobjectArgumentText;
		//					$updateThisObject->setArgument($textobjectFromWeb->getArgument());
							// $app->updateTextObject($updateThisObject,$userId);

							$textobjectViewTmp=$app->getTextObjectViewFor($updateThisObject, $userId );
							if ($textobjectViewTmp!=null)
							{
								$str=$textobjectViewTmp->viewForm( $app, $userId );
								$output=$output.$str;
							}
						}
						// todo
						// error
					}

					// todo: userid from session
					if ($actionsub=="")
					{
						$updateThisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
						if ($updateThisObject!=null)
						{
							// ... 
		//					$updateThisObject->textobjectArgumentText=$textobjectFromWeb->textobjectArgumentText;
							$updateThisObject->setArgument($textobjectFromWeb->getArgument());
							$app->updateTextObject($updateThisObject,$userId);
						}
						// todo
						// error
					}

					// set the position!
					// webservice.rest.php?area=textobjectdetail&action=update&actionsub=position&textobjectPositionX=230&textobjectPositionY=10
					if ($actionsub=="position")
					{
						// $output=$output."-----position-------";
						// todo: only possible for comments on images (who can have visual comments)
						$updateThisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
						if ($updateThisObject!=null)
						{
							// ... 
							$updateThisObject->textobjectPositionX=$textobjectFromWeb->textobjectPositionX;
							$updateThisObject->textobjectPositionY=$textobjectFromWeb->textobjectPositionY;
							// echo("<hr>".$updateThisObject->textobjectPositionX."<hr>");
							// echo("<pre>");print_r($updateThisObject);echo("</pre>");
							$app->updateTextObject($updateThisObject,$userId);
						}
						// todo
						// error
					}

					// time
					// reference
					if ($actionsub=="time")
					{
						echo("time");
						// todo: only possible for comments on images (who can have visual comments)
						$updateThisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
						if ($updateThisObject!=null)
						{
							// ... 
							$updateThisObject->textobjectTimeA=$textobjectFromWeb->textobjectTimeA;
							$updateThisObject->textobjectTimeB=$textobjectFromWeb->textobjectTimeB;
							//$updateThisObject->textobjectTimeLength=$textobjectFromWeb->textobjectTimeLength;
							echo("<pre>");print_r($updateThisObject);echo("</pre>");
							$app->updateTextObject($updateThisObject,$userId);
						}
						// todo
						// error
					}

					// argument: document
					// area=textobjectdetail&action=update&actionsub=document&textobjectId=1351 + a file ...
					// todo: test
					// documentfile
					// area=textobjectdetail&action=update&actionsub=document&textobjectId=1351&documentfile=test
					if ($actionsub=="document")
					{
						// $output=$output."\n-----document-------";
						// todo: only possible for comments on images (who can have visual comments)
						$updateThisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
						if ($updateThisObject!=null)
						{
							// is a document?
							$error=false;
							if ($updateThisObject->textobjectDocument==1)
							{
								// $output=$output."\n-----document------- isDocument! ";

								// update document ...
								// todo: move document to documentversions and add data or with version add documentsxyz ...

								// add textobject...
								// is document?

								// todo: is mime/type correct?
								// can you use this mimetype

								// ok save it as this!
								if (isset($_FILES['documentfile']))
								{
									// add this
									// $output=$output."---".$_FILES['documentfile'];
									$filePathBaseFolder=$app->getApplicationBaseFilePath();

									// $output=$output.$filePath;
									$newFilePath=$filePathBaseFolder."documents/document".$updateThisObject->textobjectId.".".$updateThisObject->textobjectSuffix;
									// $output=$output."\nfilePath: ".$newFilePath;

										// updateobject
										// new version ... 
										// todo: update with orginal upload mail
										$app->updateTextObject($updateThisObject, $userId); // todo: add a reason?

										// get last updateobject with version id ... 
										$latestVersionObj=$app->getLatestTextObjectVersion( $updateThisObject->textobjectId, $userId );
										$versionId=0;
										// print_r($latestVersionObj);
										if ($latestVersionObj!=null) $versionId=$latestVersionObj->textobjectVersionId;
										// $output=$output." $versionId  ";

										// version
										// todo: own documentsversions/document ?
										// no > better one > only one htaccess
										$newFilePathVersion=$filePathBaseFolder."documents/document".$updateThisObject->textobjectId.".".$versionId.".".$updateThisObject->textobjectSuffix;
										// todo: check if there is an object
										// $ouput=$output."<br>mv: $newFilePath   $newFilePathVersion  ";
										
										// check path 
										if (file_exists($newFilePath))
										{
											rename($newFilePath, $newFilePathVersion);
										}
										
									// move to the correct place
									move_uploaded_file($_FILES['documentfile']['tmp_name'], $newFilePath);

									// onDocumentUpload
									$updateThisObject->onDocumentUpload($app,$userId);


								}
								else
								{
									$error=true;
								}


								/*

								$updateThisObject->textobjectPositionX=$textobjectFromWeb->textobjectPositionX;
								$updateThisObject->textobjectPositionY=$textobjectFromWeb->textobjectPositionY;
								// echo("<hr>".$updateThisObject->textobjectPositionX."<hr>");
								// echo("<pre>");print_r($updateThisObject);echo("</pre>");
								$app->updateTextObject($updateThisObject,$userId);

								*/
							}
							
							// error
							if ($error) $output=$output."error.type.nodocument";

						}
						// todo
						// error
					}


					/*
						size etc
					*/
					if ($actionsub=="timelength")
					{
						echo("timelength");
						// todo: only possible for comments on images (who can have visual comments)
						$updateThisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
						if ($updateThisObject!=null)
						{
							// ... 
							$updateThisObject->textobjectTimeLength=$textobjectFromWeb->textobjectTimeLength;
							echo("<pre>");print_r($updateThisObject);echo("</pre>");
							echo("error");
							$app->updateTextObject($updateThisObject,$userId);
						}
						// todo
						// error
					}


					// size
					if ($actionsub=="size")
					{
						//echo("size");
						// todo: only possible for comments on images (who can have visual comments)
						$updateThisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
						if ($updateThisObject!=null)
						{
							// ... 
							$updateThisObject->textobjectWidth=$textobjectFromWeb->textobjectWidth;
							$updateThisObject->textobjectHeight=$textobjectFromWeb->textobjectHeight;
							// echo("<pre>");print_r($updateThisObject);echo("</pre>");
							$app->updateTextObject($updateThisObject,$userId);
						}
						// todo
						// error
					}
			}

		}	

		// update member
		/*
			update
		*/
		if ($action=="updatemember")
		{
			// echo("textobjectdetail.update");

			// check access
			// 1. go up always with member (=refname!="")
			// 2. check latest not member (=refname='')

			// get tree here ...   
			echo("---".$textobjectFromWeb->getArgument());
			$textobjectId="".$textobjectFromWeb->textobjectId;

	          $arrTree=$app->getTreeUpForIdDirectExt( $textobjectId, $userId );
	          for ($a=0;$a<count($arrTree);$a++)
	          {
	          	 $treeObj=$arrTree[$a];
	          	 echo("<br>$a ".$treeObj->textobjectId." ".$treeObj->getArgument());
	          }
	          // echo("<pre>");print_r($arrTree);echo("</pre>");
	          $baseIndex=$app->getIndexMemberBaseObject( $arrTree );
			   echo("<br>baseIndex: ".$baseIndex);
			  if ($baseIndex==-1)
			  {

			  	 	// echo("error");
			  		// lock this security issue
			  		$app->log("updatemember","".$textobjectId,$userId);

			  }
			  if ($baseIndex!=-1)
			  {		         
		          $baseObject=$arrTree[$baseIndex];
		          // print_r($baseObject);
		          $textobjectBaseId=$baseObject->textobjectId;
		          // echo($textobjectBaseId);
		          // check this
					// $baseObject=$app->getTextObjectById($textobjectBaseId, $userId);
					$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $textobjectBaseId, $userId );
					// $output=$output."<br>TextObjectId: ".$textobjectObj->textobjectId." UserID: $userId Matrix:".$ruleaccessmatrixObj->debug();

					if (!$ruleaccessmatrixObj->isWritable())
					{
						$msg="Sorry you can't change anything here @rule.access.error.noaccess";
						$output=$output.TextObjectView::viewErrorMessage( "edit", $msg );
					}

					if ($ruleaccessmatrixObj->isWritable())
					{
						// updatemember
						// ok?
						// update this
						// echo("---".$textobjectFromWeb->getArgument());
						$textobjectObject=$app->getTextObjectById($textobjectId, $userId);
						$textobjectObject->setArgument($textobjectFromWeb->getArgument());
						$app->updateTextObject($textobjectObject, $userId);
					}	

			  }

		}


		// get 
		if ($action=="get")
		{
			// echo("textobjectdetail.get");

			if ($actionsub=="")
			{
				// todo: userid from session
				// get ...
				$thisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
				// print_r($thisObject);
				if ($thisObject!=null)
				{

					// view 
					$textobjectViewTmp=$app->getTextObjectViewFor($thisObject, $userId );
					if ($textobjectViewTmp!=null)
					{
						// print_r($textobjectViewTmp);
						$output=$output.$textobjectViewTmp->viewDetail($app,$userId);
					}

					 
				}
			}

			// actions + timeline + conent + actions
			if ($actionsub=="core")
			{

				$thisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
				// print_r($thisObject);
				if ($thisObject!=null)
				{

					// view 
					$textobjectViewTmp=$app->getTextObjectViewFor($thisObject, $userId );
					if ($textobjectViewTmp!=null)
					{
						// print_r($textobjectViewTmp);
						$output=$output.$textobjectViewTmp->viewDetailCore($app,$userId);
					}

				} 
			}

				// case: core mark mode (no marks here ...)
				if ($actionsub=="coremarkmode")
				{

					$output=$output."MARKMODE";
					$thisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
					// convert to markmode
					$thisObject->updateArgumentAsWordText();
					// print_r($thisObject);
					if ($thisObject!=null)
					{

						// view 
						$textobjectViewTmp=$app->getTextObjectViewFor($thisObject, $userId );
						if ($textobjectViewTmp!=null)
						{
							// print_r($textobjectViewTmp);
							$output=$output.$textobjectViewTmp->viewDetailCore($app,$userId);
						}

					} 
				}

			// get the whole container ... 
			if ($actionsub=="container")
			{

				$thisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
				// print_r($thisObject);
				if ($thisObject!=null)
				{

					// view 
					$textobjectViewTmp=$app->getTextObjectViewFor($thisObject, $userId );
					if ($textobjectViewTmp!=null)
					{
						// print_r($textobjectViewTmp);
						$output=$output.$textobjectViewTmp->viewDetail($app,$userId);
					}

				} 
			}

			// webservice.rest.php?area=textobjectdetail&action=get&actionsub=listview&textobjectId=104		
			// as listview
			if ($actionsub=="listview")
			{

				$thisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
				// print_r($thisObject);
				if ($thisObject!=null)
				{

					// view 
					$textobjectViewTmp=$app->getTextObjectViewFor($thisObject, $userId );
					if ($textobjectViewTmp!=null)
					{
						// print_r($textobjectViewTmp);
						$output=$output.$textobjectViewTmp->viewList($app,$userId);
					}

				} 
			}

				// listview visual ... (visual comments)
				if ($actionsub=="listviewvisual")
				{

					$thisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
					if ($thisObject!=null)
					{
						$parentObject=$app->getTextObjectById($thisObject->textobjectRef, $userId);
						if ($parentObject!=null)
						{
							$parentObjectView=$app->getTextObjectViewFor($parentObject, $userId );
							if ($parentObjectView!=null)
							{
								// print_r($textobjectViewTmp);
								$output=$output.$parentObjectView->viewCommentsCommentTypeVisualObject($thisObject,$app,$userId);
								
							}
						}
					}


				}


			// components!
			// timeline (attention: timeA/timeB changes > reload the parent!)
				if ($actionsub=="timeline")
				{

					$thisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
					if ($thisObject!=null)
					{
						$thisObjectView=$app->getTextObjectViewFor($thisObject, $userId );
						if ($thisObjectView!=null)
						{
							// print_r($textobjectViewTmp);
							$output=$output.$thisObjectView->viewTimelineWithDivEnvelope( false, $app,$userId);
						}

						/*
						$parentObject=$app->getTextObjectById($thisObject->textobjectRef, $userId);
						if ($parentObject!=null)
						{
							// $output=$output."TIMELINE!";
							$parentObjectView=$app->getTextObjectViewFor($parentObject, $userId );
							if ($parentObjectView!=null)
							{
								// print_r($textobjectViewTmp);
								$output=$output.$parentObjectView->viewCommentsCommentTypeVisualObject($thisObject,$app,$userId);
							}
						}
						*/
					}
				}

					// parent
					// webservice.rest.php?area=textobjectdetail&action=get&actionsub=parenttimeline&textobjectId=1383
					if ($actionsub=="parenttimeline")
					{

						$thisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
						if ($thisObject!=null)
						{
							// todo: not very effectiv = not needed add timeline of the object
							$thisObjectView=$app->getTextObjectViewFor($thisObject, $userId );
							if ($thisObjectView!=null)
							{
								$output=$output.$thisObjectView->viewTimelineWithDivEnvelope( false, $app,$userId);
							}

							$parentObject=$app->getTextObjectById($thisObject->textobjectRef, $userId);
							if ($parentObject!=null)
							{
								// $output=$output."TIMELINE!";
								$parentObjectView=$app->getTextObjectViewFor($parentObject, $userId );
								if ($parentObjectView!=null)
								{
									// print_r($textobjectViewTmp);
									// $output=$output.$parentObjectView->viewCommentsCommentTypeVisualObject($thisObject,$app,$userId);
									$output=$output."<script>reloadTextObject( ".$parentObject->textobjectId.", 'timeline' );</script>";
								
								}
							}
						}
					}



		} // /get

		// delete 
		// webservice.rest.php?area=textobjectdetail&action=delete&actionsub=&textobjectId=104
		if ($action=="delete")
		{

			// echo("textobjectdetail.delete");

			$thisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
			$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $thisObject->textobjectId, $userId );
			// $output=$output."<br>TextObjectId: ".$textobjectObj->textobjectId." UserID: $userId Matrix:".$ruleaccessmatrixObj->debug();

			if (!$ruleaccessmatrixObj->isDeletable())
			{
				$msg="Sorry you can't change anything here @rule.access.error.noaccess";
				$output=$output.TextObjectView::viewErrorMessage( "edit", $msg );
			}

			if ($ruleaccessmatrixObj->isDeletable())
			{
				if ($actionsub=="")
				{
					// todo: userid from session
					// get ...
					$thisObject=$app->getTextObjectById($textobjectFromWeb->textobjectId, $userId);
					// print_r($thisObject);
					if ($thisObject!=null)
					{
						// to do ...
						// check access ... 
						// echo("access");

						// > put into the archive
						$app->deleteTextObject($textobjectFromWeb->textobjectId, $userId);

						// delete recursive ... here .. 
						// or status?
						 
					}
				}
			}	
		}

		// rules
		if ($action=="rule")
		{
				// request - everbody - except anonymous can add requests
				if ($actionsub=="request")
				{
					if ($userId!=$app->getUserAnonymousId())
					{
						$output=$output."";

						$ruleName=$app->requestFromWebExt("ruleName","string","");
						if ($ruleName!="")
						{
							// textobject
							$textobjectBaseId=$textobjectFromWeb->textobjectId;	
							$textobjectBaseObj=$app->getTextObjectById($textobjectBaseId, $userId);
							if ($textobjectBaseObj!=null)
							{
								// get next hyperthread ...
								// todo problem twice $userId
								$app->insertRuleByValueForExt($ruleName,$textobjectBaseId,"request",$userId,$userId);

								// add system dialog here
								$output=$output."\n<script>";
								$output=$output."\n  resetSystemDialog();";
								$output=$output."\n  appendSystemDialog(\"Request done. @rule.request.done\");";
								$output=$output."\n  showSystemDialog();";
								$output=$output."\n</script>";

							}
						}
					}
				}

				// $output=$output."----error----";

				// webservice.rest.php?area=textobjectdetail&action=get&actionsub=form&textobjectType=text&textobjectTypeSub=plain&textobjectRef=345&textobjectCommentType=visual
				// get new type/typesub 
				if ($actionsub=="form")
				{
					// search for the correct friends-index ... 
					$activeIndex=$app->getRuleFriendsIndex();
					// echo($activeIndex);

					// $output=$output."type/subtype: ".$textobjectFromWeb->textobjectType."/".$textobjectFromWeb->textobjectTypeSub;
					$output=$output."<div class='dialogCommandOnObjectRuleContainerIconClose' onClick=\"$('#dialogCommandOnObjectRuleContainer').hide()\"> X </div>";
					$output=$output."<div class='dialogCommandOnObjectRuleContainerTitle'>Rules</div>";
					$output=$output."<div style='clear: both;'></div>";

					$output=$output."<div id='ruleContainers' style='display: inline;'>"; 

						// the rule container
						$output=$output."<div id='ruleContainer'>";

						$textobjectId=$textobjectFromWeb->textobjectId;

						// rule access matrix ... 
						$flagAccess=false;
						$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $textobjectId, $userId );
						if ($ruleaccessmatrixObj->isWritable())
						{
							$flagAccess=true;
						}


						// todo: check here!
						$textobjectObj=$app->getTextObjectById($textobjectId, $userId);


								// the rules for this object
								$arrRules=$app->getRulesByTextObjectId( $textobjectId, $userId );

								// ... 
								// the form
								for ($i=0;$i<$app->countRuleTypes();$i++)
								{
									$ruleTypeObj=$app->getRuleTypeByIndex($i);

									// check rule types ...
									$ruleTypeAllowedHere=false;

									// stuff only if domain or plattform
									$ruleName=$ruleTypeObj->ruleName;
									if ($ruleName=="admin") 
									{    
										if ($textobjectObj->textobjectType=="platform") $ruleTypeAllowedHere=true;
										if ($textobjectObj->textobjectType=="domain")  $ruleTypeAllowedHere=true;
										if ($textobjectObj->textobjectType=="hyperthread")  $ruleTypeAllowedHere=true;
									}  
		//							if ($textobjectObj->objectType=="domain") $ruleTypeAllowedHere=true;

									if ($ruleName=="staff") 
									{
										if ($textobjectObj->textobjectType=="platform") $ruleTypeAllowedHere=true;
										if ($textobjectObj->textobjectType=="domain") $ruleTypeAllowedHere=true;
									}
									
									if ($ruleName=="collaborator")  
									{ 
										$ruleTypeAllowedHere=true; 
									} 
									
									if ($ruleName=="friend")  
									{ 
										if ($textobjectObj->textobjectType=="platform") $ruleTypeAllowedHere=true;
										if ($textobjectObj->textobjectType=="domain")  $ruleTypeAllowedHere=true;
										if ($textobjectObj->textobjectType=="hyperthread")  $ruleTypeAllowedHere=true;
									} 
									
									if ($ruleName=="freerider")  
									{ 
										if ($textobjectObj->textobjectType=="platform") $ruleTypeAllowedHere=true;
										if ($textobjectObj->textobjectType=="domain")  $ruleTypeAllowedHere=true;
										if ($textobjectObj->textobjectType=="hyperthread")  $ruleTypeAllowedHere=true;
									} 

									if ($ruleTypeAllowedHere)
									{
										$output=$output."\n<div class='detailContainerContentActionsRuleType' id='rule'>";

											$output=$output."\n<div class='detailContainerContentActionsRuleTypeEntitiesName'  >".$ruleTypeObj->label."</div>";
											// $output=$output."\n<div>".$ruleTypeObj->description."</div>";

											// ok now the real things in here ...
											$output=$output."\n   <div class='detailContainerContentActionsRuleTypeEntities' id='rule$i'>";
												
												if (count($arrRules)>0)
												for ($a=0;$a<count($arrRules);$a++)
												{
													$ruleObj=$arrRules[$a];
													if ($ruleObj->ruleName==$ruleTypeObj->ruleName)
													{
														$userObject=$app->getUserById($ruleObj->ruleUserRef);
														// print_r($userObject);

														$output=$output."\n   <div  class='detailContainerContentActionsRuleTypeEntity' >";
															// $output=$output."\n   $a ";
															$strOnClick="";															
															if ($flagAccess) $output=$output."\n<div class='detailContainerContentActionsRuleTypeEntityDelete' $strOnClick onClick=\"doRuleAction('delete','".$ruleTypeObj->ruleName."',".$ruleObj->ruleId.")\"> - </div>";
															if ($userObject!=null) $output=$output."\n   ".$userObject->userName;															
															// else $output=$output."\n   ".$userObject->userName;
														$output=$output."\n   </div>";
													}
												}

												// found the correct ones
												if ($flagAccess) $output=$output."\n<div  class='detailContainerContentActionsRuleTypeEntity' style='float:left; width: 49%; border-right: 1px dotted black;' onClick=\"doRuleAction('addform','".$ruleTypeObj->ruleName."',-1)\"> + user</div>";
												// invitations
												if ($flagAccess) $output=$output."\n<div  class='detailContainerContentActionsRuleTypeEntity' style='float:left; width: 50%; ' onClick=\"doRuleAction('invitationform','".$ruleTypeObj->ruleName."',-1)\"> ? invite</div>";
												// clear
												$output=$output."<div style='clear: both;'></div>";

												// todo: add defaults! anonymous & friends!
												$arrRequests=$app->getRuleRequestsByTextObjectIdRuleName( $textobjectId, $ruleName, $userId );
												if (count($arrRequests)>0)
												{
													// $output=$output."<br>arrRequests:  ".count($arrRequests);
													$output=$output."+ Requests  ";
													for ($it=0;$it<count($arrRequests);$it++)
													{
														$requestRule=$arrRequests[$it];
														$userRequestObj=$app->getUserById($requestRule->ruleUserRef,$userId);
														if ($userRequestObj!=null)
														{
															$output=$output."\n   <div  class='detailContainerContentActionsRuleTypeEntityRequest' >";
															$output=$output."<div class='detailContainerContentActionsRuleTypeEntityRequestApprove' onClick=\"doRuleAction('approverequest','',".$requestRule->ruleId.")\"> + </div> ".$userRequestObj->userName." <div class='detailContainerContentActionsRuleTypeEntityRequestApprove' onClick=\"doRuleAction('rejectrequest','',".$requestRule->ruleId.")\">reject</div> ";
															$output=$output."\n   </div>";
														}
													}
												}

												// todo: add defaults! anonymous & friends
												if ($flagAccess)
												{
													$arrInvitations=$app->getRuleInvitationsByTextObjectIdRuleName( $textobjectId, $ruleName, $userId );
													if (count($arrInvitations)>0)
													{
														// $output=$output."<br>arrInvitations:  ".count($arrInvitations);
														$output=$output."? Invitations  ";
														for ($it=0;$it<count($arrInvitations);$it++)
														{
															$invitationRule=$arrInvitations[$it];
															// $output=$output."".$invitationRule->ruleName;
															$userNameOrEmail="".$invitationRule->ruleTypeCaseInvitationsEmail;
															$userInvitationObj=$app->getUserById($invitationRule->ruleUserRef,$userId);
															if ($userInvitationObj!=null) $userNameOrEmail=$userInvitationObj->userName;

															if (
																// default
																($userInvitationObj!=null)
																||
																// special case: invitationweb!
																(($invitationRule->ruleStatus=="invitationweb")&&(($userInvitationObj==null)))
															   )
															{
																$output=$output."\n   <div  class='detailContainerContentActionsRuleTypeEntityRequest' >";
																// todo: remove request
																$ruleType=""; // [".$invitationRule->ruleStatus."]
																if ($invitationRule->ruleStatus=="invitationweb") $ruleType="[extern]";
																$output=$output."<div class='detailContainerContentActionsRuleTypeEntityRequestApprove'  onClick=\"doRuleAction('delete','".$invitationRule->ruleName."',".$invitationRule->ruleId.")\"> - </div> ".$userNameOrEmail." ".$ruleType;
																$output=$output."\n   </div>";
															}
														}
													}
												}

											$output=$output."\n   </div>";
											

						
										$output=$output."\n</div>";
									}

								}
								$output=$output."</div>";

								// add container ...
								$output=$output."\n<div id='ruleContainerAdd' >";
									$output=$output."\n ";
								$output=$output."\n</div>";


	/*
							// testing here !!!!
							$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $textobjectId, $userId );
							// check access
							$output=$output."<br>READ: ".$app->checkRuleMatrixFor($ruleaccessmatrixObj,"read");
							$output=$output."<br>WRITE: ".$app->checkRuleMatrixFor($ruleaccessmatrixObj,"write");
							$output=$output."<br>COMMENT: ".$app->checkRuleMatrixFor($ruleaccessmatrixObj,"comment");
							$output=$output."<br>COMMENTEXTENDED: ".$app->checkRuleMatrixFor($ruleaccessmatrixObj,"commentextended");

	*/
						// end of the 2 split container
						$output=$output."\n</div>";

				}
					// add direct
					if ($actionsub=="addform")
					{
						// what do you wanna add?
						
						// ruleName
						$ruleName=$app->requestFromWeb("ruleName","string");
						if ($ruleName==null) $ruleName="friends";

						$output=$output."\n<div id='ruleContainerAddHead'>";
						$output=$output."\nSelect Rule: $ruleName ";
						$output=$output."\n<form><input type=textfield name='RuleSearch' id='RuleSearch' value=''><input type=button value='search'  onClick=\"doRuleAction('addformsearch','',-1)\"></form>";
						$output=$output."\n</div>";

						$output=$output."\n<div id='ruleContainerAddResult'>";
						$output=$output."\n</div>";
					}

						if ($actionsub=="addformsearch")
						{
							// what do you wanna add?
							// ruleName
							// search now ...
							// ok search here ..
							// todo: security
							$search="";
							if (isset($_REQUEST["addformsearch"]))
							{
								$searchString="".$_REQUEST["addformsearch"];

								// search for different type of users

								// 1. friends

								// 2. groupds/topics

								// 3. persons ...
								// search for ...
								$arrUsers=$app->getUsersByNameAndPrenameLike( $searchString, $userId );
								// print_r($arrUsers);
								for ($z=0;$z<count($arrUsers);$z++)
								{
									$userObj=$arrUsers[$z];
									$output=$output."<div style='border: 1px solid black;' onClick=\"doRuleAction('addformsearchrule','',".$userObj->userId.")\">< ".$userObj->userAvatar.": ".$userObj->userName.", ".$userObj->userPreName."</div>";
								}

								if (count($arrUsers)==0) $output=$output."\n<br>No result.";

							} 
						}

							// webservice.rest.php?area=textobjectdetail&action=insert&actionsub=form&textobjectType=text&textobjectTypeSub=plain&textobjectRef=1313&textobjectCommentType=
							if ($actionsub=="insert")
							{
								$ruleName=$app->requestFromWeb("ruleName","string");
								if ($ruleName==null) $ruleName="friends";

								$userIdRule=$app->requestFromWeb("ruleUserId","string");
								if ($userIdRule==null) $userIdRule=-1;

								$textobjectId=$textobjectFromWeb->textobjectId;

								// rule access matrix ... 
								$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $textobjectId, $userId );

								if (!$ruleaccessmatrixObj->isWritable())
								{
									$msg="Sorry you can't change anything here @rule.access.error.noaccess";
									$output=$output.TextObjectView::viewErrorMessage( "rule", $msg );
								}

								// can be changed?
								if ($ruleaccessmatrixObj->isWritable())
								{
									// $output=$output."------ $ruleName $userIdRule $textobjectId";

									// let's add
									// todo: access
									// $output=$output."--- $ruleName,$textobjectId,$userId  -------";
									$app->insertRuleByValueFor($ruleName,$textobjectId,$userIdRule,$userId);
								}

							}

					// inviteform
					if ($actionsub=="invitationform")
					{
						// what do you wanna add?
						
						// ruleName
						$ruleName=$app->requestFromWeb("ruleName","string");
						if ($ruleName==null) $ruleName="friends";


						$output=$output."\n<div id='ruleContainerAddHead'>";
						// add email
						$output=$output."\n";
						$output=$output."\n<form>Invite via Email: <br><input type=textfield name='RuleEmail' id='RuleEmail' value='@'><input type=button value='invite'  onClick=\"doRuleAction('invitationwebformsearchrule','',-1)\"></form>";

						// add user
						$output=$output."\nSelect Invitation Rule: $ruleName ";
						$output=$output."\n<form><input type=textfield name='InvitationSearch' id='InvitationSearch' value=''><input type=button value='search'  onClick=\"doRuleAction('invitationformsearch','',-1)\"></form>";
						$output=$output."\n</div>";

						$output=$output."\n<div id='ruleContainerAddResult'>";
						$output=$output."\n</div>";
					}

						if ($actionsub=="invitationformsearch")
						{

							// $output=$output."invitationformsearch";
							// what do you wanna add?
							// ruleName
							// search now ...
							// ok search here ..
							// todo: security
							// echo($_REQUEST["invitationformsearch"]);
							$search="";
							if (isset($_REQUEST["invitationformsearch"]))
							{
								$searchString="".$_REQUEST["invitationformsearch"];

								// search for different type of users

								// 1. friends

								// 2. groupds/topics

								// 3. persons ...
								// search for ...
								$arrUsers=$app->getUsersByNameAndPrenameLike( $searchString, $userId );
								// print_r($arrUsers);
								for ($z=0;$z<count($arrUsers);$z++)
								{
									$userObj=$arrUsers[$z];
									$output=$output."<div style='border: 1px solid black;' onClick=\"doRuleAction('invitationformsearchrule','',".$userObj->userId.")\">< ".$userObj->userAvatar.": ".$userObj->userName.", ".$userObj->userPreName."</div>";
								}

								if (count($arrUsers)==0) $output=$output."\n<br>No result.";

							} 
						}

							// webservice.rest.php?area=textobjectdetail&action=insert&actionsub=form&textobjectType=text&textobjectTypeSub=plain&textobjectRef=1313&textobjectCommentType=
							if ($actionsub=="insertinvitation")
							{
								$ruleName=$app->requestFromWeb("ruleName","string");
								if ($ruleName==null) $ruleName="friends";

								$userIdRule=$app->requestFromWeb("ruleUserId","string");
								if ($userIdRule==null) $userIdRule=-1;

								$textobjectId=$textobjectFromWeb->textobjectId;

								// rule access matrix ... 
								$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $textobjectId, $userId );

								if (!$ruleaccessmatrixObj->isWritable())
								{
									$msg="Sorry you can't change anything here @rule.access.error.noaccess";
									$output=$output.TextObjectView::viewErrorMessage( "rule", $msg );
								}
  
								// can be changed?
								if ($ruleaccessmatrixObj->isWritable())
								{
									// $output=$output."------ $ruleName $userIdRule $textobjectId";

									// let's add
									// todo: access
									// $output=$output."--- $ruleName,$textobjectId,$userId  -------";
									$app->insertRuleByValueForExt($ruleName,$textobjectId,"invitation",$userIdRule,$userId);
								}
							}

							// invitateweb
							if ($actionsub=="insertinvitationweb")
							{
								$ruleName=$app->requestFromWeb("ruleName","string");
								if ($ruleName==null) $ruleName="friends";

								$userIdRule=$app->requestFromWeb("ruleUserId","string");
								if ($userIdRule==null) $userIdRule=-1;

								$ruleEmail=$app->requestFromWeb("ruleEmail","string");
								if ($ruleEmail==null) $ruleEmail="";

								$textobjectId=$textobjectFromWeb->textobjectId;

								// rule access matrix ... 
								$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $textobjectId, $userId );

								if (!$ruleaccessmatrixObj->isWritable())
								{
									$msg="Sorry you can't change anything here @rule.access.error.noaccess";
									$output=$output.TextObjectView::viewErrorMessage( "rule", $msg );
								}
  
								// can be changed?
								if ($ruleaccessmatrixObj->isWritable())
								{
									// $output=$output."------ $ruleName $userIdRule $textobjectId";

									// let's add
									// todo: access
									// $output=$output."--- $ruleName,$textobjectId,$userId  -------";
									$app->insertRuleByValueForExt($ruleName,$textobjectId,"invitationweb",-1,$userId,$ruleEmail); // todo: not nice programmed userId should be at the end
								}
							}


				// delete 
				if ($actionsub=="delete")
				{
					$ruleId=$app->requestFromWeb("ruleId","string");
					if ($ruleId==null) $ruleId=-1;

					$ruleObj=$app->getRuleById($ruleId);
					if ($ruleObj!=null)
					{
						// $output=$output."------ $ruleId   ";

						// $output=$output."------ $ruleName $userIdRule $textobjectId";

						// rule access matrix ... 
						$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $ruleObj->ruleTextObjectRef, $userId );


						// no access
						if (!$ruleaccessmatrixObj->isWritable())
						{
							$msg="Sorry you can't change anything here @rule.access.error.noaccess";
							$output=$output.TextObjectView::viewErrorMessage( "rule", $msg );
						}

						// can be changed?
						if ($ruleaccessmatrixObj->isDeletable())
						{
							// let's add
							// todo: access
							// $output=$output."--- $ruleName,$textobjectId,$userId  -------";
							$deleteThisRuleObj=new Rule();
							$deleteThisRuleObj->ruleId=$ruleId;
							
							// todo: check for rule - never delete last collaborator!
							//			1. get collaborator rules
							//			2. ...
							// $rulesCollaborators=$app->getRules
							// ....
							/* if (count($rulesCollaborators)>0)
							{
								*/
								$app->deleteRule($deleteThisRuleObj,$userId);
							/*}
							else
							{
								// todo: say it!
							}
							*/
						}	


					}	

				}

				// request / approves
				if ($actionsub=="approverequest")
				{
					$ruleId=$app->requestFromWeb("ruleId","string");
					if ($ruleId==null) $ruleId=-1;

					$ruleObj=$app->getRuleById($ruleId);
					if ($ruleObj!=null)
					{
						// $output=$output."------ $ruleId   ";

						// $output=$output."------ $ruleName $userIdRule $textobjectId";

						// rule access matrix ... 
						$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $ruleObj->ruleTextObjectRef, $userId );


						// no access
						if (!$ruleaccessmatrixObj->isWritable())
						{
							$msg="Sorry you can't change anything here @rule.access.error.noaccess";
							$output=$output.TextObjectView::viewErrorMessage( "rule", $msg );
						}

						// can be changed?
						if ($ruleaccessmatrixObj->isWritable())
						{
							// let's add
							// todo: access
							// $output=$output."--- $ruleName,$textobjectId,$userId  -------";
							$updateThisRuleObj=$app->getRuleById($ruleObj->ruleId);
							$updateThisRuleObj->ruleStatus="active";
							$app->updateRule($updateThisRuleObj,$userId);
						}	


					}	

				}

				// request / approves
				if ($actionsub=="rejectrequest")
				{
					$ruleId=$app->requestFromWeb("ruleId","string");
					if ($ruleId==null) $ruleId=-1;

					$ruleObj=$app->getRuleById($ruleId);
					if ($ruleObj!=null)
					{
						// $output=$output."------ $ruleId   ";

						// $output=$output."------ $ruleName $userIdRule $textobjectId";

						// rule access matrix ... 
						$ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $ruleObj->ruleTextObjectRef, $userId );


						// no access
						if (!$ruleaccessmatrixObj->isWritable())
						{
							$msg="Sorry you can't change anything here @rule.access.error.noaccess";
							$output=$output.TextObjectView::viewErrorMessage( "rule", $msg );
						}

						// can be changed?
						if ($ruleaccessmatrixObj->isWritable())
						{
							// let's add
							// todo: access
							// $output=$output."--- $ruleName,$textobjectId,$userId  -------";
							$updateThisRuleObj=$app->getRuleById($ruleObj->ruleId);
							$updateThisRuleObj->ruleStatus="rejected";
							$app->updateRule($updateThisRuleObj,$userId);
						}	


					}	

				}

		}

		// $action // viewDetailCore

	}

	
	// input
	if ($debugServices)
	{
		echo("\n<hr>INPUT<hr>");
		echo("\n<br>area: $area");
		echo("\n<br>areasub: $areasub");
		echo("\n<br>action: $action");
		echo("\n<br>actionsub: $actionsub");
		echo("\n<br>argument: $argument");
		echo("\n<br>argumentsub: $argumentsub");
	}


	echo($output);

	// output
	if ($debugServices)
	{
		echo("\n<hr>OUTPUT<hr>");
		echo("\n<br>action: $action");
		echo("\n<br>actionsub: $actionsub");
	}
	
	

	
	// stop
	include("./appdeconstruct.php");

?>