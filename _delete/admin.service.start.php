<?
	// rest services
	
	$debugServices=false;

	// area
	$area=""; if (isset($_REQUEST["area"])) $area="".$_REQUEST["area"];
	$areasub=""; if (isset($_REQUEST["areasub"])) $areasub="".$_REQUEST["area"];
	
	// actions
	$action=""; if (isset($_REQUEST["action"])) $action="".$_REQUEST["action"];
	$actionsub=""; if (isset($_REQUEST["actionsub"])) $actionsub="".$_REQUEST["actionsub"];

	// argument
	$argument=""; if (isset($_REQUEST["argument"])) $argument="".$_REQUEST["argument"];
	$argumentsub=""; if (isset($_REQUEST["argumentsub"])) $argumentsub="".$_REQUEST["argumentsub"];
	
	// output
	$output="";
	
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


	

?>