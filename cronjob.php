<?

	// include instance
	include("./appinstance.php");

	// endless
	set_time_limit(-1);


	// excercise task handling
	// include("./includes/excercisetaskhandling.user.php");

	// check logged in!
	// include("./includes/checkaccess.user.php");
	
	// let's do the cronjob
	// best executed every 5 minutes

	// job to do: wait for tasks to be done: send emails etc

	echo("<html>");
	echo("<head>");
	echo("<title>cronjob</title>");
	echo("</head>");
	echo("<style>");
		echo(".classtitle { font-size: 18px; border-top: 1px solid black;  border-bottom: 1px solid black;  }");
		echo(".classgroup { font-size: 12px; border-top: 1px solid black;  border-bottom: 1px solid black;  }");
		echo(".classtitledata { font-size: 14px; border-bottom: 1px dotted black; display: inline;  }");
	echo("</style>");
	echo("<body>");

	echo("<div>run this cronjob every 10 minutes ...<br><br></div>");

	// go through excercises
	$arr=$app->getAllActiveExcercisesByStatusAll();
	for ($i=0;$i<count($arr);$i++)
	{
		$excerciseObj=$arr[$i];
		// do on open excercises ...
		if ($excerciseObj->excerciseStatus=="open")
		{
			echo("<div class='classtitle'>excercise:<br><strong>".$excerciseObj->excerciseName."</strong></div>");

			// groups
			$arrGroups=$app->getAllUsersDistinctGroupInExcercisesByExcerciseId( $excerciseObj->excerciseId );
			
			// go now through all groups ...
			$oldgroup="";
			for ($z=0;$z<count($arrGroups);$z++)
			{
				$userGroupObj=$arrGroups[$z];

				// only once 
				if ($oldgroup==$userGroupObj->userGroup)
				{
					continue;
				}
				$oldgroup=$userGroupObj->userGroup;


				echo("<br><div class='classgroup'>group:".$userGroupObj->userGroup."</div><br>");
				
				// do the tasks for all users 
				$arrTasks=$app->getAllActiveExcerciseTasksFromExcercise( $excerciseObj->excerciseId );
				for ($ip=0;$ip<count($arrTasks);$ip++)
				{
					$excercisetaskObj=$arrTasks[$ip];
					echo("<br>-- <i>[task] ".$excercisetaskObj->excercisetaskName."</i>");

					// check .. here the date - ok to do?

					// checked this task is done?
					// no/yes ...

					// todo: time and date ...
					// _ no 

					// check time actual?
					// if ($this->getExcerciseTaskActual($excercisetaskObj->excercisetaskId))
					// {
					$doThisTask=false;
					
					$taskType=$excercisetaskObj->excercisetaskType;

					if ($taskType=="start") $doThisTask=true;
					if ($taskType=="readtext") $doThisTask=true;
					if ($taskType=="writetext") $doThisTask=true;

					if ($doThisTask)
					{
						$name="group".$userGroupObj->userGroup;
						$valdone=$app->getUserExcerciseTaskAttributeString( -1, $excercisetaskObj->excercisetaskId, "done$name", "no" );

						// val date time
						$valDateTime=$app->getUserExcerciseTaskAttributeDateTime( -1, $excercisetaskObj->excercisetaskId, "$name", "" );
						echo(" <div class='classtitledata'>[$valDateTime]</i></div>");

						// echo("---".$valDateTime."----");
						
						if (
							($valDateTime!="")
							&&
							($valDateTime!="0000-00-00 00:00:00")
						  )
						{
							
							echo(" <i>(done: $valdone)</i>");
							if (($valdone=="no")||($valdone==""))
							// if (true)
							{
								$valDateTime=$app->getUserExcerciseTaskAttributeDateTime( -1, $excercisetaskObj->excercisetaskId, "$name", "" );
		 						// echo("<br>------ <i>date: ".$valDateTime."</i>");
	
								// check date
								$laterThan=false;
	
								$dateLaterThanThis=$app->checkDateOlder( $valDateTime  );
								echo("<br>-------------- /".$app->checkDateOlder( $valDateTime  )."/ 1: to do");
								if ($dateLaterThanThis==1) $laterThan=true;
	
								if ($laterThan)
								{
									echo("<br>-------------- --- do it");
									$html=$app->cronjobDoExcerciseTaskId( $excercisetaskObj->excercisetaskId, $userGroupObj->userGroup, true );
									echo($html);
								}
								else
								{
									echo("<br>-------------- --- done");
								}
	
								// not yet active ... 
							}
						}
						else
						{
							echo("<br>--- <strong>DateTime not set! > stop now here!</strong>");
								
						}
					} // do this task

					// }

				}
				echo("<br>");

			} // / groups

			// / tasks

		}
		// / open excercise

    }
	// / excercises

	// email to send ...

    echo("</body>");

    echo("</html>");

?>