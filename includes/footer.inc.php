
 	<div class='footer'><a href='http://www.imachina.ch' target='_blank'><?=$app->getConfigValueByName("name")?></a> - Version <?=$app->version?></div>
  

<?
  if (false)
  {
 ?>
   <div id="debugSessionContainer">
	    <a onClick="$('#debugSessionContainerContent').toggle()">[Toggle Debug Session]</a>
	   <div id='debugSessionContainerContent'>
  		<?
  			if (false)
  			{
			 echo("<br>SessionUserId: ".$_SESSION["userId"]);
			 echo("<br>isLoggedIn: ".$app->session->isLoggedIn());
			 echo("<br>isAdmin: ".$app->session->isAdmin());
			 echo("<br>");
			 echo("<pre>");
				 print_r($app->session);
		 	 echo("</pre>");
		 	 if ($app->session->isLoggedIn())
		 	 {
			 	 echo($app->session->userObject->userType);
			 }
			}
		?>
	</div>

  	
 </div>
<?
}
?>
 </body>
</html>
<?
	// stop app
	$app->stop();
	
?>