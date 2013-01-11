<?
	 // questionnaire

	// do this stuff here
	/*
		TaskQuestionnaire
	*/
	/*
		add an exercise
	*/

	// create a new one? / 
	$inputQuestionObject=new TaskQuestionnaireQuestion();
    // updateto
	$inputQuestionObject->updateToWebRequest($_REQUEST);
	// print_r($frameworkObject);  

//	echo("action=".$action);

	// question

	// add
	if ($action=="addtaskquestionnairequestion")
	{
		$inputQuestionObject->questionStatus="";	
//print_r($inputQuestionObject);		
		// $inputQuestionObject->frameworktaskName=$app->getTaskQuestionnaireNameByType( $inputTaskQuestionnaireObject->frameworktaskType );
		$app->insertTaskQuestionnaireQuestion($inputQuestionObject);
		// special things for every task ...
		// print_r($inputTaskQuestionnaireObject);

		// add some on this
		if ($inputQuestionObject->taskquestionnairequestionType=="selection")
		{
			// nice to have ...
			// insert a yes and no here ...
			// - yes
			// - no
		}

	}
	// update
	if ($action=="updatetaskquestionnairequestion")
	{
		//print_r($inputTaskQuestionnaireObject);
		$inputQuestionObject=$app->getTaskQuestionnaireQuestionById($inputQuestionObject->taskquestionnairequestionId);
		//print_r($inputTaskQuestionnaireObject);
		$inputQuestionObject->updateToWebRequest($_REQUEST);
		//print_r($inputTaskQuestionnaireObject);
		$app->updateTaskQuestionnaireQuestion($inputQuestionObject);

		// really delete the whole thing?
		// todo: ? $inputTaskQuestionnaireObject->frameworktaskStatus=="deleted"
	}
	// delete
	if ($action=="deletetaskquestionnairequestion")
	{
		//print_r($inputTaskQuestionnaireObject);
		$inputQuestionObject=$app->getTaskQuestionnaireQuestionById($inputQuestionObject->taskquestionnairequestionId);
		//print_r($inputTaskQuestionnaireObject);
		$inputQuestionObject->updateToWebRequest($_REQUEST);
		//print_r($inputTaskQuestionnaireObject);
		$app->deleteTaskQuestionnaireQuestion($inputQuestionObject);


		// really delete the whole thing?
		// todo: ? $inputTaskQuestionnaireObject->frameworktaskStatus=="deleted"
	}

			// answer
			if ($action=="addtaskquestionnairequestionanswer")
			{
				$inputQuestionAnswerObject=new TaskQuestionnaireQuestionAnswer();
				$inputQuestionAnswerObject->updateToWebRequest($_REQUEST);

				$inputQuestionAnswerObject->questionanswerStatus="";	

				$app->insertTaskQuestionnaireQuestion($inputQuestionAnswerObject);
		
				//print_r($inputQuestionAnswerObject);		
				// $inputQuestionAnswerObject->frameworktaskName=$app->getTaskQuestionnaireNameByType( $inputTaskQuestionnaireObject->frameworktaskType );
				// $app->getTaskQuestionnaireQuestionAnswerById($inputQuestionAnswerObject);
				// special things for every task ...
				// print_r($inputTaskQuestionnaireObject);
			}
			// update
			if ($action=="updatetaskquestionnairequestionanswer")
			{
				$inputQuestionAnswerObject=new TaskQuestionnaireQuestionAnswer();
				$inputQuestionAnswerObject->updateToWebRequest($_REQUEST);
				//print_r($inputTaskQuestionnaireObject);
				$inputQuestionAnswerObject=$app->getTaskQuestionnaireQuestionAnswerById($inputQuestionAnswerObject->taskquestionnairequestionanswerId);
				//print_r($inputTaskQuestionnaireObject);
				$inputQuestionAnswerObject->updateToWebRequest($_REQUEST);
				//print_r($inputTaskQuestionnaireObject);
				$app->updateTaskQuestionnaireQuestionAnswer($inputQuestionAnswerObject);

				// really delete the whole thing?
				// todo: ? $inputTaskQuestionnaireObject->frameworktaskStatus=="deleted"
			}
			// delete
			if ($action=="deletetaskquestionnairequestionanswer")
			{
				$inputQuestionAnswerObject=new TaskQuestionnaireQuestionAnswer();
				$inputQuestionAnswerObject->updateToWebRequest($_REQUEST);

				//print_r($inputTaskQuestionnaireObject);
				$inputQuestionAnswerObject=$app->getTaskQuestionnaireQuestionAnswerById($inputQuestionAnswerObject->taskquestionnairequestionanswerId);
				//print_r($inputTaskQuestionnaireObject);
				$inputQuestionAnswerObject->updateToWebRequest($_REQUEST);
				//print_r($inputTaskQuestionnaireObject);
				$app->deleteTaskQuestionnaireQuestionAnswer($inputQuestionAnswerObject);


				// really delete the whole thing?
				// todo: ? $inputTaskQuestionnaireObject->frameworktaskStatus=="deleted"
			}


	echo("<table>");

	$arr=$app->getTaskQuestionnaireQuestionsByExcerciseTaskId($excercisetaskObject->excercisetaskId);
	// print_r($arr);

	// print_r($arrQuestions);
	for ($r=0;$r<count($arr);$r++)
	{
		echo("<tr>");
		$questionObj=$arr[$r];

			// dim
			echo("<td valign=top style='border-right: 1px solid black;' width=800>");

			echo("<div class='adminFramworkDim'>");
				// echo($question->taskquestionnairequestionId." ".$question->taskquestionnairequestionName);
					// add a button
					// $dimSubId="dimsub".$question->taskquestionnairequestionId;;
					// $strButton="<input type=button value='Neue Teildimension' onClick=\"$('#$dimSubId').toggle();\">";
				$strField=displayQuestionForm( $questionObj, true, "" );
				echo("<div>".$strField."</div>");
			echo("</div>");

			// sub
			echo("<div class='adminFramworkDimSub'>");
			
				$arrSub=$app->getTaskQuestionnaireQuestionAnswersByQuestionId( $questionObj->taskquestionnairequestionId );
				// print_r($arrSub);
				for ($rr=0;$rr<count($arrSub);$rr++)
				{
					$answerObj=$arrSub[$rr];
					echo("<div >");	
					// echo("".$answerObj->taskquestionnairequestionanswerId."".$answerObj->taskquestionnairequestionanswerName);
					// $answerObj=$app->getTaskQuestionnaireQuestionAnswersByQuestionId( $taskId );
						echo(displayQuestionAnswerForm($answerObj,true,""));

					echo("</div>");	

				}

				// add sub dim ... 
				if ($questionObj->taskquestionnairequestionType=="selection")
				{
					$newQuestionAnswer=new TaskQuestionnaireQuestionAnswer();
					$newQuestionAnswer->taskquestionnairequestionanswerQuestionRef=$questionObj->taskquestionnairequestionId;
					//				$newQuestionAnswer->taskquestionnairequestionRef=$question->taskquestionnairequestionId;
					// $dimSubId="dimsub".$question->taskquestionnairequestionId;;
					echo("<div class='adminFramworkDimSubTitle'>Neue M&ouml;glichkeit".displayQuestionAnswerForm( $newQuestionAnswer, false, "" )."</div>");
				}

			echo("</div>");

			echo("</td>");	
		echo("</tr>");
	}
	$newQuestionObj=new TaskQuestionnaireQuestion();
	$newQuestionObj->taskquestionnairequestionQuestionRef=$excercisetaskObject->excercisetaskId;
	// $newQuestionObj->frameworkRef=-1;
	echo("<tr><td valignt=top style='border-top: 1px dotted black;'><div class='adminFramworkDim'>Neue Frage: ".displayQuestionForm( $newQuestionObj, false )."</div></td></tr>" );
	echo("</table>");
	// echo("</div>");

	function displayQuestionForm( $taskquestionnairequestionObjectForm, $flagUpdate, $strButton="" )
	{
		global $excercisetaskObject;

		/*
		echo("<hr>");
		print_r($taskquestionnairequestionObjectForm);
		echo("<hr>");
		*/

		
		$str="";
			$str=$str."\n<form action='adminexcercisetask.php' _method='post'>";

				$str=$str."\n<input type='hidden' name='excercisetaskId'  value='".$excercisetaskObject->excercisetaskId."'>";

				if (!$flagUpdate) $str=$str."\n<input type='hidden' name='action' value='addtaskquestionnairequestion'>";
				if ($flagUpdate) { $str=$str."\n<input type='hidden' name='action' value='updatetaskquestionnairequestion'>";}
				if ($flagUpdate) { $str=$str."\n<input type=button value='x' onClick=\"if (confirm('Sie sind sicher, dass sie diese Frage loeschen wollen?')) document.location.href='adminexcercisetask.php?action=deletetaskquestionnairequestion&excercisetaskId=".$excercisetaskObject->excercisetaskId."&taskquestionnairequestionId=".$taskquestionnairequestionObjectForm->taskquestionnairequestionId."';\">"; }

				$str=$str."\n<input type='hidden' name='taskquestionnairequestionExcerciseTaskRef'  value='".$excercisetaskObject->excercisetaskId."'>";
				$str=$str."\n<input type='hidden' name='taskquestionnairequestionRef'  value='-1'>";

				// $str=$str."\n<input type='hidden' name='frameworkId'  value='".$frameworkObject->frameworkId."'>";
				$str=$str."\n<input type='hidden' name='taskquestionnairequestionId'  value='".$taskquestionnairequestionObjectForm->taskquestionnairequestionId."'>";
				$str=$str."\n<input type='textfield' size=2 name='taskquestionnairequestionOrder'  value='".$taskquestionnairequestionObjectForm->taskquestionnairequestionOrder."'>";
				$str=$str."\n<input type='textfield' size=25 name='taskquestionnairequestionName'  value='".$taskquestionnairequestionObjectForm->taskquestionnairequestionName."'>";
				if ($flagUpdate) $str=$str."\n<input type='hidden' size=3 name='taskquestionnairequestionType'  value='".$taskquestionnairequestionObjectForm->taskquestionnairequestionType."'> ".$taskquestionnairequestionObjectForm->taskquestionnairequestionType."  ";
				if (!$flagUpdate) 
				{
					$str=$str."\n<select name='taskquestionnairequestionType'>";
						$str=$str."\n<option value='textfield'>Eingabefeld</option>";
						$str=$str."\n<option value='textarea'>Eingabetext</option>";
						$str=$str."\n<option value='selection'>Auswahl</option>";
					$str=$str."\n</select>";
					//   value='".$taskquestionnairequestionObjectForm->taskquestionnairequestionType."'>";
				}

				// $str=$str."\n<textarea cols=30 name='taskquestionnairequestionDescription' >".$taskquestionnairequestionObjectForm->taskquestionnairequestionDescription."</textarea>";
				
				// textareaId
//				$textareaId=$taskquestionnairequestionObjectForm->taskquestionnairequestionId;
//				if ($textareaId==-1) $textareaId="2001";
// echo($textareaId);

				// show description
//				if ($textareaId!=-1) $str=$str."\n<input type=button style='border: 1px dotted gray; ' value=' Beschreibung + ' onClick=\"$('#$textareaId').toggle(100);\">"; 

				if (!$flagUpdate) $str=$str."\n<input type='submit'  value='neu'>";
				if ($flagUpdate) $str=$str."\n<input type='submit'  value='&auml;ndern'>";

				$str=$str.$strButton;

				// $str=$str."\n<div style='display:none;' id='$textareaId'><textarea cols=70 rows=10 name='taskquestionnairequestionDescription'>".$taskquestionnairequestionObjectForm->taskquestionnairequestionDescription."</textarea></div>";
				

			$str=$str."\n</form>";


		return $str;
	}

	// possibilties!
	function displayQuestionAnswerForm( $answerformanswerObject, $flagUpdate, $isFirstCatForm=true )
	{
		global $excercisetaskObject;

		$str="";

		// $isFirstCatForm=true;

		// $str=$str."**( ".$taskquestionnairequestioncatObjectForm.",". $flagUpdate." )***";

			$str=$str."\n<form action='adminexcercisetask.php' _method='post'>";

				if (!$flagUpdate) $str=$str."\n<input type='hidden' name='action' value='addtaskquestionnairequestionanswer'>";
				if ($flagUpdate) { $str=$str."\n<input type='hidden' name='action' value='updatetaskquestionnairequestionanswer'>";}
				if ($flagUpdate) { $str=$str."\n<input type=button value='x' onClick=\"document.location.href='adminexcercisetask.php?action=deletetaskquestionnairequestionanswer&excercisetaskId=".$excercisetaskObject->excercisetaskId."&taskquestionnairequestionanswerId=".$answerformanswerObject->taskquestionnairequestionanswerId."';\">"; }


				$str=$str."\n<input type='hidden' name='excercisetaskId'  value='".$excercisetaskObject->excercisetaskId."'>";
				$str=$str."\n<input type='hidden' name='taskquestionnairequestionanswerQuestionRef'  value='".$answerformanswerObject->taskquestionnairequestionanswerQuestionRef."'>";
				$str=$str."\n<input type='hidden' name='taskquestionnairequestionRef'  value='-1'>";


				$str=$str."\n<input type='hidden' name='taskquestionnairequestionanswerId'  value='".$answerformanswerObject->taskquestionnairequestionanswerId."'>";
				$str=$str."\n<input type='textfield' width=20 size=2 name='taskquestionnairequestionanswerOrder'  value='".$answerformanswerObject->taskquestionnairequestionanswerOrder."'>";
				$str=$str."\n<input type='textfield' size=80 name='taskquestionnairequestionanswerName'  value='".$answerformanswerObject->taskquestionnairequestionanswerName."'>";

				if (!$flagUpdate) $str=$str."\n<input type='submit'  value='neu'>";
				if ($flagUpdate) $str=$str."\n<input type='submit'  value='&auml;ndern'>";
			$str=$str."\n</form>";


		return $str;
	}

?>