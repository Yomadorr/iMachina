<?

	// todo: add this to the platform
	// 		 as an element ..
	// 		 could be static ..
	class UserContainerView
	{
		var $debug=false;


		function viewContainer( $app, $userId )
		{
			$str="";

			$str=$str."<div class='userContainer'>";

			$userId=$_SESSION["userId"];

			// not yet loggedin
			$loggedIn=false;

			// logged in
			// version 2
			$userAnonymousObj=$app->getUserAnonymous();
			// print_r($userAnonymousObj);
			if ($userId!=$userAnonymousObj->userId) $loggedIn=true;

			// todo: facebook & twitter ...
			// todo
			// is there a local-twitter account for this?
			// else create one ...

			// not logged in
			if (!$loggedIn)  $str=$str.$this->viewContainerNotYetLoggedIn( $app );
			// logged in
			if ($loggedIn)  $str=$str.$this->viewContainerLogedIn( $app, $userId  );

			$str=$str."</div>";

			return $str;
		}

			function viewContainerNotYetLoggedIn( $app )
			{
				$str="";

				// login
				$str=$str."\n<div class='userContainerLogin'>";
					$str=$str."\n<div class='userContainerLoginDescription' >Login in with your EMail-Address</div>";
					$str=$str."\n<form method='post'>";
						$str=$str."\n<input type=hidden name='action' value='login' >";
						$str=$str."\nLogin: <br><input type=text name='login' value='@' style='width: 95%;'>";
						$str=$str."\n<br>Password: <br><input type=password name='password' value='' style='width: 95%;'>";
						$str=$str."\n<div class='userContainerLoginButton'><input type=submit value='LogIn' style='width: 95%;'></div>";
					$str=$str."\n</form>";
				$str=$str."\n</div>";

				// password forgotten
				$str=$str."\n<div class='userContainerLoginRecoverToggle' onClick=\"$('.userContainerLoginRecover').toggle();\">";
				$str=$str."\nRecover Password >";
				$str=$str."\n</div>";
				$str=$str."\n<div class='userContainerLoginRecover' id='userContainerLoginRecover'>";
					$str=$str."\n<div class='userContainerLoginRecoverDescription' >Recover your password. Enter your Email-Login </div>";
					$str=$str."\n<form method='post'>";
						$str=$str."\n<input type=hidden name='action' value='recover' >";
						$str=$str."\n<input type=text name='login' id='recoverLogin' value='@' style='width: 95%;'>";
						$str=$str."\n<div class='userContainerLoginRecoverButton' ><input type=button value='Request now' style='width: 95%;' onClick=\"recoverPassword()\"></div>";
					$str=$str."\n</form>";
				$str=$str."\n   <div id='userContainerLoginRecoverAnswer'></div>";
				$str=$str."\n</div>";
				// javascript/ajax part
				$str=$str."\n <script>";
				$str=$str."\n function recoverPassword()";				
				$str=$str."\n { ";								
				$str=$str."\n   emailLogin=$('#recoverLogin').val();";
				$str=$str."\n   // alert('recoverPassword() '+emailLogin);";
				$str=$str."\n   $.ajax({";
				$str=$str."\n    url: 'webservice.rest.php',";
				$str=$str."\n    post: 'post',";
				$str=$str."\n    data:  { area: 'account', action: 'recover', actionsub: '', login: emailLogin  },";
				$str=$str."\n    context: document.body";
				$str=$str."\n   }).done(function( result ) { ";

				$str=$str."\n    // alert('insert a new record '+result); ";
				//				 userContainerLoginRecover
				$str=$str."\n     $('#userContainerLoginRecover').html(''+result);";
				
				$str=$str."\n    });";
				$str=$str."\n   // alert('recoverPassword() ');";
				$str=$str."\n }";
				$str=$str."\n </script>";

				// create
				$str=$str."\n<div class='userContainerLoginCreateToggle' onClick=\"$('.userContainerLoginCreate').toggle();\">";
				$str=$str."\nCreate Account >";
				$str=$str."\n</div>";
				$str=$str."\n<div class='userContainerLoginCreate'>";
					$str=$str."\n<div class='userContainerLoginCreateDescription' >Create an account. <br>Enter your EMail-Address.  </div>";
					$str=$str."\n<form method='post'>";
						$str=$str."\n<input type=hidden name='action' value='create' >";
						$str=$str."\n<input type=text name='login' id='createLogin' value='@' style='width: 95%;'>";
						$str=$str."\n<div class='userContainerLoginCreateButton'><input type=button value='Create Account' onClick='createAccount()' style='width: 95%;'></div>";
					$str=$str."\n</form>";
				$str=$str."\n   <div id='userContainerLoginCreateAnswer'></div>";
				$str=$str."\n</div>";
				// javascript/ajax part
				$str=$str."\n <script>";
				$str=$str."\n function createAccount()";				
				$str=$str."\n { ";				
				
				$str=$str."\n   emailLogin=$('#createLogin').val();";
				$str=$str."\n   // alert('createAccount() '+emailLogin);";
				$str=$str."\n   $.ajax({";
				$str=$str."\n    url: 'webservice.rest.php',";
				$str=$str."\n    post: 'post',";
				$str=$str."\n    data:  { area: 'account', action: 'create', actionsub: '', login: emailLogin  },";
				$str=$str."\n    context: document.body";
				$str=$str."\n   }).done(function( result ) { ";

				$str=$str."\n    // alert('insert a new record '+result); ";
				//				 userContainerLoginRecover
				$str=$str."\n     $('#userContainerLoginCreateAnswer').html(''+result);";
				
				$str=$str."\n    });";
				$str=$str."\n   // alert('recoverPassword() ');";
				$str=$str."\n }";
				$str=$str."\n </script>";


				// create domain
				if ($app->userCanCreateDomains)
				{
					$str=$str."\n<div class='userContainerDomainCreateToggle' onClick=\"$('.userContainerDomainCreate').toggle();\">";
					$str=$str."\nCreate Domain >";
					$str=$str."\n</div>";
					$str=$str."\n<div class='userContainerDomainCreate'>";
					$str=$str."\nYou have to have a user account and be logged in for creating you own domain!";
					$str=$str."\n</div>";
				}					

				return $str;
			}

			function viewContainerLogedIn( $app, $userId  )
			{
				$str="";

				// log out
				$str=$str."\n<div class='userContainerLogedIn'>";

					$str=$str."\n<div class='userContainerLogedInLogOut' >";
					$str=$str."\n <a onClick=\"logOut();\">^LogOut</a>";
					$str=$str."\n</div>";

					// user container
					$str=$str.$this->viewContainerLoggedInUserPortrait( $app, $userId );



				$str=$str."\n</div>";

				return $str;
			}

				// userPortrait
				function viewContainerLoggedInUserPortrait( $app, $userId )
				{
					$str="";
					if ($userId!=-1)
					{
						$userObject=$app->getUserById($userId);
						$str=$str."\n<div class='userPortrait' >";

							// users ... 
							// background
								$userIconPath="";
								if ($userObject->userIconStatus=="icon") $userIconPath="background-image: url(documents/user".$userObject->userId.".png)";
							$str=$str."<div id='userPortraitProfile'>";

								$str=$str."\n<div class='userPortraitIcon' style=\"$userIconPath\">&nbsp;</div>";
								$str=$str."\n <div class='userPortraitName'>".$userObject->userPreName." ".$userObject->userName."</div>";
								$str=$str."\n <div class='userPortraitAvatar' style='height: 80px'>".$userObject->userAvatar."</div>";

							$str=$str."\n </div>";
							// $str=$str."\n <div class='userPortraitClear></div>";

							// selector
							$str=$str."\n <script>function setContentUserPercentage(userWidthInPercentage) { $('.contentContainer').css('width',(100*(1.0-userWidthInPercentage))+'%'); $('.userContainer').css('width',(100*(userWidthInPercentage*0.9))+'%'); } </script>";
							$str=$str."\n <div class='userPortraitSelector'>Selection: <a onClick=\"setContentUserPercentage(0.33);\">[__|_]</a> <a onClick=\"setContentUserPercentage(0.5);\">[_|_]</a> </div>";
							// todo: insert the personal here ..

							// create new domain
							if ($app->userCanCreateDomains)
							{


								$str=$str."\n<div class='userContainerDomainCreateToggle' onClick=\"$('.userContainerDomainCreate').toggle();\">";
								$str=$str."\nCreate your own domain >";
								$str=$str."\n</div>";
								$str=$str."\n<div class='userContainerDomainCreate'>";
									$str=$str."\n<div class='userContainerDomainCreateDescription' >Create your own domain xyz/</div>";
									$str=$str."\n<form method='post'>";
										$str=$str."\n<input type=text name='login' id='createDomain' value='' style='width: 95%;'>/";
										$str=$str."\n<div class='userContainerDomainCreateButton'  onclick='createDomain();'><input type=button value='Create Domain' style='width: 95%;'></div>";
									$str=$str."\n</form>";
								$str=$str."\n <a onClick='createDomain();'>abc</a>";
								$str=$str."\n   <div id='userContainerDomainCreateAnswer'></div>";
								$str=$str."\n</div>";

								// javascript/ajax part
								$str=$str."\n <script>";
								$str=$str."\n function createDomain()";				
								$str=$str."\n { ";				
								$str=$str."\n   // alert('createDomain()');";
						
								$str=$str."\n   createDomain=$('#createDomain').val();";
								$str=$str."\n   // alert('createAccount() '+createDomain);";
								$str=$str."\n   $.ajax({";
								$str=$str."\n    url: 'webservice.rest.php',";
								$str=$str."\n    post: 'post',";
								$str=$str."\n    data:  { area: 'domain', action: 'create', actionsub: '', domain: createDomain  },";
								$str=$str."\n    context: document.body";
								$str=$str."\n   }).done(function( result ) { ";

								$str=$str."\n    // alert('insert a new record '+result); ";
								//				 userContainerLoginRecover
								$str=$str."\n     $('#userContainerDomainCreateAnswer').html(''+result);";
							
								$str=$str."\n    });";
								$str=$str."\n }";
								$str=$str."\n </script>";
							}

							// chat or content ... 
							// selection ... which is visible
							$str=$str."\n <script>var actFunctionality='chat'; function setUserFunctionality(newfunct) { /*alert('setUserFunctionality ('+newfunct+')');*/ actFunctionality=newfunct; if (newfunct=='chat') { $('.userChat').css('display','block');$('.userContentThread').css('display','none');  } if (newfunct=='content') { $('.userChat').css('display','none');$('.userContentThread').css('display','block');  }  } </script>";
							$str=$str."\n <div class='userContentType'><a onClick=\"setUserFunctionality('chat');\">[CHAT]</a> <a onClick=\"setUserFunctionality('content');\">[CONTENT]</a></div>";


							$str=$str."\n <div class='userChat' style='display:block;'>Chat: <br></div>";

							// userContent
							$str=$str."\n <div class='userContentThread' style='display:none;'>Content: <br></div>";

							// your own content ...
							// get id and display here ...
							/*
							$arrDomainUser=$app->getTextObjectByUserRef( $userObject->userId, $userId );
							// print_r($domainUser);
							if (count($arrDomainUser)>0)
							{
								$domainUser=$arrDomainUser[0];
								$textobjectViewTmpX=$app->getTextObjectViewFor($domainUser, $userId );
		                        if ($textobjectViewTmpX!=null)
		                        {
		                            // echo("<pre>");print_r($textobjectViewTmp);echo("</pre>");  
		                           $str=$str."".$textobjectViewTmpX->viewDetail($app,$userId);

		                        }

							}
							*/


						$str=$str."\n</div>";


					}

					return $str;
				}	
	}
	
    
    
    
?>