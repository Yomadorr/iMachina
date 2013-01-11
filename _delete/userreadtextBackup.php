<?

	// include instance
	include("./appinstance.php");

	// excercise task handling
	include("./includes/excercisetaskhandling.user.php");

	// start
	include("./includes/header.inc.php");

	// admin?
	// todo
	
	// id?
	$excerciseId=-1;
	$excersicetaskObject=null;

	// $excerciseObject=$app->getExcerciseById($excerciseId);
	$excerciseId=2;	
	$excerciseObject=$app->getExcerciseById($excerciseId);

	// this excercise
	if (isset($_REQUEST["id"]))
	{
		$excercisetaskId=$app->requestFromWeb("id","integer");
	
	}	

	// excerciseObject
	$excercisetaskObject=$app->getExcerciseTaskById($excercisetaskId);
	$excercisetaskObjId=-1;
	// print_r($excercisetaskObject);

	// is there a text for this 
	// get latest text and insert here ....
	// $app->getLatestText();
	$taskDescription="";

	$textInput="";

	$arr=$app->getTaskWriteTextsByExcerciseTaskAndUser($excercisetaskId,$app->session->userObject->userId);
	// print_r($arr);
	if (count($arr)>0)
	{
		//print_r($arr);

		// arr
		// take first one
		$taskWriteTextObj=$arr[0];

		$taskDescription=$taskWriteTextObj->taskwritetextDescription;


		$excercisetaskObjId=$taskWriteTextObj->taskwritetextId;
		// print_r($taskWriteTextObj);
		// search for texts
		$arrDocument=$app->getTaskWriteTextDocumentsByTaskWriteText( $taskWriteTextObj->taskwritetextId );
		// print_r($arrDocument);
		if (count($arrDocument)>0) 
		{
			$objDocument=$arrDocument[0];
			$textInput="".$objDocument->taskwritetextdocumentText;
		}

	}
	else
	{
		// generate one ...		
		// not existing - make one!
		// $app->insertTaskWriteText();
	}
?>

<h1><a href='userexcercise.php?id=<?=$excerciseObject->excerciseId?>'><?=$excerciseObject->excerciseName?></a></h1>

<!-- display the tasks -->
<?=Display::displayExcerciseTasksBreadCrump( $app, $excercisetaskObject->excercisetaskExcerciseRef, $excercisetaskObject->excercisetaskId )?>

<h2><?=$excercisetaskObject->excercisetaskName?></h2>

<!-- todo: into the database -->
<style> p { font-size: 12px; }</style>

<h3>Leseauftrag</h3>
<p>Stellen Sie sich folgende Situation vor: Die Schule, an der Sie unterrichten, m&ouml;chte ein neues Schwerpunktthema f&uuml;r die schulinterne Weiterbildung festlegen. Alle sind aufgefor&shy;dert, sich ein m&ouml;gliches Thema zu &uuml;berlegen und sich einzulesen.</p>
<p>Sie haben sich entschieden, dass Sie sich mit dem Thema &laquo;Sitzenbleiben&raquo; besch&auml;ftigen m&ouml;chten. Dazu haben Sie sich aus der Fachzeitschrift &laquo;Journal f&uuml;r P&auml;dagogik&raquo; (2/2010) zwei Texte beschafft, die unterschiedliche Standpunkte vertreten.</p>
<p>Bitte lesen Sie die Texte.</p>
<p class="Aufzhlung0">-&nbsp;&nbsp; Sie k&ouml;nnen die Texte bearbeiten und/oder mit eigenen Notizen erg&auml;nzen.</p>
<p class="Aufzhlung0">-&nbsp;&nbsp; Wenn Sie das tun: Gehen Sie dabei m&ouml;glichst so vor, wie Sie es f&uuml;r gew&ouml;hnlich tun: Solche Erg&auml;nzungen werden nicht beurteilt, sondern allenfalls im Hinblick auf eine Beratung beigezogen.</p>
<p class="Normal1"><strong>Hinweis: </strong>Bei den beiden Lesetexten handelt es sich nicht um Originaltexte.</p>
<p>Die Texte zum Downloaden: <a href=''>Texte downloaden als PDF ></a></p>
<h3>Nach dem Lesen</h3>
<p class="Normal1">Die beiden gelesenen Texte bilden die Grundlage f&uuml;r den Schreibauftrag.</p>
<h3>Nach der Schreibaufgabe</h3>
<p class="Normal1">Bitte bewahren Sie die beiden Lesetexte auch nach dem L&ouml;sen der Schreibaufgabe auf, mit Ihren allf&auml;lligen Notizen, Bemerkungen oder was auch immer. Wenn Sie Ihren eige&shy;nen Text selbst beurteilt haben, dies danach mit der R&uuml;ckmeldung zu Ihrem Text verglei&shy;chen, k&ouml;nnen die beiden Lesetexte nochmals eine wichtige Hilfe sein.</p>

<?
	// start
	include("./includes/footer.inc.php");
?>
