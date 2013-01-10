<?

	class Log
	{
		var $debug=false;


        // db 
    	var $logId=-1;
    	var $logAction="";
    	var $logArgument="";
    	var $logUrl="";
    
 		function Log()
        {
        
        }
	
	
	// insert Record to Database
		function insertRecord()
		{
			$sqlInsert="INSERT INTO Log ";

			$sqlInsert=$sqlInsert."(logAction, logUrl ,logArgument,logCreate) ";
			$sqlInsert=$sqlInsert." values ";
			$sqlInsert=$sqlInsert."('".Converter::escapeSql($this->logAction)."','".Converter::escapeSql($this->logUrl)."','".Converter::escapeSql($this->logArgument)."',Now()  )   ";

			return $sqlInsert;
		}
	
		// updateRecord
		function updateRecord()
		{
			$sqlUpdate="update log ";
	
	/*
			$sqlUpdate=$sqlUpdate." set logName='".Converter::escapeSql($this->logName)."',logPreName='".Converter::escapeSql($this->logPreName)."',logType='".Converter::escapeSql($this->logType)."',logGroup='".Converter::escapeSql($this->logGroup)."',logClass='".Converter::escapeSql($this->logClass)."',logEmails='".Converter::escapeSql($this->logEmails)."',logLogin='".Converter::escapeSql($this->logLogin)."',logPassword='".Converter::escapeSql($this->logPassword)."',logPasswordNew='".Converter::escapeSql($this->logPasswordNew)."' ";
			$sqlUpdate=$sqlUpdate." where logId=".Converter::escapeSql($this->logId)."   ";
// echo("Log.updateRecord() ".$sqlUpdate);			
	*/
			return $sqlUpdate;
		}
	

		// deleteRecord 
		function deleteRecord( )
		{
			$query="DELETE FROM log WHERE logId=".Converter::secureForSQL($this->logId)." ";
			return $query;
		}
		
		// update to record in database
		function updateToRecord( $result, $index )
		{
			$this->logId=mysql_result($result, $index,"logId");
			$this->logAction=mysql_result($result, $index,"logAction");
			$this->logCreate=mysql_result($result, $index,"logCreate");

		} 
	
		// Request
		function updateToWebRequest($request)
		{
			
			if (isset($request["logId"]))  {  $this->logId=$request["logId"]; } 

		}
	
		function getAsFormat( $formatType )
		{
			/*
			$delimiter=";";
			$output="";
			
			if ($formatType=="csv")
			{
				$output=$output.$this->logId; $output=$output.$delimiter;
				$output=$output.$this->logSessionId; $output=$output.$delimiter;
				$output=$output.asciionly($this->logCountry); $output=$output.$delimiter;
				$output=$output.asciionly($this->logTown); $output=$output.$delimiter;

				$output=$output.$this->logVirtualX; $output=$output.$delimiter;
				$output=$output.$this->logVirtualY; $output=$output.$delimiter;
				$output=$output.$this->logVirtualZ; $output=$output.$delimiter;

				$output=$output.$this->logLat; $output=$output.$delimiter;
				$output=$output.$this->logLng; $output=$output.$delimiter;
				$output=$output.$this->logAlt; $output=$output.$delimiter;

				$output=$output.$this->logCreate; $output=$output.$delimiter;

				$output=$output.$this->logArgument; $output=$output.$delimiter;
				$uniformValue="0";
				if ($this->logUniform!="") { $uniformValue=$this->logUniform; }
				$output=$output.$uniformValue; $output=$output.$delimiter;

				$output=$output.str_replace("\n","(*)",$this->logText); $output=$output.$delimiter;
				$output=$output.$this->logURL; $output=$output.$delimiter;
				$output=$output.$this->logName; $output=$output.$delimiter;
				$output=$output.$this->logArgument; $output=$output.$delimiter;
				$output=$output.$this->logTeam; $output=$output.$delimiter;
				
				$output=$output."\n";
			}
			
			return $output;
			
		*/
		}
		
	}    
    
?>