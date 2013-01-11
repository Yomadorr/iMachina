

	<!-- <h3>Herzlich willkommen bei TOSS (Texte online schreiben mit Schreibberatung)</h3> -->
<?
	$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "textfront" );
	if ($readtextObj==null) { echo(""); $newReadTask=new TaskRemarkText(); $newReadTask->taskremarktextTaskRef=0; $newReadTask->taskremarktextArea="textfront"; $newReadTask->taskremarktextDescription="Herzlich willkommen bei TOSS (Texte online schreiben mit Schreibberatung)"; $app->insertTaskRemarkText($newReadTask); }
	$readtextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "textfront" );

// print_r($readtextObj);

	// contentlogin
	$icontentlogin=$app->requestFromWeb("contentlogin","string");
	if ($icontentlogin=="") $icontentlogin="@";
	$icontentpassword=$app->requestFromWeb("contentpassword","string");
	if ($icontentpassword=="") $icontentpassword="";


?>
	<?=$readtextObj->taskremarktextDescription?>

	<!-- 
	Text TextText Text Text. Text TextText Text Text.Text TextText Text Text.Text TextText Text Text.Text TextText Text Text.Text TextText Text Text.Text TextText Text Text.Text TextText Text Text.Text TextText Text Text.Text TextText Text Text.Text TextText Text Text.
	-->
	<div class='frontLogin'>
		<h4>Anmelden</h4>
		<?
			if (
				 ($icontentlogin!="@")
				 &&
				 (isset($_REQUEST["contentpassword"]))
			   )
			{
				echo("<div class='userLoginError'><strong>Leider stimmen Ihre Daten nicht.<br>Bitte versuchen Sie es erneut oder nutzen Sie die Funktion: <br>Passwort vergessen.</strong></div><br>");
			}


		?>
		<form action="index.php" method='post'>
		  Login:
		  <br>
		  <input type='text' name='contentlogin' size=30 value='<?=$icontentlogin?>'>
		  <br>
		  Password: 
		  <br>
		  <input type='password' name='contentpassword' size=30  value=''>
		  <br>
		  <br>
		  <input type='submit' value='Einloggen'>
		</form>
		
		<br>

		<!-- password sent -->
		<?
			// check if there is an email with this
			// > send it here .. 
			$action=$app->requestFromWeb("action","string.azAZ");
			$actionSub="";
			$password=$app->requestFromWeb("password","string.azAZ");
			if ($action=="password")
			{
				// echo("<br>new password<br>");
				// check for this password 

				$contentLogin=$app->requestFromWeb("contentlogin","string.azAZ");

				// echo("-------------".$contentLogin);

				// send it now ..
				$arrLogins=$app->getUserByLogin( $contentLogin );
				// print_r($arrLogins);
				if (count($arrLogins)>0)
				{
// print_r($arrLogins);
					for ($a=0;$a<count($arrLogins);$a++)
					{
						$userObj=$arrLogins[$a];
						// print_r($userObj);

						// new login here ..
						$app->jobSetRandomPasswordNew( $userObj );

				
						// Neue Logindaten ...
						$emailText="";
/*
							// new password ... 
							$emailTextObj="".$app->getTaskRemarkTextByTaskRefAndArea( 0, "textfrontpassword" );; // Fremdbeurteilung gemacht, bitte loggen Sie sich erneut ein.";
							// $emailTextObj=$app->getTaskRemarkTextByTaskRefAndArea( $excercisetaskId, "email" );
print_r($emailTextObj);

							$sentEmail=false;
							if ($emailTextObj!=null)
							{
								$emailText=$emailTextObj->taskremarktextDescription;



					// print_r($userObject);
						
							}
							*/
							// send now ...
							// addons
							$addons="";
							$addons=$addons."";
							$addons=$addons."<br><strong>Neue Logindaten:</strong>";
							$addons=$addons."<br>";
							$serverPath=dirname($_SERVER["PHP_SELF"]);
							$url="http://".$_SERVER["HTTP_HOST"].$serverPath;
							$addons=$addons."<br>Webzugang: <a href='".$url."?contentlogin=".urlencode($userObj->userLogin)."' target='_blank'>$url</a>";
							$addons=$addons."<br>Login: ".$userObj->userLogin;
							$addons=$addons."<br>Passwort: ".$userObj->userPasswordNew;

							$addons=$addons."<br><br>";
							$addons=$addons."<br>Falls Sie kein neues Passwort bestellt haben, dann k&ouml;nnen Sie diese Nachricht ignorieren. Ihr bisheriges Passwort ist weiterhin g&uuml;ltig.";
							

							// userEmails ...
							$arr=$userObj->getEmails();
							// testings
							// $arr=array("rene.bauer@zhdk.ch","ixistenz@gmail.com");

							// todo: get from setting
							$title="[TOSS] Neues Password";
							$emailText=""; // textfrontpassword
							$emailTextObj=$app->getTaskRemarkTextByTaskRefAndArea( 0, "textfrontpassword" );
							$emailText="";
							if ($emailTextObj!=null)
							{
								$emailText=$emailTextObj->taskremarktextDescription;
							}
							$emailText=$emailText.$addons;		
							
						// echo("*****");
						// echo($emailText);	
							$sentEmail=$app->sendEmailWithTitleText($arr,$title,$emailText);
						// echo($sentEmail);
					}
					



				}
				else
				{
					$actionSub="notfound";
				}

				
				// new password will be sent to login address ...

				// is there a login address with this?

				

			}
		?>
		<div><a onClick="$('#sendpassword').toggle()"><strong>Passwort vergessen?</strong></a></div>
		<div></div>
		<!-- password -->
		<? 
		   $icontentlogin=$app->requestFromWeb("contentlogin","string");
		   if ($icontentlogin=="") $icontentlogin="@";
		   
		   if 
		   	  (
		   		($action!="password")
		   		|| 
		   		($actionSub=="notfound")
		   		
		   	  )
		   {
		   		$strHidden=" style='display: none;' ";
		   		if ($actionSub=="notfound") 
		   		{  
		   			echo("Dieser Account konnte nicht gefunden werden.<br>Versuchen Sie es erneut!<br>");
		   			$strHidden=""; 
		   		}
		   		
		   			?>
						<div id='sendpassword' <?=$strHidden?> ><a name='sendpasswordhere'>&nbsp;</a>
							<form action='index.php#sendpasswordhere' method="post">Email mit Passwort verschicken. <br>Login: <input type='hidden' name='action' value='password'><input type=textfield name='contentlogin' size=40 value='<?=$icontentlogin?>'><input type=submit value=' verschicken '></form>
						</div>
					<?  	
				
			}
		    else
		    { 
		    	// found email?
				?>
			 <div >Email mit Password versandt. <br>Nutzen Sie das neue Passwort zum Login.</div>
		<?  } ?>
	</div>
	